<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
  protected $table = 'answers';
  protected $primaryKey = 'id';
  public $timestamps = false;
  protected $dates = [
    'created_at'
  ];

  public function user()
  {
    return $this->belongsTo('App\Models\User', 'student_id');
  }
}
