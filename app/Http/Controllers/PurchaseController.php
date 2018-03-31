<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Helpers\SessionResetter;
use Session;

use App\Models\Course;
use App\Models\Purchase;
use App\Models\PurchaseDetail;

class PurchaseController extends Controller
{
  public function __construct()
  {
     // $this->middleware('auth');
  }

  public function sandbox()
  {
    $user_id = Auth::user()->id;

    $purchasedCourse = Course
      ::join('purchasedetails', 'courses.id', 'purchasedetails.course_id')
      ->join('purchase', 'purchasedetails.purchase_id', 'purchase.id')
      ->where('purchase.student_id', '=', Auth::user()->id)
      ->get();

    $purchasedCourseID = $purchasedCourse->pluck('course_id');    

    $myWishlist = Course
      ::with('review', 'user', 'promotion')
      ->whereIn('id', $purchasedCourseID)
      ->select('id', 'title', 'price', 'promotion_id', 'instructor_id')
      ->get();

    $sum_rating = 0;
    foreach ($myWishlist as $course) {
      if ( count($course->review)){
        foreach ($course->review as $review)
          $sum_rating += $review->rating;

        $course['average_rating'] = $sum_rating / count($course->review);
        $sum_rating = 0;
      }
      else 
        $course['average_rating'] = 0;
    }

    foreach ($myWishlist as $course) {
      if ($course->promotion !== null) {
        $value = $course->promotion->discount_value;
        $type = $course->promotion->discount_type;
        $price = $course->price;

        if ($type == 'VALUE')
          $course['discounted_price'] = $price - $value;
        elseif ($type == 'PERCENT')
          $course['discounted_price'] = $price - (( $price * $value ) / 100 );

        if ($course['discounted_price'] < 200)
          $course['discounted_price'] = 200;
      }
    }

    $myCourse = Course
      ::with([
        'user', 
        'user.student', 
        'review'=>function($query) use ($user_id) {$query
            ->where('user_id', ($user_id));}
        ])
      ->whereIn('id', $purchasedCourseID)
      ->get();   

    $data['myCourse'] = $myCourse;   
    $data['myWishlist'] = $myWishlist;   

    return $data;

    return view('testsandbox')
    ->with('data', $data);
  }

  public function cart()
  {
    $data = null;
    $totalPrice = 0;

    if(session()->get('cart') != null) {
      $data = Course::with([
          'promotion', 
          'user'=>function($query){$query
            ->select('id', 'name', 'last_name');}
        ])
        ->whereIn('id', session()->get('cart'))
        ->get();
    }

    if($data != null)
      foreach ($data as $course) {
        if ($course->promotion !== null){
          $value = $course->promotion->discount_value;
          $type = $course->promotion->discount_type;
          $price = $course->price;

          if ($type == 'VALUE')
            $course['discounted_price'] = $price - $value;
          elseif ($type == 'PERCENT')
            $course['discounted_price'] = $price - (( $price * $value ) / 100 );

          if ($course['discounted_price'] < 200)
            $course['discounted_price'] = 200;

          $totalPrice += $course['discounted_price'];
        }
        else 
          $totalPrice += $course->price;
      }

    return view('cart/app')
      ->with('data', $data)
      ->with('totalPrice', $totalPrice);
  }

  public function cartAddCourse(Request $request)
  {
    if (session()->get('cart') == null)
      session()->push('cart', $request->course_id);
    elseif (! in_array( $request->course_id , session()->get('cart')))
      session()->push('cart', $request->course_id);

    return redirect('cart');
  }

  public function cartRemoveCourse(Request $request)
  {
    if (($key = array_search($request->course_id, session()->get('cart'))) !== false) {
      session()->forget('cart.'.$key); 
    }

    return redirect('cart');
  }

