<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="{{ Lang::get('meta.description') }}">
	<meta name="author" content="">

	<!-- Application Title -->
	<title>{{ Lang::get('meta.title')  }}</title>

	<!-- Bootstrap CSS -->
	<link href="/css/app.css" rel="stylesheet">
	<link href="/css/vendor/font-awesome.css" rel="stylesheet">
	<link href="/css/vendor/famfamfam-flags.css" rel="stylesheet">

	<!-- Web Fonts -->
	<link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic' rel='stylesheet' type='text/css'>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<!-- Static navbar -->
	<nav class="navbar navbar-default navbar-static-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="/{{ Config::get('app.locale_prefix') }}">NONSTOP3D {{ Session::get('language') }}</a>
			</div>

			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li><a href="/{{ Config::get('app.locale_prefix') }}">Home</a></li>
				</ul>

					<ul class="nav navbar-nav navbar-right">
				@if (Auth::check())
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
                				<img src="https://www.gravatar.com/avatar/{{{ md5(strtolower(Auth::user()->email)) }}}?s=35" height="35" width="35" class="navbar-avatar">
								{{ Auth::user()->name }} <b class="caret"></b>
							</a>
							<ul class="dropdown-menu">
								<li><a href="{{ Config::get('app.locale_prefix') ? '/'.Config::get('app.locale_prefix') : '' }}/auth/logout"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
							</ul>
						</li>
				@else
						<li><a href="{{ Config::get('app.locale_prefix') ? '/'.Config::get('app.locale_prefix') : '' }}/auth/login"><i class="fa fa-btn fa-sign-in"></i>Login</a></li>
						<li><a href="{{ Config::get('app.locale_prefix') ? '/'.Config::get('app.locale_prefix') : '' }}/auth/register"><i class="fa fa-btn fa-user"></i>Register</a></li>
				@endif
				
				
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="famfamfam-flag-{{ Config::get('app.locale') }}"></i> {{ ucfirst(Config::get('app.locale')) }} <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="/translate/ru"><i class="famfamfam-flag-ru"></i>&nbsp;&nbsp; Руский</a></li>
                                    <li><a href="/translate/en"><i class="famfamfam-flag-en"></i>&nbsp;&nbsp; English</a></li>
                                </ul>
                            </li>
                        </ul>
						
					</ul>
			
			</div>
		</div>
	</nav>

	@yield('content')

	<!-- Bootstrap JavaScript -->
	<script src="/js/vendor/jquery.js"></script>
	<script src="/js/vendor/bootstrap.js"></script>
</body>
</html>
