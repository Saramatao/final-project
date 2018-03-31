<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
  protected $table = 'students';
  public $primaryKey = 'user_id';
  public $timestamps = false;
  public $incrementing = false;

  // protected $hidden = ['user_id'];

  public function user()
  {
    return $this->belongsTo('App\Models\User', 'user_id');
  }
}
