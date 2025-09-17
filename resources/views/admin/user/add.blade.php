@extends('admin.layouts.app')

@section('title', 'Add User')

@section('breadcrumb')
<div class="page-header">
    <h3 class="page-title"> Users</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.user.list') }}">Users</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add User</li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div>
    <div class="row">
        <div class="col-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Add User</h4>
                    <x-alert />

                    <form class="forms-sample" id="add-user" action="{{ route('admin.user.add') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="firstName">First Name</label>
                                    <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="firstName" placeholder="Enter First Name" name="first_name" value="{{ old('first_name') }}">
                                    @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="lastName">Last Name</label>
                                    <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="lastName" placeholder="Enter Last Name" name="last_name" value="{{ old('last_name') }}">
                                    @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="email">Email address</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Email" name="email" value="{{ old('email') }}">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="phoneNumber">Phone Number</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i id="flag-icon" class="flag-icon flag-icon-us"></i> <!-- Default flag is US -->
                                            </div>
                                        </div>

                                        <input type="tel" id="phone" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror" placeholder="Enter phone number" value="{{ old('phone_number') }}">
                                        <input type="hidden" name="country_code" id="country_code" value="{{ old('country_code') }}">
                                        <input type="hidden" name="country_shortname" id="country_shortname" value="{{ old('country_shortname') }}">
                                    </div>
                                    @error('phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                      

                      <div class="row">
                        <!-- Profile Picture -->
                        <div class="col-md-6">
                            <label for="profile_picture">Profile Picture</label>
                            <input type="file" id="profile_picture" name="profile_picture" class="form-control file-upload-info" accept=".jpg,.jpeg,.png" onchange="previewProfile(event)">
                            <br>
                            <!-- Preview Container (hidden by default) -->
                            <div id="preview_container" style="display:none; margin-top:10px;">
                                <strong>Preview:</strong><br>
                                <img id="preview_img" src="" width="200" height="200" style="border:1px solid #ccc; padding:5px;">
                            </div>
                        </div>
                    </div>

                    <script>
                        function previewProfile(event) {
                            const previewContainer = document.getElementById('preview_container');
                            const previewImg = document.getElementById('preview_img');
                            
                            // Show container
                            previewContainer.style.display = "block";

                            // Display selected image
                            previewImg.src = URL.createObjectURL(event.target.files[0]);
                        }
                    </script>



                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="dob">Date of Birth</label>
                                <input type="date" 
                                       class="form-control @error('dob') is-invalid @enderror" 
                                       id="dob" 
                                       name="dob" 
                                       value="{{ old('dob') }}">
                                @error('dob')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>



                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="bio">Bio</label>
                                    <textarea class="form-control @error('bio') is-invalid @enderror" id="bio" name="bio">{{ old('bio') }}</textarea>
                                    @error('bio')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary mr-2">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/23.3.2/js/intlTelInput.min.js"></script>
<script>
    $(document).ready(function() {
        $("#add-user").validate({
            rules: {
                first_name: {
                    required: true,
                    noSpace: true,
                    
                },
                last_name: {
                    required: true,
                    noSpace: true,
                  
                },
                email: {
                    required: true,
                    email: true,
                    noSpace: true
                },
                phone_number: {
                    number: true,
                    minlength: 8,
                    maxlength: 15
                },
                
                profile_picture: {
                    required: false

                },
                 dob: {
                    required: true

                }
            },
            messages: {
                first_name: {
                    required: "{{ __('validation.first_name_required') }}",
                    minlength: "{{ __('validation.first_name_min') }}"
                },
                last_name: {
                    required: "{{ __('validation.last_name_required') }}",
                    minlength: "{{ __('validation.last_name_min') }}"
                },
                email: {
                    required: "{{ __('validation.email_required') }}",
                    email: "{{ __('validation.email_valid') }}"
                },
                phone_number: {
                    required: "{{ __('validation.phone_required') }}",
                    number: "{{ __('validation.phone_numeric') }}",
                    minlength: "{{ __('validation.phone_min') }}",
                    maxlength: "{{ __('validation.phone_max') }}"
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
                form.submit();
            }
        });

        $.validator.addMethod("noSpace", function(value, element) {
            return value.trim().length !== 0;
        }, "Spaces are not allowed");

        var input = document.querySelector("#phone");
        var iti = window.intlTelInput(input, {
            initialCountry: 'cm',
            separateDialCode: true,
            utilsScript: 'https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js',
        });

        // Update hidden input and flag icon when the country changes
        input.addEventListener('countrychange', function() {
            var countryData = iti.getSelectedCountryData();
            $('#country_code').val('+' + countryData.dialCode);
            $('#country_shortname').val(countryData.iso2);
            $('#flag-icon').removeClass().addClass('flag-icon flag-icon-' + countryData.iso2);
        });

        $(document).ready(function() {

            var initialCountryCode = '{{ old('
            country_code ') }}';
            var initialPhoneNumber = '{{ old('
            phone_number ') }}';

            if (initialCountryCode) {
                iti.setNumber(initialCountryCode);
            }

            if (initialPhoneNumber) {
                iti.setNumber(initialPhoneNumber);
            }
        });;

    });
</script>
@endsection