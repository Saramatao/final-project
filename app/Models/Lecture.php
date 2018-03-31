<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
  protected $table = 'lectures';
  // public $primaryKey = 'id';
  public $timestamps = false;
  public $incrementing = false;
  // protected $fillable = array('id','firstname','name', 'email', 'password');
  // protected $hidden = ['course_id'];
  protected $dates = [
    'created_at'
  ];

  public function section()
  {
    return $this->belongsTo('App\Models\Section', 'sub_number');
  }

  public function progress()
  {
    return $this->hasOne('App\Models\Progress', 'lecture_id');
  }

}
