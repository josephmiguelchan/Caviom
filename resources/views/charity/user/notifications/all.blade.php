@extends('charity.charity_master')
@section('title', 'My Notifications')
@section('charity')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="">
                    <div class="p-2 mb-4">
                        <h1 class="mb-0" style="color: #62896d"><strong>NOTIFICATIONS</strong></h1>
                        <ol class="breadcrumb m-0 p-0 mb-3">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">
                                <a href="javascript: void(0);">My Account</a>
                            </li>
                            <li class="breadcrumb-item active">All Notifications</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-md-12">
                <div class="card p-3">
                    <div class="card-body">
                        <h2 class="mb-4"><strong>My Notifications</strong></h2>

                        {{-- <table id="datatable" class="table table-borderless dt-responsive nowrap table-hover"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead class="table-bordered">
                                <tr>
                                    <th width="4%">ID</th>
                                    <th width="10%">Category</th>
                                    <th width="18%">Subject</th>
                                    <th width="48%">Message</th>
                                    <th width="13%">Date</th>
                                    <th width="7%">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr class="fw-bold">
                                    <td>1</td>
                                    <td>Star Tokens</td>
                                    <td>Successful Purchase</td>
                                    <td><span class="badge bg-danger">NEW</span> This is to confirm that your Star Token Order no. 1124123 was successful.. </td>
                                    <td>3 min ago</td>
                                    <td>
                                        <a href="{{ route('user.notifications.view') }}" class="btn btn-sm btn-outline-primary waves-effect waves-light">
                                            <i class="mdi mdi-open-in-new"></i> View
                                        </a>
                                    </td>
                                </tr>
                                <tr class="text-muted">
                                    <td>2</td>
                                    <td>Projects</td>
                                    <td>New Project Created</td>
                                    <td>A new project has been created by user John Dela Cruz named "Gawad Kalinga".. </td>
                                    <td>1 hr ago</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-primary waves-effect waves-light">
                                            <i class="mdi mdi-open-in-new"></i> View
                                        </a>
                                    </td>
                                </tr>
                                <tr class="text-muted">
                                    <td>3</td>
                                    <td>Verification Updates</td>
                                    <td>Rejected Application</td>
                                    <td>We are very sorry but your application has been denied for the violating our terms.. </td>
                                    <td>3 hrs ago</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-primary waves-effect waves-light">
                                            <i class="mdi mdi-open-in-new"></i> View
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table> --}}

                        <!-- Delete Modal -->
                        <div id="deleteModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="myModalLabel"><i class="mdi mdi-alert-outline me-2"></i> Warning</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>This will permanently delete this notification. Continue?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light waves-effect w-sm" data-bs-dismiss="modal">No</button>
                                        <button type="button" class="btn btn-danger waves-effect waves-light w-sm">Yes</button>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div>

                        <table id="datatable" class="table table-borderless dt-responsive nowrap table-hover"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead class="table-bordered">
                                <tr>
                                    <th>ID</th>
                                    <th>Category</th>
                                    <th>Message</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Star Tokens</td>
                                    <td>
                                        <a href="{{ route('user.notifications.view') }}" class="text-reset">
                                            <div class="d-flex">
                                                <div class="avatar-xs me-3">
                                                    <span class="avatar-title bg-success rounded-circle font-size-16">
                                                        <i class="ri-shopping-cart-line"></i>
                                                    </span>
                                                </div>
                                                <div class="flex-1">
                                                    <h6 class="mb-1">Successful Purchase <span class="badge bg-danger">NEW</span></h6>
                                                    <div class="font-size-12 text-muted">
                                                        <p class="mb-1">This is to confirm that your Caviom Order with ID:
                                                            84D3AD was successful. Thank you for purchasing Caviom Pro. Your subs...
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </td>
                                    <td>Sep 3, 2022 2:15 PM</td>
                                    <td>
                                        <a href="{{ route('user.notifications.view') }}" class="btn btn-sm btn-outline-primary waves-effect waves-light">
                                            <i class="mdi mdi-open-in-new"></i>
                                        </a>
                                        <button data-bs-toggle="modal" data-bs-target="#deleteModal" class="btn btn-sm btn-outline-danger waves-effect waves-light">
                                            <i class="mdi mdi-delete"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr class="table-light">
                                    <td>2</td>
                                    <td>Projects</td>
                                    <td>
                                        <a href="#" class="text-reset">
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
                                                            named "Gawad Kalinga" on Sep 3, 2022. You may view the project at...
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </td>
                                    <td>Sep 3, 2022 2:13 PM</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-primary waves-effect waves-light">
                                            <i class="mdi mdi-open-in-new"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-outline-danger waves-effect waves-light">
                                            <i class="mdi mdi-delete"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr class="table-light">
                                    <td>3</td>
                                    <td>Verification Updates</td>
                                    <td>
                                        <a href="" class="text-reset">
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
                                                            denied for the violating our terms and conditions. If you wish to appeal, ple...</p>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </td>
                                    <td>
                                        Sep 2, 2022 9:12 AM</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-outline-primary waves-effect waves-light">
                                            <i class="mdi mdi-open-in-new"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm btn-outline-danger waves-effect waves-light">
                                            <i class="mdi mdi-delete"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>

            </div><!-- end col -->
        </div>
        <!-- end row -->
    </div>
</div>
@endsection