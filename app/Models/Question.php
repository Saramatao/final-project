<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
  protected $table = 'questions';
  public $timestamps = false;
  protected $dates = [
    'created_at'
  ];

  public function answer()
  {
    return $this->hasMany('App\Models\Answer', 'question_id');
  } 

  public function testanswer() {
      return $this->answer()->limit( 2 );
  }

  public function user()
  {
    return $this->belongsTo('App\Models\User', 'student_id');
  }
}
