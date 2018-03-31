<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
  protected $table = 'sections';
  public $primaryKey = 'sub_number';
  public $timestamps = false;
  public $incrementing = false;
  // protected $fillable = array('id','firstname','name', 'email', 'password');
  // protected $hidden = ['course_id'];
  protected $dates = [
    'created_at'
  ];

  public function lecture()
  {
    return $this->hasMany('App\Models\Lecture', 'sub_number');
  }
}
