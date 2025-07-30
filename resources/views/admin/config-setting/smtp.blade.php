@extends('admin.layouts.app')

@section('title', __('admin.smtp_information'))

@section('breadcrum')
<div class="page-header">
    <h3 class="page-title">{{ __('admin.config_setting') }}</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.settings.smtp') }}">{{ __('admin.config_setting') }}</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">SMTP</li>
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
                    <h4 class="card-title">{{ __('admin.smtp_information') }}</h4>
                    <x-alert />

                    <form class="forms-sample" id="smtp-information" action="{{ route('admin.settings.smtp') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <label for="exampleInputFromEmail">{{ __('admin.from_email') }}</label>
                                    <input type="email" class="form-control @error('from_email') is-invalid @enderror" id="exampleInputFromEmail" placeholder="{{ __('admin.from_email') }}" name="from_email" value="{{ $smtpDetail['from_email'] ?? '' }}">
                                    @error('from_email')
                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <label for="exampleInputHost">{{ __('admin.host') }}</label>
                                    <input type="text" class="form-control @error('host') is-invalid @enderror" id="exampleInputHost" placeholder="{{ __('admin.host') }}" name="host" value="{{ $smtpDetail['host'] ?? '' }}">
                                    @error('host')
                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <label for="exampleInputPort">{{ __('admin.port') }}</label>
                                    <input type="number" class="form-control @error('port') is-invalid @enderror" id="exampleInputPort" placeholder="{{ __('admin.port') }}" name="port" value="{{ $smtpDetail['port'] ?? '' }}">
                                    @error('port')
                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <label for="exampleInputUserName">{{ __('admin.username') }}</label>
                                    <input type="email" class="form-control @error('username') is-invalid @enderror" id="exampleInputUserName" placeholder="{{ __('admin.username') }}" name="username" value="{{ $smtpDetail['username'] ?? '' }}">
                                    @error('username')
                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <label for="exampleInputFromName">{{ __('admin.from_name') }}</label>
                                    <input type="text" class="form-control @error('from_name') is-invalid @enderror" id="exampleInputFromName" placeholder="{{ __('admin.from_name') }}" name="from_name" value="{{ $smtpDetail['from_name'] ?? '' }}">
                                    @error('from_name')
                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>

                                <div class="col-6">
                                    <label for="exampleInputPassword">{{ __('admin.password') }}</label>
                                    <input type="text" class="form-control @error('password') is-invalid @enderror" id="exampleInputPassword" placeholder="{{ __('admin.password') }}" name="password" value="{{ $smtpDetail['password'] ?? '' }}">
                                    @error('password')
                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <label for="card_type">{{ __('admin.encryption') }}</label>
                                    <select class="js-example-basic-single form-control @error('encryption') is-invalid @enderror" name="encryption" id="card_type">
                                        <option value="tls" {{ $smtpDetail['encryption'] == 'tls' ? 'selected' : '' }}>tls</option>
                                        <option value="ssl" {{ $smtpDetail['encryption'] == 'ssl' ? 'selected' : '' }}>ssl</option>
                                    </select>
                                    @error('encryption')
                                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">{{ __('admin.update') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    $("#smtp-information").submit(function(e) {
        e.preventDefault();
    }).validate({
        rules: {
            from_email: { required: true, email: true, noSpace: true },
            host: { required: true, noSpace: true, minlength: 3 },
            port: { number: true, minlength: 3, maxlength: 5 },
            username: { required: true, email: true, noSpace: true },
            from_name: { required: true, noSpace: true, minlength: 3 },
            password: { required: true, noSpace: true },
            encryption: { required: true },
        },
        messages: {
            from_email: {
                required: "{{ __('validation.required', ['attribute' => __('admin.from_email')]) }}",
                email: "{{ __('validation.email', ['attribute' => __('admin.from_email')]) }}"
            },
            host: {
                required: "{{ __('validation.required', ['attribute' => __('admin.host')]) }}",
                minlength: "{{ __('validation.min.string', ['attribute' => __('admin.host'), 'min' => 3]) }}"
            },
            port: {
                number: "{{ __('validation.numeric', ['attribute' => __('admin.port')]) }}",
                minlength: "{{ __('validation.min.numeric', ['attribute' => __('admin.port'), 'min' => 3]) }}",
                maxlength: "{{ __('validation.max.numeric', ['attribute' => __('admin.port'), 'max' => 5]) }}"
            },
            username: {
                required: "{{ __('validation.required', ['attribute' => __('admin.username')]) }}",
                email: "{{ __('validation.email', ['attribute' => __('admin.username')]) }}"
            },
            from_name: {
                required: "{{ __('validation.required', ['attribute' => __('admin.from_name')]) }}",
                minlength: "{{ __('validation.min.string', ['attribute' => __('admin.from_name'), 'min' => 3]) }}"
            },
            password: {
                required: "{{ __('validation.required', ['attribute' => __('admin.password')]) }}"
            },
            encryption: {
                required: "{{ __('validation.required', ['attribute' => __('admin.encryption')]) }}"
            },
        },
        errorElement: 'span',
        errorPlacement: function(error, element) {
            error.insertAfter(element);
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
});
</script>
@stop
