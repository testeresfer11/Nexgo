@extends('admin.layouts.app')
@section('title', __('admin.edit_user'))

@section('breadcrum')
<div class="page-header">
    <h3 class="page-title">{{ __('admin.edit_user') }}</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.user.list') }}">{{ __('admin.users') }}</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('admin.edit_user') }}</li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{ __('admin.edit_user') }}</h4>
           <form class="forms-sample" 
              id="edit-user" 
              action="{{ route('admin.user.edit', ['id' => $user->user_id]) }}" 
              method="POST" 
              enctype="multipart/form-data">
            @csrf
                    <div class="form-group">
                        <label>{{ __('admin.first_name') }}</label>
                        <input type="text" name="first_name" value="{{ old('first_name', $user->first_name) }}" class="form-control" placeholder="{{ __('admin.enter_first_name') }}">
                    </div>

                    <div class="form-group">
                        <label>{{ __('admin.last_name') }}</label>
                        <input type="text" name="last_name" value="{{ old('last_name', $user->last_name) }}" class="form-control" placeholder="{{ __('admin.enter_last_name') }}">
                    </div>

                    <div class="form-group">
                        <label>{{ __('admin.email') }}</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" placeholder="{{ __('admin.email') }}">
                    </div>

                    <div class="form-group">
                        <label>{{ __('admin.phone_number') }}</label>
                        <input type="text" name="phone_number" value="{{ old('phone', $user->phone_number) }}" class="form-control" placeholder="{{ __('admin.phone_number') }}">
                    </div>

                    <div class="form-group">
                        <label>{{ __('admin.profile_upload') }}</label>
                        <input type="file" name="profile_picture" id="profileInput" class="form-control" accept=".jpg,.jpeg,.png">

                        {{-- Show existing profile picture if available --}}
                        @if($user->profile_picture)
                            <img src="{{ $user->profile_picture }}" id="profilePreview" width="100" class="mt-2 d-block" />
                        @else
                            <img id="profilePreview" width="100" class="mt-2 d-block" style="display:none;" />
                        @endif
                    </div>

                    {{-- Image Preview Script --}}
                    <script>
                        document.getElementById('profileInput').addEventListener('change', function(event) {
                            let preview = document.getElementById('profilePreview');
                            let file = event.target.files[0];

                            if (file) {
                                preview.src = URL.createObjectURL(file);
                                preview.style.display = 'block';
                            } else {
                                preview.src = "";
                                preview.style.display = 'none';
                            }
                        });
                    </script>

                     <div class="form-group">
                        <div class="row">
                        
                            <div class="col-md-6">
                                <label for="dob">Date of Birth</label>
                                <input type="date" 
                                       class="form-control @error('dob') is-invalid @enderror" 
                                       id="dob" 
                                       name="dob" 
                                       value="{{ old('dob', $user->dob) }}">
                                @error('dob')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label>{{ __('admin.bio') }}</label>
                        <textarea name="bio" class="form-control">{{ old('bio', $user->bio) }}</textarea>
                    </div>

                    <!-- <div class="form-group">
                        <label>{{ __('admin.drivers_license') }}</label>
                        <input type="file" name="license" class="form-control">
                        @if($user->license)
                         <img src="{{ $user->license }}" width="100" class="mt-2" />
                        @endif
                    </div>

                    <div class="form-group">
                        <label>{{ __('admin.national_id_or_passport') }}</label>
                        <input type="file" name="national_id" class="form-control">
                        @if($user->national_id)
                          <img src="{{ $user->national_id }}" width="100" class="mt-2" />
                        @endif
                    </div>

                    <div class="form-group">
                        <label>{{ __('admin.technical_inspection') }}</label>
                        <input type="file" name="technical_inspection_certificate" class="form-control">
                        @if($user->technical_inspection_certificate)
                        <img src="{{ $user->technical_inspection_certificate }}" width="100" class="mt-2" />
                        @endif
                    </div>

                    <div class="form-group">
                        <label>{{ __('admin.registration_certificate') }}</label>
                        <input type="file" name="registration_certificate" class="form-control">
                        @if($user->registration_certificate)
                       <img src="{{ $user->registration_certificate }}" width="100" class="mt-2" />
                        @endif
                    </div>

                    <div class="form-group">
                        <label>{{ __('admin.insurance') }}</label>
                        <input type="file" name="insurance" class="form-control">
                        @if($user->insurance)
                       <img src="{{ $user->insurance }}" width="100" class="mt-2" />
                        @endif
                    </div> -->

                    <button type="submit" class="btn btn-primary">{{ __('admin.update') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/23.3.2/js/intlTelInput.min.js"></script>
<script>
    $(document).ready(function() {
        // Form validation
        $("#edit-user").validate({
            rules: {
                first_name: {
                    required: true,
                    noSpace: true,
                   
                },
                last_name: {
                    required: false,
                    noSpace: true,
                    
                },
                email: {
                    
                    email: true
                   
                },
                phone_number: {
                    number: true,
                    minlength: 8,
                    maxlength: 15
                }
            },
            messages: {
                first_name: {
                    required: "{{ __('validation.first_name_required') }}",
                    minlength: "{{ __('validation.first_name_minlength') }}"
                },
                last_name: {
                    required: "{{ __('validation.last_name_required') }}",
                    minlength: "{{ __('validation.last_name_minlength') }}"
                },
                email: {
                
                    email: "{{ __('validation.email_invalid') }}"
                },
                phone_number: {
                    required: "{{ __('validation.phone_required') }}",
                    number: "{{ __('validation.phone_invalid') }}",
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

        // Custom method to check for spaces
        $.validator.addMethod("noSpace", function(value, element) {
            return value.trim().length !== 0;
        }, "Spaces are not allowed");

        // Initialize international telephone input
        var input = document.querySelector("#phone");
        var iti = window.intlTelInput(input, {
            initialCountry: '{{ old('
            country_shortname ', $user->country_shortname) }}',
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
            country_code ', $user->country_code) }}';
            var initialPhoneNumber = '{{ old('
            phone_number ', $user->phone_number) }}';

            if (initialCountryCode) {
                iti.setNumber(initialCountryCode);
            }

            if (initialPhoneNumber) {
                iti.setNumber(initialPhoneNumber);
            }
        });


        // Image preview functionality
        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('profilePreview');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    });
</script>
@endsection