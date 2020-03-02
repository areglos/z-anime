@extends('theme.layout')

@section('content')
<div class="row">
	<div class="col-sm-8">
		<div class="row">
			<div class="col-sm-8 offset-sm-2">
				<h1 class="text-center">Sign In</h1>
				<div class="form-group">
					<label>With</label>
					<div class="row">
						<div class="col-sm-6 mb-1">
							<a class="btn btn-block btn-primary">
								<i class="fa fa-facebook mr-2"></i> Facebook
							</a>
						</div>
						<div class="col-sm-6">
							<a class="btn btn-block btn-danger">
								<i class="fa fa-google-plus mr-2"></i> Google
							</a>
						</div>
					</div>
				</div>
				<hr class="my-2" style="border-color:#343a40 !important" />
				<form method="POST" action="{{ route('theme.postSignIn') }}">
					@csrf
					@if(session('error'))
						<div class="alert alert-danger">
							{{ session('error') }}
						</div>
					@endif
					<div class="form-group">
						<label>Email</label>
						<input class="form-control" type="text" name="email" placeholder="" />
					</div>
					<div class="form-group">
						<label>Password</label>
						<input class="form-control" type="password" name="password" placeholder="" />
					</div>
					<p><a href="{{ route('theme.getSignUp')}}" class="text-primary">Click here to sign up !</a></p>
					<div class="text-center">
						<input type="submit" class="btn btn-primary" value="Sign In" />
					</div>
				</form>
			</div> <!-- col 8 -->
		</div>
	</div>
</div>
@endsection