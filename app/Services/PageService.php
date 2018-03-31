<?php

namespace App\Services;

use App\Repositories\CourseRepositoryInterface;
use App\Models\Course;

class PageService
{
  protected $course;

  public function __construct
  (
    CourseRepositoryInterface $course
  )
  {
    $this->course = $course;
  }

  public function index()
  {
    $data = Course
      ::where('license', 'PASS')
      ->get();

    $sum_rating = 0;
    foreach ($data as $course)
      if ( count($course->review)){
        foreach ($course->review as $review)
          $sum_rating += $review->rating;

        $course['average_rating'] = $sum_rating / count($course->review);
        $sum_rating = 0;
      }
      else 
        $course['average_rating'] = 0;

    foreach ($data as $course)
      if ($course->promotion !== null) {

        $nowDate = strtotime(date("Y-m-d H:i:s"));
        $startDate = strtotime($course->promotion->start_date);
        $stopDate = strtotime($course->promotion->stop_date);

        // if (
        //   $nowDate > $startDate && 
        //   $nowDate < $stopDate &&
        //   $course->promotion->status == 'ENABLED') 
        // {
          $value = $course->promotion->discount_value;
          $type = $course->promotion->discount_type;
          $price = $course->price;

          if ($type == 'VALUE')
            $course['discounted_price'] = $price - $value;
          elseif ($type == 'PERCENT')
            $course['discounted_price'] = $price - (( $price * $value ) / 100 );

          if ($course['discounted_price'] < 200)
            $course['discounted_price'] = 200;
        // }
    
      }

    return $data;
  }

  public function view($slug)
  {
    $data = $this->course->_page_view($slug);

    if (! ($data))
      return false;

    foreach ($data->section as $i=>$section)
      foreach ($section->lecture as $j=>$lecture)
        if ($section->sub_number != $lecture->sub_number)
          unset($data['section'][$i]['lecture'][$j]);

    $sum_rating = 0;
    if ( count($data->review)){
      foreach ($data->review as $review)
        $sum_rating += $review->rating;
      
      $data['average_rating'] = $sum_rating / count($data->review);
    }
    else 
      $data['average_rating'] = 0;

    if ($data->promotion !== null) {
      $value = $data->promotion->discount_value;
      $type = $data->promotion->discount_type;
      $price = $data->price;

      if ($type == 'VALUE')
        $data['discounted_price'] = $price - $value;
      elseif ($type == 'PERCENT')
        $data['discounted_price'] = $price - (( $price * $value ) / 100 );

      if ($data['discounted_price'] < 200)
        $data['discounted_price'] = 200;
    }

    return $data;
  }
}