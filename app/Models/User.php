<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
  protected $table = 'users';
  public $timestamps = false;
  public $incrementing = false;
  
  protected $fillable = array('id','firstname','name', 'email', 'password');

  // protected $hidden = ['id', 'password'];

  public function course()
  {
    return $this->hasMany('App\Models\Course', 'instructor_id');
  }

  public function purchase()
  {
    return $this->hasMany('App\Models\Purchase', 'student_id');
  }

  public function instructor()
  {
    return $this->hasOne('App\Models\Instructor', 'user_id');
  }

  public function student()
  {
    return $this->hasOne('App\Models\Student', 'user_id');
  }

  public function review()
  {
    return $this->hasMany('App\Models\Review', 'user_id');
  }

  public function notification()
  {
    return $this->hasMany('App\Models\Notification', 'user_id');
  }

  public function lastThreeNotification()
  {
    return $this->hasMany('App\Models\Notification', 'user_id')->limit(3);
  }
}

  // use Notifiable;
  // public $primaryKey = 'id';
  // protected $fillable = [
  //     'name', 'Email', 'password',
  // ];
  // protected $hidden = [
  //     'pwd', 'remember_token',
  // ];
  // protected $casts = [
  //   'is_admin' => 'boolean',
  // ];
