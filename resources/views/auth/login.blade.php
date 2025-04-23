@extends('layouts.app')

@section('content')

<section class="ftco-section">
<div class="bg-img">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					
				</div>
			</div>

			<div class="row justify-content-center">
				<div class="col-md-7 col-lg-5">
			        <div class="login-wrap p-4 p-md-5">
		      	<div class="icon d-flex align-items-center justify-content-center">
		      		<span class="fa fa-user"></span>
		      	</div>
		      	<h3 class="text-center mb-4">Sign In</h3>
          
                    <form method="POST" action="{{ route('login') }}" class="login-form">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-5 col-form-label text-md-end">{{ __('Email Address') }}:</label>

                            <div class="col-md-7">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-5 col-form-label text-md-end">{{ __('Password') }}:</label>

                            <div class="col-md-7">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                
                                    <a class="btn btn-link" href="{{ route('pass.index') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                
                            </div>
                        </div>
                    </form>
             
            </div> </div>
				</div>
			</div>
		</div>
        @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session("success") }}',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
        </script>
    @endif
    
    @if(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{{ session("error") }}',
                confirmButtonColor: '#d33',
                confirmButtonText: 'OK'
            });
        </script>
    @endif
	</section>
    @if(session('logout_success'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                title: "Logged Out!",
                text: "{{ session('logout_success') }}",
                icon: "info",
                confirmButtonText: "OK"
            });
        });
    </script>
@endif


     
@endsection
</div>