<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Models\Type;

class TypeController extends Controller
{
  public function index () {
  	$types = Type::withCount('films')->get();
  	return response()->json($types);
  }

  public function store (Request $rq) {
  	$type = new Type;
  	$type->name = $rq->name;
  	$type->save();
  	return $type;
  }

  public function update ($id, Request $rq) {
  	$type  = Type::find($id);
  	$type->name = $rq->name;
  	$type->save();
  	return 'OK';
  }

  public function delete($id) {
  	$type  = Type::find($id);
  	$type->delete();
  	return 'OK';
  }
}
