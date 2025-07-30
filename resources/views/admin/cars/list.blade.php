@extends('admin.layouts.app')
@section('title', __('admin.cars'))
@section('breadcrum')
<div class="page-header">
    <h3 class="page-title">{{ __('admin.cars') }}</h3>
    <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{ __('admin.cars') }}</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ __('admin.cars') }}</li>
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
              <h4 class="card-title">{{ __('admin.cars_management') }}</h4>

              <div class="custom-search">
                <form action="{{ route('admin.cars.search') }}" method="GET" id="searchForm">
                    <div class="d-flex align-items-center search-gap">
                        <input type="text" name="search" value="{{ request()->search }}" placeholder="{{ __('admin.search') }}...">
                        <button type="submit" class="btn default-btn btn-md">{{ __('admin.search') }}</button>
                        <button type="button" class="btn secondary-btn btn-md" id="resetBtn">{{ __('admin.reset') }}</button>
                    </div>
                </form>
              </div>
            </div>
          </div>

        <script>
            document.getElementById('resetBtn').addEventListener('click', function() {
                document.getElementById('searchForm').reset();
                window.location.href = "{{ route('admin.cars.list') }}";
            });
        </script>

          <div class="table-responsive mt-0">
            <table class="table table-striped" id="filterData">
              <thead>
                <tr>
                  <th>{{ __('admin.user_name') }}</th>
                  <th>{{ __('admin.make') }}</th>
                  <th>{{ __('admin.model') }}</th>
                  <th>{{ __('admin.type') }}</th>
                  <th>{{ __('admin.color') }}</th>
                  <th>{{ __('admin.license_plate') }}</th>
                  <th>{{ __('admin.year') }}</th>
                  <th>{{ __('admin.action') }}</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($cars as $keys => $car)
                  <tr id={{ $keys+1 }}>
                    <td>
                      <a href="{{ route('admin.user.view', ['id' => $car->user_id]) }}">
                        {{ $car->first_name }} {{ $car->last_name }}
                      </a>
                    </td>
                    <td>{{ $car->make }}</td>
                    <td>{{ $car->model }}</td>
                    <td>{{ $car->type }}</td>
                    <td>{{ $car->color }}</td>
                    <td>{{ $car->license_plate }}</td>
                    <td>{{ $car->year }}</td>
                    <td>
                      <span class="menu-icon">
                        <a href="{{ route('admin.cars.edit', ['id' => $car->car_id]) }}" title="{{ __('admin.edit') }}" class="text-success">
                          <i class="mdi mdi-pencil"></i>
                        </a>
                      </span>
                      <span class="menu-icon mx-2">
                        <a href="#" title="{{ __('admin.delete') }}" class="text-danger deleteCar" data-id="{{ $car->car_id }}">
                          <i class="mdi mdi-delete"></i>
                        </a>
                      </span>
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
             {{ $cars->links('pagination::bootstrap-4') }}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
<script>
  $('.deleteCar').on('click', function() {
    var user_id = $(this).attr('data-id');
    Swal.fire({
        title: "{{ __('admin.are_you_sure') }}",
        text: "{{ __('admin.confirm_delete_vehicle_text', [], 'admin') ?? 'You want to delete the Vehicle?' }}",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#2ea57c",
        cancelButtonColor: "#d33",
        confirmButtonText: "{{ __('admin.yes_delete') }}"
      }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "/admin/cars/delete/" + user_id,
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
</script>
@stop
