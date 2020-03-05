@extends('theme.layout')
@section('title', $title )

@section('content')
<nav aria-label="breadcrumb">
	<ol class="breadcrumb mb-0" style="background:none; padding:0 0 0.75rem">
		<li class="breadcrumb-item"><a href="/">Home</a></li>
		<li class="breadcrumb-item active" aria-current="page">{{ $film->name }}</li>
	</ol>
</nav>
<div class="row film-info">
	<div class="col-12 col-md-4 col-lg-3 mb-3 mb-md-0">
		<div class="position-relative">
			<img src="{{ asset($film->background) }}" class="img-fluid d-block d-sm-none" >
			<img src="{{ asset($film->image) }}" class="img-fluid d-none d-sm-block">
			<span class="comment"><i class="fa fa-heart mr-1"></i> 0</span>
			<span class="views"><i class="fa fa-eye"></i> 12k </span>
		</div>
		<div class="row">
			<div class="col-6 pr-1">
				<a class="btn btn-danger btn-block mt-2 btn-sm" href="#"><i class="fa fa-play"></i> Watch</a>
			</div>
			<div class="col-6 pl-1">
				<button class="btn btn-primary btn-block mt-2 btn-sm"><i class="fa fa-calendar-star"></i> Like</button>
			</div>
		</div>
	</div>
	<div class="col-12 col-md-8 col-lg-9">
		<ul class="p-0 mb-0">
			<li>
				<h1 class="mb-2" style="font-size:22px;">{{ $film->name }}</h1>
			</li>
			
			<li class="mt-1">
				<b>Latest episode:</b>
				@foreach($film->episodes as $ep)
					<a class="badge badge-light py-1 px-3 ml-1" href="{{ route('theme.watch', $ep->slug) }}">{{ $ep->ep }}</a>
				@endforeach 
			</li>
			<li class="mt-1">
				<b>Type:</b> <span class="text-capitalize">{{ $film->type->name }}</span>
			</li>
			<li class="mt-1">
				<b>Genre:</b> 
				@foreach($film->categories as $category)
				<a href="{{ route('theme.category', $category->slug) }}" class="badge badge-secondary">{{ $category->name }}</a>
				@endforeach
			</li>
			<li class="mt-3">
				<div class="description-movie">{{{ ($film->description) ? $film->description : 'Content is being updated' }}}</div>
			</li>
		</ul>
	</div>
</div>
<div class="comment-area mt-3">
	<div class="fb-comments" data-href="{{ route('theme.anime', $film->slug) }}" data-width="100%" data-numposts="8" data-colorscheme="dark"></div>

@endsection