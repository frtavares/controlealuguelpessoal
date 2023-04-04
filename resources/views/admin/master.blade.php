<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>@yield('title') - {{ Config::get('madecms.name') }}</title>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="routeName" content="{{ Route::currentRouteName() }}">

	@yield('css')
	<!-- CSS only -->
    
	<link rel="stylesheet" href="{{ url('/static/bootstrap.min.css')}}" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
	
	<link href="{{ url('/static/css/all.min.css')}}" rel="stylesheet" type="text/css">

   <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap" rel="stylesheet">
	<link rel="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"  rel="stylesheet"/>

    <link href="{{ url('/static/css/sb-admin-2.css?v='.time()) }}" rel="stylesheet">
    {{-- <link href="{{ url('/static/css/admin.css?v='.time()) }}" rel="stylesheet"> --}}
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

	<link rel="stylesheet" type="text/css" 
    href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"> 

	{{-- <link rel="stylesheet" href="{{ url('/static/css/dataTables.bootstrap5.min.css') }}"> --}}
	<script>
		$(document).ready(function() {
			$('[data-bs-toggle="tooltip"]').tooltip()
	 });
	 </script>
	
</head>


<body id="page-top">
	<!-- Loader -->
	<div class="load" id="loader">
		<div class="load">
			<img src="{{ url('/static/images/loading_white.svg') }}">
		</div> 
	</div>

		<!-- Page Wrapper -->
		<div id="wrapper">
	
			<div class="col1">@include('admin.sidebar')</div>
		
 <!-- Content Wrapper -->
 <div id="content-wrapper" class="d-flex flex-column">

	<!-- Main Content -->
	<div id="content">

		<!-- Topbar -->
		<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

			<!-- Sidebar Toggle (Topbar) -->
			<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
				<i class="fa fa-bars"></i>
			</button>

			<!-- Topbar Search -->
			{{-- <form
				class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
				<div class="input-group">
					<input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
						aria-label="Search" aria-describedby="basic-addon2">
					<div class="input-group-append">
						<button class="btn btn-primary" type="button">
							<i class="fas fa-search fa-sm"></i>
						</button>
					</div>
				</div>
			</form> --}}

			<!-- Topbar Navbar -->
			<ul class="navbar-nav ml-auto">

				<!-- Nav Item - Search Dropdown (Visible Only XS) -->
				<li class="nav-item dropdown no-arrow d-sm-none">
					<a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
						data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="fas fa-search fa-fw"></i>
					</a>
					<!-- Dropdown - Messages -->
					<div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
						aria-labelledby="searchDropdown">
						<form class="form-inline mr-auto w-100 navbar-search">
							<div class="input-group">
								<input type="text" class="form-control bg-light border-0 small"
									placeholder="Search for..." aria-label="Search"
									aria-describedby="basic-addon2">
								<div class="input-group-append">
									<button class="btn btn-primary" type="button">
										<i class="fas fa-search fa-sm"></i>
									</button>
								</div>
							</div>
						</form>
					</div>
				</li>

				<!-- Nav Item - Alerts -->
				<li class="nav-item dropdown no-arrow mx-1">
					<a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
						data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="fas fa-bell fa-fw"></i>
						<!-- Counter - Alerts -->
						<span class="badge badge-danger badge-counter">3+</span>
					</a>
					<!-- Dropdown - Alerts -->
					<div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
						aria-labelledby="alertsDropdown">
						<h6 class="dropdown-header">
							Alerts Center
						</h6>
						<a class="dropdown-item d-flex align-items-center" href="#">
							<div class="mr-3">
								<div class="icon-circle bg-primary">
									<i class="fas fa-file-alt text-white"></i>
								</div>
							</div>
							<div>
								<div class="small text-gray-500">December 12, 2019</div>
								<span class="font-weight-bold">A new monthly report is ready to download!</span>
							</div>
						</a>
						<a class="dropdown-item d-flex align-items-center" href="#">
							<div class="mr-3">
								<div class="icon-circle bg-success">
									<i class="fas fa-donate text-white"></i>
								</div>
							</div>
							<div>
								<div class="small text-gray-500">December 7, 2019</div>
								$290.29 has been deposited into your account!
							</div>
						</a>
						<a class="dropdown-item d-flex align-items-center" href="#">
							<div class="mr-3">
								<div class="icon-circle bg-warning">
									<i class="fas fa-exclamation-triangle text-white"></i>
								</div>
							</div>
							<div>
								<div class="small text-gray-500">December 2, 2019</div>
								Spending Alert: We've noticed unusually high spending for your account.
							</div>
						</a>
						<a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
					</div>
				</li>

				<!-- Nav Item - Messages -->
				<li class="nav-item dropdown no-arrow mx-1">
					<a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
						data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="fas fa-envelope fa-fw"></i>
						<!-- Counter - Messages -->
						<span class="badge badge-danger badge-counter">7</span>
					</a>
					<!-- Dropdown - Messages -->
					<div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
						aria-labelledby="messagesDropdown">
						<h6 class="dropdown-header">
							Message Center
						</h6>
						<a class="dropdown-item d-flex align-items-center" href="#">
							<div class="dropdown-list-image mr-3">
								<img class="rounded-circle" src="img/undraw_profile_1.svg"
									alt="...">
								<div class="status-indicator bg-success"></div>
							</div>
							<div class="font-weight-bold">
								<div class="text-truncate">Hi there! I am wondering if you can help me with a
									problem I've been having.</div>
								<div class="small text-gray-500">Emily Fowler · 58m</div>
							</div>
						</a>
						<a class="dropdown-item d-flex align-items-center" href="#">
							<div class="dropdown-list-image mr-3">
								<img class="rounded-circle" src="img/undraw_profile_2.svg"
									alt="...">
								<div class="status-indicator"></div>
							</div>
							<div>
								<div class="text-truncate">I have the photos that you ordered last month, how
									would you like them sent to you?</div>
								<div class="small text-gray-500">Jae Chun · 1d</div>
							</div>
						</a>
						<a class="dropdown-item d-flex align-items-center" href="#">
							<div class="dropdown-list-image mr-3">
								<img class="rounded-circle" src="img/undraw_profile_3.svg"
									alt="...">
								<div class="status-indicator bg-warning"></div>
							</div>
							<div>
								<div class="text-truncate">Last month's report looks great, I am very happy with
									the progress so far, keep up the good work!</div>
								<div class="small text-gray-500">Morgan Alvarez · 2d</div>
							</div>
						</a>
						<a class="dropdown-item d-flex align-items-center" href="#">
							<div class="dropdown-list-image mr-3">
								<img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60"
									alt="...">
								<div class="status-indicator bg-success"></div>
							</div>
							<div>
								<div class="text-truncate">Am I a good boy? The reason I ask is because someone
									told me that people say this to all dogs, even if they aren't good...</div>
								<div class="small text-gray-500">Chicken the Dog · 2w</div>
							</div>
						</a>
						<a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
					</div>
				</li>

				<div class="topbar-divider d-none d-sm-block"></div>

				

				<!-- Nav Item - User Information -->
				<li class="nav-item dropdown no-arrow">
					<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
						data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }} {{ Auth::user()->lastname }}</span>
						@if(is_null(Auth::user()->avatar))
								<img src="{{ url('/static/images/default-avatar.png') }}" class="img-profile rounded-circle">
							@else
								<img src="{{ url('/uploads_users/'.Auth::id().'/av_'.Auth::user()->avatar) }}" class="img-profile rounded-circle">
							@endif 
						{{-- <img class="img-profile rounded-circle"
							src="img/undraw_profile.svg"> --}}
					</a>
					<!-- Dropdown - User Information -->
					<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
						aria-labelledby="userDropdown">
						<a class="dropdown-item" href="{{ url('/account/edit') }}">
							<i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
							Perfil
						</a>
						{{-- <a class="dropdown-item" href="#">
							<i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
							Settings
						</a> --}}
						{{-- <a class="dropdown-item" href="#">
							<i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
							Activity Log
						</a> --}}
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
							<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
							Sair
						</a>
					</div>
				</li>

			</ul>

		</nav>
		<!-- End of Topbar -->


		<div class="container-fluid">

			
					<ol class="breadcrumb">
						<li class="breadcrumb-item">
							<a href="{{ url('/admin') }}"><i class="fas fa-home"></i> Dashboard</a>
						</li>
						@section('breadcrumb')
						@show
					</ol>
		

			
							<!-- Content Row -->
						<div class="row">
							@if(Session::has('message'))
								<div class="container-fluid">
								<div class="alert alert-{{ Session::get('typealert') }} mtop16" style="display:block; margin-bottom: 16px;">
									{{ Session::get('message') }}
									@if ($errors->any())
									<ul>
										@foreach($errors->all() as $error)
										<li>{{ $error }}</li>
										@endforeach
									</ul>
									@endif


									<script type="text/javascript">
										/* Fadeout Flash Notice */
										setTimeout(function() {
											$('.alert').fadeOut('slow');}, 3000
										  );
									</script>

								
								</div>
								</div>
							@endif

							@section('content')
							@show

						</div>
		</div>

	</div>
	<!-- /.container-fluid -->

		
