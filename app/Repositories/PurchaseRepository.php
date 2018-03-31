<?php

namespace App\Repositories;

use App\Models\Purchase;

class PurchaseRepository implements PurchaseRepositoryInterface
{
  public static function all()
	{
		return Purchase::all();
	}
	
	public static function find($id)
	{
		return Purchase::find($id);
	}

	public static function checkPurchaseCourse($course_id, $user_id)
	{
		$data =
      Purchase::join('purchasedetails', 'purchase.id', '=', 'purchasedetails.purchase_id')
        ->where('student_id', '=',$user_id)
        ->where('course_id', '=', $course_id)
        ->first();
    
    if (! ($data))
      return false; 

    return true;
	}

	public static function getCourses($user_id)
	{
		return 
		 	Purchase
        ::join('purchasedetails', 'purchase.id', '=', 'purchasedetails.purchase_id')
        ->join('courses', 'purchasedetails.course_id', '=', 'courses.id')
        ->join('users', 'courses.instructor_id', '=', 'users.id')
        ->join('students', 'users.id', '=', 'students.user_id')
        ->where('purchase.student_id', '=', $user_id)
        ->select('title', 'courses.slug', 'cover_image', 'name', 'last_name', 'headline')
        ->get();
	}
}