<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Forgot Password</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ asset('admin/vendors/mdi/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/vendors/css/vendor.bundle.base.css') }}">
  <!-- endinject -->

  <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">

  <style>
    label.error {
      color: #db7373;
      position: relative;
      padding-top: 11px;
    }
  </style>
  <!-- End layout styles -->
  <link rel="shortcut icon" href="{{ asset('admin/images/favicon.png') }}" />
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
              <img src="{{asset('images/new-logo.png')}}" class="img-fluid logo">
            </div>
          </div>
             @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

          <div class=" col-lg-6 bg-white px-5 py-5">
          <x-language-switcher />

            <div class="card-body login-form px-5 py-5">
              <div class="text-center">
                <img src="{{asset('admin/images/auth/new_logo.png')}}" class="img-fluid" alt="">
                <h1 class="heading-primary my-3"></h1>
               <p class="grey">{{ __('auth.reset_password_description') }}</p>

              </div>
                            <form method="POST" action="{{ route('user.verify') }}">
                  @csrf
                  <input type="hidden" name="email" value="{{ $email }}">
                  
                  <label for="otp">Enter OTP</label>
                  <input type="number" name="otp" id="otp" class="form-control" required minlength="4" maxlength="4" oninput="this.value = this.value.slice(0, 4);">

                  <div class="mt-2 text-center">
                      <small>
                          Didn’t get code? 
                          <a href="{{ route('user.resend') }}" id="resendLink" style="pointer-events: none; color: grey;">
                              Resend OTP (<span id="timer">30</span>s)
                          </a>
                      </small>
                  </div>

                  <button type="submit" class="btn btn-primary mt-3">Verify</button>
              </form>

              {{-- Timer Script --}}
              <script>
                  let countdown = 30;
                  let timerDisplay = document.getElementById("timer");
                  let resendLink = document.getElementById("resendLink");

                  let interval = setInterval(function () {
                      countdown--;
                      timerDisplay.textContent = countdown;

                      if (countdown <= 0) {
                          clearInterval(interval);
                          resendLink.style.pointerEvents = "auto";   // Enable link
                          resendLink.style.color = "#007bff";        // Bootstrap primary color
                          //timerDisplay.textContent = "";
                          resendLink.innerHTML = 'Resend OTP';
                      }
                  }, 1000);
              </script>



            </div>
          </div>
        </div>