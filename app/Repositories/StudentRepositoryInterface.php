<?php

namespace App\Repositories;

interface StudentRepositoryInterface 
{
	public static function all();

	public static function find($id);

	public function updateRequest($id, $request);

	public function updatePhotoRequest($student, $filename);
}