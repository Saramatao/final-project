<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Benefit extends Model
{
  protected $table = 'benefits';
  public $primaryKey = 'course_id';
  public $timestamps = false;
  public $incrementing = false;

  protected $hidden = ['course_id'];

  // protected $fillable = [];

  protected $dates = [
    'created_at'
  ];
}
