
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<title>Indeks Rehabilitasi & Rekonstruksi Pascabencana &raquo; BNPB</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="icon" type="image/png" href="{{ asset('styles/images/logo/logo.png') }}"/>
	<link rel="stylesheet" type="text/css" href="{{ asset('styles/vendor/bootstrap/css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('styles/vendor/bower_components/font-awesome/css/font-awesome.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('styles/vendor/animate/animate.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('styles/vendor/css-hamburgers/hamburgers.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('styles/vendor/select2/select2.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('styles/css/util.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('styles/css/main.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('styles/css/preload.min.css') }}">
	<style>.disabledbutton {
		pointer-events: none;
		opacity: 0.4;
	}</style>
</head>
<body class="content">
	<div id="">
	@include('layouts.preload')

	<div id="content" class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				@if ($message = Session::get('success'))
					<div class="alert-alert-success">
						{{ $message }}
					</div>
				@endif
				<form id="form_login" class="login100-form validate-form" action="{{ route('login') }}" method="POST">
                    @csrf
				
					<span class="login100-form-title">
						<img src="{{ asset('styles/images/logo/logo4.png') }}" alt="" style="width: 70%; height: auto">
					</span>

					<div class="wrap-input100">
						<p class="text-danger bold font-weight-bold text-center error"></p>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Email is required">
						<input class="input100" type="email" name="email" id="email" placeholder="Email">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" type="password" name="password" id="password" placeholder="Password">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 contact100-form-checkbox m-l-4" align="center">
						<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
						<label class="label-checkbox100" for="ckb1">
							Remember me
						</label>
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit" id="submit" name="submit">
							Login
						</button>
					</div>

					<div class="text-center p-t-50">
						<span class="txt1">
							Do you have an account ?
						</span>
						<a class="txt2" href="{{ route('register') }}">
							Register here
						</a>
					</div>
					<div class="text-center p-t-50">
						<a href="{{ route('forgot-password') }}">
							Forgot Password?
						</a>
					</div>

				</form>
			</div>
		</div>
	</div>
	</div>
	<script src="{{ asset('styles/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
	<script src="{{ asset('styles/vendor/bootstrap/js/popper.js') }}"></script>
	<script src="{{ asset('styles/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/../assets/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
	<script src="{{ asset('styles/vendor/select2/select2.min.js') }}"></script>
	<script src="{{ asset('styles/vendor/tilt/tilt.jquery.min.js') }}"></script>
	<script >
		// $('.js-tilt').tilt({
		// 	scale: 1.1
		// })
	</script>
	<script src="{{ asset('styles/vendor/preloader.js') }}"></script>
	<script type="text/javascript">
		$("#overlay").addClass("disabledbutton");
		$('#overlay').find('input').each(function () {
			$(this).attr('disabled', 'disabled');
		});
	</script>
		

</body>
</html>
