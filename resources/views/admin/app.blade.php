<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>We Dew Lawns</title>
	<!--
	<link href="/css/app.css" rel="stylesheet">
-->
	<link rel="stylesheet" href="{{ elixir('css/app.css') }}">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>

		@include('inc.nav')

		@yield('intro', view('default_intro'))

		<div class="container">
		<div class="row">
			<div class="col-md-12">
			@if(Session::has('message'))
			    <div class="alert alert-info">
			      {{ Session::get('message') }}
			    </div>
			@endif
			</div>		
		</div>
			<div class="row">
				<div class="col-md-9">
					@yield('content')
				</div>
				<div class="col-md-3">
					@include('inc.sidebar')
				</div>
			</div>
		</div>

		<footer>
			&copy; 1971 - {{ date("Y") }} We Dew Lawns, Inc., a fictional lawn care company.<br />
			Cool lawn photograph <a href="https://www.flickr.com/photos/adamkr/4507810159/in/photolist-7SkGUP-kwDzU-h4fgGJ-9pEbxe-7HrmV1-a4mr9F-oewKYZ-h4gMRY-h4gxUS-692irQ-4gEdnq-7XW6Vk-c61vkG-kx3mo-bjup6Q-ktm8BH-4aW9CX-ouWTh-ktkrnX-aUPTHe-57ZpqM-6NetV2-6rRN7N-egFA9U-cG1fgC-4iFXhu-docNQ9-ktm7Le-5X6x6T-fdwLTh-ktku3X-5X6Q4P-9m56PA-niHkAq-9sAuHj-4RU6PW-mzeLc-bPrVsP-oGELe-3o4Jfz-52jjHR-pMKHTJ-7AnDdo-LrFMf-e781RD-p8AHQQ-etM9bx-h4hhiu-2PXaov-eepyo3">credit</a>. &middot; Cool grass blades <a href="https://www.flickr.com/photos/77108378@N06/16604611047/in/photolist-rihYnn-Ju6fP-qq8Lrt-pQJW1V-rpaLsT-a4tci3-6n95uh-9cYBYt-9dUV9z-f8moN-3gPcy-a3N9iL-9fc2MM-aro1g-36feP-65YUZr-9cHcQa-9dgRfu-9NW9dP-spgVuf-nP9rZF-NCrec-51zjZf-cfNGgd-cgnZvw-aD42PE-9dmT4V-bDfsRU-ewAdy1-6LxfHf-6cfSGm-6WAmK2-8XvRzc-9GWGW6-aSbH4-ufemn-67YqaE-9NYYKU-9dnn9i-9d4AgH-rnw6MQ-9NYYJh-6HrrCK-npi1Eg-6UeUtu-6cfSJG-49Ckgy-fk5vW6-8wWxgs-6HwhxJ">credit</a>
		</footer>
	<!-- Scripts -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
    @yield('footer_js')
</body>
</html>
