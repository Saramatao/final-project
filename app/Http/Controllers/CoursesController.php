<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Services\LearnService;

use App\Models\Course;
use App\Models\Section;
use App\Models\Lecture;
use App\Models\Category;
use App\Models\Coupon;

use App\Models\Target;
use App\Models\Benefit;
use App\Models\Prerequisite;

class CoursesController extends Controller
{
  protected $learnService;

  public function __construct(LearnService $learnService)
  {
    $this->middleware('auth');
    $this->learnService = $learnService;
  }

  public function editTitle($course_id)
  {
    $data = Course::find($course_id);
    $categories = Category::all();

    $data->disable = ($data->license == 'PENDING') ? true : false ;

    return view('course/edit-title')
      ->with('data', $data)
      ->with('categories', $categories);
  }

  public function editDetail($course_id)
  {
    $data = Course::with('target', 'prerequisite', 'benefit')
      ->where('id', '=', $course_id)
      ->first();

    $target = count(Target::where('course_id', '=', $course_id)->get());
    $prerequisite = count(Prerequisite::where('course_id', '=', $course_id)->get());
    $benefit = count(Benefit::where('course_id', '=', $course_id)->get());
  
    $data['count_target'] = $target;
    $data['count_prerequisite'] = $prerequisite;
    $data['count_benefit'] = $benefit;

    // return $data;
    return view('course/edit-detail')
      ->with('data', $data);
  }

  public function editPriceCoupon($course_id)
  {
    $data = Course::with([
      'coupon'=>function($query){$query
      ->orderBy('created_at', 'desc');}
    ])
      ->where('id', '=', $course_id)
      ->first();

    $data['current_date'] = date("Y/m/d");
    // return $data;

    return view('course/edit-price-coupon')
      ->with('data', $data);
  }

  public function editCirriculum($course_id)
  {
    $course = Course::with([
        'section',
        'section.lecture'=>function($query){$query
          ->orderBy('created_at');}
      ])
      ->where('id', '=', $course_id)
      ->first();

    $course->disable = (
      $course->license == 'PENDING' || 
      $course->license == 'BAN' || 
      $course->license == 'PASS') ? true : false ;

    foreach ($course->section as $i=>$section)
      foreach ($section->lecture as $j=>$lecture)
        if ($section->sub_number != $lecture->sub_number)
          unset($course['section'][$i]['lecture'][$j]);

    // return $course;
    return view('course/edit-cirriculum')
      ->with('data', $course);
  }

  public function editSetting($course_id)
  {
    $data = Course::find($course_id);

    return view('course/edit-setting')
      ->with('data', $data);
  }

  // ==========================================================
  // ==========================================================

  public function createCourse(Request $request)
  {
    $id1 = '';
    $id2 = '';
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    while($id1 == $id2){
      $id1 = '';
      $max = strlen($characters) - 1;
      for ($i = 0; $i < 10; $i++)
        $id1 .= $characters[mt_rand(0, $max)];

      if(Course::find($id1))
        $id2 = Course::find($id1)->id;
    }
    $rand_id = array($id1);

    $course = new Course();
    $course->id = $rand_id[0];
    $course->title = $request->title;
    $course->slug = $rand_id[0];
    $course->instructor_id = Auth::user()->id;
    $course->save();

    return response()->json(['success' => 'create course succeed']);
  }

  public function saveLectureVdo(Request $request)
  {
    if ($request->hasFile('file')) {
      $lecture = Lecture::find($request->lecture_id);

      if (
        $lecture->content_path != null &&
        $lecture->content_path != 'lectures/sample-slide.pdf' &&
        $lecture->content_path != 'lectures/sample-vdo.mp4'
        )
        if( is_file( storage_path('app/' . $lecture->content_path)))
          unlink( storage_path('app/' . $lecture->content_path));

      $filename = $request->file->store('lectures');

      $lecture->content_type = 'VDO';
      $lecture->content_text = null;
      $lecture->content_path = $filename;
      $lecture->save();
    }
    return response('อัพโหลดไฟล์สำเร็จ!');
  }

