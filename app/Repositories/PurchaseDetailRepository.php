<?php

namespace App\Repositories;

use App\Models\PurchaseDetail;

class PurchaseDetailRepository implements PurchaseDetailRepositoryInterface
{
  public static function all()
	{
		return PurchaseDetail::all();
	}
	
	public static function find($id)
	{
		return PurchaseDetail::find($id);
	}

	public static function countEnrollment($course_id)
  {
    return count(PurchaseDetail::where('course_id','=', $course_id)->get());
  }
}