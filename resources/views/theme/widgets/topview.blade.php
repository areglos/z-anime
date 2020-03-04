<div class="widget topview">
	<h5 class="text-warning text-uppercase">Đang Xem Nhiều Nhất</h5>
	<ul>
		@foreach ($topFilms as $film)
		<li class="mb-2">
			<a title="xem phim I hate being in pain, so I think I'll make a full defense build., I Hate Getting Hurt, So I Put All My Skill Points Into Defense " href="{{ route('theme.anime', $film->slug )}}">
				<div class="img-container" style="background: rgba(0, 0, 0, 0) url('{{ asset($film->background) }}') repeat scroll center center / cover;">
					<span class="people small">72</text> đang xem</span>
					<div class="titleGroup">
						<h3 class="font-weight-bold">
							<a class="text-warning" href="{{ route('theme.anime', $film->slug )}}">{{ $film->name }}</a>
						</h3>
					</div>
				</div>
			</a>
		</li>
		@endforeach
	</ul>
</div>