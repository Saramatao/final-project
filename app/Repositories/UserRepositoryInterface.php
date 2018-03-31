<?php

namespace App\Repositories;

interface UserRepositoryInterface 
{
	public function all();

	public function find($id);

	public function getPassword($id);

	public function findDetail($id);

	public function updateRequest($id, $request);

	public function isEmailDuplicate($email);
}