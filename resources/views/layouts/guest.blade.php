<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<title>{{ config('app.name', 'Laravel') }}</title>

	<!-- Global stylesheets -->
	<link href="{{ asset('admin/fonts/inter/inter.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('admin/icons/phosphor/styles.min.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('admin/css/all.min.css') }}" id="stylesheet" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script src="{{ asset('admin/demo/demo_configurator.js') }}"></script>
	<script src="{{ asset('admin/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script src="{{ asset('admin/js/app.js') }}"></script>
	<!-- /theme JS files -->

</head>

<body>

	<!-- Main navbar -->
	<div class="navbar navbar-dark navbar-static py-2">
		<div class="container-fluid">
			<div class="navbar-brand">
				<a href="{{ url('/') }}" class="d-inline-flex align-items-center">
					<img src="{{ asset('img/credimundo_icono.png') }}" alt="">
					<img src="{{ asset('img/credimundo_letras.png') }}" class="d-none d-sm-inline-block h-16px ms-3" alt="">
				</a>
			</div>

			<div class="d-flex justify-content-end align-items-center ms-auto">
				<ul class="navbar-nav flex-row">
					<li class="nav-item">
						<a href="#" class="navbar-nav-link navbar-nav-link-icon rounded ms-1">
							<div class="d-flex align-items-center mx-md-1">
							<i class="ph-map-pin-line"></i>
							<span class="d-none d-md-inline-block ms-2">Contacto</span>
						</div>
						</a>
					</li>
					
					@auth
					<li class="nav-item">
						<a href="{{ route('dashboard') }}" class="navbar-nav-link navbar-nav-link-icon rounded ms-1">
							<div class="d-flex align-items-center mx-md-1">
								<i class="ph-table"></i>
							<span class="d-none d-md-inline-block ms-2">Administración</span>
						</div>
						</a>
					</li>
					@else
						<li class="nav-item">
							<a href="{{ route('login') }}" class="navbar-nav-link navbar-nav-link-icon rounded ms-1">
								<div class="d-flex align-items-center mx-md-1">
								<i class="ph-user-circle"></i>
								<span class="d-none d-md-inline-block ms-2">Acceder</span>
							</div>
							</a>
						</li>
					@endauth
					
				</ul>
			</div>
		</div>
	</div>
	<!-- /main navbar -->


	<!-- Page content -->
	<div class="page-content">

		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Inner content -->
			<div class="content-inner">

				<!-- Content area -->
				<div class="content d-flex justify-content-center align-items-center">

					{{ $slot }}

				</div>
				<!-- /content area -->


				@include('layouts.footer')

			</div>
			<!-- /inner content -->

		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->


	@include('layouts.config')

</body>
</html>
