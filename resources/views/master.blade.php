<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>@yield('title') - {{ Config::get('madecms.name') }}</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="routeName" content="{{ Route::currentRouteName() }}">
	<meta name="currency" content="{{ Config::get('madecms.currency') }}">
	<meta name="auth" content="{{ Auth::check() }}">

	<!-- CSS only -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
	<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
	<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
	<link rel="stylesheet" href="{{ url('/static/css/style.css?v='.time()) }}">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;500;700&display=swap" rel="stylesheet">
	
	<!-- JS -->
	<script src="https://kit.fontawesome.com/b0d8aefb17.js" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
	<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
	<script src="{{ url('/static/js/mdslider.js?v='.time()) }}"></script>
	<script src="{{ url('/static/js/site.js?v='.time()) }}"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

</head>
<body>

	<div class="loader" id="loader">
		<div class="box">
			<!-- <div class="cart">
				<img src="{{ url('/static/images/loader_cart.png') }}">
			</div> -->
			<div class="load">
				<div class="spinner-border text-secondary" role="status">
					
				</div>
			</div>
		</div>
	</div>

	<nav class="navbar navbar-expand-lg shadow">
		<div class="container">
			<a class="navbar-brand" href="{{ url('/') }}"><img src="{{ url('/static/images/logo.png') }}"></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigationMain" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				<i class="fas fa-bars"></i>
			</button>

			<div class="collapse navbar-collapse" id="navigationMain">
				<ul class="navbar-nav ml-auto">
					<!-- <li class="nav-item">
						<a href="{{ url('/') }}" class="nav-link"><i class="fas fa-home"></i> <span>Home</span></a>
					</li>
					<li class="nav-item">
						<a href="{{ url('/') }}" class="nav-link"><i class="fas fa-store-alt"></i> <span>Loja</span></a>
					</li>
					<li class="nav-item">
						<a href="{{ url('/') }}" class="nav-link"><i class="fas fa-id-card-alt"></i> <span>Sobre Nós</span></a>
					</li>
					<li class="nav-item">
						<a href="{{ url('/') }}" class="nav-link"><i class="far fa-envelope-open"></i> <span>Contatos</span></a>
					</li>
					<li class="nav-item">
						<a href="{{ url('/car') }}" class="nav-link"><i class="fas fa-shopping-cart"></i> <span class="carnumber">0</span></a>
					</li> -->
					@if(Auth::guest())
					<li class="nav-item link-acc">
						<a href="{{ url('/login') }}" class="nav-link btn"><i class="fas fa-fingerprint"></i> Entrar</a>
						<a href="{{ url('/register') }}" class="nav-link btn"><i class="far fa-user-circle"></i> Criar Conta</a>
					</li>
					@else
					<li class="nav-item dropdown link-acc link-user">
						<a href="#" class="nav-link btn dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-expanded="false">
							@if(is_null(Auth::user()->avatar))
								<img src="{{ url('/static/images/default-avatar.png') }}">
							@else
								<img src="{{ url('/uploads_users/'.Auth::id().'/av_'.Auth::user()->avatar) }}" class="circle">
							@endif Olá: {{ Auth::user()->name }}
						</a>
						<ul class="dropdown-menu shadow" aria-labelledby="navbarDropdown">
							@if(Auth::user()->role == "1")
							<li>
								<a class="dropdown-item" href="{{ url('/admin') }}">
									<i class="fas fa-chalkboard-teacher"></i> Administração
								</a>
							</li>
							<li><hr class="dropdown-divider"></li>
							@endif
							<!-- <li>
								<a class="dropdown-item" href="{{ url('/account/favorites') }}">
									<i class="fas fa-heart"></i> Favoritos
								</a>
							</li> -->
							<li>
								<a class="dropdown-item" href="{{ url('/account/edit') }}">
									<i class="fas fa-address-card"></i> Editar perfil
								</a>
							</li>
							<li>
								<a class="dropdown-item" href="{{ url('/logout') }}">
									<i class="fas fa-sign-out-alt"></i> Sair
								</a>
							</li>
						</ul>
					</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>


@if(Session::has('message'))
		<div class="container">           
		<div class="alert alert-{{ Session::get('typealert') }} mtop16" style="display:block; margin-bottom: 16px;"> 
			{{ Session::get('message') }}
			@if ($errors->any())       
			<ul>
				@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
				@endforeach
			</ul>
			@endif
			<script>
				$('.alert').slideDown();
				setTimeout(function(){ $('.alert').slideUp(); }, 10000);
			</script>
		</div>
		</div>
	@endif

	<div class="wrapper">
		<div class="container">
			@yield('content')
		</div>
	</div>
	
</body>
</html>