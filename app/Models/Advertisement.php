<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
  protected $table = 'advertisements';
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
}