  public function checkout()
  {
    if(session()->get('cart') === null || Auth::guest())
      return redirect('/');

    $invoice = '';
    $dummyid = '';
    while($invoice == $dummyid){
      $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
      $invoice = '';
      $max = strlen($characters) - 1;
      for ($i = 0; $i < 10; $i++)
        $invoice .= $characters[mt_rand(0, $max)];
      if(Purchase::where('invoice', '=', $invoice)->first())
        $dummyid = Purchase::where('invoice', '=', $invoice)->first()->invoice;
    }
    $rand_invoice = array($invoice);
    $rand_invoice = $rand_invoice[0] . '-' . Auth::user()->id; 

    $data = null;
    $totalPrice = 0;

    $data = Course::with([
        'promotion', 
        'user'=>function($query){$query
          ->select('id', 'name', 'last_name');}
      ])
      ->whereIn('id', session()->get('cart'))
      ->get();

    $pluck_ids = $data->pluck('id');
    $course_ids = [];
    $course_price = [];
    
    foreach ($data as $course) {
      if ($course->promotion !== null){
        $value = $course->promotion->discount_value;
        $type = $course->promotion->discount_type;
        $price = $course->price;

        if ($type == 'VALUE')
          $course['discounted_price'] = $price - $value;
        elseif ($type == 'PERCENT')
          $course['discounted_price'] = $price - (( $price * $value ) / 100 );

        if ($course['discounted_price'] < 200)
          $course['discounted_price'] = 200;

        $totalPrice += $course['discounted_price'];
        array_push($course_price, $course['discounted_price']);
      }
      else {
        $totalPrice += $course->price;
        array_push($course_price, $course->price);
      }
    }

    foreach($pluck_ids as $i => $id) {
      array_push($course_ids, $id);
      array_push($course_ids, $course_price[$i]);
    }
  
    $course_ids = implode('|', $course_ids);

    $paypalItems = [];
    foreach ($data as $index => $course) {
      $price = ($course->promotion === null) 
        ? $course->price
        : $course['discounted_price'];

      array_push($paypalItems, [
        'name' =>       $course->title,
        'quantity' =>   '1',
        'price' =>      $price,
        'currency' =>   'THB'
      ]);
    }

    return view('checkout/app')
      ->with('data', $data)
      ->with('totalPrice', $totalPrice)
      ->with('paypalItems', $paypalItems)
      ->with('rand_invoice', $rand_invoice)
      ->with('course_ids', $course_ids);
  }

  public function paypalFinishTransaction(Request $request)
  {
    $id = substr($request->invoice_number, 0, 10);

    $purchase = new Purchase();
    $purchase->id                       = $id;
    $purchase->invoice                  = $request->invoice_number;
    $purchase->payment_type             = 'PAYPAL';
    $purchase->status                   = $request->status;
    $purchase->paypal_pay_id            = $request->pay_id;
    $purchase->paypal_payer_id          = $request->payer_id;
    $purchase->paypal_payer_email       = $request->payer_email;
    $purchase->paypal_payer_firstname   = $request->payer_first_name;
    $purchase->paypal_payer_middlename  = $request->payer_middle_name;
    $purchase->paypal_payer_lastname    = $request->payer_last_name;
    $purchase->paypal_paid_amount       = $request->total;
    $purchase->paypal_trans_id          = $request->transaction_id;
    $purchase->student_id               = Auth::user()->id;
    $purchase->save();

    $course_ids = [];
    $details = explode("|", $request->custom);
    foreach($details as $i => $detail) {
      if ($i % 2 == 0) {
        $purchasedetails = new PurchaseDetail();
        $purchasedetails->purchase_id   = $id;
        $purchasedetails->status        = 'PAID';
        $purchasedetails->course_id     = $detail;
        $purchasedetails->sold_price    = $details[$i + 1];
        $purchasedetails->save();
        array_push($course_ids, $detail);
      }
    }

    SessionResetter::wishlist(Auth::user()->id);

    $courses = Course::whereIn('id', $course_ids)->get();

    Session::flash('complete_courses', $courses); 

    return redirect('/complete');
  }

  public function completedMessage()
  {
    return view('checkout/complete');
  }

  public function paypalPDT(Request $request)
  {
    $data = [];

    // return $request;

    $data['txn_id']                 = $request->txn_id;
    $data['custom']                 = $request->custom;
    $data['txn_type']               = $request->txn_type;
    $data['verify_sign']            = $request->verify_sign;
    $data['verify_version']         = $request->verify_version;
    $data['protection_eligibility'] = $request->protection_eligibility;
  
    $data['payer'] = [
      'payer_email' => $request->payer_email, 
      'payer_id' => $request->payer_id, 
      'payer_status' => $request->payer_status,
      'first_name' => $request->first_name,
      'last_name' => $request->last_name
    ];

    $data['receiver'] = [
      'receiver_id' => $request->receiver_id,
      'business' => $request->business
    ];

    $data['product'] = [
      'num_cart_items' => $request->num_cart_items,
      'item_name1' => $request->item_name1,
      'quantity1' => $request->quantity1,
      'mc_gross_1' => $request->mc_gross_1,
      'item_name2' => $request->item_name2,
      'quantity2' => $request->quantity2,
      'mc_gross_2' => $request->mc_gross_2
    ];

    $data['payment'] = [
      'payment_type' => $request->payment_type,
      'payment_date' => $request->payment_date,
      'payment_fee' => $request->payment_fee,
      'payment_gross' => $request->payment_gross,
      'payment_status' => $request->payment_status,
      'mc_currency' => $request->mc_currency,
      'mc_fee' => $request->mc_fee,
      'mc_gross' => $request->mc_gross,
      'tax' => $request->tax
    ];
    
    return $data;
    return $request;
    return 'got post return from paypal';
  }
}
