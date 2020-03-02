<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Models\Category;

class CategoryController extends Controller
{
  public function index () {
  	$categories = Category::withCount('films')->get();
  	return response()->json($categories);
  }

  public function store (Request $rq) {
  	$category = new Category;
  	$category->name = $rq->name;
  	$category->save();
  	return $category;
  }

  public function update ($id, Request $rq) {
  	$category  = Category::find($id);
  	$category->name = $rq->name;
  	$category->save();
  	return 'OK';
  }

  public function delete($id) {
  	$category  = Category::find($id);
  	$category->delete();
  	return 'OK';
  }

}
