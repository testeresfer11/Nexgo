@extends('admin.layouts.app')

@section('title', __('admin.change_password'))
@section('breadcrum')
<div class="page-header">
<h3 class="page-title">{{ __('admin.change_password') }}</h3>
<nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Profile</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ __('admin.change_password') }}</li>
      </ol>
    </nav>
</div>
@endsection
@section('content')
<style type="text/css">
  .toggle-password {
    right: 41px;
    top: 17px;
}
</style>
<div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">{{ __('admin.change_password') }}</h4>
               
                <form class="forms-sample" action="{{route(name: 'admin.changePassword')}}" method="post" id="change-password">
                  @csrf
                  <div class="row px-2">
                    <div class="col-md-4">
                    <div class="form-group">
                        
                          <label for="exampleInputPassword" class=" col-form-label">{{ __('admin.current_password') }}</label>
                          <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="password" placeholder="{{ __('admin.current_password') }}" name="current_password">
                          <i class="toggle-password fa fa-eye-slash eye-icon" toggle="#password" ></i>
                          @error('current_password')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                          
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">

                      <label for="password" class=" col-form-label">New Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password-field" placeholder="{{ __('admin.new_password') }}" name="password" pattern="(?=.*[A-Z])(?=.*[@$!%*#?&]).*" title="Password must include at least one uppercase letter and one special character (@, $, !, %, *, #, ?, &)">
                        <i class="toggle-password fa fa-eye-slash eye-icon" toggle="#password-field" ></i>
                        @error('password')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                    </div>
                  </div>
                  <div class="col-md-4">
                    
                    <div class="form-group">
                      <label for="password_confirm" class=" col-form-label">Confirm Password</label>
                      
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id = "password-confirm" name="password_confirmation" placeholder="{{ __('admin.confirm_password') }}">
                        <i class="toggle-password fa fa-eye-slash eye-icon" toggle="#password-confirm" ></i>
                        @error('password_confirm')
                          <span class="invalid-feedback">
                              <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      
                    </div>
                  </div>
                  </div>
                  <div class="text-end">
                  <button type="submit" class="btn btn-primary mr-2">{{ __('admin.update') }}</button>
                  {{-- <button class="btn btn-dark">Cancel</button> --}}
                </div>
                </form>
              </div>
            </div>
        </div>
    </div>
</div>    
@endsection

@section('scripts')
<script type="text/javascript">
  $(".toggle-password").click(function() {

  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});
</script>
<script type="text/javascript">
  $(".password").click(function() {

  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});
</script>
<script type="text/javascript">
  $(".password-confrim").click(function() {

  $(this).toggleClass("fa-eye fa-eye-slash");
  var input = $($(this).attr("toggle"));
  if (input.attr("type") == "password") {
    input.attr("type", "text");
  } else {
    input.attr("type", "password");
  }
});
</script>
<script>
  $(document).ready(function() {
    $("#change-password").submit(function(e){
        e.preventDefault();
    }).validate({
        rules: {
            current_password: {
                required: true,
                noSpace: true,
                minlength: 8,
            },
            password: {
              required: true,
              noSpace: true,
              minlength: 8,
            },
            password_confirmation: {
              required: true,
              noSpace: true,
              minlength: 8,
              equalTo: "#password-field",
            },
        },
        messages: {
            current_password: {
                required: "{{ __('admin.current_password_required') }}",
                minlength: "{{ __('admin.current_password_min') }}"
            },
            password: {
                required: "{{ __('admin.new_password_required') }}",
                minlength: "{{ __('admin.new_password_min') }}"
            },
            password_confirmation: {
                required: "{{ __('admin.confirm_password_required') }}",
                minlength: "{{ __('admin.confirm_password_min') }}",
                equalTo: "{{ __('admin.password_match') }}"
            }
        },

        errorElement: 'span',
        errorPlacement: function(error, element) {
            if (element.attr("type") == "file") {
                error.insertAfter(element.next());
            } else {
                error.insertAfter(element);
            }
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass('is-invalid').removeClass('is-valid');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass('is-invalid').addClass('is-valid');
        },
        submitHandler: function(form) {
          var formData = new FormData(form);
          var action = $(form).attr('action'); // Corrected to use jQuery
          $.ajax({
              url: action, // Use the form's action attribute
              type: 'POST',
              data: formData,
              contentType: false,
              processData: false,
              success: function(response) {
                console.log(response);  
                  // Handle success
                  if (response.status == "success") {
                   toastr.success(response.message);
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                  } else {
                    toastr.error(response.message);
                  }
              },
              error: function(xhr) {
                  // Handle error
                  // let errors = xhr.responseJSON;
                  let response = xhr.responseJSON;
                  toastr.error(response.message);
              }
          });
      }

    });
  });
  </script>
@stop