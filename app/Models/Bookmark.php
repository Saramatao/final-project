<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bookmark extends Model
{
  protected $table = 'bookmarks';
  public $primaryKey = 'student_id';
  public $timestamps = false;
  public $incrementing = false;
}
