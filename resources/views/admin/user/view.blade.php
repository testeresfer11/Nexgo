<style type="text/css">
    /* Adjust text color for Document Files section */
.documents-section h6 span.qury {
    color: #333; /* Change to your desired color */
}

.documents-section p.text-muted {
    color: #6c757d; /* Change to your desired color */
}

.documents-section .img-lg {
    border: 2px solid #ddd; /* Optional: Add border to images */
    border-radius: 8px; /* Optional: Add rounded corners */
}

/* Optional: Style for the tab buttons */
.tablinks {
    color: #007bff; /* Change to your desired color */
}

.tablinks.active {
    background-color: #007bff; /* Change to your desired color */
    color: #fff; /* Change to your desired color */
}


.bank-details {
    background-color: #f9f9f9; /* Light background for better contrast */
    border: 1px solid #e0e0e0; /* Subtle border */
    border-radius: 8px; /* Rounded corners */
    padding: 20px; /* Padding for spacing */
    margin: 20px 0; /* Margin to separate from other content */
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Light shadow for depth */
}

.detail-item {
    margin-bottom: 15px; /* Spacing between items */
}

.detail-item h6 {
    color: #333; /* Darker text for headings */
    font-weight: 600; /* Slightly bolder text */
}

.detail-item .text-muted {
    color: #666; /* Muted color for less emphasis */
    font-size: 14px; /* Consistent font size */
}


</style>
@extends('admin.layouts.app')
@section('title',  __('admin.view_user'))
@section('breadcrum')
    <div class="page-header">
        <h3 class="page-title">{{ __('admin.user_profile') }}</h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.user.list') }}">{{ __('admin.user_profile') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{__('admin.view_user')}}</li>
            </ol>
        </nav>    
    </div>
