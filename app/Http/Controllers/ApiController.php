<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Course;

class ApiController extends Controller
{
  public function getCourse($course_id)
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

    return $course;
  }
}
