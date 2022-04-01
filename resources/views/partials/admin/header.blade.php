<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center justify-content-between">
    {{-- Logo --}}
    <div class="d-flex align-items-center justify-content-between">
        <a href="{{ route('home') }}" class="logo d-flex align-items-center justify-content-center">
            <span class="d-none d-lg-block">{{ env('APP_NAME') }}</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>
    <!-- End Logo -->

    {{-- Search bar --}}
    <div class="search-bar">
        <form class="search-form d-flex align-items-center" method="POST" action="#">
            <input type="text" name="admin_search" placeholder="{{ __('Search') }}">
            <button type="submit" title="{{ __('Search') }}"><i class="bi bi-search"></i></button>
        </form>
    </div>
    <!-- End Search Bar -->

    {{-- Icons Navigation --}}
    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">
            {{-- Search icon --}}
            <li class="nav-item d-block d-lg-none">
                <a class="nav-link nav-icon search-bar-toggle " href="#">
                    <i class="bi bi-search"></i>
                </a>
            </li>
            <!-- End Search Icon-->

            {{-- I18n Dropdown Items --}}
            <li class="nav-item dropdown">
                {{-- i18n Image Icon --}}
                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <i class="fa-solid fa-earth-asia"></i>
                </a>
                <!-- End i18n Image Icon -->

                {{-- i18n Dropdown Items --}}
                <ul class="dropdown-menu dropdown-menu-end i18n" style="min-width: 6rem;">
                    <li>
                        <a href="{{ route('language', ['vi']) }}" class="dropdown-item d-flex align-items-center justify-content-center">
                            <span> {{ __('Vietnamese') }} </span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a href="{{ route('language', ['en']) }}" class="dropdown-item d-flex align-items-center justify-content-center">
                            <span> {{ __('English') }} </span>
                        </a>
                    </li>
                </ul>
                <!-- End i18n Dropdown Items -->
            </li>
            <!-- End I18n Dropdown Items -->
            <li class="nav-item dropdown">
                <a id="notifications" class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                    <i class="bi bi-bell"></i>
                    <span class="pending badge bg-primary badge-number">{{ auth()->user()->unreadNotifications->count() }}</span>
                </a><!-- End Notification Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                    <li class="dropdown-header">
                        {{ __('notification') }}
                        <a href="#">
                            <span class="badge rounded-pill bg-primary p-2 ms-2 text-light">{{ __('mark_at_read_all') }}</span>
                        </a>
                    </li>
                    <li>
                        <ul class="p-0 m-0" id="notification-list">
                            @foreach (Auth::user()->notifications as $notification)
                                <li class="notification-item {{ $notification->unread() ? 'unread' : '' }}">
                                    <p>{{ __('notification_mess', ['email' => $notification->data['email']]) }}</p>
                                    <p class="float-right">{{ $notification->created_at->diffForHumans() }}</p>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="dropdown-footer">
                        <a href="#">{{ __('View all') }}</a>
                    </li>
                </ul><!-- End Notification Dropdown Items -->

            </li><!-- End Notification Nav -->
            {{-- Profile Nav --}}
            <li class="nav-item dropdown pe-3">
                {{-- Profile Image Icon --}}
                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <img src="{{ auth()->user()->avatar_full_path }}" alt="Profile" class="rounded-circle">
                    <span class="d-none d-md-block dropdown-toggle pl-2"> {{ auth()->user()->full_name }} </span>
                </a>
                <!-- End Profile Image Icon -->

                {{-- Profile Dropdown Items --}}
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6> {{ auth()->user()->full_name }} </h6>
                        <span> {{ __('admin') }} </span>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <i class="bi bi-person"></i>
                            <span> {{ __('My profile') }} </span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                            <i class="bi bi-gear"></i>
                            <span> {{ __('Account settings') }} </span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button class="dropdown-item d-flex align-items-center">
                                <i class="bi bi-box-arrow-right"></i>
                                <span> {{ __('Sign out') }} </span>
                            </button>
                        </form>
                    </li>
                </ul>
                <!-- End Profile Dropdown Items -->
            </li>
            <!-- End Profile Nav -->
        </ul>
    </nav>
    <!-- End Icons Navigation -->

</header>
<!-- End Header -->
