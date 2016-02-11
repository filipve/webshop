@extends('app')

@section('intro')
	<div class="intro">
    <div class="container">
    	<h1>Please Sign In to Your WeDewLawns.com Account</h1>
    </div>
  </div>
@endsection

@section('content')
	<h1 class="primary">Please Sign In</h1>
	@if (count($errors) > 0)
		<div class="alert alert-danger">
			<strong>Whoops!</strong> There were some problems with your input.<br><br>
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif

<p>
Visitors in search of special discounts or who would like to purchase a lawn care subscription must first sign in. Don't have an account? <a href="/auth/register">Creating an account is free and easy</a>!
</p>

	<div class="well well-lg">
		<form class="form-horizontal" role="form" method="POST" action="/login">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">

				<div class="form-group">
					<label class="col-md-4 control-label">E-Mail Address</label>
					<div class="col-md-6">
						<input type="email" class="form-control" name="email" value="{{ old('email') }}">
					</div>
				</div>

				<div class="form-group">
					<label class="col-md-4 control-label">Password</label>
					<div class="col-md-6">
						<input type="password" class="form-control" name="password">
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-6 col-md-offset-4">
						<div class="checkbox">
							<label>
								<input type="checkbox" name="remember"> Remember Me
							</label>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-6 col-md-offset-4">
						<button type="submit" class="btn btn-primary" style="margin-right: 15px;">
							Sign In
						</button>

						<a href="/password/email">Forgot Your Password?</a>
					</div>
				</div>
			</form>
	</div>
@endsection
