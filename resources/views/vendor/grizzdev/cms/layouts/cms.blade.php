<!DOCTYPE html>
<html>
	<head>
		<title>{{ $title or 'CMS' }} | Gamerosity</title>
		<meta name="csrf-token" content="{{ csrf_token() }}" />
		<meta name="csrf-param" content="_token" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<link rel="canonical" href="{{ Request::url() }}" />
		<link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}" sizes="16x16">
		<link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}" sizes="32x32">
		<link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}" sizes="96x96">
		<link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}" sizes="160x160">
		<link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}" sizes="192x192">
		<link rel="apple-touch-icon" sizes="57x57" href="{{ asset('img/favicon.png') }}">
		<link rel="apple-touch-icon" sizes="114x114" href="{{ asset('img/favicon.png') }}">
		<link rel="apple-touch-icon" sizes="72x72" href="{{ asset('img/favicon.png') }}">
		<link rel="apple-touch-icon" sizes="144x144" href="{{ asset('img/favicon.png') }}">
		<link rel="apple-touch-icon" sizes="60x60" href="{{ asset('img/favicon.png') }}">
		<link rel="apple-touch-icon" sizes="120x120" href="{{ asset('img/favicon.png') }}">
		<link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/favicon.png') }}">
		<link rel="apple-touch-icon" sizes="152x152" href="{{ asset('img/favicon.png') }}">
		<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/favicon.png') }}">
		<meta name="msapplication-square70x70logo" content="{{ asset('img/favicon.png') }}" />
		<meta name="msapplication-square150x150logo" content="{{ asset('img/favicon.png') }}" />
		<meta name="msapplication-wide310x150logo" content="{{ asset('img/favicon.png') }}" />
		<link rel="stylesheet" type="text/css" href="{{ elixir('css/cms.css') }}" />
		<base href="{{ Request::url() }}/" />
	</head>
	<body>
		<div class="body-wrapper">
			<header>
				<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
					<div class="container-fluid">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
							<a class="navbar-brand" href="{{ url() }}">gamerosity</a>
						</div>
						<div class="collapse navbar-collapse">
							@if(Auth::check())
							<ul class="nav navbar-nav">
								<li class="active">
									<a href="{{ url() }}"><i class="glyphicon glyphicon-dashboard"></i> <span>Dashboard</span></a>
								</li>
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Gamerosity <i class="caret"></i></a>
									<ul class="dropdown-menu">
										@if(Auth::user()->can('heroes'))
										<li>
											<a href="{{ url('heroes') }}">Heroes</a>
										</li>
										<li>
											<a href="{{ url('nominations') }}">Nominations</a>
										</li>
										@endif
										<!--<li>
											<a href="{{ url('packages') }}">Packages</a>
										</li>-->
										<!--<li>
											<a href="{{ url('hospitals') }}">Hospitals</a>
										</li>-->
										<!--<li>
											<a href="{{ url('team') }}">Team</a>
										</li>-->
										<!--<li>
											<a href="{{ url('faqs') }}">FAQs</a>
										</li>-->
									</ul>
								</li>
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Shop <i class="caret"></i></a>
									<ul class="dropdown-menu">
										@if(Auth::user()->can('orders'))
										<li>
											<a href="{{ url('shop/orders') }}">Orders</a>
										</li>
										@endif
										@if(Auth::user()->can('products'))
										<!--<li>
											<a href="{{ url('shop/products') }}">Products</a>
										</li>-->
										<li>
											<a href="{{ url('shop/attributes') }}">Attributes</a>
										</li>
										<li>
											<a href="{{ url('shop/categories') }}">Categories</a>
										</li>
										<li>
											<a href="{{ url('shop/tags') }}">Tags</a>
										</li>
										@endif
									</ul>
								</li>
								<!--
								@if(Auth::user()->hasRole('admin'))
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Site <i class="caret"></i></a>
									<ul class="dropdown-menu">
										<li>
											<a href="{{ url('site/pages') }}">Pages</a>
										</li>
										<li>
											<a href="{{ url('site/partials') }}">Partials</a>
										</li>
										<li>
											<a href="{{ url('site/layouts') }}">Layouts</a>
										</li>
										<li>
											<a href="{{ url('site/media') }}">Media</a>
										</li>
										<li>
											<a href="{{ url('site/users') }}">Users</a>
										</li>
										<li>
											<a href="{{ url('site/emails') }}">Emails</a>
										</li>
										<li>
											<a href="{{ url('site/locations') }}">Locations</a>
										</li>
									</ul>
								</li>
								@endif
								-->
							</ul>
							<ul class="nav navbar-nav navbar-right">
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown">
										<i class="glyphicon glyphicon-user"></i> {!! Auth::user()->name !!}<i class="caret"></i>
									</a>
									<ul class="dropdown-menu">
										<li>
											<a href="{{ url() }}"><i class="glyphicon glyphicon-globe"></i> Main Site</a>
										</li>
										<li>
											<a href="{{ url('auth/logout') }}"><i class="glyphicon glyphicon-log-out"></i> Logout</a>
										</li>
									</ul>
								</li>
							</ul>
							@endif
						</div>
					</div>
				</nav>
			</header>
			<div class="container-fluid content-wrapper">
				<div class="row">
					<div class="col-xs-12">
						@yield('content')
					</div>
				</div>
			</div>
			<footer>
			</footer>
		</div>
		@include('vendor.grizzdev.cms.includes.modal', [
			'id' => 'errorModal',
			'title' => 'Error!',
			'content' => '<p>There are errors in the form.</p><p>Please correct the fields marked with: <i class="glyphicon glyphicon-remove" style="color:#a94442"></i></p>',
			'view' => null,
			'buttons' => [
				'<a type="button" class="btn btn-primary" data-dismiss="modal">OK</a>'
			]
		])
		<script src="{{ elixir('js/cms.js') }}"></script>
	</body>
</html>
