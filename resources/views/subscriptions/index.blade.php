@extends('app')

@section('intro')
  <div class="intro">
    <div class="container">
      <h1>Make your neighbors envious!</h1>
      <p>Let the professionals at WeDewLawns service your lawn.</p>
    </div>
  </div>
@endsection

@section('content')
	<div class="col-xs-12 col-sm-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title text-center">Gold Plan $20</h3>
			</div>
			<div class="panel-body">
				<p>Get a healthy, weed-free lawn with our patented monthly weed-free service.</p>
                <div class="text-center"><a class="btn btn-primary" href="/plans/subscribe/gold">Select</a></div>
			</div>
		</div>
	</div>

	<div class="col-xs-12 col-sm-4">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title text-center">Platinum Plan $35</h3>
			</div>
			<div class="panel-body">
				<p>Take your lawn to the next level with our Platinum plan. With this plan you get monthly spraying and fertilizing. </p>
                <div class="text-center"><a class="btn btn-primary" href="/plans/subscribe/platinum">Select</a></div>
			</div>
		</div>
	</div>

	<div class="col-xs-12 col-sm-4">
		<div class="panel panel-success">
			<div class="panel-heading">
				<h3 class="panel-title text-center">Diamond Plan $50</h3>
			</div>
			<div class="panel-body">
				<p><b>Our Best Value!</b></p>
				<p>Make your lawn shine! With this plan you get monthly spraying, fertilizing, and spring/fall aeration. </p>
				<div class="text-center"><a class="btn btn-primary" href="/plans/subscribe/diamond">Select</a></div>
			</div>
		</div>
	</div>

@endsection
