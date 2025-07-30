<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
        <a class="sidebar-brand brand-logo" href="{{ route('admin.dashboard') }}">
            <img src="{{ asset('images/new-logo.png') }}" alt="logo" />
        </a>
        <a class="sidebar-brand brand-logo-mini" href="{{ route('admin.dashboard') }}">
            <img src="{{ asset('images/new-logo.png') }}" alt="logo" />
        </a>
    </div>

    <ul class="nav">
        <br>

        <!-- Dashboard -->
        <li class="nav-item menu-items {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">
                <span class="menu-icon"><i class="mdi mdi-view-dashboard"></i></span>
                <span class="menu-title">{{ __('admin.dashboard') }}</span>
            </a>
        </li>

        <!-- Profile -->
        <li class="nav-item menu-items {{ request()->routeIs('admin.profile', 'admin.changePassword') ? 'active' : '' }}">
            <a class="nav-link {{ request()->routeIs('admin.profile', 'admin.changePassword') ? '' : 'collapsed' }}"
               data-toggle="collapse" href="#ui-basic" aria-expanded="{{ request()->routeIs('admin.profile', 'admin.changePassword') ? 'true' : 'false' }}">
                <span class="menu-icon"><i class="mdi mdi-laptop"></i></span>
                <span class="menu-title">{{ __('admin.profile') }}</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{ request()->routeIs('admin.profile', 'admin.changePassword') ? 'show' : '' }}" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.profile') ? 'active' : '' }}" href="{{ route('admin.profile') }}">{{ __('admin.settings') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.changePassword') ? 'active' : '' }}" href="{{ route('admin.changePassword') }}">{{ __('admin.change_password') }}</a>
                    </li>
                </ul>
            </div>
        </li>

        <!-- User Management -->
        <li class="nav-item menu-items {{ request()->routeIs('admin.user.*') ? 'active' : '' }}">
            <a class="nav-link main-menu" href="javascript:void(0);">
                <span class="menu-icon"><i class="mdi mdi-account"></i></span>
                <span class="menu-title">{{ __('admin.user_management') }}</span>
            </a>
            <div class="submenu" style="display: none;">
                <ul class="nav flex-column sub-menu">
                    <li class="{{ request()->routeIs('admin.user.list') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.user.list') }}">{{ __('admin.user_list') }}</a>
                    </li>
                    <li class="{{ request()->routeIs('admin.user.deleted') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.user.deleted') }}">{{ __('admin.deleted_users') }}</a>
                    </li>
                </ul>
            </div>
        </li>

        <!-- Document Management -->
        <li class="nav-item menu-items {{ request()->routeIs('admin.document.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.document.list') }}">
                <span class="menu-icon"><i class="mdi mdi-file-document-edit"></i></span>
                <span class="menu-title">{{ __('admin.document_management') }}</span>
            </a>
        </li>

        <!-- Vehicle Management -->
        <li class="nav-item menu-items {{ request()->routeIs('admin.vehicle.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.vehicle.list') }}">
                <span class="menu-icon"><i class="mdi mdi-car"></i></span>
                <span class="menu-title">{{ __('admin.vehicle_management') }}</span>
            </a>
        </li>

        <!-- Ride Management -->
        <li class="nav-item menu-items {{ request()->routeIs('admin.ride.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.ride.list') }}">
                <span class="menu-icon"><i class="mdi mdi-motorbike"></i></span>
                <span class="menu-title">{{ __('admin.ride_management') }}</span>
            </a>
        </li>

        <!-- Cars -->
        <li class="nav-item menu-items {{ request()->routeIs('admin.cars.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.cars.list') }}">
                <span class="menu-icon"><i class="mdi mdi-car"></i></span>
                <span class="menu-title">{{ __('admin.cars_management') }}</span>
            </a>
        </li>

        <!-- Payments -->
        <li class="nav-item menu-items {{ request()->routeIs('admin.payments.*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.payments.list') }}">
                <span class="menu-icon"><i class="mdi mdi-cash"></i></span>
                <span class="menu-title">{{ __('admin.payment_management') }}</span>
            </a>
        </li>

        <!-- Reports -->
        <li class="nav-item menu-items {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
            <a class="nav-link" data-toggle="collapse" href="#auth1" aria-expanded="{{ request()->routeIs('admin.reports.*') ? 'true' : 'false' }}">
                <span class="menu-icon"><i class="mdi mdi-finance"></i></span>
                <span class="menu-title">{{ __('admin.reports') }}</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{ request()->routeIs('admin.reports.*') ? 'show' : '' }}" id="auth1">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.reports.users') ? 'active' : '' }}" href="{{ route('admin.reports.users') }}">{{ __('admin.user_complaints') }}</a>
                    </li>
                </ul>
            </div>
        </li>

        <!-- Payout -->
        <li class="nav-item menu-items {{ request()->routeIs('admin.payout.*') ? 'active' : '' }}">
            <a class="nav-link" data-toggle="collapse" href="#auth5" aria-expanded="{{ request()->routeIs('admin.payout.*') ? 'true' : 'false' }}">
                <span class="menu-icon"><i class="mdi mdi-cash"></i></span>
                <span class="menu-title">{{ __('admin.payout') }}</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{ request()->routeIs('admin.payout.*') ? 'show' : '' }}" id="auth5">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.payout.pending') ? 'active' : '' }}" href="{{ route('admin.payout.pending') }}">{{ __('admin.pending_payouts') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.payout.completed') ? 'active' : '' }}" href="{{ route('admin.payout.completed') }}">{{ __('admin.completed_payouts') }}</a>
                    </li>
                </ul>
            </div>
        </li>

        <!-- Settings -->
        <li class="nav-item menu-items {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
            <a class="nav-link" data-toggle="collapse" href="#auth2" aria-expanded="{{ request()->routeIs('admin.settings.*') ? 'true' : 'false' }}">
                <span class="menu-icon"><i class="mdi mdi-settings"></i></span>
                <span class="menu-title">{{ __('admin.settings') }}</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse {{ request()->routeIs('admin.settings.*') ? 'show' : '' }}" id="auth2">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.settings.general') ? 'active' : '' }}" href="{{ route('admin.settings.general') }}">{{ __('admin.general_settings') }}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.settings.smtp') ? 'active' : '' }}" href="{{ route('admin.settings.smtp') }}">{{ __('admin.smtp_settings') }}</a>
                    </li>
                </ul>
            </div>
        </li>

        <!-- Logout -->
        <li class="nav-item menu-items">
            <a class="nav-link" href="{{ route('logout') }}">
                <span class="menu-icon"><i class="mdi mdi-logout"></i></span>
                <span class="menu-title">{{ __('admin.logout') }}</span>
            </a>
        </li>
    </ul>
</nav>

<!-- jQuery submenu toggle -->
<script>
    $(document).ready(function () {
        $('.main-menu').click(function () {
            $(this).next('.submenu').slideToggle();
        });
    });
</script>
