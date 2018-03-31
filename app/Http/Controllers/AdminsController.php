<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Course;
use App\Models\Promotion;
use App\Models\Student;
use App\Models\Instructor;
use App\Models\Category;
use App\Models\Advertisement;
use App\Models\Purchase;
use App\Models\AbuseReport;

class AdminsController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function checkAuthAdmin()
  {
    return ( Auth::user()->role !== '3' );
  }

  public function index()
  {
    return view('admin/index');
  }

  public function login()
  {
    return view('admin/login');
  }

  public function courses()
  {
    if ($this->checkAuthAdmin()) return redirect('/');
    $data = Course
      ::with('category', 'user', 'promotion')
      ->orderBy('created_at', 'desc')
      ->paginate(10);

    return view('admin/courses')
      ->with('data', $data);
  }

  public function coursesPending()
  {
    if ($this->checkAuthAdmin()) return redirect('/');
    $data = Course
      ::with('category', 'user', 'promotion')
      ->where('license', 'PENDING')
      ->orderBy('created_at', 'desc')
      ->paginate(10);

    return view('admin/courses-pending')
      ->with('data', $data);
  }

  public function courseDetail($course_id)
  {
    if ($this->checkAuthAdmin()) return redirect('/');
    $data = Course
      ::with('section', 'section.lecture')
      ->where('id', '=', $course_id)
      ->first();
   
    return view('admin/coursedetails')
      ->with('data', $data);
  }

  public function promotions()
  {
    if ($this->checkAuthAdmin()) return redirect('/');
    $data = Promotion::paginate(10);

    return view('admin/promotions')
      ->with('data', $data);
  }

  public function students()
  {
    if ($this->checkAuthAdmin()) return redirect('/');
    $data = User
      ::with('student')
      ->where('role', '<>', '3')
      ->paginate(10);

    return view('admin/students')
      ->with('data', $data);
  }

  public function instructors()
  {
    if ($this->checkAuthAdmin()) return redirect('/');
    $data = Instructor::with('user','user.student')->paginate(10);

    return view('admin/instructors')
      ->with('data', $data);
  }

  public function categories()
  {
    if ($this->checkAuthAdmin()) return redirect('/');
    $data = Category::with('course')->get();

    foreach ($data as $category) {
      $count_course = 0;

      foreach ($category->course as $course)
        $count_course++; 
    
      $category['count_course'] = $count_course;
    }

    return view('admin/categories')
      ->with('data', $data);
  }

  public function advertisements()
  {
    if ($this->checkAuthAdmin()) return redirect('/');
    $data = Advertisement::with('course')->get();

    return view('admin/advertisements')
      ->with('data', $data);
  }

  public function purchase()
  {
    if ($this->checkAuthAdmin()) return redirect('/');
    $data = Purchase::with('purchasedetail')->paginate(10);

    foreach ($data as $purchase) {
      $sum_price = 0;

      foreach ($purchase->purchasedetail as $purchasedetail)
        $sum_price += $purchasedetail->sold_price;
    
      $purchase['sum_price'] = $sum_price;
    }

    return view('admin/purchase')
      ->with('data', $data);
  }

  public function abusereport()
  {
    if ($this->checkAuthAdmin()) return redirect('/');
    $data = AbuseReport::paginate(10);

    return view('admin/abusereport')
      ->with('data', $data);
  }

  // SEARCH

  public function searchCourses(Request $request)
  {
    $data = Course
      ::where('id', 'like', '%'.$request->course_id.'%')
      ->where('slug', 'like', '%'.$request->slug.'%')
      ->where('promotion_id', 'like', '%'.$request->promotion_id.'%')
      ->paginate(10);
   
    return view('admin/courses')
      ->with('data', $data);
  }

  public function searchPromotions(Request $request)
  {
    $data = Promotion
      ::where('id', 'like', '%'.$request->promotion_id.'%')
      ->where('name', 'like', '%'.$request->name.'%')
      ->paginate(10);
   
    return view('admin/promotions')
      ->with('data', $data);
  }

  public function searchStudents(Request $request)
  {
    $data = User
      ::where('role', '<>', '3')
      ->where('id', 'like', '%'.$request->user_id.'%')
      ->where('name', 'like', '%'.$request->name.'%')
      ->where('last_name', 'like', '%'.$request->last_name.'%')
      ->where('email', 'like', '%'.$request->email.'%')
      ->paginate(10);

    return view('admin/students')
      ->with('data', $data);
  }

  public function searchInstructors(Request $request)
  {
    $data = User
      ::where('role', '=', '2')
      ->where('id', 'like', '%'.$request->user_id.'%')
      ->where('name', 'like', '%'.$request->name.'%')
      ->where('last_name', 'like', '%'.$request->last_name.'%')
      ->where('email', 'like', '%'.$request->email.'%')
      ->paginate(10);
   
    return view('admin/instructors')
      ->with('data', $data);
  }

  public function searchCategories(Request $request)
  {
    // $data = Course
    //   ::where('id', 'like', '%'.$request->course_id.'%')
    //   ->where('slug', 'like', '%'.$request->slug.'%')
    //   ->where('promotion_id', 'like', '%'.$request->promotion_id.'%')
    //   ->paginate(10);
   
    return view('admin/categories')
      ->with('data', $data);
  }

  public function searchAdvertisements(Request $request)
  {
    // $data = Course
    //   ::where('id', 'like', '%'.$request->course_id.'%')
    //   ->where('slug', 'like', '%'.$request->slug.'%')
    //   ->where('promotion_id', 'like', '%'.$request->promotion_id.'%')
    //   ->paginate(10);
   
    return view('admin/advertisements')
      ->with('data', $data);
  }

  public function searchPurchase(Request $request)
  {
    // $data = Course
    //   ::where('id', 'like', '%'.$request->course_id.'%')
    //   ->where('slug', 'like', '%'.$request->slug.'%')
    //   ->where('promotion_id', 'like', '%'.$request->promotion_id.'%')
    //   ->paginate(10);
   
    return view('admin/purchase')
      ->with('data', $data);
  }

  public function searchAbusement(Request $request)
  {
    // $data = Course
    //   ::where('id', 'like', '%'.$request->course_id.'%')
    //   ->where('slug', 'like', '%'.$request->slug.'%')
    //   ->where('promotion_id', 'like', '%'.$request->promotion_id.'%')
    //   ->paginate(10);
   
    return view('admin/abusereport')
      ->with('data', $data);
  }

}
