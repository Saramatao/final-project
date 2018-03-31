<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Collection;
use App\Models\CollectionDetail;
use App\Models\Course;

class CollectionsController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function createCollection(Request $request)
  {
    $collection = new Collection();
    $collection->student_id = Auth::user()->id;
    $collection->name = $request->collection_name;
    $collection->note = $request->note;

    $collection->save();

    return response()->json(['success' => 'create collection succeed']);
  }

  public function updateCollection(Request $request)
  {
    $collection = Collection::where('id', $request->collection_id)->first();
    $collection->name = $request->collection_name;
    $collection->note = $request->note;

    $collection->save();

    return response()->json(['success' => 'update collection succeed']);
  }

  public function deleteCollection(Request $request)
  {
    $collection = Collection::where('id', $request->collection_id)->first();

    $collection->collectiondetail()->delete();
    $collection->delete();

    return response()->json(['success' => 'delete collection succeed']);
  }

  public function deleteCollectionDetail(Request $request)
  {
    $collectionDetail = CollectionDetail
      ::where('collection_id', $request->collection_id)
      ->where('course_id', $request->course_id)
      ->delete();

    return response()->json(['success' => 'delete collection detail succeed']);
  }

  public function editCollectionDetail(Request $request)
  {
    $collectionDetail = CollectionDetail
      ::where('collection_id', $request->collection_id)
      ->where('course_id', $request->course_id)
      ->first();

    if (! $collectionDetail) {
      $collectionDetail = new CollectionDetail();
      $collectionDetail->collection_id = $request->collection_id;
      $collectionDetail->course_id = $request->course_id;
      $collectionDetail->save();
    } else {
      $collectionDetail = CollectionDetail
        ::where('collection_id', $request->collection_id)
        ->where('course_id', $request->course_id)
        ->delete();
    }

    return response()->json(['success' => 'edit collection detail succeed']);
  }

  public function getCollectionDetail($id)
  {
    $user_id = Auth::user()->id;
    $collection_id = $id;
    $purchasedCourseID = Course
      ::join('purchasedetails', 'courses.id', 'purchasedetails.course_id')
      ->join('purchase', 'purchasedetails.purchase_id', 'purchase.id')
      ->where('purchase.student_id', '=', Auth::user()->id)
      ->get()
      ->pluck('course_id');
    
    $data = Course::with([
        'collectiondetail'=>function($query) use ($user_id, $collection_id) {$query
        ->join('collections', 'collectiondetails.collection_id', 'collections.id')
        ->where('collections.student_id', ($user_id))
        ->where('collections.id', ($collection_id));},
      ])
      ->whereIn('courses.id', $purchasedCourseID)
      ->get();

    return $data;
  }
}