@endsection
@section('content')
    <div>
        <div class="card">
            <div class="card-body">
              <h3>{{ __('admin.personal_details') }}</h3>

                <form class="forms-sample">
    <div class="form-group">
        <div class="row align-items-center">
            <div class="col-12 col-md-3">
                <div class="view-user-details">
                    <div class="text-center">
                        <img 
                            class="user-details-icon w-100 rounded"
                            src="{{ $user->profile_picture ? url('storage/users/' . $user->profile_picture) : asset('admin/images/user-image.webp') }}"
                            alt="User profile picture">
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-8">
                <div class="row user-details-data">
                    <div class="col-12 col-md-4 mb-4">
                        <h6 class="f-14 mb-1">
                            <span class="semi-bold qury">{{ __('admin.first_name') }}:</span> 
                            <span class="text-muted">{{ $user->first_name ?? '-' }}</span>
                        </h6>
                    </div>
                    <div class="col-12 col-md-4 mb-4">
                        <h6 class="f-14 mb-1">
                            <span class="semi-bold qury">{{ __('admin.last_name') }}:</span> 
                            <span class="text-muted">{{ $user->last_name ?? '-' }}</span>
                        </h6>
                    </div>
                    <div class="col-12 col-md-4 mb-4">
                        <h6 class="f-14 mb-1">
                            <span class="semi-bold qury">{{ __('admin.email') }}:</span> 
                            <span class="text-muted">{{ $user->email ?? '-' }}</span>
                        </h6>
                    </div>
                    <div class="col-12 col-md-4 mb-4">
                        <h6 class="f-14 mb-1">
                            <span class="semi-bold qury">{{ __('admin.phone_number') }}:</span> 
                            <span class="text-muted">{{ $user->country_code }}{{ $user->phone_number ?? '-' }}</span>
                        </h6>
                    </div>
                    <div class="col-12 col-md-4 mb-4">
                        <h6 class="f-14 mb-1">
                            <span class="semi-bold qury">{{ __('admin.join_date') }}:</span> 
                            <span class="text-muted">{{ convertDate($user->join_at) }}</span>
                        </h6>
                    </div>
                    <div class="col-12 col-md-4 mb-4">
                        <h6 class="f-14 mb-1">
                            <span class="semi-bold qury">{{ __('admin.dob') }}:</span> 
                            <span class="text-muted">{{ $user->dob ?? '-' }}</span>
                        </h6>
                    </div>
                    <div class="col-12 col-md-4 mb-4">
                        <h6 class="f-14 mb-1">
                            <span class="semi-bold qury">{{ __('admin.chattiness') }}:</span> 
                            <span class="text-muted">{{ $user->chattiness ?? '-' }}</span>
                        </h6>
                    </div>
                    <div class="col-12 col-md-4 mb-4">
                        <h6 class="f-14 mb-1">
                            <span class="semi-bold qury">{{ __('admin.music') }}:</span> 
                            <span class="text-muted">{{ $user->music ?? '-' }}</span>
                        </h6>
                    </div>
                    <div class="col-12 col-md-4 mb-4">
                        <h6 class="f-14 mb-1">
                            <span class="semi-bold qury">{{ __('admin.smoking') }}:</span> 
                            <span class="text-muted">{{ $user->smoking ?? '-' }}</span>
                        </h6>
                    </div>
                    <div class="col-12 col-md-4 mb-4">
                        <h6 class="f-14 mb-1">
                            <span class="semi-bold qury">{{ __('admin.pets') }}:</span> 
                            <span class="text-muted">{{ $user->pets ?? '-' }}</span>
                        </h6>
                    </div>
                    <div class="col-12">
                        <h6 class="f-14 mb-1">
                            <span class="semi-bold qury">{{ __('admin.bio') }}:</span> 
                            <span class="text-muted">{{ $user->bio ?? '-' }}</span>
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
            </div>
        </div>
          <div class="card mt-4">
            <div class="card-body">
                <h3 class="mb-4">{{ __('admin.document_files') }} : <span class="text-muted">{{ $user->verify_id }}</span></h3>
                <div class="documents-section">
                    @if($user->id_card)
                        <h6 class="f-14 mb-1">
                            <span class="semi-bold qury">{{ __('admin.document_id') }}:</span>
                        </h6>
                        <a href="{{ str_contains($user->id_card, 'https://dummyimage.com/') ? $user->id_card : url('/storage/id_card/'.$user->id_card) }}" target="_blank">
                            <img class="img-lg" 
                                 src="{{ str_contains($user->id_card, 'https://dummyimage.com/') ? $user->id_card : url('/storage/id_card/'.$user->id_card) }}" 
                                 alt="{{ __('admin.user_id_card') }}" 
                                 width="400" height="400">
                        </a>
                    @else
                        <p class="text-muted">{{ __('admin.no_documents_added_yet') }}</p>
                    @endif
                </div>
            </div>
        </div>


        <div class="card mt-4">
                    <div class="card-body">
                        <h3 class="mb-4">{{ __('admin.bank_details') }} : <span class="text-muted"></span></h3>
                        <div class="documents-section">
                            @if($bankDetails)
                                <div class="bank-details">
                                    <div class="detail-item">
                                        <h6 class="f-14 mb-1">
                                            <span class="semi-bold qury">{{ __('admin.bsb_number') }}</span>
                                        </h6>
                                        <span class="text-muted">&nbsp;&nbsp;&nbsp;{{ $bankDetails->B5B_number ?? '-' }}</span>
                                    </div>

                                    <div class="detail-item">
                                        <h6 class="f-14 mb-1">
                                            <span class="semi-bold qury">{{ __('admin.account_number') }}</span>
                                        </h6>
                                        <span class="text-muted">&nbsp;&nbsp;&nbsp;{{ $bankDetails->account_number ?? '-' }}</span>
                                    </div>

                                    <div class="detail-item">
                                        <h6 class="f-14 mb-1">
                                            <span class="semi-bold qury">{{ __('admin.full_name') }}</span>
                                        </h6>
                                        <span class="text-muted">&nbsp;&nbsp;&nbsp;{{ $bankDetails->full_name ?? '-' }}</span>
                                    </div>

                                    <div class="detail-item">
                                        <h6 class="f-14 mb-1">
                                            <span class="semi-bold qury">{{ __('admin.paypal_id') }}</span>
                                        </h6>
                                        <span class="text-muted">&nbsp;&nbsp;&nbsp;{{ $bankDetails->paypal_id ?? '-' }}</span>
                                    </div>
                                </div>
                            @else
                                <p class="text-muted">{{ __('admin.no_bank_details_added') }}</p>
                            @endif
                        </div>
                    </div>
                </div>



                <div class="card mt-4">
                    <div class="card-body">
                        <h3 class="mb-4">{{ __('admin.rides_information') }}</h3>
                            <div class="carpool-tabs">
                                <div class="tab border-0 bg-transparent">
                                    <button class="tablinks" onclick="openTab(event, 'Cars')">{{ __('admin.cars') }}</button>
                                    <button class="tablinks" onclick="openTab(event, 'Rides')">{{ __('admin.rides') }}</button>
                                    <button class="tablinks" onclick="openTab(event, 'Bookings')">{{ __('admin.bookings') }}</button>
                                    <button class="tablinks" onclick="openTab(event, 'Reviews')">{{ __('admin.reviews') }}</button>
                                </div>
                            </div>

                            <div id="Cars" class="tabcontent border-0">
                                <h3>{{ __('admin.cars') }}</h3>
                                <div class="table-responsive">
                                    <table class="table table-striped" id="filterData">
                                        <thead>
                                            <tr>
                                                <th>{{ __('admin.make') }}</th>
                                                <th>{{ __('admin.model') }}</th>
                                                <th>{{ __('admin.year') }}</th>
                                                <th>{{ __('admin.license_plate') }}</th>
                                                <th>{{ __('admin.color') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($cars as $key => $car)
                                                <tr>
                                                    <td>{{ $car->make }}</td>
                                                    <td>{{ $car->model }}</td>
                                                    <td>{{ $car->year }}</td>
                                                    <td>{{ $car->license_plate }}</td>
                                                    <td>{{ $car->color }}</td>
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

                                    @if(count($cars) > 5)
                                        <form action="{{ route('admin.cars.search') }}" method="GET">
                                            <input type="hidden" value="{{ $user->user_id }}" name="search" placeholder="{{ __('admin.search') }}">
                                            <div class="text-end">
                                                <button type="submit" class="btn gradient-btn btn-md mt-4">
                                                    {{ __('admin.view_more') }}
                                                </button>
                                            </div>
                                        </form>
                                    @endif
                                </div>
                            </div>

                            <div id="Rides" class="tabcontent border-0">
                                        <h3>{{ __('ride.rides') }}</h3>
                                        <div class="table-responsive">
                                            <table class="table table-striped" id="filterData">
                                                <thead>
                                                    <tr>
                                                        <th>{{ __('ride.profile') }}</th>
                                                        <th>{{ __('ride.driver_name') }}</th>
                                                        <th>{{ __('ride.origin') }}</th>
                                                        <th>{{ __('ride.destination') }}</th>
                                                        <th>{{ __('ride.departure_time') }}</th>
                                                        <th>{{ __('ride.arrival_time') }}</th>
                                                        <th>{{ __('ride.total_seats') }}</th>
                                                        <th>{{ __('ride.seats_available') }}</th>
                                                        <th>{{ __('ride.actions') }}</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($rides as $key => $ride)
                                                        <tr>
                                                            <td>{{ $key + 1 }}</td>
                                                            <td>{{ $ride->first_name }}</td>
                                                            <td>{{ $ride->departure_city }}</td>
                                                            <td>{{ $ride->arrival_city }}</td>
                                                            <td>{{ $ride->departure_time }}</td>
                                                            <td>{{ $ride->arrival_time }}</td>
                                                            <td>{{ $ride->available_seats }}</td>
                                                            <td>{{ $ride->seat_booked == 4 ? __('ride.full') : $ride->seat_booked }}</td>
                                                            <td>
                                                                <span class="menu-icon">
                                                                    <a href="{{ route('admin.ride.view', ['id' => $ride->ride_id]) }}" title="{{ __('ride.view') }}" class="text-primary">
                                                                        <i class="mdi mdi-eye"></i>
                                                                    </a>
                                                                </span>
                                                                &nbsp;&nbsp;&nbsp;
                                                                <span class="menu-icon">
                                                                    <a href="{{ route('admin.ride.edit', ['id' => $ride->ride_id]) }}" title="{{ __('ride.edit') }}" class="text-success">
                                                                        <i class="mdi mdi-pencil"></i>
                                                                    </a>
                                                                </span>
                                                                &nbsp;&nbsp;
                                                                <span class="menu-icon">
                                                                    <a href="#" title="{{ __('ride.delete') }}" class="text-danger deleteUser" data-id="{{ $ride->ride_id }}">
                                                                        <i class="mdi mdi-delete"></i>
                                                                    </a>
                                                                </span>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td colspan="9" class="no-record"><center>{{ __('ride.no_record') }}</center></td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>

                                            @if(count($rides) > 5)
                                                <form action="{{ route('admin.ride.search') }}" method="GET">
                                                    <input type="hidden" value="{{ $user->user_id }}" name="search">
                                                    <div class="text-end">
                                                        <button type="submit" class="btn gradient-btn btn-md mt-4">{{ __('ride.view_more') }}</button>
                                                    </div>
                                                </form>
                                            @endif
                                        </div>
                                    </div>

                            <div id="Bookings" class="tabcontent border-0">
                                <h3>{{ __('booking.heading') }}</h3>
                                <div class="table-responsive">
                                    <table class="table table-striped" id="filterData">
                                        <thead>
                                            <tr>
                                                <th>{{ __('booking.sr_no') }}</th>
                                                <th>{{ __('booking.passenger_name') }}</th>
                                                <th>{{ __('booking.ride_id') }}</th>
                                                <th>{{ __('booking.origin') }}</th>
                                                <th>{{ __('booking.destination') }}</th>
                                                <th>{{ __('booking.requested_seats') }}</th>
                                                <th>{{ __('booking.status') }}</th>
                                                <th>{{ __('booking.request_date') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($requests as $key => $request)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $request->first_name }}</td>
                                                <td>{{ $request->ride_id }}</td>
                                                <td>{{ $request->departure_location }}</td>
                                                <td>{{ $request->arrival_location }}</td>
                                                <td>{{ $request->seat_count }}</td>
                                                <td>{{ $request->status }}</td>
                                                <td>{{ convertDate($request->booking_date) }}</td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="8" class="no-record">
                                                    <center>{{ __('booking.no_record') }}</center>
                                                </td>
                                            </tr>
                                            @endforelse
                                        </tbody>
                                    </table>

                                    @if(count($requests) > 5)
                                    <form action="{{ route('admin.requests.search') }}" method="GET">
                                        <input type="hidden" name="search" value="{{ $user->user_id }}">
                                        <div class="text-end">
                                            <button type="submit" class="btn gradient-btn btn-md mt-4">
                                                {{ __('booking.view_more') }}
                                            </button>
                                        </div>
                                    </form>
                                    @endif
                                </div>
                            </div>

                            
                            <div id="Reviews" class="tabcontent border-0">
                                <h3>{{ __('review.Reviews') }}</h3>
                                <div class="table-responsive">
                                    <table class="table table-striped" id="filterData">
                                        <thead>
                                            <tr>
                                                <th>{{ __('review.Sr No.') }}</th>
                                                <th>{{ __('review.Reviewer Name') }}</th>
                                                <th>{{ __('review.Rating') }}</th>
                                                <th>{{ __('review.Comment') }}</th>
                                                <th>{{ __('review.Review Date') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($reviews as $key => $review)
                                                <tr>
                                                    <td>{{ $key+1 }}</td>
                                                    <td>{{ $review->reviewer_first_name }} {{ $review->reviewer_last_name }}</td>
                                                    <td>{{ $review->rating }}</td>
                                                    <td>{{ $review->comment }}</td>
                                                    <td>{{ convertDate($review->review_date) }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="6" class="no-record"><center>{{ __('review.No record found') }}</center></td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                    @if(count($reviews) > 5)
                                    <form action="{{ route('admin.review.search') }}" method="GET">
                                        <input type="hidden" value="{{ $user->user_id }}" name="search" placeholder="Search...">
                                        <div class="text-end">
                                            <button type="submit" class="btn gradient-btn btn-md mt-4">{{ __('review.View more') }}</button>
                                        </div>
                                    </form>
                                    @endif
                                </div>
                            </div>

                           
                    </div>
                </div>
          
<script>
    function openTab(evt, tabName) {
        // Declare all variables
        var i, tabcontent, tablinks;

        // Get all elements with class="tabcontent" and hide them
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }

        // Get all elements with class="tablinks" and remove the class "active"
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }

        // Show the current tab, and add an "active" class to the button that opened the tab
        document.getElementById(tabName).style.display = "block";
        evt.currentTarget.className += " active";
    }

    // Get the element with id="defaultOpen" and click on it
    document.getElementsByClassName("tablinks")[0].click();
</script>
      
@endsection