  public function saveLecturePdf(Request $request)
  {
    if ($request->hasFile('file')) {
      $lecture = Lecture::find($request->lecture_id);

      if (
        $lecture->content_path != null &&
        $lecture->content_path != 'lectures/sample-slide.pdf' &&
        $lecture->content_path != 'lectures/sample-vdo.mp4'
        )
        if( is_file( storage_path('app/' . $lecture->content_path)))
          unlink( storage_path('app/' . $lecture->content_path));

      $filename = $request->file->store('lectures');

      $lecture->content_type = 'PDF';
      $lecture->content_text = null;
      $lecture->content_path = $filename;
      $lecture->save();
    }
    return response('อัพโหลดไฟล์สำเร็จ!');
  }

  public function saveLectureTxt(Request $request)
  {
    $lecture = Lecture::find($request->lecture_id);

    if (
      $lecture->content_path != null &&
      $lecture->content_path != 'lectures/sample-slide.pdf' &&
      $lecture->content_path != 'lectures/sample-vdo.mp4'
      )
      if( is_file( storage_path('app/' . $lecture->content_path)))
        unlink( storage_path('app/' . $lecture->content_path));

    $lecture->content_type = 'TXT';
    $lecture->content_text = $request->lecture_text;
    $lecture->content_path = null;
    $lecture->save();
    
    return response()->json(['success' => 'save lecture text succeed']);
  }

  public function saveLecture(Request $request)
  {
    if ($request->lecture_id) {
      $lecture = Lecture::find($request->lecture_id);
    } else {
      $id1 = '';
      $id2 = '';
      $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
      while($id1 == $id2){
        $id1 = '';
        $max = strlen($characters) - 1;
        for ($i = 0; $i < 10; $i++)
          $id1 .= $characters[mt_rand(0, $max)];
  
        if(Lecture::find($id1))
          $id2 = Lecture::find($id1)->id;
      }
      $rand_id = array($id1);
  
      $lecture = new Lecture();
      $lecture->id = $rand_id[0];
      $lecture->sub_number = $request->section_sub_number;
      $lecture->course_id = $request->course_id;
    }

    $lecture->title = $request->title;
    $lecture->status = $request->status;
    $lecture->save();

    return response()->json(['success' => 'save lecture succeed']);
  }

  public function deleteLecture(Request $request)
  {
    if ($request->lecture_id) {
      $lecture = Lecture::find($request->lecture_id);
      $lecture->delete();
    }

    return response()->json(['success' => 'delete lecture succeed']);
  }

  public function saveSection(Request $request)
  {
    if ($request->section_sub_number) 
      $section = Section::find($request->section_sub_number);
    else {
      $section = new Section();
      $section->course_id = $request->course_id;
    }

    $section->title = $request->title;
    $section->objective = $request->objective;
    $section->save();

    return response()->json(['success' => 'save section succeed']);
  }

  public function deleteSection(Request $request)
  {
    if ($request->section_sub_number) {
      $section = Section::find($request->section_sub_number);
      $section->lecture()->delete();
      $section->delete();
    }

    return response()->json(['success' => 'delete section succeed']);
  }

  public function savePrice(Request $request)
  {
    $course = Course::find($request->course_id);
    $course->price = $request->price;
    $course->save();

    return response()->json(['success' => 'save price succeed']);
  }

  public function createCoupon(Request $request)
  {
    $coupon = new Coupon();
    $coupon->discounted_price = $request->discounted_price;
    $coupon->quantity = $request->quantity;
    $coupon->course_id = $request->course_id;

    if($request->stop_date)
      $coupon->stop_date = $request->stop_date;

    $id1 = '';
    $id2 = '';
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    while($id1 == $id2){
      $id1 = '';
      $max = strlen($characters) - 1;
      for ($i = 0; $i < 10; $i++)
        $id1 .= $characters[mt_rand(0, $max)];

      if(Coupon::find($id1))
        $id2 = Coupon::find($id1)->code;
    }
    $rand_id = array($id1);

    $coupon->code = $rand_id[0];
    $coupon->save();

    return response()->json(['success' => 'save coupon succeed']);
  }

