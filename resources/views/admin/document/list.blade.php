@extends('admin.layouts.app')
@section('title', __('admin.document'))

@section('breadcrum')
<div class="page-header">
    <h3 class="page-title">{{ __('admin.document') }}</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('admin.document') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('admin.document') }}</li>
        </ol>
    </nav>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12 grid-margin table-card stretch-card">
        <div class="card">
            <x-alert />
            <div class="card-body">
                <div class="px-4 py-4">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">{{ __('admin.document_management') }}</h4>
                        <div class="custom-search">
                            <form action="{{ route('admin.document.search') }}" method="GET" id="searchForm">
                                <div class="d-flex align-items-center justify-content-end search-gap">
                                    <input type="text" name="search" value="{{ request()->search }}" placeholder="{{ __('admin.search') }}">
                                    <button type="submit" class="btn default-btn btn-md">{{ __('admin.search') }}</button>
                                    <button type="button" class="btn secondary-btn btn-md" id="resetBtn">{{ __('admin.reset') }}</button>
                                </div>
                            </form>
                            <script>
                                document.getElementById('resetBtn').addEventListener('click', function () {
                                    document.getElementById('searchForm').reset();
                                    window.location.href = "{{ route('admin.document.list') }}";
                                });
                            </script>
                        </div>
                    </div>
                </div>
                <div class="table-responsive mt-0">
                    <table class="table table-striped" id="filterData">
                        <thead>
                            <tr>
                                <th>{{ __('admin.sr_no') }}</th>
                                <th>{{ __('admin.name') }}</th>
                                <th>{{ __('admin.document') }}</th>
                                <th>{{ __('admin.status') }}</th>
                                <th>{{ __('admin.verify') }}</th>
                                <th>{{ __('admin.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($documents as $keys => $document)
                            <tr>
                                <td class="py-1">{{ $keys + 1 }}</td>
                                <td>{{ $document->first_name ?? "-" }}</td>
                                <td>
                                    @if($document->id_card != "" && str_contains($document->id_card, 'https://dummyimage.com/'))
                                    <a href="{{ $document->id_card }}" target="_blank">
                                        <img class="img-lg" src="{{ $document->id_card }}" alt="{{ __('admin.user_id_card') }}" width="500" height="500">
                                    </a>
                                    @else
                                    <a href="{{ url('/') }}/storage/id_card/{{ $document->id_card }}" target="_blank">
                                        <img class="img-lg" src="{{ url('/') }}/storage/id_card/{{ $document->id_card }}" alt="{{ __('admin.user_id_card') }}" width="400" height="400">
                                    </a>
                                    @endif
                                </td>
                                <td>{{ $document->verify_id }}</td>
                                <td>
                                    <button type="submit" class="btn green-btn btn-md switch" data-id="{{ $document->user_id }}" data-value="2">{{ __('admin.approve') }}</button>
                                    <button type="submit" class="btn red-btn btn-md switch" data-id="{{ $document->user_id }}" data-value="3">{{ __('admin.decline') }}</button>
                                </td>
                                <td>
                                    <a href="{{ route('admin.user.view', ['id' => $document->user_id]) }}" title="{{ __('admin.view') }}" class="text-primary">
                                        <i class="mdi mdi-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="no-record"><center>{{ __('admin.no_record_found') }}</center></td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="custom_pagination"></div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $('.deleteUser').on('click', function () {
        var user_id = $(this).attr('data-id');
        Swal.fire({
            title: "{{ __('admin.are_you_sure') }}",
            text: "{{ __('admin.confirm_delete_text') }}",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#2ea57c",
            cancelButtonColor: "#d33",
            confirmButtonText: "{{ __('admin.yes_delete') }}"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "/admin/user/delete/" + user_id,
                    type: "GET",
                    success: function (response) {
                        if (response.status == "success") {
                            toastr.success(response.message);
                            setTimeout(function () {
                                location.reload();
                            }, 2000);
                        } else {
                            toastr.error(response.message);
                        }
                    }
                });
            }
        });
    });

    $('.switch').on('click', function () {
        var status = $(this).data('value');
        var id = $(this).data('id');

        Swal.fire({
            title: "{{ __('admin.are_you_sure') }}",
            text: "{{ __('admin.confirm_status_change') }}",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#2ea57c",
            cancelButtonColor: "#d33",
            confirmButtonText: "{{ __('admin.yes_mark_status') }}"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "/admin/document/changeStatus",
                    type: "GET",
                    data: { id: id, status: status },
                    success: function (response) {
                        if (response.status == "success") {
                            toastr.success(response.message);
                            setTimeout(function () {
                                location.reload();
                            }, 2000);
                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function (error) {
                        console.log('error', error);
                    }
                });
            } else {
                $('.switch').prop('checked', !$('.switch').prop('checked'));
            }
        });
    });
</script>
@stop
