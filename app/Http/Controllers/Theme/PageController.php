<?php

namespace App\Http\Controllers\Theme;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Film;

class PageController extends Controller
{   
    public function home () {
        $films = Film::with('latest_episode')->whereHas('latest_episode')->paginate(16);
        $films->setCollection($films->sortByDesc('latest_episode.created_at'));
        	
        $topFilms = Film::with('latest_episode')->whereHas('latest_episode')->orderBy('view','desc')->limit(5)->get();

        $title = 'Page Home';
        return view('theme.pages.index', compact('title', 'films', 'topFilms'));
    }

    
}
