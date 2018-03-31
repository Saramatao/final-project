<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;

class CategoriesController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function createCategory(Request $request)
  {
    $category = new Category();
    $category->attribute  = $request->except('_token');
    $category->save();

    return back();
  }

  public function updateCategory(Request $request)
  {
    $category = Category::find($request->category_id);
    $category->name         = $request->name;
    $category->description  = $request->description;
    $category->save();

    return back();
  }

  public function deleteCategory(Request $request)
  {
    Category::find($request->category_id)->delete();
    
    return back();
  }

}
