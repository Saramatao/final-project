<?php

namespace App\Services;

use App\Repositories\UserRepositoryInterface;
use App\Repositories\StudentRepositoryInterface;
use App\Repositories\InstructorRepositoryInterface;

use Illuminate\Support\Facades\Hash;

class UserService
{
  protected $user;
  protected $student;
  protected $instructor;

  public function __construct
  (
    UserRepositoryInterface $user,
    StudentRepositoryInterface $student,
    InstructorRepositoryInterface $instructor
  )
  {
    $this->user = $user;
    $this->student = $student;
    $this->instructor = $instructor;
  }

  public function getUser($user_id)
  {
    return $this->user->findDetail($user_id);
  }

  public function updateProfile($user_id, $request)
  {
    $this->user->updateRequest($user_id, $request);
    $this->student->updateRequest($user_id, $request);
    $this->instructor->updateRequest($user_id, $request);
  }

  public function updateImage($user_id, $request)
  {
    $student = $this->student->find($user_id);

    if ($student->photo != 'avatars/default-user.jpg')
      if ( is_file( storage_path('app/'.$student->photo)))
        unlink( storage_path('app/'.$student->photo));
    
    $filename = $request->photo->store('avatars');

    $this->student->updatePhotoRequest($student, $filename);

    return $filename;
  }

  public function updateAccount($user_id, $request)
  {
    $user = $this->user->find($user_id);

    $isEmailDuplicate = $this->user->isEmailDuplicate($request->new_email);

    $errors = [];
    if ($isEmailDuplicate)
      $errors['new_email'] = ['อีเมล์นี้มีผู้อยู่ใช้แล้ว'];

    if (! (Hash::check(
      $request->email_password, 
      $user->password
    )))
      $errors['email_password'] = ['รหัสผ่านไม่ถูกต้อง'];
    
    if ( count($errors) == 0)
      $this->user->updateRequest($user_id, $request);
    
    return $errors;
  }

  public function updatePassword($user_id, $request)
  {
    $user = $this->user->find($user_id);

    if (! (Hash::check(
      $request->current_password, 
      $user->password
    )))  
      return false;

    $this->user->updateRequest($user_id, $request);

    return true;
  }

  public function updatePrivacy($user_id, $request)
  {
    $student = $this->student->find($user_id);
    $instructor = $this->instructor->find($user_id);

    $this->student->updateRequest($user_id, $request);
    $this->instructor->updateRequest($user_id, $request);
  }

  public function updateNotification($user_id, $request)
  {
    $student = $this->student->find($user_id);

    $this->student->updateRequest($user_id, $request);
  }
}