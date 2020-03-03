<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Film;
use App\Models\Episode;
use Validator;
class EpisodeController extends Controller
{
  public function index ($fid) {
  	$film = Film::with('episodes')->whereId($fid)->first();
  	return response()->json($film);
  }
  public function store($fid, Request $rq) {
  	$validator = Validator::make($rq->all(), [
  		'name' 	=> 'required',
  		'ep'		=> 'required|numeric|min:0',
  		'drive' => 'required'
  	]);
  	if ($validator->fails()) {
      return response()->json(['error' => $validator->errors()->first()], 400);
    }

  	$drive = get_drive_id($rq->drive);
    if (!$drive) {
      return response()->json(['error' => 'Drive URL not valid'], 500);
    } 

    if (! $this->existsDrive($rq->drive)) {
      return response()->json(['error' => 'File Not Exists On Drive'], 500);
    }

    $this->uploadFile($drive);

  	$film = Film::find($fid);

  	$episode = new Episode;
  	$episode->name 		= $rq->name;
  	$episode->ep 			= $rq->ep;
  	$episode->label 	= $rq->label;
  	$episode->drive 	= $rq->drive;
  	$episode->film_id = $film->id;
  	$episode->status 	= 'uploading';
  	$episode->save();

  	return $episode;
  }
  public function update($fid, $id, Request $rq) {
  	$validator = Validator::make($rq->all(), [
  		'name' 	=> 'required',
  		'ep'		=> 'required|numeric|min:0',
  		'drive' => 'required'
  	]);
  	if ($validator->fails()) {
      return response()->json(['error' => $validator->errors()->first()], 400);
    }

    $drive = get_drive_id($rq->drive);
    if (!$drive) {
      return response()->json(['error' => 'Drive URL not valid'], 500);
    } 

  	if (! $this->existsDrive($rq->drive)) {
  		return response()->json(['error' => 'File Not Exists On Drive'], 500);
  	}

    $this->uploadFile($drive);

  	$episode = Episode::find($id);
  	$episode->name 		= $rq->name;
  	$episode->ep 			= $rq->ep;
  	$episode->label 	= $rq->label;
  	$episode->drive 	= $rq->drive;
  	$episode->status 	= 'uploading';
  	$episode->save();
  	return $episode;
  
  }
  public function delete($fid, $id) {
  	$episode = Episode::find($id);
  	$episode->delete();
  	return 'OKE';
  }

  public function all (Request $rq) {
  	$episodes = Episode::orderBy('status', 'desc')
  		->orderBy('updated_at')
      ->where(function ($q) use ($rq) {
        if ($rq->keyword) $q->where('name', 'like', '%'.$rq->keyword.'%');
      })
      ->limit($rq->show)
  		->get();
  	return $episodes;
  }

  protected function existsDrive ($drive_url) {
  	$client = new \GuzzleHttp\Client();
  	$response = $client->request('GET', $drive_url, ['http_errors' => false]);
  	if ($response->getStatusCode() != 200) {
  		return false;
  	}
  	return true;
  }
  protected function uploadFile($drive_id) {
    $client = new \GuzzleHttp\Client();
    $client->request('GET', 'http://116.203.155.21:3001/addDriveId?driveId='.$drive_id);
  }

}


