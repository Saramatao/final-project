<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AbuseReport extends Model
{
  protected $table = 'abusereport';
  public $primaryKey = 'course_id';
  public $timestamps = false;
  public $incrementing = false;
  protected $dates = [
    'created_at'
  ];

  public function course()
  {
    return $this->belongsTo('App\Models\Course', 'course_id');
  }

  public function user()
  {
    return $this->belongsTo('App\Models\Course', 'student_id');
  }
}
