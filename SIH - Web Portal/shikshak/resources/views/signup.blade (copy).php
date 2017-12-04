<!DOCTYPE html>
<html>
<head>
    <title>Shikshak | Sign Up</title>
    <!-- Latest compiled and minified CSS -->
    
   <!-- Bootstrap core CSS     -->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 <style type="text/css">
         #navbar {
             background: -webkit-linear-gradient(60deg, #ab47bc , #8e24aa ); /* For Safari 5.1 to 6.0 */
            background: -o-linear-gradient(60deg, #ab47bc , #8e24aa ); /* For Opera 11.1 to 12.0 */
            background: -moz-linear-gradient(60deg, #ab47bc , #8e24aa ); /* For Firefox 3.6 to 15 */
           background: linear-gradient(60deg, #ab47bc , #8e24aa ); /* Standard syntax */
           border-color: none;    
           color: #FFFFFF ;
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
                <li class="active"><a href="{{ url('signup') }}"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                <li><a href="{{ url('login') }}"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
              </ul>
            </div>
          </div>
        </nav>
    </div>
    <div class="container">
        <form method="post">
            <div class="row">
                <div class="col-xs-12 col-md-4">
                  <div class="form-group">
                    <label for="firstname">First name:</label>
                    <input type="text" class="form-control" id="firstname" name="first_name" required>
                  </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-md-4">
                  <div class="form-group">
                    <label for="middlename">Middle name:</label>
                    <input type="text" class="form-control" id="middlename" name="middle_name" required>
                  </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-md-4">
                  <div class="form-group">
                    <label for="lastename">Last name:</label>
                    <input type="text" class="form-control" id="lastname" name="last_name" required>
                  </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-md-4">
                  <div class="form-group">
                    <label for="city">Field:</label>
                      <select class="form-control" id="city" name="field_id">
                        @foreach ($fields as $field)
                          <option value="{{ $field->id }}">{{ $field->name }}</option>
                        @endforeach
                      </select>
                  </div>
                </div>
              </div>

            <div class="row">
                <div class="col-xs-12 col-md-4">
                  <div class="form-group">
                    <label for="city">Qualification:</label>
                      <select class="form-control" id="city" name="qualification_id">
                        @foreach ($qualifications as $qualification)
                          <option value="{{ $qualification->id }}">{{ $qualification->name }}</option>
                        @endforeach
                      </select>
                  </div>
                </div>
              </div>

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

            <div class="row">
                <div class="col-xs-12 col-md-4">
                  <div class="form-group">
                    <label for="phone">Phone number:</label>
                    <input type="number" class="form-control" id="phone" name="phone" required>
                  </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-md-4">
                  <div class="form-group">
                    <label for="aadharid">Aadhar id:</label>
                    <input type="number" class="form-control" id="aadhar" name="aadhar_id" required>
                  </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-md-4">
                  <div class="form-group">
                    <label for="birthdate">Birthdate:</label>
                    <input type="date" class="form-control" id="birthdate" name="birthdate" required>
                  </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-md-4">
                  <div class="form-group">
                    <label for="city">Select city:</label>
                      <select class="form-control" id="city" name="current_city_id">
                        @foreach ($cities as $city)
                          <option value="{{ $city->id }}">{{ $city->name }}</option>
                        @endforeach
                      </select>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-xs-12 col-md-4">
                  <label for="relocating">Relocating:</label>
                  <div class="radio">
                    <label><input type="radio" name="relocating" value="true">Yes</label>
                  </div>
                  <div class="radio">
                      <label><input type="radio" name="relocating" value="false">No</label>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-xs-12 col-md-4">
                  <div class="form-group">
                    <label for="superaanuatingage">Superannuating age:</label>
                    <input type="number" class="form-control" id="superaanuatingage" name="superaanuatingage" required>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-xs-12 col-md-4">
                  <div class="form-group">
                    <label for="experience">Experience:</label>
                    <input type="number" class="form-control" id="eperience" name="experience" required>
                  </div>
                </div>
              </div>

          <button type="submit" class="btn btn-default">Sign up</button>
        </form>
    </div>

</body>
<!-- Latest compiled and minified JavaScript -->
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->
</html>