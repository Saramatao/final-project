<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bookmark;

class BookmarksController extends Controller
{
  public function getBookmarks(Request $request)
  {
    $bookmarks = Bookmark
      ::where('lecture_id', $request->lecture_id)
      ->where('student_id', $request->user_id)
      ->first();
      
    return $bookmarks;
  }

  public function createBookmarks(Request $request)
  {
    $bookmarks = Bookmark
      ::where('lecture_id', $request->lecture_id)
      ->where('student_id', $request->user_id)
      ->first();

    if ($bookmarks) {
      $bookmarks = Bookmark
        ::where('lecture_id', $request->lecture_id)
        ->where('student_id', $request->user_id)
        ->update([
          'note' =>  $request->note
        ]);
    } else {
      $bookmarks = new Bookmark();
      $bookmarks->lecture_id = $request->lecture_id;
      $bookmarks->student_id = $request->user_id;
      $bookmarks->note = $request->note;
      $bookmarks->save();
    }

    return response()->json(['success'=> 'request succeed']);
  }

  public function updateBookmarks(Request $request)
  {
    return 'putbookmarks';
  }

  public function deleteBookmarks(Request $request)
  {
    $bookmarks = Bookmark
      ::where('lecture_id', $request->lecture_id)
      ->where('student_id', $request->user_id)
      ->delete();

    return response()->json(['success'=> 'request succeed']);
  }
}
