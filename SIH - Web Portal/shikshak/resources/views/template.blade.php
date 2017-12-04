<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png" />
	<link rel="icon" type="image/png" href="../assets/img/favicon.png" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Shikshak | @yield('title')</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <!-- Bootstrap core CSS     -->
    <link href="{{ url('assets/css/bootstrap.min.css') }}" rel="stylesheet" />

    <!--  Material Dashboard CSS    -->
    <link href="{{ url('assets/css/material-dashboard.css') }}" rel="stylesheet"/>

    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="{{ url('assets/css/demo.css') }}" rel="stylesheet" />

    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons' rel='stylesheet' type='text/css'>
</head>

<body>

	<div class="wrapper">

	    <div class="sidebar" data-color="purple" data-image="{{ url('assets/img/sidebar-1.jpg') }}">
			<!--
		        Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

		        Tip 2: you can also add an image using data-image tag
		    -->

			<div class="logo">
				<a href="{{ url('/') }}" class="simple-text">
					Shikshak
				</a>
			</div>

	    	<div class="sidebar-wrapper">
	            <ul class="nav">
	                <li>
	                    <a href="{{ url('/') }}">
	                        <i class="material-icons">home</i>
	                        <p>Home</p>
	                    </a>
	                </li>
	                <li>
	                    <a href="{{ url('instituteActions') }}">
	                        <p>Institute Actions</p>
	                    </a>
	                </li>
	                @if (count(\App\InstituteRep::where('user_id', \Auth::user()->id)->get()) > 0)
	                <li>
	                    <a href="{{ url('vacancies') }}">
	                        <p>Vacancies</p>
	                    </a>
	                </li>
	                @endif
	                <li>
	                	<a href="{{ url('find/vacancy') }}">
	                		<p>Find Vacancies</p>
	                	</a>
	                </li>
	                <li>
	                    <a href="{{ url('me') }}">
	                        <p>Interested in Me</p>
	                    </a>
	                </li>
	                <li>
	                    <a href="{{ url('employment') }}">
	                        <p>Current Employment</p>
	                    </a>
	                </li>
	                <li>
	                    <a href="{{ url('aicte') }}">
	                        <p>AICTE Dashboard</p>
	                    </a>
	                </li>
	            </ul>
	    	</div>
	    </div>

	    <div class="main-panel">
			<nav class="navbar navbar-transparent navbar-absolute">
				<div class="container-fluid">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="{{ url('/') }}">Shikshak</a>
					</div>
					<div class="collapse navbar-collapse">
						<ul class="nav navbar-nav navbar-right">
							<li>
								<a href="{{ url('logout') }}">Logout</a>
							</li>
						</ul>
					</div>
				</div>
			</nav>

			<div class="content">
				<div class="container-fluid">
					<div class="content">
			            <div class="container-fluid">
			                @yield('content')
			            </div>
	        		</div>
				</div>
			</div>
		</div>
	</div>

</body>

	<!--   Core JS Files   -->
	<script src="{{ url('assets/js/jquery-3.1.0.min.js') }}" type="text/javascript"></script>
	<script src="{{ url('assets/js/bootstrap.min.js') }}" type="text/javascript"></script>
	<script src="{{ url('assets/js/material.min.js') }}" type="text/javascript"></script>

	<!--  Notifications Plugin    -->
	<script src="{{ url('assets/js/bootstrap-notify.js') }}"></script>

	<!-- Material Dashboard javascript methods -->
	<script src="{{ url('assets/js/material-dashboard.js') }}"></script>

</html>
