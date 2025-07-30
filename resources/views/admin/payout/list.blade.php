@extends('admin.layouts.app')
@section('title', __('admin.payouts'))
@section('breadcrum')
<div class="page-header">
<h3 class="page-title">{{ __('admin.payouts') }}</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{ __('admin.payouts') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('admin.payouts') }}</li>
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
                        <h4 class="card-title">{{ __('admin.payouts_management') }}</h4>
                        <!-- <a href="{{route('admin.ride.add')}}"><button type="button" class="btn default-btn btn-md">
                    <span class="menu-icon">+ Add User</span></button></a> -->

                        <div class="custom-search">

                            <form action="{{ route('admin.payout.pending') }}" method="GET" id="searchForm">
                                <div class="d-flex align-items-center search-gap">
                                    <input type="text" name="search" value="{{ request()->search }}" placeholder="{{ __('admin.search') }}">
                                    <button type="submit" class="btn default-btn btn-md">{{ __('admin.search') }}</button>
                                    <button type="button" class="btn secondary-btn btn-md" id="resetBtn">{{ __('admin.reset') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <script>
                    // Reset button click event
                    document.getElementById('resetBtn').addEventListener('click', function() {
                        // Reset form inputs
                        document.getElementById('searchForm').reset();

                        // Optionally, you can remove query parameters by redirecting to the base URL
                        window.location.href = "{{ route('admin.payout.pending') }}"; // Redirect to your pending payouts page
                    });
                </script>

                <div class="table-responsive mt-0">
                    <table class="table table-striped" id="filterData">
                        <thead>
                            <tr>
                                <th>{{ __('admin.sr_no') }}</th>
                                <th>{{ __('admin.user') }}</th>
                                <th>{{ __('admin.email') }}</th>
                                <th>{{ __('admin.amount') }}</th>
                                <th>{{ __('admin.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($payouts as $payout)

                            <tr id="payout-{{ $payout->id }}">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $payout->driver_name ?? 'N/A' }}</td>
                                <td>{{ $payout->driver_email ?? 'N/A' }}</td>
                                <td>${{ number_format($payout->amount, 2) }}</td>

                                <td>
                                    <div class="pay-out-btn">

                                        <button type="button" class="btn btn-outline-primary f-12 m-btn" id="make-payment-status" data-payout-id="{{$payout->id}}">MAKE PAYMENT</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="no-record">
                                    <center>{{ __('admin.no_record_found') }} </center>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $payouts->appends(request()->input())->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="blogModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="{{ route('admin.payout.mark_complete') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <!-- Profile Upload Section -->
                    <div class="row">
                        <input type="hidden" id="payout_id" name="payout_id">
                        <div class="col-12">
                            <div class="form-group">
                            <label class="payment_slip">{{ __('admin.upload_payment_slip') }}</label>

                                <input type="file" id="payment_slip" name="payment_slip" class="nme form-control" placeholder="Upload Image" accept="image/*">
                            </div>
                            <div class="form-group">
                                <label for="payment_method">{{ __('admin.select_payment_method') }}</label>
                                <select id="payment_method" name="payment_method" class="form-control" style="padding: unset" ;>
                                    <option value="">{{ __('admin.select_payment_method') }}</option>
                                    <option value="bank_transfer">{{ __('admin.bank_transfer') }}</option>
                                    <option value="paypal">{{ __('admin.paypal') }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="payment_date">{{ __('admin.date') }}</label>
                                <input type="date" id="payment_date" name="payment_date" class="nme form-control">
                            </div>
                            <div class="form-group">
                                <!-- <label class="payment_status">Payment Status</label> -->
                                <input type="hidden" class="form-control" id="payment_status" name="payment_status" value="completed">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('admin.close') }}</button>
                    <button type="submit" class="btn btn-primary">{{ __('admin.save_changes') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script>
    function resetUrl() {
        // Get the current URL
        const url = new URL(window.location.href);

        // Remove all query parameters
        url.search = '';

        // Redirect to the modified URL
        window.location.href = url.toString();
    }

    $(document).on('click', '#make-payment-status', function(e) {
        var payout_id = $(this).data('payout-id');
        $("#payout_id").val(payout_id);
        $('#paymentModal').modal('show');
    });


    $('.deleteUser').on('click', function() {
        var user_id = $(this).attr('data-id');
        Swal.fire({
            title: "Are you sure?",
            text: "You want to delete the User?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#2ea57c",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "/admin/user/delete/" + user_id,
                    type: "GET",
                    success: function(response) {
                        if (response.status == "success") {
                            toastr.success(response.message);
                            //$('table.table-striped tr#+'{$user_id}).remove();
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

    $('.switch').on('click', function() {
        var status = $(this).data('value');
        var action = (status == 1) ? 0 : 1;
        var id = $(this).data('id');

        Swal.fire({
            title: "Are you sure?",
            text: "Do you want to change the status of the user?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#2ea57c",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, mark as status"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "/admin/user/changeStatus",
                    type: "GET",
                    data: {
                        id: id,
                        status: action
                    },
                    success: function(response) {
                        if (response.status == "success") {
                            toastr.success(response.message);
                            setTimeout(function() {
                                location.reload();
                            }, 2000);
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

@stop