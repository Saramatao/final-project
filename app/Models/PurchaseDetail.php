<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseDetail extends Model
{
  public $table = 'purchasedetails';
  
  public $timestamps = false;
  // protected $fillable = array('id','firstname','name', 'email', 'password');
  // protected $hidden = [
  //   'purchase_id',
  //   'course_id'
  // ];
  protected $dates = [
    'created_at'
  ];

  public function course()
  {
    return $this->belongsTo('App\Models\Course', 'course_id');
  }

  public function purchase()
  {
    return $this->belongsTo('App\Models\Purchase', 'purchase_id');
  }
}
