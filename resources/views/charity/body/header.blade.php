@php
    if (Auth::user()) {
        $avatar = 'upload/avatar_img/'.Auth::user()->profile_image;
        $defaultAvatar = 'upload/avatar_img/no_avatar.png';
    }
@endphp

<header id="page-topbar" style="background-color: #62896d;">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="{{ url('/') }}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset('backend/assets/images/Caviom.png') }}" alt="logo-sm" height="52">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('backend/assets/images/Caviom.png') }}" alt="logo-dark" height="50">
                    </span>
                </a>

                <a href="{{ url('/') }}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ asset('backend/assets/images/Caviom Logo.png') }}" alt="logo-sm-light" height="20">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('backend/assets/images/Caviom.png') }}" alt="logo-light" height="50">
                    </span>
                </a>
            </div>

        </div>

        <div class="d-flex">

            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item noti-icon waves-effect" value="#">
                    Home
                </button>
            </div>

            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item noti-icon waves-effect" value="#">
                    About
                </button>
            </div>

            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item noti-icon waves-effect" value="#">
                    Blog
                </button>
            </div>

            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item noti-icon waves-effect" value="#">
                    Contact
                </button>
            </div>

            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item noti-icon waves-effect" value="#">
                    Charitable Organizations
                </button>
            </div>


            @if (Auth::user() and Auth::user()->role != 'Root Admin')
            <div class="dropdown d-inline-block">

                <button type="button" class="btn header-item noti-icon waves-effect"
                    id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="ri-notification-3-line"></i>

                    @foreach(Auth::user()->notifications as $item)
                        @if ($item->read_status=='unread')
                        <span class="noti-dot"></span>
                        @endif
                    @endforeach


                </button>

                 <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                    aria-labelledby="page-header-notifications-dropdown">
                    <div class="p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-0"> Notifications </h6>
                            </div>
                            <div class="col-auto">
                                <a href="{{ route('notifications.all') }}" class="small"> View All</a>
                            </div>
                        </div>
                    </div>
                    @include('charity.body.notifications')
                    <div class="p-2 border-top">
                        <div class="d-grid">
                            <a class="btn btn-sm btn-link font-size-14 text-center" href="{{ route('notifications.all') }}">
                                <i class="mdi mdi-arrow-right-circle me-1"></i> View all..
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="dropdown d-inline-block user-dropdown">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="{{ (!empty(Auth::user()->profile_image))? url($avatar):url($defaultAvatar) }}"
                        alt="Profile Picture">
                    {{-- <span class="d-none d-xl-inline-block ms-1">Julia</span> --}}
                    <span class="d-none d-xl-inline-block ms-1">Hi {{ Auth::user()->info->first_name }}</span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a class="dropdown-item" href="{{ route('user.profile') }}">
                        <i class="ri-user-line align-middle me-1"></i> Profile
                    </a>
                    <a class="dropdown-item d-block" href="{{ route('user.password.change') }}">
                        <i class="ri-lock-unlock-line align-middle me-1"></i> Change Password</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="{{ route('user.logout') }}"><i
                            class="ri-logout-box-line align-middle me-1 text-danger"></i> Logout</a>
                </div>
            </div>

            @elseif (Auth::user() and Auth::user()->role == 'Root Admin')

            <div class="dropdown d-inline-block user-dropdown">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="{{ (!empty(Auth::user()->profile_image))? url($avatar):url($defaultAvatar) }}"
                        alt="Profile Picture">
                    {{-- <span class="d-none d-xl-inline-block ms-1">Julia</span> --}}
                    <span class="d-none d-xl-inline-block ms-1">Hi {{ Auth::user()->info->first_name }}</span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a class="dropdown-item" href="{{ route('admin.profile') }}">
                        <i class="ri-user-line align-middle me-1"></i> Profile
                    </a>
                    <a class="dropdown-item d-block" href="{{ route('admin.password.change') }}">
                        <i class="ri-lock-unlock-line align-middle me-1"></i> Change Password</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="{{ route('admin.logout') }}"><i
                        class="ri-logout-box-line align-middle me-1 text-danger"></i> Logout</a>
                </div>
            </div>

            @else

            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button onclick="location.href='{{ route('login') }}'" type="button" class="btn header-item noti-icon waves-effect">
                    Login
                </button>
            </div>
            @endif
        </div>
    </div>
</header>