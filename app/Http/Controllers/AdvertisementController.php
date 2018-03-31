<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;


use App\Models\Advertisement;
use App\Models\Category;

class AdvertisementController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function createAdvertisement(Request $request)
  {
    $advertisement = new Advertisement();
    $advertisement->course_id   = strtoupper($request->course_id);
    $advertisement->title       = $request->title;
    $advertisement->detail      = $request->detail;
    $advertisement->save();

    return back();
  }

  public function updateAdvertisement(Request $request)
  {
    $advertisement = Advertisement::find(strtoupper($request->course_id));
    $advertisement->title       = $request->title;
    $advertisement->detail      = $request->detail;
    $advertisement->save();

    return back();
  }

  public function deleteAdvertisement(Request $request)
  {
    Advertisement::find(strtoupper($request->course_id))->delete();
    
    return back();
  }
}
