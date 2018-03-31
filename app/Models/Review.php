<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
  protected $table = 'reviews';
  public $timestamps = false;
  // protected $hidden = ['user_id', 'course_id'];

  // protected $fillable = array('id','firstname','name', 'email', 'password');
  // public $incrementing = false;

  protected $dates = [
    'created_at'
  ];

  public function user()
  {
    return $this->belongsTo('App\Models\User', 'user_id')->withDefault();
  }
}
