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
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title">{{ __('admin.deleted_users') }}</h4>
                        <a href="{{ route('admin.user.add') }}">
                            <button type="button" class="btn default-btn btn-md">
                                <span class="menu-icon">+ {{ __('admin.add_user') }}</span>
                            </button>
                        </a>
                    </div>
                    <div class="custom-search mt-3">
                        <form action="{{ route('admin.user.deleted') }}" method="GET">
                            <div class="d-flex align-items-center justify-content-end search-gap">
                                <input type="text" name="search" placeholder="{{ __('admin.search') }}..." class="w-25">
                                <button type="submit" class="btn default-btn btn-md">{{ __('admin.search') }}</button>
                                <button type="button" class="btn secondary-btn btn-md" id="resetBtn">{{ __('admin.reset') }}</button>
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
                                <th>{{ __('admin.action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
                                <tr id="{{ $user->user_id }}">
                                    <td class="py-1">
                                        <img class="img-lg rounded-circle"
                                            @if($user->profile_picture != "")
                                                src="{{ url('/') }}/storage/users/{{ $user->profile_picture }}"
                                            @else
                                                src="{{ asset('/admin/images/user-image.webp') }}"
                                            @endif
                                            alt="{{ __('admin.user_profile_picture') }}">
                                    </td>
                                    <td class="vehicle-modal" style="width: 300px">
                                        {{ $user->first_name ?? '-' }} {{ $user->last_name }}
                                    </td>
                                    <td class="vehicle-modal" style="width: 300px">
                                        {{ $user->email }}
                                    </td>
                                    <td>
                                        <span class="menu-icon">
                                            <a href="#" title="{{ __('admin.restore') }}" class="text-success restoreUser" data-id="{{ $user->user_id }}">
                                                <i class="mdi mdi-restore"></i>
                                            </a>
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
                    {{ $users->links('pagination::bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).on('click', '.restoreUser', function(e) {
    e.preventDefault();
    const userId = $(this).data('id');
   


    Swal.fire({
        title: '{{ __("admin.are_you_sure") }}',
        text: '{{ __("admin.confirm_restore_text") }}',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: "#2ea57c",
        cancelButtonColor: "#d33",
        confirmButtonText: '{{ __("admin.yes_restore") }}',
        cancelButtonText: '{{ __("admin.cancel") }}'
    }).then((result) => {
        if (result.isConfirmed) {
            const csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url:"{{ route('admin.user.restore', ['id' => '__id__']) }}".replace('__id__', userId),
                type: 'POST',
                data: {
                    _token: csrfToken
                },
                success: function(response) {
                    if (response.success) {
                        toastr.success('{{ __("admin.restore_success") }}');
                        setTimeout(() => location.reload(), 2000);
                    } else {
                        toastr.error('{{ __("admin.restore_failed") }}');
                    }
                },
                error: function() {
                    toastr.error('{{ __("admin.restore_error") }}');
                }
            });
        }
    });
});
</script>

<script>
document.getElementById('resetBtn').addEventListener('click', function() {
    window.location.href = "{{ route('admin.user.deleted') }}";
});
</script>
@stop