<!-- Footer -->
<footer class="sticky-footer bg-white">
	<div class="container my-auto">
		<div class="copyright text-center my-auto">
			<span>Copyright © frtSYS Developer {{ date('Y') }}</span>
		</div>
	</div>
	</footer>
	<!-- End of Footer -->
	
	</div>
	<!-- End of Content Wrapper -->
	
	</div>
	<!-- End of Page Wrapper -->
	
	<!-- Scroll to Top Button-->
	<a class="scroll-to-top rounded" href="#page-top">
	<i class="fas fa-angle-up"></i>
	</a>
	
	<!-- Logout Modal-->
	<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
	<div class="modal-content">
	<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">Tem certeza que qer sair?</h5>
		<button class="close" type="button" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">×</span>
		</button>
	</div>
	<div class="modal-body">Selecione "Logout" para encerrar a sessão.</div>
	<div class="modal-footer">
		<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
		<a class="btn btn-primary" href="{{ url('/logout') }}">Logout</a>
	

		
	<!-- Js only -->

 {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script> --}}
	{{-- <script src="https://kit.fontawesome.com/b0d8aefb17.js" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script> --}}
	{{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script> --}}

	@yield('js')
	<script src="{{ url('/static/js/select2.min.js') }}"></script>
	<script src="{{ url('/static/js/b0d8aefb17.js') }}"></script>
	<script src="{{ url('/static/js/popper.min.js') }}"></script>
	<script src="{{ url('/static/js/bootstrap.min.js') }}"></script>

	<script src="{{ url('/static/js/jquery.min.js') }}"></script>
	<script src="{{ url('/static/js/bootstrap.bundle.min.js') }}"></script>


	<script src="{{ url('/static/js/jquery.easing.min.js') }}"></script>

	<script src="{{ url('/static/js/sb-admin-2.js') }}"></script>
	<script src="{{ url('/static/js/admin.js') }}"></script>

	<script src="{{ url('/static/js/Chart.min.js') }}"></script>

	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

	<script src="{{ url('/static/js/select.js') }}"></script>

	
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script> 


	{{-- <script>
		@if(Session::has('message'))
	toastr.options =
	{
	"closeButton": false,
	"debug": false,
	"newestOnTop": false,
	"progressBar": true,
	"positionClass": "toast-top-center",
	"preventDuplicates": true,
	"onclick": null,
	"showDuration": "200",
	"hideDuration": "1000",
	"timeOut": "5000",
	"extendedTimeOut": "1000",
	"showEasing": "swing",
	"hideEasing": "linear",
	"showMethod": "fadeIn",
	"hideMethod": "fadeOut"
	}
		  toastr.success("{{ session('message') }}");
	@endif
	
	@if(Session::has('error'))
	toastr.options =
	{
	"closeButton": false,
	"debug": false,
	"newestOnTop": false,
	"progressBar": true,
	"positionClass": "toast-top-center",
	"preventDuplicates": false,
	"onclick": null,
	"showDuration": "300",
	"hideDuration": "1000",
	"timeOut": "5000",
	"extendedTimeOut": "1000",
	"showEasing": "swing",
	"hideEasing": "linear",
	"showMethod": "fadeIn",
	"hideMethod": "fadeOut"
	}
		  toastr.error("{{ session('error') }}");
	@endif
	
	@if(Session::has('info'))
	toastr.options =
	{
	"closeButton": false,
	"debug": false,
	"newestOnTop": false,
	"progressBar": true,
	"positionClass": "toast-top-center",
	"preventDuplicates": true,
	"onclick": null,
	"showDuration": "200",
	"hideDuration": "1000",
	"timeOut": "5000",
	"extendedTimeOut": "1000",
	"showEasing": "swing",
	"hideEasing": "linear",
	"showMethod": "fadeIn",
	"hideMethod": "fadeOut"
	}
		  toastr.info("{{ session('info') }}");
	@endif
	
	@if(Session::has('warning'))
	toastr.options =
	{
	"closeButton": false,
	"debug": false,
	"newestOnTop": false,
	"progressBar": true,
	"positionClass": "toast-top-center",
	"preventDuplicates": true,
	"onclick": null,
	"showDuration": "200",
	"hideDuration": "1000",
	"timeOut": "5000",
	"extendedTimeOut": "1000",
	"showEasing": "swing",
	"hideEasing": "linear",
	"showMethod": "fadeIn",
	"hideMethod": "fadeOut"
	}
		  toastr.warning("{{ session('warning') }}");
	@endif
	</script> --}}
	


</body>
</html>
