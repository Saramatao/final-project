<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Wishlist;
use App\Models\Course;

use App\Helpers\SessionResetter;

class WishlistsController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function createWishlist(Request $request)
  {
    $wishlist = new Wishlist();
    $wishlist->student_id = Auth::user()->id;
    $wishlist->course_id = $request->course_id;
    $wishlist->save();

    SessionResetter::wishlist(Auth::user()->id);

    return back();
  }

  public function deleteWishlist(Request $request)
  {
    $data = Wishlist::where('course_id', '=', $request->course_id)
      ->where('student_id', '=', Auth::user()->id)
      ->delete();

    SessionResetter::wishlist(Auth::user()->id);

    return back();
  }
}
