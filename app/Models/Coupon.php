<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
  protected $table = 'coupons';
  public $primaryKey = 'code';
  public $timestamps = false;
  public $incrementing = false;

  public function course()
  {
    return $this->belongsTo('App\Models\Course', 'course_id');
  }
  
}
