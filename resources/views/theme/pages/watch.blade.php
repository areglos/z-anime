@extends('theme.layout')
@section('title', $title)
@section('content')

<div class="row">
	<div class="col-12 col-lg-7">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb mb-0" style="background:none; padding:0 0 0.75rem">
				<li class="breadcrumb-item"><a href="/">Home</a></li>
				<li class="breadcrumb-item"><a href="{{ route('theme.anime', $episode->film->slug) }}">{{ $episode->film->name }}</a></li>
				<li class="breadcrumb-item active d-none d-md-inline">{{ $episode->label ? $episode->label : ('Episode '. $episode->ep) }}</li>
			</ol>
		</nav>
		<!-- VIDEO -->
		<div style="min-height:355.5px; background:#212c35; position:relative;">
			<iframe style="position: absolute;top: 0;left: 0;width: 100%;height: 100%;overflow:hidden;" src="/stream?code={{$hash}}" allowfullscreen="" frameborder="0"></iframe>
		</div>
		<!-- -->
		<div class="mt-4">
			<h6 class="font-weight-bold"><i class="fa fa-list"></i> List of Episodes:</h6>
			<ul class="list-inline">
				@foreach($episode->film->episodes as $ep)
					<li class="list-inline-item p-2 m-1 rounded small {{ ($ep->slug==$episode->slug) ? 'bg-danger' :'bg-holder' }} "><a href="{{ route('theme.watch', $ep->slug ) }}">{{ $ep->ep }}</a></li>
				@endforeach
			</ul>
		</div>
	</div>
	<div class="col-12 col-lg-5">
		<div class="comment-area">
			<div class="fb-comments" data-href="{{ route('theme.anime', $episode->film->slug ) }}" data-width="100%" data-numposts="8" data-colorscheme="dark"></div>
		</div>
	</div>
</div>

@endsection