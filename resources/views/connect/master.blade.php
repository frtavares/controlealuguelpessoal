<!DOCTYPE html>
<html>
<head>
	<title>frtsys - @yield('title')</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
	
	<link rel="stylesheet" href="{{ url('/static/css/bootstrap2.min.css?v='.time()) }}">
    <link rel="stylesheet" href="{{ url('/static/css/connect2.css?v='.time()) }}">
	<link rel="stylesheet" href="{{ url('/static/css/icomoon.css?v='.time()) }}">
	<link rel="stylesheet" href="{{ url('/static/css/carousel.min.css?v='.time()) }}">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/b0d8aefb17.js" crossorigin="anonymous"></script>
</head>
<body>

	

	@section('content')
	
	@show

</body>

<script src="{{ url('/static/js/connect.js?v='.time()) }}"></script>
<script src="{{ url('/static/js/popper.min.js?v='.time()) }}"></script>
<script src="{{ url('/static/js/bootstrap.min.js?v='.time()) }}"></script>
<script src="{{ url('/static/js/main.js?v='.time()) }}"></script>

</html>