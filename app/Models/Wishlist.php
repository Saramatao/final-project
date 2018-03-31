<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
  protected $table = 'wishlists';
  public $primaryKey = 'student_id';
  public $timestamps = false;
  public $incrementing = false;
 
  protected $dates = [
    'created_at'
  ];

  public function course()
  {
    return $this->belongsTo('App\Models\Course');
  }
}
