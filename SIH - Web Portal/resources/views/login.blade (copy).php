<!DOCTYPE html>
<html>
<head>
	<title>Shikshak | Log In</title>
	<!-- Latest compiled and minified CSS -->
	
    <!-- Bootstrap core CSS     -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style type="text/css">
  		#navbar {
  			background: -webkit-linear-gradient(60deg, #ab47bc, #8e24aa); /* For Safari 5.1 to 6.0 */
		    background: -o-linear-gradient(60deg, #ab47bc, #8e24aa); /* For Opera 11.1 to 12.0 */
		    background: -moz-linear-gradient(60deg, #ab47bc, #8e24aa); /* For Firefox 3.6 to 15 */
    		background: linear-gradient(60deg, #ab47bc, #8e24aa); /* Standard syntax */
    		border-color: none;	
    		color: #FFFFFF;
    		text-decoration: none;
  		}

  		a {
  			text-decoration: none;
  			color: white;
  		}

  		.background-white {
  			background-color: white;
  		}
  </style>

</head>
<body>
	<div id="navbar">
		<nav class="navbar">
		  <div class="container-fluid">
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar" style="border: white;">
		        <span class="icon-bar background-white"></span>
		        <span class="icon-bar background-white"></span>
		        <span class="icon-bar background-white"></span>                        
		      </button>
		      <a class="navbar-brand" href="#">Shikshak</a>
		    </div>
		    <div class="collapse navbar-collapse" id="myNavbar">
		      <ul class="nav navbar-nav navbar-right">
		        <li><a href="{{ url('signup') }}"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
		        <li class="active"><a href="{{ url('login') }}"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
		      </ul>
		    </div>
		  </div>
		</nav>
	</div>
	<div class="container centered">
		<form method="post" action="">
			<div class="row">
				<div class="col-xs-12 col-md-4">
				  <div class="form-group">
				    <label for="email">Email address:</label>
				    <input type="email" class="form-control" id="email" name="email" required>
				  </div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-md-4">
				  <div class="form-group">
				    <label for="password">Password:</label>
				    <input type="password" class="form-control" id="password" name="password" required>
				  </div>
				</div>
			</div>
		  <button type="submit" class="btn btn-default">Login</button>
		</form>
	</div>

</body>
</html>