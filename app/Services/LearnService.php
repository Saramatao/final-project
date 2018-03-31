<?php

namespace App\Services;

use App\Repositories\CourseRepositoryInterface;
use App\Repositories\PurchaseRepositoryInterface;
use App\Repositories\PurchaseDetailRepositoryInterface;

class LearnService
{
	protected $course;
	protected $purchase;
	protected $purchaseDetail;

  public function __construct
  (
    CourseRepositoryInterface $course,
    PurchaseRepositoryInterface $purchase,
    PurchaseDetailRepositoryInterface $purchaseDetail
  )
  {
    $this->course = $course;
    $this->purchase = $purchase;
    $this->purchaseDetail = $purchaseDetail;
  }

  public function dashboard($slug, $user_id)
  {
  	$course_id = $this->course->getIdBySlug($slug);
  	$isPurchase = $this->purchase->checkPurchaseCourse($course_id, $user_id);

    $data = $this->course->_learn_dashboard($slug, $user_id);
    
	  if (! ($data && $isPurchase))
      return false; 

    $data = $this->course->distinctLecture($data);
    $data['count_lecture'] = $this->course->countLecture($data);
    $data['count_enrollment'] = $this->purchaseDetail->countEnrollment($course_id);

    return $data;
  }

  public function dashboardAdminAuth($slug, $user_id)
  {
  	$course_id = $this->course->getIdBySlug($slug);
    $data = $this->course->_learn_dashboard($slug, $user_id);

	  if (! ($data))
      return false; 

    $data = $this->course->distinctLecture($data);
    $data['count_lecture'] = $this->course->countLecture($data);
    $data['count_enrollment'] = $this->purchaseDetail->countEnrollment($course_id);

    return $data;
  }
}