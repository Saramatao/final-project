<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
  protected $table = 'collections';
  public $timestamps = false;
  public $incrementing = false;
  protected $dates = [
    'created_at'
  ];

  public function collectiondetail()
  {
    return $this->hasMany('App\Models\CollectionDetail', 'collection_id');
  }
}
