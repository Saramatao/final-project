<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Auth;

class FilesController extends Controller
{

  // public function __construct()
  // {
  //   $this->middleware('auth');
  // }

  public function getAvatar($filename)
  {
    return response()->download(storage_path('app/avatars/'.$filename), null, [], null);
  }

  public function getCoverImage($filename)
  {
    return response()->download(storage_path('app/cover_images/'.$filename), null, [], null);
  }

  public function getLecture($filename)
  {
    return response()->download(storage_path('app/lectures/'.$filename), null, [], null);
  }
}
