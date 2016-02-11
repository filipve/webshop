@extends('app')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <h1>Hi {{ Auth::user()->name }}, welcome back!</h1>
      <p class="lead">Below is a list of all the special offers We Dew Lawns currently has available.</p>
    </div>
  </div>
</div>
@endsection
