<!-- filepath: /d:/ukk/todolist/resources/views/auth/login.blade.php -->
<x-guest-layout>
    <!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Laravel') }} - Login</title>
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
        <style>
            .input-group-text i {
                color: grey; /* Default grey color for the icon */
            }
            .form-control:focus ~ .input-group-text i,
            .form-control:not(:placeholder-shown) ~ .input-group-text i {
                color: #28a745; /* Green color for the icon when input is focused or filled */
            }
            .form-control {
                border-radius: 50px; /* Rounded input fields */
                border: 1px solid #ced4da; /* Default border color */
                font-size: 0.875rem; /* Smaller font size */
                padding-left: 20px; /* Add padding to the left */
            }
            .form-control:focus {
                border-color: #28a745; /* Green border color when input is focused */
                box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.25); /* Green outline when input is focused */
            }
            .input-group-text {
                border-radius: 50px; /* Rounded input group text */
                background: transparent;
                border: none;
            }
            .input-group {
                position: relative;
            }
            .input-group .form-control::placeholder {
                color: #6c757d; /* Default placeholder color */
            }
            .input-group .form-control:focus::placeholder {
                color: #ced4da; /* Placeholder color when input is focused */
            }
            .input-group .form-control:focus + .input-group-text i,
            .input-group .form-control:not(:placeholder-shown) + .input-group-text i {
                color: #28a745; /* Green color for the icon when input is focused or filled */
            }
            .input-group .form-control + .input-group-text {
                position: absolute;
                right: 15px;
                top: 50%;
                transform: translateY(-50%);
                pointer-events: none;
            }
            .btn-rounded {
                border-radius: 50px; /* Rounded button */
            }
            .btn-link-rounded {
                border-radius: 50px; /* Rounded link button */
                color: grey; /* Grey color for the link */
            }
            .subtitle {
                color: grey; /* Grey color for the subtitle */
            }
        </style>
    </head>
    <body>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="text-center mb-4">
                        <a href="">
                            <img width="150px" src="{{ asset('images/logo.png') }}" alt="Logo">
                        </a>
                    </div>
                    <div class="">
                        <div class="text-success text-center">
                            <h4>{{ __('Login') }}</h4>
                            <p class="subtitle">Welcome back! Please login to your account.</p>
                        </div>
                        <div class="">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <!-- Email Address -->
                                <div class="form-group">
                                    <div class="input-group">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="{{ __('Email Address') }}">
                                        <div class="input-group-text"><i class="bi bi-envelope"></i></div>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Password -->
                                <div class="form-group">
                                    <div class="input-group">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="{{ __('Password') }}">
                                        <div class="input-group-text"><i class="bi bi-lock"></i></div>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Remember Me -->
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
                                    <label class="form-check-label" for="remember_me">{{ __('Remember Me') }}</label>
                                </div>

                                <div class="form-group mb-3">
                                    <button type="submit" class="btn btn-success btn-block btn-rounded">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                                <div class="form-group mt-3 text-center">
                                    <span>Do not have an account?</span>
                                    <a class="p-0 btn btn-link btn-link-rounded text-success" href="{{ route('register') }}">
                                        {{ __(' Register here!') }}
                                    </a>
                                </div>

                                @if (Route::has('password.request'))
                                    <div class="form-group mt-3 text-center">
                                        <a class="btn btn-link btn-link-rounded" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    </div>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>
    </html>
</x-guest-layout>