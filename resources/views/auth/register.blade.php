<!-- filepath: /d:/ukk/todolist/resources/views/auth/register.blade.php -->
<x-guest-layout>
    <!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Laravel') }} - Register</title>
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
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="text-center mb-4">
                        <a href="">
                            <img width="160px" src="{{ asset('images/logo.png') }}" alt="Logo">
                        </a>
                    </div>
                    <div class="">
                        <div class="text-success text-center">
                            <h4>{{ __("Let's Get Started") }}</h4>
                            <p class="subtitle">Create an Account to ListAll to get all features</p>
                        </div>
                        <div class="">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <!-- Name -->
                                <div class="form-group">
                                    <div class="input-group">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="{{ __('Name') }}">
                                        <div class="input-group-text"><i class="bi bi-person-circle"></i></div>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Email Address -->
                                <div class="form-group">
                                    <div class="input-group">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="{{ __('Email Address') }}">
                                        <div class="input-group-text"><i class="bi bi-envelope"></i></div>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Gender -->
                                <div class="form-group">
                                    <div class="input-group">
                                        <select id="gender" class="form-control @error('gender') is-invalid @enderror" name="gender" required>
                                            <option value="" disabled selected>{{ __('Select Gender') }}</option>
                                            <option value="male">{{ __('Male') }}</option>
                                            <option value="female">{{ __('Female') }}</option>
                                        </select>
                                        <div class="input-group-text"><i class="bi bi-gender-ambiguous"></i></div>
                                        @error('gender')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Password -->
                                <div class="form-group">
                                    <div class="input-group">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="{{ __('Password') }}">
                                        <div class="input-group-text"><i class="bi bi-lock"></i></div>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Confirm Password -->
                                <div class="form-group">
                                    <div class="input-group">
                                        <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="{{ __('Confirm Password') }}">
                                        <div class="input-group-text"><i class="bi bi-lock-fill"></i></div>
                                    </div>
                                </div>

                                <div class="form-group mb-0">
                                    <button type="submit" class="btn btn-success btn-block btn-rounded">
                                        {{ __("Sign Up") }}
                                    </button>
                                </div>
                            </form>
                            <div class="form-group mt-3 text-center">
                                <span>Already have an account?</span>
                                <a class="p-0 btn btn-link btn-link-rounded text-success" href="{{ route('login') }}">
                                    {{ __('Login!') }}
                                </a>
                            </div>
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