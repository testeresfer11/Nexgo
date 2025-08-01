<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ __('auth.login_title') }}</title>    <!-- plugins:css -->
    <link rel="stylesheet" href="{{asset('admin/vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/vendors/css/vendor.bundle.base.css')}}">
    <!-- endinject -->

    <link rel="stylesheet" href="{{asset('admin/css/style.css')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">

    <style>
        label.error {
        color: #db7373;
        position: relative;
        padding-top: 0;
        bottom: 12px;
    }
    </style>
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{asset('images/carpool_logo.png')}}" />
</head>
<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper relative">
            <div class="content-wrapper login-page full-page-wrapper d-flex align-items-center auth login-bg">
                <div class="icon-box">
                    <img src="{{asset('images/icon-6.png')}}" class="img-fluid icon-1">
                    <img src="{{asset('images/icon-6.png')}}" class="img-fluid icon-2">
                    <img src="{{asset('images/icon-4.png')}}" class="img-fluid icon-4">
                </div>
                <div class="row w-100 m-0">
                    <div class="col-12 col-md-6 d-flex justify-content-center align-items-center">
                        <div class="login-left-icon text-center w-100 logo-box">
                            {{-- <img src="{{asset('images/carpool_logo.jpg')}}"> --}}
                            <img src="{{asset('images/new-logo.png')}}" class="img-fluid logo">
                        </div>
                    </div>
                    <div class="col-12 col-md-6">

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                        <div class="card">
                            <div class="card-body px-5">
                                <div class="login-title d-flex align-items-center justify-content-between">
                                <p class="f-18">{{ __('auth.welcome') }} <span class="dark bold">Nexgo</span></p>
                                <x-language-switcher />
                                </div>
                                <h2 class="pb-4 f-38">{{ __('auth.sign_in') }}</h2>
                                <form action="{{ route('login') }}" method="POST" id="loginForm">
                                    @csrf
                                    <div class="form-group">
                                        <label for="email">{{ __('auth.email') }}  *</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="password">{{ __('auth.passwords') }} *</label>
                                        <input name="password" id="password" type="password" class="form-control @error('password') is-invalid @enderror" autocomplete="current-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group d-flex align-items-center justify-content-end">
                                        <div class="forgot"> <a href="{{route('user.forget-password')}}" class="forgot-pass dark text-decoration-none">{{ __('auth.forgot_password') }} 
                                        </a></div>
                                    </div>
                                     
                                    <div class="text-center">
                                        <button type="submit" class="btn default-btn btn-md w-100">{{ __('auth.login') }}</button>
                                    </div>   
                                         
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
            </div>
            <!-- row ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="{{asset('admin/vendors/js/vendor.bundle.base.js')}}"></script>
    <!-- endinject -->
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js"></script>
    <script>
    $(document).ready(function() {
        @if (session('success'))
            toastr.success("{{ session('success') }}");
        @endif

        @if (session('error'))
            toastr.error("{{ session('error') }}");
        @endif
    });

    let messages = {
        emailRequired: "{{ __('auth.validation.email_required') }}",
        emailValid: "{{ __('auth.validation.email_valid') }}",
        passwordRequired: "{{ __('auth.validation.password_required') }}",
        passwordMin: "{{ __('auth.validation.password_min') }}",
    };

    $('#loginForm').validate({
        errorElement: 'label',
        errorClass: 'error',
        focusInvalid: false,
        focusCleanup: true,
        rules: {
            email: {
                required: true,
                email: true,
            },
            password: {
                required: true,
            },
        },
        messages: {
            email: {
                required: messages.emailRequired,
                email: messages.emailValid,
            },
            password: {
                required: messages.passwordRequired,
                minlength: messages.passwordMin,
            },
        },
    });
    </script>
</body>
</html>
      