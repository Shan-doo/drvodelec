<!DOCTYPE html>

<html lang="en">

<head>

	<title>{{ config('app.name') }}</title>

	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	
	<!-- favicon -->
	<link rel="icon" type="/image/png" href="./images/logo.png">
	
	<!-- cdns -->
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,700|Open+Sans:700' rel='stylesheet' type='text/css'>
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	
	<!-- <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel='stylesheet' id='camera-css'  href='css/camera.css' type='text/css' media='all'>
	<link rel="stylesheet" type="text/css" href="css/slicknav.css">
	<link rel="stylesheet" href="css/prettyPhoto.css" type="text/css" media="screen" title="prettyPhoto main stylesheet" charset="utf-8" />		
	<link rel="stylesheet" type="text/css" href="css/select2.css">
	<link rel="stylesheet" type="text/css" href="css/normalize.css">
	<link rel="stylesheet" type="text/css" href="css/style.css"> -->

	<link rel="stylesheet" type="text/css" href="/css/master.css">

	<!-- <script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
	<script type="text/javascript" src="js/jquery.mobile.customized.min.js"></script>
	<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"></script>	
	<script src="js/jquery.slicknav.js"></script>
	<script type="text/javascript" src="js/camera.min.js"></script>
	<script src="js/shuffle.js"></script>
	<script src="js/select2.js"></script> -->
	<script src="/js/vendors.js"></script>
	

</head>

	<body id="body">

	    <!--home start-->

	    <!-- {{ App::getLocale() }}
	    
	    {{ session('locale') }} -->
	    
	    <div id="home">

	    	<div class="headerLine">

				@include('layouts.navigation')
				
				@if(Request::segment(1) !== 'admin' && Request::segment(1) !== 'login' && Request::segment(2) !== 'forgot')

				@include('layouts.gallery')

				@endif

			</div>
			  
	    </div>

	    @yield('content')

	    @include('layouts.footer')
		
	</body>
	
</html>