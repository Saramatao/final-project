<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Progress extends Model
{
  protected $table = 'progress';
  public $timestamps = false;
  public $incrementing = false;
  protected $dates = [
    'created_at'
  ];

}
