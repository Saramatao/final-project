<?php

namespace App\Repositories;

interface PurchaseDetailRepositoryInterface 
{
	public static function all();

	public static function find($id);

	public static function countEnrollment($course_id);
}