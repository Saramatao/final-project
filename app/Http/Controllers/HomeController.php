<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Services\HomeService;

use App\Models\Course;
use App\Models\Wishlist;
use App\Models\Purchase;
use App\Models\Collection;

class HomeController extends Controller
{
  protected $homeService;

  public function __construct
  (
    HomeService $homeService
  )
  {
    $this->middleware('auth');
    $this->homeService = $homeService;
  }

  public function myCourses()
  {
    $user_id = Auth::user()->id;
    
    $purchasedCourseID = Course
      ::join('purchasedetails', 'courses.id', 'purchasedetails.course_id')
      ->join('purchase', 'purchasedetails.purchase_id', 'purchase.id')
      ->where('purchase.student_id', '=', Auth::user()->id)
      ->get()
      ->pluck('course_id');

    $wistlistCourseID = Course
      ::join('wishlists', 'courses.id', 'wishlists.course_id')
      ->where('wishlists.student_id', '=', Auth::user()->id)
      ->get()
      ->pluck('course_id');    

    $myWishlist = Course
      ::with('review', 'user', 'promotion')
      ->whereIn('id', $wistlistCourseID)
      ->select('id', 'title', 'slug', 'cover_image', 'price', 'promotion_id', 'instructor_id')
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
        'section',
        'section.lecture',
        'section.lecture.progress'=>function($query) use ($user_id) {$query
          ->where('student_id', ($user_id));},
        'user', 
        'user.student', 
        'review'=>function($query) use ($user_id) {$query
          ->where('user_id', ($user_id));}
        ])
      ->whereIn('id', $purchasedCourseID)
      ->get();   

    $data['myCourse'] = $myCourse;   
    $data['myWishlist'] = $myWishlist;   
    
    foreach ($data['myCourse'] as $course) {
      $count_lecture = 0;

      foreach ($course->section as $section) {
        foreach ($section->lecture as $lecture) {
          $count_lecture++; 
        }
      }

      $course['count_lecture'] = $count_lecture;
    }

    foreach ($data['myCourse'] as $course) {
      $count_progress = 0;
      
      foreach ($course->section as $section) {
        foreach ($section->lecture as $lecture) {
          if ($lecture->progress != null) 
            $count_progress++;
        }
      }

      $course['count_progress'] = $count_progress;
      $course['learn_progress'] = ($count_progress / $course['count_lecture']) * 100;
    }

    $myCollection = Collection
      ::with([
        'collectiondetail', 
        'collectiondetail.course',
        'collectiondetail.course.user',
        'collectiondetail.course.user.student',

        'collectiondetail.course.section',
        'collectiondetail.course.section.lecture',
        'collectiondetail.course.section.lecture.progress'
          =>function($query) use ($user_id) {$query
          ->where('student_id', ($user_id));},

        'collectiondetail.course.review'=>function($query) use ($user_id) {$query
          ->where('user_id', ($user_id));}
        ])
      ->where('student_id', '=', Auth::user()->id)
      ->get();

    foreach ($data['myCourse'] as $course) {
      $count_lecture = 0;

      foreach ($course->section as $section) {
        foreach ($section->lecture as $lecture) {
          $count_lecture++; 
        }
      }

      $course['count_lecture'] = $count_lecture;
    }

    foreach ($data['myCourse'] as $course) {
      $count_progress = 0;
      
      foreach ($course->section as $section) {
        foreach ($section->lecture as $lecture) {
          if ($lecture->progress != null) 
            $count_progress++;
        }
      }

      $course['count_progress'] = $count_progress;
      $course['learn_progress'] = ($count_progress / $course['count_lecture']) * 100;
    }

    $data['myCollection'] = $myCollection;

    foreach ($data['myCollection'] as $collection) {
      foreach ($collection->collectiondetail as $detail) {
        $count_lecture = 0;

        foreach ($detail->course->section as $section) {
          foreach ($section->lecture as $lecture) {
            $count_lecture++; 
          }
        }

        $detail->course['count_lecture'] = $count_lecture;
      }
    }

    foreach ($data['myCollection'] as $collection) {
      foreach ($collection->collectiondetail as $detail) {
        $count_progress = 0;
        
        foreach ($detail->course->section as $section) {
          foreach ($section->lecture as $lecture) {
            if ($lecture->progress != null) 
              $count_progress++;
          }
        }

        $detail->course['count_progress'] = $count_progress;
        $detail->course['learn_progress'] = ($count_progress / $detail->course['count_lecture']) * 100;
      }
    }

    return view('home/my-courses/app')
      ->with('data', $data);
  }

  public function teaching()
  {
    $data = Course::where('instructor_id', '=', Auth::user()->id)
      ->orderBy('created_at', 'desc')
      ->get();
    return view('home/teaching/app')
      ->with('data', $data);
  }

  public function transaction()
  {
    $data = Purchase::with([
        'purchasedetail', 
        'purchasedetail.course'=> function($query) {
          $query->where('instructor_id', Auth::user()->id);
      }])
      ->where('status', 'completed')
      ->orderBy('created_at', 'desc')
      ->get();

    $myTeachCourses = Course::where('instructor_id', Auth::user()->id)
      ->get();

    $transactions = [];
    foreach ($data as $purchase) {
      foreach ($purchase->purchasedetail as $purchasedetail) {
        $purchasedetail->get_price = $purchasedetail->sold_price / 2;
        if ($purchasedetail->course !== null)
          $transactions[] = $purchasedetail;
      }
    }

    foreach ($myTeachCourses as $course) {
      $course->total_sold_price = 0;
      $course->total_sold_qty = 0;
    }

    foreach ($transactions as $trans) {
      foreach ($myTeachCourses as $course) {
        if ($trans->course_id === $course->id) {
          $course->total_sold_price += $trans->sold_price;
          $course->total_sold_qty ++;
        }
      }
    }

    $format_data = new \stdClass();
    $format_data->total_sold_price = 0;
    $format_data->total_get_price = 0;
    $format_data->total_sold_qty = 0;

    foreach ($myTeachCourses as $course) {
      $course->total_get_price = $course->total_sold_price / 2;

      $format_data->total_get_price += $course->total_get_price;
      $format_data->total_sold_price += $course->total_sold_price;
      $format_data->total_sold_qty += $course->total_sold_qty;
    }

    
    foreach ($myTeachCourses as $course) {
      $purchased = [];
      foreach ($transactions as $trans) {
        if ($trans->course_id === $course->id)
          $purchased[] = $trans;
      }
      $course->transaction = $purchased;
    }

    // return $myTeachCourses;
    // return $transactions;
    return view('home/teaching/transaction')
      ->with('data', $transactions)
      ->with('myTeachCourses', $myTeachCourses)
      ->with('format_data', $format_data);
  }
}