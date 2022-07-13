<div class="vertical-menu" style="background-color: #f7f3ea;">

    <div data-simplebar class="h-100">

        <!-- User details -->
        <div class="user-profile text-center mt-3">
            <div class="">
                <img src="{{ asset('backend/assets/images/users/avatar-1.jpg') }}" alt="" class="avatar-md rounded-circle">
            </div>
            <div class="mt-3">
                <h4 class="font-size-16 mb-1">Julia Hudda</h4>
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

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-hand-coin-line"></i>
                        <span>Donors and Donations</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="email-inbox.html">Leads</a></li>
                        <li><a href="email-read.html">Prospects</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-bank-line"></i>
                        <span>Our Charitable Org</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="email-inbox.html">Public Profile</a></li>
                        <li><a href="email-read.html">Projects</a></li>
                        <li><a href="email-read.html">Users</a></li>
                        <li><a href="email-read.html">Beneficiaries</a></li>
                        <li><a href="email-read.html">Benefactors</a></li>
                        <li><a href="email-read.html">Volunteers</a></li>
                    </ul>
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