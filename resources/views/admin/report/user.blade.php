@extends('admin.layouts.app')
@section('title', __('admin.reports'))
<style>
    .table tbody tr td.mw {
    min-width: 450px;
    overflow-wrap: break-word;
    white-space: normal;
}
select.form-control {
    width: fit-content !important;
}
</style>
@section('breadcrum')
<div class="page-header">
    <h3 class="page-title">{{ __('admin.reports_management') }}</h3>
    <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{ __('admin.reports') }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ __('admin.reports') }}</li>
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
            <h4 class="card-title">{{ __('admin.reports_management') }}</h4>
          </div>
          <div class="custom-search">
            <form action="{{ route('admin.reports.users') }}" method="GET" id="searchForm" class="m-0">
                <div class="d-flex align-items-end justify-content-between search-gap">
                    <div class="d-flex align-items-end">
                    <!-- Date Filter -->
                    <div class="form-group m-0">
                        <label for="start_date">{{ __('admin.from_date') }}</label>
                        <input type="date" id="start_date" name="start_date" value="{{ request()->get('start_date') }}" class="form-control" placeholder="{{ __('admin.from_date') }}">
                    </div>
                    <div class="form-group m-0 px-2">
                        <label for="end_date">{{ __('admin.to_date') }}</label>
                        <input type="date" id="end_date" name="end_date" value="{{ request()->get('end_date') }}" class="form-control" placeholder="{{ __('admin.to_date') }}">
                    </div>
                    <script>
                        document.getElementById('start_date').addEventListener('focus', function() {
                            this.showPicker();
                        });
                        document.getElementById('end_date').addEventListener('focus', function() {
                            this.showPicker();
                        });
                    </script>
                    <select name="status" class="form-control" style="width: fit-content;">
                        <option value="" {{ request()->status === "" ? 'selected' : '' }}>{{ __('admin.all') }}</option>
                        <option value="0" {{ request()->status == 0 ? 'selected' : '' }}>{{ __('admin.unresolved') }}</option>
                        <option value="1" {{ request()->status == 1 ? 'selected' : '' }}>{{ __('admin.resolved') }}</option>
                        <option value="2" {{ request()->status == 2 ? 'selected' : '' }}>{{ __('admin.false_complaint') }}</option>
                    </select>
                </div>
                <div class="d-flex">
                    <input type="text" name="search" value="{{ request()->search }}" placeholder="{{ __('admin.search') }}..." class="form-control">
                    <button type="submit" class="btn default-btn mx-2 btn-md">{{ __('admin.search') }}</button>
                    <button type="button" class="btn default-btn btn-md" id="resetBtn">{{ __('admin.reset') }}</button>
                </div>
              </div>
          </form>
          <script>
              document.getElementById('resetBtn').addEventListener('click', function() {
                  document.getElementById('searchForm').reset();
                  window.location.href = "{{ route('admin.reports.users') }}";  
              });
          </script>
          </div>
            </div>
          <div class="table-responsive mt-0">
            <table class="table table-striped" id="filterData">
                    <thead>
                        <tr>
                            <th>{{ __('admin.ride_id') }}</th>
                            <th>{{ __('admin.ride_location') }}</th>
                            <th>{{ __('admin.user') }}</th>
                            <th>{{ __('admin.driver') }}</th>
                            <th>{{ __('admin.report_about') }}</th>
                            <th>{{ __('admin.description') }}</th>
                            <th>{{ __('admin.reported_at') }}</th>
                            <th style="width: 200px;">{{ __('admin.status') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reports as $data)
                            <tr>
                             <td>
                                <a href="{{ route('admin.ride.view', ['id' => $data->ride->ride_id]) }}">
                                    {{ $data->ride->ride_id }}
                                </a>
                            </td>
                                <td class="mw">{{ $data->ride->arrival_city }} - {{ $data->ride->departure_city }}</td>
                                <td>{{ $data->passenger->first_name ?? 'N/A' }}</td>
                                <td>{{ $data->driver->first_name }}</td>
                                <td>{{ $data->report->type }}</td>
                                <td >{{ $data->description }}</td>
                                <td>{{ $data->created_at->diffForHumans() }}</td>
                               <td>
                                    @if($data->status == 0)
                                        <select class="form-control changeStatus" data-id="{{ $data->id }}">
                                            <option value="0" selected>{{ __('admin.unresolved') }}</option>
                                            <option value="1">{{ __('admin.resolved') }}</option>
                                            <option value="2">{{ __('admin.false_complaint') }}</option>
                                        </select>
                                    @elseif($data->status == 1)
                                        <span class="badge badge-success">{{ __('admin.resolved') }}</span>
                                    @else 
                                        <span class="badge badge-danger">{{ __('admin.false_complaint') }}</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
          </div>
          <div class="custom_pagination">
              {{ $reports->appends(request()->except('page'))->links('pagination::bootstrap-4') }}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('scripts')
<script>
  $(document).on('change', '.changeStatus', function() {
      var report_id = $(this).data('id');
      var new_status = $(this).val();
      Swal.fire({
          title: "{{ __('admin.are_you_sure') }}",
          text: "{{ __('admin.update_status') }}",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#2ea57c",
          cancelButtonColor: "#d33",
          confirmButtonText: "{{ __('admin.yes_update') }}"
      }).then((result) => {
          if (result.isConfirmed) {
              $.ajax({
                  url: "/admin/reports/changeStatus/" + report_id,
                  type: "POST",
                  data: {
                      _token: "{{ csrf_token() }}",
                      status: new_status
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
                      toastr.error('Something went wrong!');
                  }
              });
          } else {
              location.reload();
          }
      });
  });
</script>
@endsection
