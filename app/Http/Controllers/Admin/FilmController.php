<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Storage;
use App\Models\Film;
use App\Models\Category;
use Validator;
class FilmController extends Controller
{
    public function index (Request $rq) {
      $films = Film::where(function ($query) use ($rq) {
        if ($rq->keyword) $query->where('name', 'like', '%'.$rq->keyword.'%');
      })
      ->limit($rq->show)
      ->get();
    	return $films;
    }
    public function store (Request $rq) {
      $validator = Validator::make($rq->all(), [
        'name'  => 'required'
      ]);
      if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()->first()], 400);
      }
    	$film = Film::create($rq->all());
    	return response()->json($film);
    }
    public function edit ($id) {
    	$film = Film::find($id);
    	$categories = $film->categories()->get()->pluck('id');
    	$film->categories = $categories;
    	return response()->json($film);
    }
    public function update($id, Request $rq) {
      $validator = Validator::make($rq->all(), [
        'name'        => 'required',
        'type_id'     => 'numeric',
        'image'       => 'required',
        'background'  => 'required',
        'all_episode' => 'nullable|numeric|min:0',
        'year_release'=> 'nullable|numeric'  
      ]);
      if ($validator->fails()) {
        return response()->json(['error' => $validator->errors()->first()], 400);
      }

    	$input = $rq->all();
    	$film = Film::find($id);
    	if ($film->image !== $rq->image) {
    		$this->removeImg($film->image);
    		$input['image'] = $this->saveImgBase64($rq->image, 'uploads');
    	}
    	if ($film->background !== $rq->background) {
    		$this->removeImg($film->background);
    		$input['background'] = $this->saveImgBase64($rq->background, 'uploads');
    	}

    	$film->update($input);
    	$film->categories()->sync($rq->categories);
    	return response()->json(['msg' => 'Ok']);
    }
    public function delete($id) {
      $film = Film::find($id);
      $film->delete();
      return 'OK';
    }

    protected function saveImgBase64($param, $folder)
		{
	    list($extension, $content) = explode(';', $param);
	    $tmpExtension = explode('/', $extension);
	    preg_match('/.([0-9]+) /', microtime(), $m);
	    $fileName = sprintf('img%s%s.%s', date('YmdHis'), $m[1], $tmpExtension[1]);
	    $content = explode(',', $content)[1];
	    $storage = Storage::disk('public');

	    $checkDirectory = $storage->exists($folder);

	    if (!$checkDirectory) {
	        $storage->makeDirectory($folder);
	    }

	    $storage->put($folder . '/' . $fileName, base64_decode($content), 'public');
	    return $folder . '/' . $fileName;
		}
		protected function removeImg($imgPath) {
			$storage = Storage::disk('public');
			$checkPath = $storage->exists($imgPath);
			if ($checkPath) {
				Storage::disk('public')->delete($imgPath);
			}
		}
}

