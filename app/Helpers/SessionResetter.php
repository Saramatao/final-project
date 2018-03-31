<?php

namespace App\Helpers;

use App\Models\Wishlist;

class SessionResetter
{

  public static function wishlist($user_id)
  {
    $wishlists = Wishlist
    ::with('course')
    ->where('student_id', '=', $user_id)
    ->get();

    session()->forget('wishlist');
    session(['wishlist' => $wishlists]);

    return true;    
  }


}