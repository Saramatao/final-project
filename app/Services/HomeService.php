<?php

namespace App\Services;

use App\Repositories\PurchaseRepositoryInterface;

class HomeService
{
  protected $purchase;

  public function __construct
  (
    PurchaseRepositoryInterface $purchase
  )
  {
    $this->purchase = $purchase;
  }

  public function myCourses($user_id)
  {
    $data = $this->purchase->getCourses($user_id);
  
    return $data;
  }
}