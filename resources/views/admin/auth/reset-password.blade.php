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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-C4uY2V0+ZnD6eGgXvD0Qdddo4nJ6Z6O6G8lF8qgqk2oTlmV3m21gXc2vC5jZx3w5JKjDfhcGQ0An4L6Yx0Hw==" crossorigin="anonymous" referrerpolicy="no-referrer" />


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
           @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
            <div class="card-body login-form px-5 py-5">
              <div class="text-center">
                <img src="{{asset('admin/images/auth/new_logo.png')}}" class="img-fluid" alt="">
                <h1 class=" heading-primary my-3">{{ __('auth.reset_password') }}</h1>
                <p class="grey">{{ __('auth.reset_password_description') }}</p>
              </div>
              {{-- <x-alert /> --}}
              <form action="{{ route('user.reset-password',['token' => $token]) }}" method="POST" id="loginForm">
                    @csrf
                  <div class="form-group position-relative mb-3">
                      <label for="password">{{ __('admin.password') }}</label>
                      <input id="password" type="password" 
                             class="form-control" 
                             name="password" required>

                      <!-- Eye Icon -->
                      <span class="togglePassword eye-icon position-absolute" 
                            data-target="password" 
                            title="Show Password"
                            style="top: 48px; right: 10px; transform: translateY(-50%); cursor: pointer;">
                          <i class="fa-solid fa-eye-slash"></i>
                      </span>
                  </div>

                  <div class="form-group position-relative mb-3">
                      <label for="password-confirm">{{ __('admin.confirm_password') }}</label>
                      <input id="password-confirm" type="password" 
                             class="form-control" 
                             name="password_confirmation" required>

                      <!-- Eye Icon -->
                      <span class="togglePassword eye-icon position-absolute" 
                            data-target="password-confirm" 
                            title="Show Password"
                            style="top: 48px; right: 10px; transform: translateY(-50%); cursor: pointer;">
                          <i class="fa-solid fa-eye-slash"></i>
                      </span>
                  </div>

                          @error('password_confirmation')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                      </div>

                      


                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-block enter-btn">
                            {{ __('auth.reset_password') }}
                        </button>
                    </div>
                </form>



            </div>
          </div>

          <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
        <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">


        <script>
          document.querySelectorAll('.togglePassword').forEach(function (eye) {
              eye.addEventListener('click', function () {
                  let target = document.getElementById(this.getAttribute('data-target'));
                  let icon = this.querySelector('i');

                  if (target.type === "password") {
                      target.type = "text";
                      icon.classList.replace("fa-eye-slash", "fa-eye");
                      this.setAttribute("title", "Hide Password");
                  } else {
                      target.type = "password";
                      icon.classList.replace("fa-eye", "fa-eye-slash");
                      this.setAttribute("title", "Show Password");
                  }
              });
          });
      </script>
          <script>
           $(document).ready(function () {

    // ✅ Define strong password validation rule
    jQuery.validator.addMethod("strongPassword", function(value, element) {
        return this.optional(element) || 
               /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/.test(value);
    }, "Password must include uppercase, lowercase, number, and special character.");

    // ✅ Now initialize validation
    $("#loginForm").validate({
        rules: {
            password: {
                required: true,
                minlength: 8,
                strongPassword: true
            },
            password_confirmation: {
                required: true,
                equalTo: "#password"
            }
        },
        messages: {
            password: {
                required: "Password is required.",
                minlength: "Password must be at least 8 characters long."
            },
            password_confirmation: {
                required: "Password confirmation is required.",
                equalTo: "Passwords do not match."
            }
        },
        errorElement: 'div',
        errorClass: 'invalid-feedback',
        highlight: function (element) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element) {
            $(element).removeClass('is-invalid');
        },
        errorPlacement: function (error, element) {
            if (element.parent('.input-group').length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        }
    });

});
          </script>