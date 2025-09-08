@extends('admin.layouts.app')
@section('title', __('admin.payment'))
@section('breadcrum')
<div class="page-header">
    <h3 class="page-title">{{ __('admin.payment_management') }}</h3>
    <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">{{ __('admin.payment') }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ __('admin.payment') }}</li>
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
                    <div class="d-flex justify-content-between mb-3">
                        <h4 class="card-title">{{ __('admin.payment_management') }}</h4>
                    </div>
                    <div class="custom-search">
                        <form action="{{ route('admin.payments.list') }}" method="GET" id="searchForm">
                            <div class="d-flex align-items-end justify-content-between search-gap">
                                <div class="d-flex align-items-end">
                                    <div class="form-group mb-0">
                                        <label for="start_date">{{ __('admin.from_date') }}</label>
                                        <input type="date" id="start_date" name="start_date" value="{{ request()->get('start_date') }}" class="form-control" placeholder="{{ __('admin.from_date') }}">
                                    </div>
                                    <div class="form-group mb-0 px-2">
                                        <label for="end_date">{{ __('admin.to_date') }}</label>
                                        <input type="date" id="end_date" name="end_date" value="{{ request()->get('end_date') }}" class="form-control" placeholder="{{ __('admin.to_date') }}">
                                    </div>

                                    <script>
                                        document.getElementById('start_date').addEventListener('focus', function () {
                                            this.showPicker();
                                        });
                                        document.getElementById('end_date').addEventListener('focus', function () {
                                            this.showPicker();
                                        });
                                    </script>

                                    <select name="payment_method" class="form-control">
                                        <option value="">{{ __('admin.all') ?? 'All' }}</option>
                                        <option value="stripe" {{ request()->get('payment_method') == 'stripe' ? 'selected' : '' }}>{{ __('admin.stripe') }}</option>
                                        <option value="paypal" {{ request()->get('payment_method') == 'paypal' ? 'selected' : '' }}>{{ __('admin.paypal') }}</option>
                                    </select>
                                </div>
                                <div class="d-flex">
                                    <input type="text" name="search" placeholder="{{ __('admin.search') }}" value="{{ request()->get('search') }}" class="form-control">
                                    <button type="submit" class="btn default-btn mx-2 btn-md">{{ __('admin.search') }}</button>
                                    <button type="button" class="btn secondary-btn btn-md" id="resetBtn">{{ __('admin.reset') }}</button>
                                </div>
                            </div>
                        </form>

                        <script>
                            document.getElementById('resetBtn').addEventListener('click', function () {
                                document.getElementById('searchForm').reset();
                                window.location.href = "{{ route('admin.payments.list') }}";
                            });
                        </script>
                    </div>
                </div>
                <div class="table-responsive mt-0">
                    <table class="table table-striped" id="filterData">
                        <thead>
                            <tr>
                                <th>{{ __('admin.sr_no') }}</th>
                                <th>{{ __('admin.passenger_name') }}</th>
                                <th>{{ __('admin.ride_id') }}</th>
                                <th>{{ __('admin.booking_id') }}</th>
                                <th>{{ __('admin.amount') }}</th>
                                <th>{{ __('admin.payment_date') }}</th>
                                <th>{{ __('admin.payment_method') }}</th>
                                <th>{{ __('admin.status') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($payments as $key => $payment)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $payment->first_name }}</td>
                                <td><a href="{{ route('admin.ride.view', $payment->ride_id) }}">{{ $payment->ride_id }}</a></td>
                                <td>{{ $payment->booking_id }}</td>
                                <td>${{ number_format($payment->amount, 2) }}</td>
                                <td>{{ convertDate($payment->payment_date) }}</td>
                                <td>{{ $payment->payment_method }}</td>
                                <td>
                                    @if ($payment->status === 'COMPLETED')
                                        {{ __('admin.succeeded') }}
                                    @else
                                        {{ $payment->status }}
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="no-record"><center>{{ __('admin.no_record_found') }}</center></td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="custom_pagination">
                    {{ $payments->appends(request()->except('page'))->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
  $('.deleteUser').on('click', function() {
    var user_id = $(this).attr('data-id');
    Swal.fire({
        title: "{{ __('admin.are_you_sure') }}",
        text: "{{ __('admin.confirm_delete_user_text') }}",
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
                success: function(response) {
                    if (response.status == "success") {
                        toastr.success(response.message);
                        setTimeout(function() {
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
    var action = (status == 1) ? 0 : 1;
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
