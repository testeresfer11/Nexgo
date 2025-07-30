@extends('admin.layouts.app')
@section('title')
    {{ __('admin.general_setting') }}
@endsection

@section('content')
<div class="page-content-wrapper">
    <div class="container-fluid">

        <div class="row mb-3">
            <div class="col-sm-12">
                <h3 class="page-title">{{ __('admin.general_setting') }}</h3>
            </div>
        </div>

        <form method="POST" action="{{ route('admin.settings.general') }}" id="edit-user">
            @csrf
            @method('POST')

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ __('admin.general_setting') }}</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="site_name">{{ __('admin.site_name') }}</label>
                            <input type="text" class="form-control @error('site_name') is-invalid @enderror" id="site_name" name="site_name" value="{{ old('site_name', $general->site_name ?? '') }}">
                            @error('site_name')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="email">{{ __('admin.email') }}</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $general->email ?? '') }}">
                            @error('email')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="col-md-6 mt-3">
                            <label for="phone_number">{{ __('admin.phone') }}</label>
                            <input type="text" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number" name="phone_number" value="{{ old('phone_number', $general->phone_number ?? '') }}">
                            @error('phone_number')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                            <input type="hidden" name="country_code" id="country_code" value="{{ old('country_code', $general->country_code ?? '') }}">
                        </div>

                        <div class="col-md-6 mt-3">
                            <label for="address">{{ __('admin.address') }}</label>
                            <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address', $general->address ?? '') }}">
                            @error('address')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-body">
                    <h4 class="card-title">{{ __('admin.fee_setting') }}</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="platform_fee">{{ __('admin.platform_fee') }}</label>
                            <input type="number" step="0.01" class="form-control @error('platform_fee') is-invalid @enderror" id="platform_fee" name="platform_fee" value="{{ old('platform_fee', $general->platform_fee ?? '') }}">
                            @error('platform_fee')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="per_km_price">{{ __('admin.per_km_price') }}</label>
                            <input type="number" step="0.01" class="form-control @error('per_km_price') is-invalid @enderror" id="per_km_price" name="per_km_price" value="{{ old('per_km_price', $general->per_km_price ?? '') }}">
                            @error('per_km_price')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group mt-4">
                <button type="submit" class="btn btn-primary">{{ __('admin.update') }}</button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/23.3.2/js/intlTelInput.min.js"></script>
<script>
    $(document).ready(function() {
        $("#edit-user").validate({
            rules: {
                site_name: {
                    required: true,
                    noSpace: true,
                    minlength: 3
                },
                email: {
                    required: true,
                    email: true,
                    noSpace: true
                },
                phone_number: {
                    required: true,
                    number: true,
                    minlength: 8,
                    maxlength: 15
                },
                platform_fee: {
                    required: true,
                    number: true,
                    min: 0
                }
            },
            messages: {
                site_name: {
                    required: "{{ __('admin.site_name_required') }}",
                    minlength: "{{ __('admin.site_name_minlength') }}"
                },
                email: {
                    required: "{{ __('admin.email_required') }}",
                    email: "{{ __('admin.email_valid') }}"
                },
                phone_number: {
                    required: "{{ __('admin.phone_required') }}",
                    number: "{{ __('admin.phone_number') }}",
                    minlength: "{{ __('admin.phone_minlength') }}",
                    maxlength: "{{ __('admin.phone_maxlength') }}"
                },
                platform_fee: {
                    required: "{{ __('admin.platform_fee_required') }}",
                    number: "{{ __('admin.platform_fee_number') }}",
                    min: "{{ __('admin.platform_fee_min') }}"
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
            highlight: function(element) {
                $(element).addClass('is-invalid').removeClass('is-valid');
            },
            unhighlight: function(element) {
                $(element).removeClass('is-invalid').addClass('is-valid');
            },
            submitHandler: function(form) {
                form.submit();
            }
        });

        $.validator.addMethod("noSpace", function(value) {
            return value.trim().length !== 0;
        }, "Spaces are not allowed");

        const input = document.querySelector("#phone_number");
        if (input) {
            const iti = window.intlTelInput(input, {
                initialCountry: 'au',
                separateDialCode: true,
                utilsScript: 'https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js',
            });

            $('#phone_number').on('countrychange', function() {
                const countryCode = $('.iti__selected-dial-code').html();
                $('#country_code').val(countryCode);
            });
        }
    });

    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const output = document.getElementById('profilePreview');
            output.src = reader.result;
            output.style.display = 'block';
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection
