<?php

namespace App\Http\Controllers\Theme;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Film;
use App\Models\Episode;
use App\Models\Category;
use App\Models\Type;
use Session;
class PageController extends Controller
{   
	public function home () {
		$films = Film::with('latest_episode')->whereHas('latest_episode')->paginate(16);
		$films->setCollection($films->sortByDesc('latest_episode.created_at'));
			
		$topFilms = Film::with('latest_episode')->whereHas('latest_episode')->orderBy('view','desc')->limit(5)->get();

		$title = 'Page Home';
		return view('theme.pages.index', compact('title', 'films', 'topFilms'));
	}
	public function category ($slug) {
		$category = Category::whereSlug($slug)->first();
		$films = Film::with('latest_episode')->whereHas('latest_episode')
			->whereHas('categories', function ($q) use ($slug) {
				$q->whereSlug($slug);
			})
			->paginate(16);
		$films->setCollection($films->sortByDesc('latest_episode.created_at'));
		$topFilms = Film::with('latest_episode')->whereHas('latest_episode')->orderBy('view','desc')->limit(5)->get();
		$title = 'Page Home';
		return view('theme.pages.category', compact('title', 'films', 'topFilms', 'category'));
	}

	public function type ($slug) {
		$type = Type::whereSlug($slug)->first();
		$films = Film::with('latest_episode')->whereHas('latest_episode')
			->whereHas('type', function ($q) use ($slug) {
				$q->whereSlug($slug);
			})
			->paginate(16);
		$films->setCollection($films->sortByDesc('latest_episode.created_at'));
		$topFilms = Film::with('latest_episode')->whereHas('latest_episode')->orderBy('view','desc')->limit(5)->get();
		$title = 'Page Home';
		return view('theme.pages.type', compact('title', 'films', 'topFilms', 'type'));
	}

	public function anime ($slug) {
		$film = Film::whereSlug($slug)
			->with('categories', 'type')
			->with(['episodes' => function ($q) {
					$q->orderBy('ep', 'desc');
					$q->limit(3);
			}])
			->first();
		$title = 'Anime '.$film->name;
		return view('theme.pages.anime', compact('title', 'film'));
	}

	public function watch ($slug) {
		$episode = Episode::whereSlug($slug)
			->with(['film' => function ($q) {
				$q->with('episodes');
			}])
			->first();
		// Hassh
		$sid = Session::getId();
    $hash = md5($episode->slug.$sid);
    Session::put($hash, $episode->slug);
			
			
		$title = 'Watch '.$episode->name;
		return view('theme.pages.watch', compact('title', 'episode', 'hash'));
	}

	public function stream (Request $rq) {
		$slug = Session::get($rq->code);
		$episode = Episode::whereSlug($slug)->first();
		$drive = get_drive_id($episode->drive);
		$ch =  curl_init('http://116.203.155.21/getKeyEmbed?file=downloaded.'.$drive.'.mp4');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    curl_setopt($ch, CURLOPT_TIMEOUT, 3);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
    $data = json_decode(curl_exec($ch), true);
    
    $html = file_get_contents('http://116.203.155.21/embedplay/'.$data['key']);
    return $html;
	}

	
}
