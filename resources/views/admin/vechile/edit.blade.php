@extends('admin.layouts.app')

@section('title', __('Edit Vehicle'))

@section('breadcrumb')
<div class="page-header">
    <h3 class="page-title"> @lang('Edit Vehicle')</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.vehicle.list') }}"> @lang('Edit Vehicle') </a></li>
            <li class="breadcrumb-item active" aria-current="page"> @lang('Edit Vehicle')</li>
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
                    <h3 class="card-title">@lang('Edit Vehicle')</h3>
                    <x-alert />

                    <form class="forms-sample" id="edit-vechile" action="{{ route('admin.vehicle.edit', $vechile->vechile_id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>@lang('Make/Brand Name')</label>
                                    <textarea class="form-control @error('make') is-invalid @enderror" name="make" rows="4">{{ old('make', $vechile->make) }}</textarea>
                                    @error('make')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label>@lang('Model')</label>
                                    <textarea class="form-control @error('model') is-invalid @enderror" name="model" rows="4">{{ old('model', $vechile->model) }}</textarea>
                                    @error('model')
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
                                    <label>@lang('Type')</label>
                                    <textarea class="form-control @error('type') is-invalid @enderror" name="type" rows="4">{{ old('type', $vechile->type) }}</textarea>
                                    @error('type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label>@lang('Color')</label>
                                    <textarea class="form-control @error('color') is-invalid @enderror" name="color" rows="4">{{ old('color', $vechile->color) }}</textarea>
                                    @error('color')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">@lang('Update')</button>
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
    $(document).ready(function () {
        $("#edit-vechile").validate({
            rules: {
                make: { required: true },
                model: { required: true },
                color: { required: true },
                type: { required: true },
            },
            messages: {
                make: { required: "{{ __('admin.required_make') }}" },
                model: { required: "{{ __('admin.required_model') }}" },
                type: { required: "{{ __('admin.required_type') }}" },
                color: { required: "{{ __('admin.required_color') }}" },
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                if (element.attr("type") == "file") {
                    error.insertAfter(element.next());
                } else {
                    error.insertAfter(element);
                }
            },
            highlight: function (element) {
                $(element).addClass('is-invalid').removeClass('is-valid');
            },
            unhighlight: function (element) {
                $(element).removeClass('is-invalid').addClass('is-valid');
            },
            submitHandler: function (form) {
                form.submit();
            }
        });

        $.validator.addMethod("noSpace", function (value) {
            return value.trim().length !== 0;
        }, "@lang('Spaces are not allowed')");
    });
</script>
@endsection
