@extends('layouts.master-no-nav')

@section('head')
	<link href="/compiled/css/bootstrap-splash.css" rel="stylesheet">
@stop

@section('content')
	<div class="site-wrapper">

		<div class="site-wrapper-inner">

			<div class="cover-container">

				<div class="masthead clearfix">
					<div class="inner">
						<h3 class="masthead-brand">sequl&nbsp;<small>(sequel without the e)</small></h3>
						<nav>
							<ul class="nav masthead-nav">
								<li><a href="/home">Home</a></li>
								<li class="active"><a href="#">Register</a></li>
								<li><a href="/auth/login">Login</a></li>
							</ul>
						</nav>
					</div>
				</div>

				<div class="inner cover">

					<h1>Register.</h1>
					<h4>Glad to have you!</h4>
				</div>

				@if (count($errors) > 0)
					@foreach ($errors->all() as $error)
						<strong><p class="text-danger"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> {{ $error }}</p></strong>
					@endforeach
				@endif

					<form class="col-md-6 col-md-offset-3" role="form" method="POST" action="{{ url('/auth/register') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<input type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="Username" autofocus>
						</div>

						<div class="form-group">
							<input type="text" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email (optional, for password resets)">
						</div>

						<div class="form-group">
							<input type="password" class="form-control" name="password" placeholder="Password">
						</div>

						<div class="form-group">
							<input type="password" class="form-control" name="password_confirmation" placeholder="Password again">
						</div>

						<div class="form-group">
							<div class="col-md-5 col-md-offset-4">
								<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
