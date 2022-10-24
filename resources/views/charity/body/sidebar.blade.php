@php
    $avatar = 'upload/charitable_org/profile_photo/'.Auth::user()->charity->profile_photo;
    $defaultAvatar = 'upload/charitable_org/profile_photo/no_avatar.png';
@endphp

<div class="vertical-menu" style="background-color: #f7f3ea;">

    <div data-simplebar class="h-100">

        <!-- User details -->
        <div class="user-profile text-center mt-3">
            <div>
                <img src="{{ Auth::user()->charity->profile_photo? url($avatar):url($defaultAvatar) }}"
                    alt="Profile Picture" class="rounded-circle me-2" width="100" data-holder-rendered="true">
            </div>
            <div class="mt-3">
                <h4 class="font-size-16 mb-1">{{ Auth::user()->charity->name }}</h4>
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
                            @if(Auth::user()->role == "Charity Admin")
                                <a class="{{ Request::routeIs('charity.profile*')?'active':'' }}" href="{{ route('charity.profile') }}">Public Profile</a>
                            @endif
                        </li>
                        <li><a class="{{ Request::routeIs('charity.projects*')?'active':'' }}" href="{{ route('charity.projects.all') }}">Projects</a></li>
                        <li><a class="{{ Request::routeIs('charity.users*')?'active':'' }}" href="{{ route('charity.users') }}">Users</a></li>
                        <li><a class="{{ Request::routeIs('charity.beneficiaries*')?'active':'' }}" href="{{ route('charity.beneficiaries.all') }}">Beneficiaries</a></li>
                        <li><a class="{{ Request::routeIs('charity.benefactors*')?'active':'' }}" href="{{ route('charity.benefactors.all') }}">Benefactors</a></li>
                        <li><a class="{{ Request::routeIs('charity.volunteers*')?'active':'' }}" href="{{ route('charity.volunteers.all') }}">Volunteers</a></li>
                    </ul>
                </li>

                <li class="{{ Request::routeIs('gifts*')?'mm-active':'' }}">
                    <a href="{{ route('gifts.all') }}" class="waves-effect">
                        <i class="ri-gift-line"></i>
                        <span>Gift Giving</span>
                    </a>
                </li>

                @if(Auth::user()->role == "Charity Admin")
                    <li class="{{ Request::routeIs('audits*')?'mm-active':'' }}">
                        <a href="{{ route('audits.all') }}" class="waves-effect">
                            <i class="ri-file-search-line"></i>
                            <span>Audit Logs</span>
                        </a>
                    </li>

                    <li class="menu-title">Balance</li>

                    <li class="text-center {{ Request::routeIs('star.tokens*')?'mm-active':'' }}">
                        <a href="{{ route('star.tokens.balance') }}">
                            <i class="ri-coin-line"></i>
                            <span>{{ Auth::user()->charity->star_tokens }} Star Tokens</span>
                        </a>
                    </li>
                @endif

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>

