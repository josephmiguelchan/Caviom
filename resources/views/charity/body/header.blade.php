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

            <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect"
                id="vertical-menu-btn">
                <i class="ri-menu-2-line align-middle"></i>
            </button>

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

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon waves-effect"
                    id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="ri-notification-3-line"></i>
                    <span class="noti-dot"></span>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                    aria-labelledby="page-header-notifications-dropdown">
                    <div class="p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-0"> Notifications </h6>
                            </div>
                            <div class="col-auto">
                                <a href="#!" class="small"> View All</a>
                            </div>
                        </div>
                    </div>
                    <div data-simplebar style="max-height: 230px;">
                        <a href="" class="text-reset notification-item">
                            <div class="d-flex">
                                <div class="avatar-xs me-3">
                                    <span class="avatar-title bg-success rounded-circle font-size-16">
                                        <i class="ri-shopping-cart-line"></i>
                                    </span>
                                </div>
                                <div class="flex-1">
                                    <h6 class="mb-1">Successful Purchase</h6>
                                    <div class="font-size-12 text-muted">
                                        <p class="mb-1">This is to confirm that your Star Token Order no.
                                            1124123 was successful..</p>
                                        <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 3 min ago</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="" class="text-reset notification-item">
                            <div class="d-flex">
                                <div class="avatar-xs me-3">
                                    <span class="avatar-title bg-info rounded-circle font-size-16">
                                        <i class="ri-heart-fill"></i>
                                    </span>
                                </div>
                                <div class="flex-1">
                                    <h6 class="mb-1">New Project Created</h6>
                                    <div class="font-size-12 text-muted">
                                        <p class="mb-1">A new project has been created by user John Dela Cruz
                                            named "Gawad Kalinga"..</p>
                                        <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 1 hour ago</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="" class="text-reset notification-item">
                            <div class="d-flex">
                                <div class="avatar-xs me-3">
                                    <span class="avatar-title bg-danger rounded-circle font-size-16">
                                        <i class="ri-close-circle-line"></i>
                                    </span>
                                </div>
                                <div class="flex-1">
                                    <h6 class="mb-1">Rejected Application</h6>
                                    <div class="font-size-12 text-muted">
                                        <p class="mb-1">We are very sorry but your application has been
                                            denied
                                            for the violating our terms..</p>
                                        <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 3 hours ago
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="p-2 border-top">
                        <div class="d-grid">
                            <a class="btn btn-sm btn-link font-size-14 text-center" href="javascript:void(0)">
                                <i class="mdi mdi-arrow-right-circle me-1"></i> View More..
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="dropdown d-inline-block user-dropdown">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="{{ asset('backend/assets/images/users/avatar-1.jpg') }}"
                        alt="Header Avatar">
                    <span class="d-none d-xl-inline-block ms-1">Julia</span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a class="dropdown-item" href="#"><i class="ri-user-line align-middle me-1"></i>
                        Profile</a>
                    <a class="dropdown-item d-block" href="#">
                        <i class="ri-lock-password-line align-middle me-1"></i> Change Password</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="{{ route('user.logout') }}"><i
                            class="ri-shut-down-line align-middle me-1 text-danger"></i> Logout</a>
                </div>
            </div>

        </div>
    </div>
</header>