  public function saveTarget(Request $request)
  {
    $course_target = Target::where('course_id', '=', $request->course_id);
    $course_target->delete();

    foreach ($request->target as $index=>$target) {
      if ($target !== null) {
        $new_target = new Target();
        $new_target->course_id = $request->course_id;
        $new_target->sub_number = $index;
        $new_target->detail = $target;
        $new_target->save();
      }
    }

    $course_target = Target::where('course_id', '=', $request->course_id)->get();

    return response()->json(['success' => $course_target]);
  }

  public function saveBenefit(Request $request) 
  {
    $course_benefit = Benefit::where('course_id', '=', $request->course_id);
    $course_benefit->delete();

    foreach ($request->benefit as $index=>$benefit) {
      if ($benefit !== null) {
        $new_benefit = new Benefit();
        $new_benefit->course_id = $request->course_id;
        $new_benefit->sub_number = $index;
        $new_benefit->detail = $benefit;
        $new_benefit->save();
      }
    }

    return response()->json(['success' => 'save benefit succeed']);
  }

  public function savePrerequisite(Request $request)
  {
    $course_prerequisite = Prerequisite::where('course_id', '=', $request->course_id);
    $course_prerequisite->delete();

    foreach ($request->prerequisite as $index=>$prerequisite) {
      if ($prerequisite !== null) {
        $new_prerequisite = new Prerequisite();
        $new_prerequisite->course_id = $request->course_id;
        $new_prerequisite->sub_number = $index;
        $new_prerequisite->detail = $prerequisite;
        $new_prerequisite->save();
      }
    }

    return response()->json(['success' => 'save prerequisite succeed']);
  }

  public function updateTitle(Request $request)
  {
    $course = Course::find($request->course_id);
    $course->title = $request->title;
    $course->subtitle = $request->subtitle;
    // $course->slug = $request->slug;
    $course->description = $request->description;
    $course->level = $request->level;
    $course->language = $request->language;
    $course->category_id = $request->category_id;
    $course->save();

    return response()->json(['success' => 'update course title succeed']);
  }

  public function updateImage(Request $request)
  {
    if ($request->hasFile('cover_image')) {
      $course = Course::find($request->course_id);

      if ($course->cover_image != 'cover_images/default-cover-image.jpg')
        if( is_file( storage_path('app/'.$course->cover_image)))
          unlink( storage_path('app/'.$course->cover_image));
    
      $filename = $request->cover_image->store('cover_images');
      $course->cover_image = $filename;
      $course->save();
    }

    return response()->json(['success' => $filename]);
  }

  public function saveLicense(Request $request)
  {
    $course = Course::find($request->course_id);

    $course->admin_feedback = $request->admin_feedback;
    $course->slug = $request->slug;
    if ($request->license)
      $course->license = $request->license;

    $course->save();

    return redirect()->back();
    return response()->json(['success' => $course]);
  }

  public function updateSetting(Request $request)
  {
    $course = Course::find($request->course_id);

    $course->license = 'PENDING';
    $course->save();

    return redirect()->back();
  }

  public function previewLecture($course_id, $lecture_id)
  {
    $data = Lecture::find($lecture_id);    
    
    if (! ($data))
      return redirect()->route('invalid-url');

    $course_id = $data->course_id;

    $slug = Course::find($course_id)->slug;

    $sections = $this->learnService->dashboardAdminAuth($slug, Auth::user()->id)->section;

    $lecture_ids = [];

    foreach($sections as $section){
      foreach($section->lecture as $lecture){
        array_push($lecture_ids, $lecture->id );
      }
    }

    return view('course/preview/app')
      ->with('data', $data)
      ->with('sections', $sections)
      ->with('course_id', $course_id)
      ->with('lecture_ids', $lecture_ids);
  }
}
