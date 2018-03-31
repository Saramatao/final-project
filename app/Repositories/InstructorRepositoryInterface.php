<?php

namespace App\Repositories;

interface InstructorRepositoryInterface 
{
	public static function all();

	public static function find($id);

	public function updateRequest($id, $request);
}