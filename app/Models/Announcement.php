<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
  protected $table = 'announcement';
  // public $primaryKey = 'code';
  public $timestamps = false;
  public $incrementing = false;
  protected $dates = [
    'created_at'
  ];
}
