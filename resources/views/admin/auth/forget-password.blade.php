<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ __('auth.forgot_password') }}</title>

  <link rel="stylesheet" href="{{ asset('admin/vendors/mdi/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/vendors/css/vendor.bundle.base.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
  <link rel="shortcut icon" href="{{ asset('admin/images/favicon.png') }}" />

  <style>
    label.error {
      color: #db7373;
      position: relative;
      padding-top: 11px;
    }
  </style>
</head>

<body>
  <div class="container-scroller">

    <div class="container-fluid page-body-wrapper full-page-wrapper relative">
      <div class="content-wrapper login-page full-page-wrapper d-flex align-items-center auth login-bg">
        <div class="icon-box">
          <img src="{{ asset('images/icon-6.png') }}" class="img-fluid icon-1">
          <img src="{{ asset('images/icon-6.png') }}" class="img-fluid icon-2">
          <img src="{{ asset('images/icon-4.png') }}" class="img-fluid icon-4">
        </div>
        <div class="row w-100 m-0">
          <div class="col-12 col-md-6 d-flex justify-content-center align-items-center">
            <div class="login-left-icon text-center w-100 logo-box">
              <img src="{{ asset('images/new-logo.png') }}" class="img-fluid logo">
            </div>
          </div>

          <div class="col-lg-6 bg-white px-5 py-5">
          <x-language-switcher />

            <div class="card-body login-form px-5 py-5">
              <div class="text-center">

                <img src="{{ asset('admin/images/auth/new_logo.png') }}" class="img-fluid" alt="">
                <h1 class="heading-primary my-3">{{ __('auth.reset_password') }}</h1>
                <p class="grey">{{ __('auth.reset_password_hint') }}</p>
              </div>

              <form action="{{ route('user.forget-password') }}" method="POST" id="loginForm">
                @csrf
                <div class="form-group">
                  <label for="email">{{ __('auth.email_address') }} *</label>
                  <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email') }}" autocomplete="email" autofocus>

                  @error('email')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>

                <div class="text-center mt-3">
                  <button type="submit" class="btn btn-primary btn-block enter-btn">
                    {{ __('auth.send_password_reset_link') }}
                  </button>
                </div>

                <div class="text-center mt-3 humb-line">
                  <a href="{{ route('login') }}">{{ __('auth.back_to_login') }}</a>
                </div>
              </form>
            </div>
          </div>

          <script>
            $(document).ready(function () {
              $('#loginForm').validate({
                rules: {
                  email: {
                    required: true,
                    email: true
                  },
                },
                messages: {
                  email: {
                    required: '{{ __("auth.email_required") }}',
                    email: '{{ __("auth.email_valid") }}',
                  },
                },
                submitHandler: function (form) {
                  form.submit();
                }
              });
            });
          </script>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
