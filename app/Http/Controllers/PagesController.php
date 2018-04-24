<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Wishlist;
use App\Models\Course;
use App\Models\Advertisement;
use App\Models\Purchase;
use App\Models\Lecture;

use App\Helpers\SessionResetter;
use Auth;

use App\Services\PageService;

class PagesController extends Controller
{
  protected $pageService;

  public function __construct(PageService $pageService)
  {
    $this->pageService = $pageService;
  }

  public function index()
  {
    $dataset = $this->pageService->index();

    $adverts = Advertisement
      ::with('course')
      ->get();

    if (! Auth::guest()) {
      SessionResetter::wishlist(Auth::user()->id);
      $purchasedCourses = Purchase
        ::join('purchasedetails', 'purchase.id', '=', 'purchasedetails.purchase_id')
        ->where('student_id', Auth::user()->id)
        ->where('purchasedetails.status', 'PAID')
        ->select('course_id')
        ->get()
        ->pluck('course_id');

      foreach ($purchasedCourses as $pur_id) 
        foreach($dataset as $i => $data) 
          if ($data->id == $pur_id) 
            unset($dataset[$i]);
    }

    // return $dataset;

    return view('index/app')
      ->with('dataset', $dataset)
      ->with('adverts', $adverts);
  }

  public function view($slug)
  {
    $data = $this->pageService->view($slug);

    if (! ($data))
      return redirect()->route('invalid-url');

    if (! Auth::guest()) {
      $course_id = Course
        ::where('slug', '=', $slug)
        ->first()
        ->id;

      $wishlist = Wishlist
        ::where('course_id', '=', $course_id)
        ->where('student_id', '=', Auth::user()->id)
        ->first();

      $data['isWishlisted'] = ($wishlist) ? true : false ;

      $purchasedCourses = Purchase
        ::join('purchasedetails', 'purchase.id', '=', 'purchasedetails.purchase_id')
        ->where('student_id', Auth::user()->id)
        ->where('purchasedetails.status', 'PAID')
        ->select('course_id')
        ->get()
        ->pluck('course_id');

      foreach ($purchasedCourses as $pur_id)
        if ($course_id == $pur_id) 
          return redirect("/learn/$slug/dashboard");
    }
    
    return view('view/app')
      ->with('data', $data);
  }

  public function previewLecture($lecture_id)
  {
    $data = Lecture
      ::where('id', $lecture_id)
      ->where('status', 'FREE')
      ->first();

    if (! $data)
      return redirect('/');

    // return response()->download(storage_path('app/'.$lecture->content_path), null, [], null);
    return view('view/preview')
      ->with('data', $data);
  }

  public function becomeInstructor() 
  {
    if (Auth::user()->role == 1)
      return view('become-instructor');

    return redirect()->back();
  }

  public function searchPage()
  {
    $courses = $this->pageService->index();

    return view('search/app')
      ->with('courses', $courses);
  }

  public function search($name)
  {
    $courses = Course
      ::where('title', 'like', "%$name%")
      // ->where('license', 'PASS')
      ->get();

    return view('search/app')
      ->with('courses', $courses);
  }

  public function searchForm(Request $request)
  {
    $courses = Course
      ::where('title', 'like', '%'. $request->searchTxt .'%')
      ->where('license', 'PASS')
      ->get();

    return view('search/app')
      ->with('courses', $courses);
  }
}