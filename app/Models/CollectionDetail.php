<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CollectionDetail extends Model
{
  protected $table = 'collectiondetails';
  public $primaryKey = 'collection_id';
  public $timestamps = false;
  public $incrementing = false;
  protected $dates = [
    'created_at'
  ];

  public function course()
  {
    return $this->belongsTo('App\Models\Course', 'course_id');
  }

  public function collection()
  {
    return $this->belongsTo('App\Models\Collection', 'collection_id');
  }
}
