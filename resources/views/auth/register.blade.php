@extends('app')

@section('intro')
	<div class="intro blade">
    <div class="container">
    	<h1>Create a WeDewLawns.com Account</h1>
    </div>
  </div>
@endsection

@section('content')
	<h1 class="primary">Register for an account</h1>

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
Creating a WeDewLawns.com account is free and easy. Registered account holders have exclusive access to the latest lawn care service discounts, and can subscribe to one of our popular service plans.
</p>

	<form class="form-horizontal" role="form" method="POST" action="/register">
		<input type="hidden" name="_token" value="{{ csrf_token() }}">

		<div class="form-group">
			<label class="col-md-4 control-label">Name</label>
			<div class="col-md-6">
				<input type="text" class="form-control" name="name" value="{{ old('name') }}">
			</div>
		</div>

    <div class="form-group">
      <label class="col-md-4 control-label">Address</label>
      <div class="col-md-6">
        <input type="text" class="form-control" name="address" value="{{ old('address') }}">
      </div>
    </div>
    <div class="form-group">
      <label class="col-md-4 control-label">City</label>
      <div class="col-md-6">
        <input type="text" class="form-control" name="city" value="{{ old('city') }}">
      </div>
    </div>
    <div class="form-group">
      <label class="col-md-4 control-label">State</label>
      <div class="col-md-6">
        <input type="text" class="form-control" name="state" value="{{ old('state') }}">
      </div>
    </div>
    <div class="form-group">
      <label class="col-md-4 control-label">Zip</label>
      <div class="col-md-6">
        <input type="text" class="form-control" name="zip" value="{{ old('zip') }}">
      </div>
    </div>

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
			<label class="col-md-4 control-label">Confirm Password</label>
			<div class="col-md-6">
				<input type="password" class="form-control" name="password_confirmation">
			</div>
		</div>

		<div class="form-group">
			<div class="col-md-6 col-md-offset-4">
				<button type="submit" class="btn btn-primary">
					Register
				</button>
			</div>
		</div>
	</form>
@endsection
