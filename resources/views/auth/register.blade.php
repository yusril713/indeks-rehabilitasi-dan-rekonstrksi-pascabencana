
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
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('styles/vendor/sweetalert2/bootstrap-4.min.css') }}">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="content">

	@include('layouts.preload')
    
    @if (session('status'))
        <script>
            Swal.fire(
                'Message!',
                'Kode validasi provinsi tidak valid....',
                'warning'
            );
        </script>
    @endif

	<div id="content" class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">

				<form action="{{ route('manage-petugas.register_akun') }}" method="post">
                    @csrf
					<span class="login100-form-title" style="margin-bottom: -30px">
						<h4>REGISTRASI</h4>
					</span>

					<span class="login100-form-title">
						<img src="{{ asset('styles/images/logo/logo4.png') }}" alt="" style="width: 70%; height: auto">
					</span>

					<div class="wrap-input100">
						<p class="text-danger bold font-weight-bold text-center error"></p>
					</div>

					<div class="wrap-input100 validate-input">
						<input class="input100 @error('no_identitas') is-invalid @enderror" type="text" name="no_identitas" id="no_identitas" placeholder="No Identitas" value="{{ old('no_identitas') }}">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-address-card" aria-hidden="true"></i>
						</span>
					</div>
                    @error('no_identitas')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror

					<div class="wrap-input100 validate-input">
						<input class="input100 @error('nama') is-invalid @enderror" type="text" name="nama" id="nama" placeholder="Nama" value="{{ old('nama') }}">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
					</div>
                    @error('nama')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror

					<div class="wrap-input100 validate-input">
						<input class="input100 @error('email') is-invalid @enderror" type="email" name="email" id="email" placeholder="Email" value="{{ old('email') }}">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope-open" aria-hidden="true"></i>
						</span>
					</div>
                    @error('email')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror

                    <div class="wrap-input100" hidden>
						<input class="input100" type="text" name="role" id="role" value="Level 1">
                        <span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-balance-scale" aria-hidden="true"></i>
						</span>
                    </div>

                    <div class="wrap-input100">
                        <select class="input100 @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin" id="jenis_kelamin">
                            <option selected>Jenis Kelamin</option>
                            <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Pria</option>
                            <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Wanita</option>
                        </select>
                        <span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-anchor" aria-hidden="true"></i>
						</span>
                    </div>
					@error('jenis_kelamin')
						<div class="alert alert-danger">
							{{ $message }}
						</div>
					@enderror

					<div class="wrap-input100 validate-input">
						<input class="input100 @error('tempat_lahir') is-invalid @enderror" type="text" name="tempat_lahir" id="tempat_lahir" placeholder="Tempat Lahir" value="{{ old('tempat_lahir') }}">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-bookmark" aria-hidden="true"></i>
						</span>
					</div>
                    @error('tempat_lahir')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror

					<div class="wrap-input100 validate-input">
						<input class="input100 @error('tanggal_lahir') is-invalid @enderror" type="date" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-birthday-cake" aria-hidden="true"></i>
						</span>
					</div>
                    @error('tanggal_lahir')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror

					<div class="wrap-input100 validate-input">
						<input class="input100 @error('no_hp') is-invalid @enderror" type="text" name="no_hp" id="no_hp" placeholder="No Hp" value="{{ old('no_hp') }}">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-phone" aria-hidden="true"></i>
						</span>
					</div>
                    @error('no_hp')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror

					<div class="wrap-input100 validate-input">
						<input class="input100 @error('alamat') is-invalid @enderror" type="text" name="alamat" id="alamat" placeholder="Alamat" value="{{ old('alamat') }}">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-building-o" aria-hidden="true"></i>
						</span>
					</div>
                    @error('alamat')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror

					<div class="wrap-input100 validate-input">
						<input class="input100 @error('password') is-invalid @enderror" type="password" name="password" id="password" placeholder="Password" value="{{ old('password') }}">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
                    @error('password')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror

					<div class="wrap-input100 validate-input">
						<input class="input100 @error('validasi_provinsi') is-invalid @enderror" type="text" name="validasi_provinsi" id="validasi_provinsi" placeholder="Kode Provinsi" value="{{ old('validasi_provinsi') }}">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
                    @error('validasi_provinsi')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror

					<div class="container-login100-form-btn">
						<button class="login100-form-btn" type="submit" name="submit" id="submit">Register</button>
					</div>

				</form>
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
	<script>
		$(document).ready(function() {
			// $('#submit').click(function() {
			// 	var kode = $('kode').val();
			// 	if(kode == 'Indeks RR 01'){
					
			// 	}
			// });
		});
	</script>

</body>
</html>
