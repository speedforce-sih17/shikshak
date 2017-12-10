<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png" />
  <link rel="icon" type="image/png" href="../assets/img/favicon.png" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

  <title>Shikshak | Sign Up</title>

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
                      <a href="{{ url('signup') }}">
                          <p>Sign Up</p>
                      </a>
                  </li>
                  <li>
                      <a href="{{ url('login') }}">
                          <p>Log In</p>
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
            <a class="navbar-brand" href="http://localhost/shikshak/public">Shikshak</a>
          </div>
        </div>
      </nav>
      <div class="content">
        <div class="container-fluid">
          <div class="content">
                  <div class="container-fluid">
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header" data-background-color="purple">
                <h4 class="title">Sign Up</h4> 
            </div>
            <div class="card-content">
                      
                    <form method="post">
            <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="firstname">First name:</label>
                    <input type="text" class="form-control" id="firstname" name="first_name" required>
                  </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="middlename">Middle name:</label>
                    <input type="text" class="form-control" id="middlename" name="middle_name" required>
                  </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="lastename">Last name:</label>
                    <input type="text" class="form-control" id="lastname" name="last_name" required>
                  </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
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
                <div class="col-md-12">
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
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="email">Email address:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                  </div>
                </div>
            </div> 

            <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                  </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="phone">Phone number:</label>
                    <input type="number" class="form-control" id="phone" name="phone" required>
                  </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="resume">Link to Resume:</label>
                    <input type="text" class="form-control" id="resume" name="resume" required>
                  </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="aadharid">Aadhar id:</label>
                    <input type="number" class="form-control" id="aadhar" name="aadhar_id" required>
                  </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="birthdate">Birthdate:</label>
                    <input type="date" class="form-control" id="birthdate" name="birthdate" required>
                  </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12">
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
                <div class="col-md-12">
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
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="superaanuatingage">Superannuating age:</label>
                    <input type="number" class="form-control" id="superaanuatingage" name="superaanuatingage" required>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="experience">Experience:</label>
                    <input type="number" class="form-control" id="eperience" name="experience" required>
                  </div>
                </div>
              </div>

          <button type="submit" class="btn btn-primary">Sign up</button>
        </form>

                      
            </div>
        </div>
    </div>
</div>
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
