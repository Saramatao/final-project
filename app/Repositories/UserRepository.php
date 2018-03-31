<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
  public function all()
	{
		return User::all();
	}
	
	public function find($id)
	{
		return User::find($id);
	}

	public function getPassword($id)
	{
		return User::where('id', '=', $id)->select('password')->first();
	}

	public function findDetail($id)
	{
		return User::with('student', 'instructor')
			->where('users.id', '=', $id)
      ->first();
	}

	public function updateRequest($id, $request)
	{
		$user = User::find($id);

		if($request->first_name)
			$user->name	= $request->first_name;

		if($request->last_name)
			$user->last_name = $request->last_name;
		
		if($request->new_email)
			$user->email = $request->new_email;

		if($request->new_password)
			$user->password = bcrypt($request->new_password);

    $user->save();
	}

	public function isEmailDuplicate($email){
		return $uniqueEmail = 
			User::select('email', 'status')
      ->where('email', '=', $email)
      ->first();
	}

}