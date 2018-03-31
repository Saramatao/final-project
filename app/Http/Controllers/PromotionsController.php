<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Promotion;

class PromotionsController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function updatePromotion(Request $request)
  {
    $promotion = Promotion::where('id', $request->promotion_id)->first();
    $promotion->name            = $request->name;
    $promotion->description     = $request->description;
    $promotion->discount_type   = $request->type;
    $promotion->discount_value  = $request->value;
    $promotion->start_date      = date('Y-m-d', strtotime($request->start_date));
    $promotion->stop_date       = date('Y-m-d', strtotime($request->stop_date));
    $promotion->status          = $request->status;
    $promotion->save();

    return back();
  }

  public function createPromotion(Request $request)
  {
    $id1 = '';
    $id2 = '';
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $max = strlen($characters) - 1;
    while ($id1 == $id2) {
      $id1 = '';
      for ($i = 0; $i < 10; $i++)
        $id1 .= $characters[mt_rand(0, $max)];

      if(Promotion::find($id1))
        $id2 = Promotion::find($id1)->id;
    }
    
    $promotion = new Promotion();
    $promotion->id              = $id1;
    $promotion->name            = $request->name;
    $promotion->description     = $request->description;
    $promotion->discount_type   = $request->type;
    $promotion->discount_value  = $request->value;
    $promotion->start_date      = date('Y-m-d', strtotime($request->start_date));
    $promotion->stop_date       = date('Y-m-d', strtotime($request->stop_date));
    $promotion->status          = $request->status;
    $promotion->save();

    return back();
  }
}
