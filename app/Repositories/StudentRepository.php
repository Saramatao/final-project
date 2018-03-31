<?php

namespace App\Repositories;

use App\Models\Student;

class StudentRepository implements StudentRepositoryInterface
{
  public static function all()
	{
		return Student::all();
	}
	
	public static function find($id)
	{
		return Student::find($id);
	}
	
	public function updateRequest($id, $request)
	{
		$student = Student::find($id);

		if ($request->headline)
			$student->headline = $request->headline;

		if ($request->biography)
    	$student->biography = $request->biography;

    if ($request->allow_pub_profile)
    	$student->allow_pub_profile = ($request->allow_pub_profile=="true" ? 'Y' : 'N');

    if ($request->allow_pub_course)
    	$student->allow_pub_course = ($request->allow_pub_course=="true" ? 'Y' : 'N');

    if ($request->allow_pro_email)
    	$student->allow_pro_email = ($request->allow_pro_email=="true" ? 'Y' : 'N');

  	if ($request->allow_imp_update)
    	$student->allow_imp_update = ($request->allow_imp_update=="true" ? 'Y' : 'N');

  	if ($request->allow_announcement)
    	$student->allow_announcement = ($request->allow_announcement=="true" ? 'Y' : 'N');

    $student->save();
	}	

	public function updatePhotoRequest($student, $filename)
	{
    $student->photo = $filename;
    $student->save();
	}	

}