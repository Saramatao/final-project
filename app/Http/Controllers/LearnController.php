<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Services\LearnService;

use App\Models\Lecture;
use App\Models\Section;
use App\Models\Course;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Progress;
use App\Models\Review;

class LearnController extends Controller
{
  protected $learnService;

  public function __construct
  (
    LearnService $learnService
  )
  {
    $this->middleware('auth');
    $this->learnService = $learnService;
  }

  public function dashboard($slug)
  { 
    $data = $this->learnService->dashboard($slug, Auth::user()->id);

    if (! ($data))
      return redirect()->route('invalid-url');

    $course_id = Course
      ::where('slug', '=', $slug)
      ->first()
      ->id;

    $progress = Progress
      ::join('lectures', 'progress.lecture_id', '=', 'lectures.id')
      ->where('lectures.course_id', '=', $course_id)
      ->where('progress.student_id', '=', Auth::user()->id)
      ->select('student_id', 'lecture_id')
      ->get();

    $data['count_progress'] = count($progress);
    $data['learn_progress'] = (count($progress) / $data['count_lecture']) * 100;

    foreach($data->section as $section) {
      foreach ($section->lecture as $lecture) {
        
        foreach($progress as $prog) {
          if ($lecture->id == $prog->lecture_id) {
            $lecture->learn_status = true;
            break 1;
          }
          else 
            $lecture->learn_status = false;
        }


      }
    }
    
    $data->bookmarks = Section
      ::join('lectures', 'sections.sub_number', '=', 'lectures.sub_number')
      ->join('bookmarks', 'lectures.id', '=', 'bookmarks.lecture_id')
      ->where('lectures.course_id', $course_id)
      ->where('bookmarks.student_id', Auth::user()->id)
      ->select('sections.title as section_title' ,
        'lectures.title as lecture_title', 'lectures.id as lecture_id', 'note')
      ->get();

    $review = Review
      ::where('user_id', '=', Auth::user()->id)
      ->where('course_id', '=', $course_id)
      ->first();

    return view('learn/dashboard/app')
      ->with('data', $data)
      ->with('review', $review);
  }

  public function lecture($slug, $lecture_id)
  {
    $data = Lecture::find($lecture_id);    

    if (! ($data))
      return redirect()->route('invalid-url');

    $sections = $this->learnService->dashboard($slug, Auth::user()->id)->section;

    $lecture_ids = [];

    foreach($sections as $section){
      foreach($section->lecture as $lecture){
        array_push($lecture_ids, $lecture->id );
      }
    }

    $progress = Progress
      ::where('student_id', '=', Auth::user()->id)
      ->where('lecture_id', '=', $data->id)
      ->first();

    if (! $progress) {
      $progress = new Progress();
      $progress->student_id = Auth::user()->id;
      $progress->lecture_id = $data->id;
      $progress->save();
    }
   
    return view('learn/lecture/app')
      ->with('data', $data)
      ->with('sections', $sections)
      ->with('slug', $slug)
      ->with('lecture_ids', $lecture_ids);
  }

  public function createQuestion(Request $request)
  {
    $course_id = Course::where('slug', '=', $request->slug)->first()->id;
    $question = new Question();
    $question->title = $request->title;
    $question->content = $request->question;
    $question->course_id = $course_id;
    $question->student_id = Auth::user()->id;
    $question->save();

    return response()->json(['success' => $question]);
  }

  public function createAnswer(Request $request)
  {
    $answer = new Answer();
    $answer->question_id = $request->question_id;
    $answer->content = $request->answer;
    $answer->student_id = Auth::user()->id;
    $answer->save();

    return response()->json(['success' => $answer]);
  }

  public function deleteAnswer(Request $request)
  {
    $answer = Answer::where('id', '=', $request->answer_id)->first();
    $answer->delete();

    return response()->json(['success' => 'delete success']);
  }

  public function deleteQuestion(Request $request)
  {
    $question = Question::with('answer')
      ->where('id', '=', $request->question_id)
      ->first();

    $question->answer()->delete();
    $question->delete();

    return response()->json(['success' => 'delete question success']);
  }

  public function updateQuestion(Request $request)
  {
    $question = Question::where('id', '=', $request->question_id)
      ->first();

    $question->title = $request->title;
    $question->content = $request->question;
    $question->save();

    return response()->json(['success' => 'update question success']);
  }

  public function saveReview(Request $request)
  {
    Review::where('id', '=', $request->review_id)->delete();

    $review = new Review();
    $review->user_id = Auth::user()->id;
    $review->comment = $request->comment;
    $review->rating = $request->rating;
    $review->course_id = $request->course_id;
    $review->save();

    return redirect()->back();
  }

  public function updateAnswer(Request $request)
  {
    $answer = Answer::where('id', '=', $request->answer_id)
      ->first();

    $answer->content = $request->answer;
    $answer->save();

    return response()->json(['success' => 'update answer success']);
  }

  public function upvdo(Request $request)
  {
    if ($request->hasFile('vdo')){
      $request->vdo->store('vdo');
    }
  }
}
