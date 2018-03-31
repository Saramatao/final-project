<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
  protected $table = 'instructors';
  public $primaryKey = 'user_id';
  public $timestamps = false;
  public $incrementing = false;

  // protected $hidden = ['user_id'];
  
  protected $dates = [
    'created_at'
  ];

  public function user()
  {
    return $this->belongsTo('App\Models\User')->withDefault();
  }
}
