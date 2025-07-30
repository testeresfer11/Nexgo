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

          <div class=" col-lg-6 bg-white px-5 py-5">
          <x-language-switcher />

            <div class="card-body login-form px-5 py-5">
              <div class="text-center">
                <img src="{{asset('admin/images/auth/new_logo.png')}}" class="img-fluid" alt="">
                <h1 class="heading-primary my-3">{{ __('auth.reset_password') }}</h1>
               <p class="grey">{{ __('auth.reset_password_description') }}</p>

              </div>

              <form method="POST" action="{{ route('user.verify') }}">
                @csrf
                <div class="form-group">
                  <input type="hidden" name="email" value="{{ $email }}">

                 <label for="otp">{{ __('auth.enter_code') }}</label>

                  <input type="text" name="otp" id="otp" class="form-control" required maxlength="6">
                </div>

                <div class="mt-2 text-center">
                  <small>
                    {{ __('auth.didnt_receive_code') }}
                    <a href="{{ route('user.resend') }}" class="text-danger">{{ __('auth.resend') }}</a>
                  </small>
                </div>
                <div class="text-center">
                 <button type="submit" class="btn btn-primary w-100 mt-3">{{ __('auth.continue') }}</button>

                </div>

              </form>

            </div>
          </div>
        </div>