<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
	<title>Login &mdash; {{ config('app.name') }}</title>

	<!-- General CSS Files -->
	<link rel="stylesheet" href="{{ url('assets/bootstrap/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ url('assets/fontawesome/css/all.css') }}">

	<!-- Template CSS -->
	<link rel="stylesheet" href="{{ url('assets/css/style.css') }}">
	<link rel="stylesheet" href="{{ url('assets/css/components.css') }}">
</head>

<body>
	<div id="app">
	<section class="section">
      <div class="container mt-2">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
              <img src="../assets/img/logo-shb.jpg" alt="logo" width="150" class="shadow-light rounded-circle">
			</div>
			
            <div class="card card-primary">

              <div class="card-body">
                <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate="">
				@csrf
					<div class="form-group">
					  <label for="email">Email</label>
					  <input id="email" type="email"
							 class="form-control @error('email') is-invalid @enderror"
							 name="email"
							 tabindex="1"
							 placeholder="Masukan alamat email.."
							 value="{{ old('email') }}"
							 required autofocus>

					  @error('email')
					  <span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					  </span>
					  @enderror
					</div>


					<div class="form-group">
						
								<div class="d-block">
									<label for="password" class="control-label">Password</label>
								<div class="float-right">
									<a href="#" class="text-small">
									Forgot Password?
									</a>
								</div>
								</div>
								<input id="password" type="password" class="form-control @error('password') @enderror" name="password"
									tabindex="2" placeholder="Masukan kata sandi.." required>
								<div class="invalid-feedback">
									Mohon masukkan password!
								</div>

								@error('email')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
								@enderror
					</div>

                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                      <label class="custom-control-label" for="remember-me">Remember Me</label>
                    </div>
                  </div>

				  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Login
                    </button>
                  </div>
                </form>
                <div class="text-center mt-4 mb-3">
                  <div class="text-job text-muted">Login With Social</div>
                </div>
                <div class="row sm-gutters">
                  <div class="col-6">
                    <a href="#" class="btn btn-block text-white" style="background-color: #3b5998;">
						<i class="fab fa-facebook me-2"></i> Facebook
					</a>
                  </div>
                  <div class="col-6">
					<a href="#" class="btn btn-block text-white" style="background-color: #db4437;">
						<i class="fab fa-google me-2"></i> Google
					</a>
				  </div>
                </div>

              </div>
            </div>
			<!--
            <div class="mt-5 text-muted text-center">
              Don't have an account? <a href="#">Create One</a>
            </div>			-->
            <div class="simple-footer">
              Copyright &copy; IT SHB
            </div>

          </div>
        </div>
      </div>
    </section>
	</div>

	<!-- General JS Scripts -->
	<script src="{{ url('assets/js/jquery-3.5.1.min.js') }}"></script>
	<script src="{{ url('assets/js/popper.min.js') }}"></script>
	<script src="{{ url('assets/bootstrap/js/bootstrap.min.js') }}"></script>
	<script src="{{ url('assets/js/jquery.nicescroll.min.js') }}"></script>
	<script src="{{ url('assets/js/moment.min.js') }}"></script>
	<script src="{{ url('assets/js/stisla.js') }}"></script>

	<!-- Template JS File -->
	<script src="{{ url('assets/js/scripts.js') }}"></script>
	<script src="{{ url('assets/js/custom.js') }}"></script>

	<!-- Page Specific JS File -->
	@include('layouts.partials.greetings')

	<script>
		$(document).ready(function() {
            $("#greetings").html(greetings());
        });
	</script>
</body>

</html>
