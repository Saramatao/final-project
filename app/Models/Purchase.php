<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
  protected $table = 'purchase';
  public $timestamps = false;
  public $incrementing = false;

  // protected $fillable = array('id','firstname','name', 'email', 'password');
  // protected $hidden = [
  //   'id', 'student_id'
  // ];
  protected $dates = [
    'created_at'
  ];

  // MODEL FUNCTION =========================================
  // MODEL FUNCTION =========================================

  public function purchasedetail()
  {
    return $this->hasMany('App\Models\PurchaseDetail', 'purchase_id');
  }

  public function user()
  {
    return $this->belongsTo('App\Models\User', 'student_id');
  }

  public function purchasedatail()
  {
    return $this->hasMany('App\Models\PurchaseDetail', 'purchase_id');
  }
}
