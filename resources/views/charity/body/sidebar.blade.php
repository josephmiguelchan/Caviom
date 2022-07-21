@php
    $avatar = 'upload/avatar_img/'.Auth::user()->profile_image;
    $defaultAvatar = 'upload/avatar_img/no_avatar.png';
@endphp

<div class="vertical-menu" style="background-color: #f7f3ea;">

    <div data-simplebar class="h-100">

        <!-- User details -->
        <div class="user-profile text-center mt-3">
            <div class="">
                <img src="{{ (!empty(Auth::user()->profile_image))? url($avatar):url($defaultAvatar) }}"
                    alt="Profile Picture" class="avatar-lg rounded-circle">
            </div>
            <div class="mt-3">
                <!-- <h4 class="font-size-16 mb-1">Julia Hudda</h4> -->
            </div>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    <a href="{{ route('dashboard') }}" class="waves-effect">
                        <i class="ri-dashboard-line"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="{{ (Request::routeIs('leads*') or Request::routeIs('prospects*'))?'mm-active':''  }}">
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-hand-coin-line"></i>
                        <span>Donors and Donations</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('leads.all') }}" class="{{ Request::routeIs('leads*')?'active':'' }}">Leads</a></li>
                        <li><a href="{{ route('prospects.all') }}" class="{{ Request::routeIs('prospects*')?'active':'' }}">Prospects</a></li>
                    </ul>
                </li>

                <li class="{{ Request::routeIs('charity*')?'mm-active':''  }}">
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-bank-line"></i>
                        <span>Our Charitable Org</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a class="{{ Request::routeIs('charity.profile*')?'active':'' }}" href="{{ route('charity.profile') }}">Public Profile</a>
                        </li>
                        <li><a href="email-read.html">Projects</a></li>
                        <li><a href="email-read.html">Users</a></li>
                        <li><a href="email-read.html">Beneficiaries</a></li>
                        <li><a href="email-read.html">Benefactors</a></li>
                        <li><a href="email-read.html">Volunteers</a></li>
                    </ul>
                </li>

                <li>
                    <a href="index.html" class="waves-effect">
                        <i class="ri-gift-line"></i>
                        <span>Gift Giving</span>
                    </a>
                </li>

                <li>
                    <a href="index.html" class="waves-effect">
                        <i class="ri-list-settings-line"></i>
                        <span>Audit Logs</span>
                    </a>
                </li>

                <li class="menu-title">Balance</li>

                <li>
                    <a href="index.html" class="waves-effect">
                        <i class="ri-coin-line"></i>
                        <span>4,500 Star Tokens</span>
                    </a>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>