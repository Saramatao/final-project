<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
  protected $table = 'categories';
  public $timestamps = false;
  public $incrementing = false;
  protected $dates = [
    'created_at'
  ];

  public function course()
  {
    return $this->hasMany('App\Models\Course', 'category_id');
  }
}
