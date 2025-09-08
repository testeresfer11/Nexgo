@extends('admin.layouts.app')

@section('title', __('admin.vehicle'))

@section('breadcrum')
<div class="page-header">
    <h3 class="page-title">{{ __('admin.vehicle') }}</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}">{{ __('admin.vehicle') }}</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('admin.vehicle') }}</li>
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
                        <h4 class="card-title">{{ __('admin.vehicle_management') }}</h4>
                        <a href="{{ route('admin.vehicle.add') }}">
                            <button type="button" class="btn default-btn btn-md">
                                <span class="menu-icon">+ {{ __('admin.add_vehicle') }}</span>
                            </button>
                        </a>
                    </div>

                    <div class="custom-search mt-3">
                        <form action="{{ route('admin.vehicle.search') }}" method="GET" id="searchForm">
                            <div class="d-flex align-items-center justify-content-end search-gap">
                                <input type="text" name="search" class="w-25" value="{{ request()->search }}" placeholder="{{ __('admin.search') }}...">
                                <button type="submit" class="btn default-btn btn-md">{{ __('admin.search') }}</button>
                                <button type="button" class="btn secondary-btn btn-md" id="resetBtn">{{ __('admin.reset') }}</button>
                            </div>
                        </form>

                        <script>
                            document.getElementById('resetBtn').addEventListener('click', function () {
                                document.getElementById('searchForm').reset();
                                window.location.href = "{{ route('admin.vehicle.list') }}";
                            });
                        </script>
                    </div>
                </div>

                <div class="table-responsive vehicle-table mt-0">
                    <table class="table table-striped" id="filterData">
                        <thead>
                            <tr>
                                <th>{{ __('admin.sr_no') }}</th>
                                <th>{{ __('admin.make') }}</th>
                                <th>{{ __('admin.model') }}</th>
                                <th>{{ __('admin.type') }}</th>
                                <th>{{ __('admin.colors') }}</th>
                                <th>{{ __('admin.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($vechiles as $keys => $vechile)
                                <tr id="{{ $keys + 1 }}">
                                    <td>{{ $keys + 1 }}</td>
                                    <td>{{ $vechile->make }}</td>
                                    <td><div style="width: 300px" class="vehicle-modal">{{ $vechile->model }}</div></td>
                                    <td><div style="width: 200px" class="vehicle-modal">{{ $vechile->type }}</div></td>
                                    <td><div style="width: 200px" class="vehicle-modal">{{ $vechile->color }}</div></td>
                                    <td>
                                        <span class="menu-icon">
                                            <a href="{{ route('admin.vehicle.edit', ['id' => $vechile->vechile_id]) }}" title="{{ __('admin.edit') }}" class="text-success"><i class="mdi mdi-pencil"></i></a>
                                        </span>
                                        <span class="menu-icon mx-2">
                                            <a href="#" title="{{ __('admin.delete') }}" class="text-danger deleteVechile" data-id="{{ $vechile->vechile_id }}"><i class="mdi mdi-delete"></i></a>
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="no-record text-center">{{ __('admin.no_record_found') }}</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="custom_pagination">
                    {{ $vechiles->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $('.deleteVechile').on('click', function () {
        var user_id = $(this).attr('data-id');
        Swal.fire({
            title: "{{ __('admin.confirm_delete_title') }}",
            text: "{{ __('admin.confirm_delete_text') }}",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#2ea57c",
            cancelButtonColor: "#d33",
            confirmButtonText: "{{ __('admin.confirm_delete_button') }}"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('admin.vehicle.delete', ['id' => '__id__']) }}".replace('__id__', user_id),
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
</script>
@endsection
