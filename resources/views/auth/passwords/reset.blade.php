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
                        <h3 class="text-center mb-4">Forgot Password</h3>

                        <form method="POST" action="{{ route('pass.conemail') }}" class="login-form">
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

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div> 
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Include jQuery and SweetAlert -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


   

    // Display SweetAlert for flash messages
    @if(session('success'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '{{ session("success") }}',
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'OK'
        });
    </script>

    <!-- Show updated OTP in input field -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById("otp").value = "{{ session('otp') }}";
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



@endsection
