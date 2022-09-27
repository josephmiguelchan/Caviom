@php
    $avatar = 'upload/avatar_img/'.Auth::user()->profile_image;
    $defaultAvatar = 'upload/avatar_img/no_avatar.png';
@endphp

<div class="vertical-menu" style="background-color: #3c4661;">

    <div data-simplebar class="h-100">

        <!-- User details -->
        <div class="user-profile text-center mt-4">
            <div>
                <img src="{{ (!empty(Auth::user()->charity->profile_photo))? url($avatar):url($defaultAvatar) }}"
                    alt="Profile Picture" class="rounded-circle me-2" width="100" data-holder-rendered="true">
            </div>
            <div class="mt-3">
                <h4 class="font-size-16 mb-1">ID No. {{ Auth::user()->info->organizational_id_no }}</h4>
                <span class="badge bg-secondary">{{ Auth::user()->role }}</span>
            </div>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">

                <li class="menu-title">Home</li>

                <li>
                    <a href="{{ route('admin.panel') }}" class="waves-effect">
                        <i class="ri-home-4-line"></i>
                        <span>Admin Panel</span>
                    </a>
                </li>

                <li class="menu-title">Menu</li>

                <li>
                    <a href="#" class="waves-effect">
                        <i class="ri-bank-line"></i>
                        <span>Charitable Organizations</span>
                    </a>
                </li>

                <li>
                    <a href="#" class="waves-effect">
                        <i class="ri-shopping-cart-2-line"></i>
                        <span>Star Token Orders</span>
                    </a>
                </li>

                <li>
                    <a href="#" class="waves-effect">
                        <i class="ri-heart-add-line"></i>
                        <span>Featured Projects</span>
                    </a>
                </li>

                <li>
                    <a href="#" class="waves-effect">
                        <i class="ri-admin-line"></i>
                        <span>Admin User Accounts</span>
                    </a>
                </li>

                <li class="{{ Request::routeIs('admin.audit-logs*')?'mm-active':'' }}">
                    <a href="{{ route('admin.audit-logs') }}" class="waves-effect">
                        <i class="ri-file-search-line"></i>
                        <span>Audit Logs</span>
                    </a>
                </li>

                <li class="{{ Request::routeIs('admin.notifiers*')?'mm-active':'' }}">
                    <a href="{{ Route('admin.notifiers') }}" class="waves-effect">
                        <i class="ri-notification-2-line"></i>
                        <span>Notifiers</span>
                    </a>
                </li>


            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>