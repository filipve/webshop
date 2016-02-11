@extends('admin.layouts.app')

@section('main-content')

<h1>WeDewLawns.com Administration Console</h1>

<ul>
	<li>{!! link_to_route('admin.orders.index', 'Manage Orders') !!}</li>
	<li>{!! link_to_route('admin.products.index', 'Manage Products') !!}</li>
</ul>

@endsection