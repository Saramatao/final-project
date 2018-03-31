<?php

namespace App\Repositories;

use App\Models\Instructor;

class InstructorRepository implements InstructorRepositoryInterface
{
  public static function all()
	{
		return Instructor::all();
	}
	
	public static function find($id)
	{
		return Instructor::find($id);
	}

	public function updateRequest($id, $request)
	{
		$instructor = Instructor::find($id);

		if ($instructor){

			if ($request->website)
      	$instructor->website = $request->website;

      if ($request->facebook)
      	$instructor->facebook = $request->facebook;

    	if ($request->twitter)
      	$instructor->twitter = $request->twitter;

    	if ($request->linkedin)
      	$instructor->linkedin = $request->linkedin;

    	if ($request->github)
      	$instructor->github = $request->github;

    	if ($request->youtube)
      	$instructor->youtube = $request->youtube;

      if ($request->allow_pub_teaching)
    		$instructor->allow_pub_teaching = ($request->allow_pub_teaching=="true" ? 'Y' : 'N');

      $instructor->save();
    }
	}	

}