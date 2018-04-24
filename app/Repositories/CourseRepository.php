<?php

namespace App\Repositories;

use App\Models\Course;
use Auth;

class CourseRepository implements CourseRepositoryInterface
{
  public static function all()
	{
		return Course::all();
	}
	
	public static function find($id)
	{
		return Course::find($id);
  }
  
  public static function checkOwner($user_id, $course_id)
  {
    $course = Course
      ::where('id', $course_id)
      ->where('instructor_id', $user_id)
      ->first();

    if ($course)
      return true;

    return false;
  }

  public static function getIdBySlug($slug)
  {
    $course = Course::where('slug','=', $slug)->first();

    if ($course)
      return $course->id;

    return false;
  }

  public static function distinctLecture($course)
  {
    foreach ($course->section as $i=>$section)
      foreach ($section->lecture as $j=>$lecture)
        if ($section->sub_number != $lecture->sub_number)
          unset($course['section'][$i]['lecture'][$j]);

    return $course;
  }

  public static function countLecture($data)
  {
    $count_lecture = 0;
    foreach ($data->section as $section)
      foreach ($section->lecture as $lecture)
        $count_lecture++; 

    return $count_lecture;
  }

	public static function _page_index()
	{
		return
      Course::with([
        'promotion', 
        'user'=>function($query){$query
          ->select('id', 'name', 'last_name');},
        'user.student'=>function($query){$query
          ->select('user_id', 'headline', 'biography', 'photo');},
        'review'=>function($query){$query
          ->select('user_id', 'course_id', 'rating');},
      ])
      ->select('id', 'title', 'slug', 'cover_image', 'price', 'promotion_id', 'instructor_id')
      ->get();
  }

	public static function _page_view($slug)
	{
		return
			Course::with([
        'promotion', 
        'user'=>function($query){$query
          ->select('id', 'name', 'last_name');},
        'user.student'=>function($query){$query
          ->select('user_id', 'headline', 'biography', 'photo');},
        'target'=>function($query){$query
          ->select('course_id', 'detail');},
        'benefit'=>function($query){$query
          ->select('course_id', 'detail');},
        'prerequisite'=>function($query){$query
          ->select('course_id', 'detail');},
        'review'=>function($query){$query
          ->select('user_id', 'course_id', 'rating', 'comment', 'created_at');},
        'review.user'=>function($query){$query
          ->select('id', 'name', 'last_name');},
        'review.user.student'=>function($query){$query
          ->select('user_id', 'photo');},
        'section'=>function($query){$query
          ->select('course_id', 'sub_number', 'title');},
        'section.lecture'=>function($query){$query
          ->select('lectures.id', 'course_id', 'sub_number', 'title', 'content_type', 'content_path', 'status');}
      ])
      ->where('slug', '=', $slug)
      ->first();
  }

  public static function _learn_dashboard($slug, $user_id)
  {
    return
      Course::with([ 
        'announcement',
        'user'=>function($query){$query
          ->select('id', 'name', 'last_name');},
        'user.student'=>function($query){$query
          ->select('user_id', 'headline', 'biography', 'photo');},
        'user.instructor'=>function($query){$query
          ->select('user_id', 'website', 'twitter', 'facebook', 'linkedin', 'youtube', 'github');},
        'review'=>function($query) use ($user_id) {$query
          ->where('user_id', '=', $user_id)
          ->select('user_id', 'course_id', 'rating', 'comment', 'created_at');},
        'section'=>function($query){$query
          ->select('course_id', 'sub_number', 'title');},
        'section.lecture'=>function($query){$query
          ->orderBy('created_at')
          ->select('id', 'course_id', 'sub_number', 'title', 'content_type', 'content_path', 'status');},
        'question'=>function($query){$query
          ->select('id', 'title', 'content', 'course_id' ,'student_id', 'created_at')
          ->orderBy('id', 'desc');},
        'question.user'=>function($query){$query
          ->select('id', 'name', 'last_name');},
        'question.user.student'=>function($query){$query
          ->select('user_id', 'photo');},
        'question.answer'=>function($query){$query
          ->select('question_id', 'id', 'content', 'student_id', 'created_at');},
        'question.answer.user'=>function($query){$query
          ->select('id', 'name', 'last_name');},
        'question.answer.user.student'=>function($query){$query
          ->select('user_id', 'photo');}
      ])
      ->where('slug', '=', $slug)
      ->first();
  }
}