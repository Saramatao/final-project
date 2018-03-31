<?php

namespace App\Repositories;

interface PurchaseRepositoryInterface 
{
	public static function all();

	public static function find($id);

	public static function checkPurchaseCourse($course_id, $user_id);

	public static function getCourses($user_id);
}