@extends('charity.charity_master')
@section('title', 'Users')
@section('charity')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="p-2">
                    <h1 class="mb-0" style="color: #62896d"><strong>USERS</strong></h1>
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item">Our Charitable Organization</li>
                        <li class="breadcrumb-item active">Users</li>
                    </ol>

                    @include('charity.modals.users')
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="col-12">
            <div class="card p-3">
                <div class="card-body">
                    <div class="float-end">
                        <div class="dropdown mx-0 mt-2">
                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exportModal">
                                    <i class="mdi mdi-download"></i> Export to Excel</button>
                            </div>
                        </div>
                    </div>
                    <!-- Export to Excel Modal -->
                    <div id="exportModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="myModalLabel"><i class="mdi mdi-alert-outline me-2"></i> Warning</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>You are about to attempt to backup all your users. This action
                                        will notify all other users in your Charitable Organization. Continue?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light waves-effect w-sm" data-bs-dismiss="modal">No</button>
                                    <button type="button" class="btn btn-danger waves-effect waves-light w-sm">Yes</button>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div>
                        <h2><strong>Users</strong></h2>
                        <p>List of All Caviom Users in your Charitable Organization</p>
                        @if(Auth::user()->role == "Charity Admin")
                            <a href="{{ route('charity.users.add') }}" class="btn btn-sm w-md btn-outline-dark waves-effect waves-light">
                                <i class="ri-user-add-line"></i> Register New Account
                            </a>
                        @endif
                </div>

                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Organizational ID</th>
                                <th>Last Name</th>
                                <th>First Name</th>
                                <th>Username</th>
                                <th>Email Address</th>
                                <th>Role</th>
                                <th>Account Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>


                        <tbody>
                            <tr>
                                <td>1</td>
                                <td><span class="badge bg-light">2022090831</span></td>
                                <td>Liwanag</td>
                                <td>Christopher</td>
                                <td>@chris_liwanag24</td>
                                <td>
                                    <a href="mailto: liwanag.chris@gmail.com">liwanag.chris@gmail.com</a>
                                </td>
                                <td>Charity Admin</td>
                                <td><i class="ri-checkbox-blank-circle-fill font-size-10 text-success align-middle me-2"></i>Active</td>
                                <td>
                                    <a href="{{ route('charity.users.view') }}" class="btn btn-sm btn-outline-primary waves-effect waves-light">
                                        <i class="mdi mdi-open-in-new"></i> View
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td><span class="badge bg-light">2022052132</span></td>
                                <td>Zamora</td>
                                <td>Luigi</td>
                                <td>@zluigi_23</td>
                                <td>
                                    <a href="mailto: zluigi23@gmail.com">zluigi23@gmail.com</a>
                                </td>
                                <td>Charity Associate</td>
                                <td><i class="ri-checkbox-blank-circle-fill font-size-10 text-warning align-middle me-2"></i>Pending</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-outline-primary waves-effect waves-light">
                                        <i class="mdi mdi-open-in-new"></i> View
                                    </a>
                                    @if(Auth::user()->role == "Charity Admin")
                                        <a href="#" class="btn btn-sm btn-outline-danger waves-effect waves-light">
                                            <i class="mdi mdi-trash-can-outline"></i> Edit Email / Delete Account
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div> <!-- end col -->


    </div>

</div>

@endsection