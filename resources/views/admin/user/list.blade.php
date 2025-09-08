@extends('admin.layouts.app')

@section('title', __('admin.users'))

@section('breadcrum')
<div class="page-header">
    <h3 class="page-title">{{ __('admin.users') }}</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('admin.users') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('admin.users') }}</li>
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
                    <div class="d-flex justify-content-between" style="padding-bottom: 16px;">
                        <h4 class="card-title">{{ __('admin.user_management') }}</h4>
                        <a href="{{ route('admin.user.add') }}">
                            <button type="button" class="btn default-btn btn-md">
                                <span class="menu-icon">+ {{ __('admin.add_user') }}</span>
                            </button>
                        </a>
                    </div>

                    <div class="custom-search">
                        <form action="{{ route('admin.user.list') }}" method="GET" id="searchForm">
                            <div class="d-flex align-items-end justify-content-between search-gap">
                                <div class="d-flex align-items-end">
                                    <div class="form-group mb-0">
                                        <label for="start_date">{{ __('admin.from_date') }}</label>
                                        <input type="date" id="start_date" name="start_date"
                                            value="{{ request()->get('start_date') }}" class="form-control">
                                    </div>

                                    <div class="form-group mb-0 mx-2">
                                        <label for="end_date">{{ __('admin.to_date') }}</label>
                                        <input type="date" id="end_date" name="end_date"
                                            value="{{ request()->get('end_date') }}" class="form-control">
                                    </div>

                                    <select name="status" class="form-control">
                                        <option value="" {{ request()->get('status') == '' ? 'selected' : '' }}>
                                            {{ __('admin.all_status') }}</option>
                                        <option value="1" {{ request()->get('status') == '1' ? 'selected' : '' }}>
                                            {{ __('admin.active') }}</option>
                                        <option value="0" {{ request()->get('status') == '0' ? 'selected' : '' }}>
                                            {{ __('admin.inactive') }}</option>
                                    </select>
                                </div>

                                <div class="d-flex">
                                    <input type="text" name="search" class="px-2" placeholder="{{ __('admin.search') }}"
                                        value="{{ request()->get('search') }}">
                                    <button type="submit" class="btn default-btn mx-2 btn-md">{{ __('admin.search') }}</button>
                                    <button type="button" class="btn secondary-btn btn-md" id="resetBtn">{{ __('admin.reset') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>

                <div class="table-responsive mt-0">
                    <table class="table table-striped" id="filterData">
                        <thead>
                            <tr>
                                <th>{{ __('admin.profile') }}</th>
                                <th>{{ __('admin.name') }}</th>
                                <th>{{ __('admin.email') }}</th>
                                <th>{{ __('admin.registered_at') }}</th>
                                <th>{{ __('admin.status') }}</th>
                                <th>{{ __('admin.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr id="{{ $user->user_id }}">
                                    <td class="py-1">
                                        <img class="img-lg rounded-circle"
                                            src="{{ $user->profile_picture ? $user->profile_picture : asset('/admin/images/user-image.webp') }}"
                                            alt="User profile picture">
                                    </td>
                                    <td class="vehicle-modal" style="width: 300px;">{{ $user->first_name ?? '-' }} {{ $user->last_name }}</td>
                                    <td class="vehicle-modal" style="width: 300px;">{{ $user->email }}</td>
                                    <td class="vehicle-modal" style="width: 300px;">{{ $user->created_at }}</td>
                                    <td>
                                        <div class="toggle-user dark-toggle">
                                            <input type="checkbox" name="is_active" data-id="{{ $user->user_id }}"
                                                class="switch" @if ($user->status == 1) checked @endif
                                                data-value="{{ $user->status }}">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="menu-icon">
                                                <a href="{{ route('admin.user.view', ['id' => $user->user_id]) }}"
                                                    title="{{ __('admin.view') }}" class="text-primary">
                                                    <i class="mdi mdi-eye"></i>
                                                </a>
                                            </span>
                                            <span class="menu-icon mx-2">
                                                <a href="{{ route('admin.user.edit', ['id' => $user->user_id]) }}"
                                                    title="{{ __('admin.edit') }}" class="text-success">
                                                    <i class="mdi mdi-pencil"></i>
                                                </a>
                                            </span>
                                            <span class="menu-icon">
                                                <a href="#" title="{{ __('admin.delete') }}" class="text-danger deleteUser"
                                                    data-id="{{ $user->user_id }}">
                                                    <i class="mdi mdi-delete"></i>
                                                </a>
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="no-record">
                                        <center>{{ __('admin.no_record_found') }}</center>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="custom_pagination">
                    {{ $users->appends(request()->query())->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.getElementById('resetBtn').addEventListener('click', function() {
        window.location.href = "{{ route('admin.user.list') }}";
    });

    $('.deleteUser').on('click', function() {
        var user_id = $(this).data('id');
        Swal.fire({
            title: "{{ __('admin.confirm_delete') }}",
            text: "{{ __('admin.delete_user_warning') }}",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#2ea57c",
            cancelButtonColor: "#d33",
            confirmButtonText: "{{ __('admin.yes_delete') }}"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                  url: "{{ route('admin.user.delete', ['id' => '__id__']) }}".replace('__id__', user_id),

                    type: "GET",
                    success: function(response) {
                        if (response.status == "success") {
                            toastr.success(response.message);
                            setTimeout(() => location.reload(), 2000);
                        } else {
                            toastr.error(response.message);
                        }
                    }
                });
            }
        });
    });

    $('.switch').on('click', function() {
        var status = $(this).data('value');
        var action = (status == 1) ? 0 : 1;
        var id = $(this).data('id');
         var user_id = $(this).data('id');

        Swal.fire({
            title: "{{ __('admin.confirm_status_change') }}",
            text: "{{ __('admin.status_change_warning') }}",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#2ea57c",
            cancelButtonColor: "#d33",
            confirmButtonText: "{{ __('admin.yes_change') }}"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "{{ route('admin.user.changeStatus', ['id' => '__id__']) }}".replace('__id__', user_id),
                    type: "GET",
                    data: { id: id, status: action },
                    success: function(response) {
                        if (response.status == "success") {
                            toastr.success(response.message);
                            setTimeout(() => location.reload(), 2000);
                        } else {
                            toastr.error(response.message);
                        }
                    }
                });
            } else {
                $(this).prop('checked', !$(this).prop('checked'));
            }
        });
    });
</script>
@endsection
