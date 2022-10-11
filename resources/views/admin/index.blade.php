@extends('admin.admin_master')
@section('title', 'Dashboard')
@section('charity')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="">
                    <div class="p-2">
                        <h1 class="mb-0" style="color: #62896d"><strong>Welcome, System Admin</strong></h1>
                        <ol class="breadcrumb m-0 p-0 mb-3">
                            <li class="breadcrumb-item active">
                                Caviom Admin Panel
                            </li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">

            <div class="col-xl-4 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-truncate font-size-14 mb-2"><strong>Charitable Organizations</strong>
                                </p>
                                <h4 class="mb-2 text-success">1,347</h4>
                                <p class="text-muted mb-0">
                                    Registered Charitable Organizations
                                </p>
                            </div>
                            <div class="avatar-sm">
                                <span class="avatar-title bg-light text-success rounded-3">
                                    <i class="ri-bank-line font-size-24" style="color: #92713e;"></i>
                                </span>
                            </div>
                        </div>
                        <a href="{{route('admin.charities.all')}}" class="mt-3 btn btn-primary w-100 waves-effect waves-light">Go to Charitable Organizations</a>
                    </div><!-- end cardbody -->
                </div><!-- end card -->
            </div><!-- end col -->

            <div class="col-xl-4 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-truncate font-size-14 mb-2"><strong>Star Token Orders</strong>
                                </p>
                                <h4 class="mb-2 text-success">12</h4>
                                <p class="text-muted mb-0">
                                    No. of Pending Orders
                                </p>
                            </div>
                            <div class="avatar-sm">
                                <span class="avatar-title bg-light text-success rounded-3">
                                    <i class="ri-shopping-cart-2-line font-size-24" style="color: #92713e;"></i>
                                </span>
                            </div>
                        </div>
                        <a href="{{route('admin.orders.all')}}" class="mt-3 btn btn-primary w-100 waves-effect waves-light">View Star Token Orders</a>
                    </div><!-- end cardbody -->
                </div><!-- end card -->
            </div><!-- end col -->
            <!-- end col -->

            <div class="col-xl-4 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-truncate font-size-14 mb-2"><strong>Featured Projects</strong>
                                </p>
                                <h4 class="mb-2 text-success">35</h4>
                                <p class="text-muted mb-0">
                                    Featured Project Requests
                                </p>
                            </div>
                            <div class="avatar-sm">
                                <span class="avatar-title bg-light text-success rounded-3">
                                    <i class="ri-heart-add-line font-size-24" style="color: #92713e;"></i>
                                </span>
                            </div>
                        </div>
                        <a href="{{route('admin.feat-projects.all')}}" class="mt-3 btn btn-primary w-100 waves-effect waves-light">Go to Featured Projects</a>
                    </div><!-- end cardbody -->
                </div><!-- end card -->
            </div><!-- end col -->
            <!-- end col -->
        </div>

        <div class="row">
            <div class="col-xl-4 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-truncate font-size-14 mb-2"><strong>Admin User Accounts</strong></p>
                                <h4 class="mb-2 text-success">12</h4>
                                <p class="text-muted mb-0">
                                    Total Active Administrators
                                </p>
                            </div>
                            <div class="avatar-sm">
                                <span class="avatar-title bg-light text-success rounded-3">
                                    <i class="ri-admin-line font-size-24" style="color: #92713e;"></i>
                                </span>
                            </div>
                        </div>
                        <a href="{{ route('admin.users') }}" class="mt-3 btn btn-primary w-100 waves-effect waves-light">View Admin Accounts</a>
                    </div><!-- end cardbody -->
                </div><!-- end card -->
            </div><!-- end col -->
            <div class="col-xl-4 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-truncate font-size-14 mb-2"><strong>Audit Logs</strong></p>
                                <h4 class="mb-2 text-success">30,239</h4>
                                <p class="text-muted mb-0">
                                    Caviom's Audit Logs Count
                                </p>
                            </div>
                            <div class="avatar-sm">
                                <span class="avatar-title bg-light text-success rounded-3">
                                    <i class="ri-file-search-line font-size-24" style="color: #92713e;"></i>
                                </span>
                            </div>
                        </div>
                        <a href="{{ route('admin.audit-logs') }}" class="mt-3 btn btn-primary w-100 waves-effect waves-light">Go to Audit Logs</a>
                    </div><!-- end cardbody -->
                </div><!-- end card -->
            </div><!-- end col -->
            <div class="col-xl-4 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-truncate font-size-14 mb-2"><strong>Notifiers</strong></p>
                                <h4 class="mb-2 text-success">53</h4>
                                <p class="text-muted mb-0">
                                    No. of Notifications and Remarks
                                </p>
                            </div>
                            <div class="avatar-sm">
                                <span class="avatar-title bg-light text-success rounded-3">
                                    <i class="ri-notification-2-line font-size-24" style="color: #92713e;"></i>
                                </span>
                            </div>
                        </div>
                        <a href="{{route('admin.notifiers')}}" class="mt-3 btn btn-primary w-100 waves-effect waves-light">View Notifiers</a>
                    </div><!-- end cardbody -->
                </div><!-- end card -->
            </div><!-- end col -->
        </div>
        <!-- end row -->

    </div>

</div>

@endsection