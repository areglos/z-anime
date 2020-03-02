<div id="header" class="container">
	<nav class="navbar navbar-light justify-content-between p-0 pt-2 pb-2" style="border-bottom:1px solid #343a40  !important; position:relative;">
		<ul class="list-inline mb-0 menu-top-category active">
			<li class="list-inline-item nav-item">
				<a class="nav-link font-weight-bold pl-0" href="/"><img src="{{ asset('img/logo.png') }}" style="width:100px;"></a>
			</li>
			<li class="list-inline-item nav-item">
				<a class="nav-link font-weight-bold px-2 dropdown-toggle" data-toggle="collapse" href="#genres" style="color:#d9d9d9">
					<i class="fa fa-atom"></i> <span class="d-none d-md-inline">Genre</span>
				</a>
			</li>
			<li class="list-inline-item nav-item">
				<a class="nav-link font-weight-bold px-2 dropdown-toggle" data-toggle="collapse" href="#types" style="color:#d9d9d9">
					<i class="fa fa-atom"></i> <span class="d-none d-md-inline">Type</span>
				</a>
			</li>
			<li class="list-inline-item nav-item">
				@if (!Auth::check())
				<a class="nav-link font-weight-bold px-2" href="{{ route('theme.getSignIn') }}">
					<span class="d-md-inline" style="color:#d9d9d9">Đăng nhập</span>
				</a>
				@else
				<div class="dropdown show">
					<a class="nav-link font-weight-bold px-2 dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Account</a>
					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
						<a class="dropdown-item" href="{{ route('theme.history' )}}">History</a>
						<a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
						@if (Auth::user()->hasRole('manager') )
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="/admin">Admin Panel</a>
						@endif
				@endif
			</li>
			
			<!-- <li class="list-inline-item nav-item">
				<a class="nav-link font-weight-bold px-2"><i class="fa fa-bars"></i> <span class="d-none d-md-inline">Loại Phim</span></a>
			</li> -->
			
		</ul>
		<form class="form-inline search-top-form d-inline">
			<input type="search" class="form-control mr-sm-2 border-0 bg-holder rounded-pill text-light" placeholder="Tìm kiếm phim" aria-label="Search" style="background:#212c35 !important;">
			<button class="btn btn-dark my-2 my-sm-0 d-none d-md-inline" type="submit"><i class="fa fa-search"></i></button>
		</form>

		<!--
		<div class="collapse" id="genres" style="position:absolute; top:calc(100% + 1px); left:0; width:100%; z-index:999; background:#212c35; padding:1rem 15px; transition:none;">
			<div class="row">
				// foreach
				<div class="col-6 col-sm-3 mb-3">
					<a href=""></a>
				</div>
				//endforeach
			</div>
		</div>
		<div class="collapse" id="types" style="position:absolute; top:calc(100% + 1px); left:0; width:100%; z-index:999; background:#212c35; padding:1rem 15px; transition:none;">
			<div class="row">
				// foreach
				<div class="col-6 col-sm-3 mb-3">
					<a href=""></a>
				</div>
				//endforeach
			</div>
		</div>
		-->
	</nav>
	
</div>
