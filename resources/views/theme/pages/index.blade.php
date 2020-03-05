@extends('theme.layout')

@section('title', $title )
@section('content')

<div class="row">
	<div class="col-sm-9">
		<h4 class="text-warning">Recent Release</h4>
		<div class="row">
			@foreach ($films as $film)
			<div class="col-6 col-md-4 col-lg-3  holder-movie">
				<div class="position-relative">
					<a href="{{ route('theme.anime', $film->slug )}}">
						<img src="{{ asset($film->image ? $film->image : '/img/film_image.jpeg')}}" alt="{{ $film->name }}" class="img-fluid rounded">
					</a>
					<span class="status">{{ $film->latest_episode->ep }}</span>
					<span class="comment"><i class="fa fa-heart mr-1"></i>0</span>
				</div>
				<div class="info-container">
					<ul class="p-0 mt-2 mb-3">
						<li class="original-name">
							<a title="{{ $film->name}}" class="font-weight-bold" href="{{ route('theme.anime', $film->slug )}}">{{ $film->name }}</a>
						</li>
					</ul>
				</div>
			</div>
			@endforeach
		</div>
		{{ $films->links('theme.partials.paginate') }}
	</div>

	<div class="col-sm-3">
		@include('theme.widgets.topview')
	</div>
	
</div>

@endsection