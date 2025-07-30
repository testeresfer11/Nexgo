@extends('admin.layouts.app')
@section('title', __('admin.rides'))
@section('breadcrum')
<div class="page-header">
    <h3 class="page-title">{{ __('admin.rides') }}</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{ __('admin.rides') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('admin.rides') }}</li>
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
                        <h4 class="card-title">{{ __('admin.rides_management') }}</h4>
                    </div>

                    <div class="custom-search">
                        <form action="{{ route('admin.ride.list') }}" method="GET" id="searchForm">
                            <div class="d-flex align-items-end justify-content-between search-gap">
                                <div class="d-flex align-items-end">
                                    <div class="form-group mb-0">
                                        <label for="start_date">{{ __('admin.from_date') }}</label>
                                        <input type="date" id="start_date" name="start_date" value="{{ request()->get('start_date') }}" class="form-control">
                                    </div>

                                    <div class="form-group px-2 mb-0">
                                        <label for="end_date">{{ __('admin.to_date') }}</label>
                                        <input type="date" id="end_date" name="end_date" value="{{ request()->get('end_date') }}" class="form-control">
                                    </div>

                                    <script>
                                        document.getElementById('start_date').addEventListener('focus', function() { this.showPicker(); });
                                        document.getElementById('end_date').addEventListener('focus', function() { this.showPicker(); });
                                    </script>

                                    <select name="status" class="form-control">
                                        <option value="">{{ __('admin.status') }}</option>
                                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>{{ __('admin.active') }}</option>
                                        <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>{{ __('admin.confirmed') }}</option>
                                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>{{ __('admin.completed') }}</option>
                                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>{{ __('admin.cancelled') }}</option>
                                    </select>
                                </div>

                                <div class="d-flex">
                                    <input type="text" name="search" placeholder="{{ __('admin.search') }}..." value="{{ request('search') }}">
                                    <button type="submit" class="btn default-btn mx-2 btn-md">{{ __('admin.search') }}</button>
                                    <button type="button" class="btn secondary-btn btn-md" id="resetBtn">{{ __('admin.reset') }}</button>
                                </div>
                            </div>
                        </form>

                        <script>
                            document.getElementById('resetBtn').addEventListener('click', function() {
                                document.getElementById('searchForm').reset();
                                window.location.href = "{{ route('admin.ride.list') }}";
                            });
                        </script>
                    </div>
                </div>

                <div class="table-responsive mt-0">
                    <table class="table table-striped" id="filterData">
                        <thead>
                            <tr>
                                <th>{{ __('admin.ride_id') }}</th>
                                <th>{{ __('admin.driver_name') }}</th>
                                <th>{{ __('admin.origin') }}</th>
                                <th>{{ __('admin.destination') }}</th>
                                <th>{{ __('admin.total_seats') }}</th>
                                <th>{{ __('admin.seats_available') }}</th>
                                <th>{{ __('admin.departure_date') }}</th>
                                <th>{{ __('admin.ride_status') }}</th>
                                <th>{{ __('admin.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($rides as $ride)
                            <tr>
                                <td>{{ $ride->ride_id }}</td>
                                <td><a href="{{ route('admin.user.view', ['id' => $ride->user_id]) }}">{{ $ride->first_name }} {{ $ride->last_name }}</a></td>
                                <td>{{ $ride->departure_city }}</td>
                                <td>{{ $ride->arrival_city }}</td>
                                <td>{{ $ride->available_seats }}</td>
                                <td>{{ $ride->available_seats - $ride->seat_booked <= 0 ? __('admin.full') : ($ride->available_seats - $ride->seat_booked) }}</td>
                                <td>{{ $ride->departure_time }}</td>
                                <td>{{ $ride->getStatusTextnew() }}</td>
                                <td>
                                    <span class="menu-icon">
                                        <a href="{{ route('admin.ride.view', ['id' => $ride->ride_id]) }}" title="{{ __('admin.view') }}" class="text-primary"><i class="mdi mdi-eye"></i></a>
                                    </span>
                                    <span class="menu-icon mx-2">
                                        <a href="#" title="{{ __('admin.delete') }}" class="text-danger deleteUser" data-id="{{ $ride->ride_id }}"><i class="mdi mdi-delete"></i></a>
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="9" class="no-record"><center>{{ __('admin.no_record_found') }}</center></td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="custom_pagination">
                    {{ $rides->appends(request()->query())->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $('.deleteUser').on('click', function() {
        var ride_id = $(this).data('id');
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
                    url: "/admin/ride/delete/" + ride_id,
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
        var action = status == 1 ? 0 : 1;
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
                    url: "/admin/user/changeStatus",
                    type: "GET",
                    data: { id: id, status: action },
                    success: function(response) {
                        if (response.status == "success") {
                            toastr.success(response.message);
                            setTimeout(() => location.reload(), 2000);
                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function(error) {
                        console.log('error', error);
                    }
                });
            } else {
                $('.switch').prop('checked', !$('.switch').prop('checked'));
            }
        });
    });
</script>
@endsection
