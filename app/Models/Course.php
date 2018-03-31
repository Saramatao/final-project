<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
  protected $table = 'courses';
  public $timestamps = false;
  public $incrementing = false;
  // protected $fillable = array('id','firstname','name', 'email', 'password');
  // protected $hidden = [
  //   'instructor_id', 
  //   'id', 
  //   'promotion_id'
  // ];
  protected $dates = [
    'created_at'
  ];

  public function category()
  {
    return $this->belongsTo('App\Models\Category', 'category_id');
  }

  public function user()
  {
    return $this->belongsTo('App\Models\User', 'instructor_id');
  }

  public function promotion()
  {
    return $this->belongsTo('App\Models\Promotion');
  }

  public function target()
  {
    return $this->hasMany('App\Models\Target', 'course_id');
  }

  public function benefit()
  {
    return $this->hasMany('App\Models\Benefit', 'course_id');
  }

  public function prerequisite()
  {
    return $this->hasMany('App\Models\Prerequisite', 'course_id');
  }

  public function section()
  {
    return $this->hasMany('App\Models\Section', 'course_id');
  }

  public function review()
  {
    return $this->hasMany('App\Models\Review', 'course_id');
  }

  public function purchasedetail()
  {
    return $this->hasMany('App\Models\PurchaseDetail', 'course_id');
  }

  public function question()
  {
    return $this->hasMany('App\Models\Question', 'course_id');
  }

  public function coupon()
  {
    return $this->hasMany('App\Models\Coupon', 'course_id');
  }

  public function announcement()
  {
    return $this->hasMany('App\Models\Announcement', 'course_id');
  }

  public function collectiondetail()
  {
    return $this->hasMany('App\Models\CollectionDetail', 'course_id');
  }

}
