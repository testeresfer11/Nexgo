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
                        <div class="custom-search">
                            <form action="{{ route('admin.payout.completed') }}" method="GET" id="searchForm">
                                <div class="d-flex align-items-center search-gap">
                                    <input type="text" name="search" value="{{ request()->search }}" placeholder="{{ __('admin.search') }}...">
                                    <button type="submit" class="btn default-btn btn-md">{{ __('admin.search') }}</button>
                                    <button type="button" class="btn secondary-btn btn-md" id="resetBtn">{{ __('admin.reset') }}</button>
                                </div>
                            </form>

                            <script>
                                document.getElementById('resetBtn').addEventListener('click', function() {
                                    document.getElementById('searchForm').reset();
                                    window.location.href = "{{ route('admin.payout.completed') }}";
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
                                    <button type="button" class="btn btn-outline-primary f-12 m-btn" id="make-payment-status" data-payout-id="{{ $payout->id }}">{{ __('admin.payment_proof') }}</button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="no-record">
                                    <center>{{ __('admin.no_record_found') }}</center>
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

{{-- Modal --}}
<div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="blogModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <input type="hidden" id="payout_id" name="payout_id">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="payment_slip">{{ __('admin.payment_slip') }}</label>
                            <img id="payment_slip_preview" src="" alt="Payment Slip" class="user-details-icon w-100 rounded">
                        </div>
                        <div class="form-group">
                            <label for="payment_method">{{ __('admin.payment_method') }}</label>
                            <input type="text" id="payment_method" name="payment_method" class="form-control" disabled>
                        </div>
                        <div class="form-group">
                            <label class="payment_date">{{ __('admin.date') }}</label>
                            <input type="date" id="payment_date" name="payment_date" class="form-control" disabled>
                        </div>
                        <div class="form-group">
                            <label class="payment_status">{{ __('admin.payment_status') }}</label>
                            <input type="text" class="form-control" id="payment_status" name="payment_status" value="completed" disabled>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                {{-- Optional footer buttons --}}
            </div>
        </div>
    </div>
</div>
@endsection
