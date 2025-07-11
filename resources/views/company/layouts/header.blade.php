<nav class="navbar p-0 fixed-top d-flex flex-row">
    <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
      <a class="navbar-brand brand-logo-mini" href="index.html"><img src="{{asset('admin/images/logo-mini.svg')}}" alt="logo" /></a>
    </div>
    <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
      <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
        <span class="mdi mdi-menu"></span>
      </button>
      <ul class="navbar-nav navbar-nav-right">
        <li class="nav-item dropdown border-left">
            <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
              <i class="mdi mdi-email"></i>
              <span class="count bg-success"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
              <h6 class="p-3 mb-0">Messages</h6>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <img src="{{asset('admin/images/faces/face4.jpg')}}" alt="image" class="rounded-circle profile-pic">
                </div>
                <div class="preview-item-content">
                  <p class="preview-subject ellipsis mb-1">Mark send you a message</p>
                  <p class="text-muted mb-0"> 1 Minutes ago </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <img src="{{asset('admin/images/faces/face2.jpg')}}" alt="image" class="rounded-circle profile-pic">
                </div>
                <div class="preview-item-content">
                  <p class="preview-subject ellipsis mb-1">Cregh send you a message</p>
                  <p class="text-muted mb-0"> 15 Minutes ago </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <img src="{{asset('admin/images/faces/face3.jpg')}}" alt="image" class="rounded-circle profile-pic">
                </div>
                <div class="preview-item-content">
                  <p class="preview-subject ellipsis mb-1">Profile picture updated</p>
                  <p class="text-muted mb-0"> 18 Minutes ago </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <p class="p-3 mb-0 text-center">4 new messages</p>
            </div>
        </li> 
        @php
            $notification_count = auth()->user()->unreadNotifications()->whereNull('read_at')->count();
        @endphp
        <li class="nav-item dropdown border-left">
            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown" onclick="{{readNotification(authId())}}">
                <i class="mdi mdi-bell"></i>
                @if ($notification_count)
                <span class="count bg-danger"></span>
              @endif
            </a>
            @if($notification_count)
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                  <h6 class="p-3 mb-0">Notifications</h6>
                  <div class="dropdown-divider"></div>
                  @foreach (auth()->user()->unreadNotifications()->whereNull('read_at')->take(5)->get() as $notification)
                    @if(($notification->data)['type'] == 'user_added')
                      <a class="dropdown-item preview-item" href="{{route('admin.user.list')}}">
                        <div class="preview-thumbnail">
                            <div class="preview-icon rounded-circle">
                              <i class="mdi mdi-contacts text-success"></i>
                            </div>
                        </div>
                        <div class="preview-item-content">
                            <p class="preview-subject mb-1">{{($notification->data)['title']}}</p>
                            <p class="text-muted ellipsis mb-0"> {{($notification->data)['description']}} </p>
                        </div>
                      </a>
                    @endif
                  @endforeach
                  @if(auth()->user()->unreadNotifications->whereNull('read_at')->count() > 5)
                        <div class="dropdown-divider"></div>
                        <p class="p-3 mb-0 text-center">See all notifications</p>
                  @endif
              </div>
            @endif
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link" id="profileDropdown" href="#" data-toggle="dropdown">
            <div class="navbar-profile">

             <img class="img-xs rounded-circle"
                        @if (isset($user->userDetail) && !is_null($user->userDetail->profile)) 
                            src="{{ asset('storage/images/' . $user->userDetail->profile) }}"
                        @else
                            src="{{ asset('admin/images/faces/face15.jpg') }}" 
                        @endif
                        onerror="this.src = '{{ asset('admin/images/faces/face15.jpg') }}'"
                        alt="User profile picture">        
              
              <p class="mb-0 d-none d-sm-block navbar-profile-name">{{UserNameById(authId(  ))}}</p>
              <i class="mdi mdi-menu-down d-none d-sm-block"></i>
            </div>
          </a>
          <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="profileDropdown">
            <h6 class="p-3 mb-0">Profile</h6>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item preview-item" href="{{route('company.profile')}}">
                <div class="preview-thumbnail">
                  <div class="preview-icon rounded-circle">
                    <i class="mdi mdi-account text-success"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <p class="preview-subject mb-1">Settings</p>
                </div>
            </a>
            <a class="dropdown-item preview-item" href="{{route('company.helpDesk.list',['type' => 'open'])}}">
                <div class="preview-thumbnail">
                  <div class="preview-icon rounded-circle">
                    <i class="mdi mdi-desktop-mac text-success"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <p class="preview-subject mb-1">Helpdesk</p>
                </div>
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item preview-item" href="{{route('company.logout')}}">
              <div class="preview-thumbnail">
                <div class="preview-icon rounded-circle">
                  <i class="mdi mdi-logout text-danger"></i>
                </div>
              </div>
              <div class="preview-item-content">
                <p class="preview-subject mb-1">Log out</p>
              </div>
            </a>
          </div>
        </li>
      </ul>
      <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
        <span class="mdi mdi-format-line-spacing"></span>
      </button>
    </div>
  </nav>
  <!-- partial -->