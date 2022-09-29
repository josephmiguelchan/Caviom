@extends('admin.admin_master')
@section('title', 'View Orders')
@section('charity')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="p-2">
                    <h1 class="mb-0" style="color: #62896d"><strong>STAR TOKENS</strong></h1>
                    <ol class="breadcrumb m-0 p-0 mb-3">
                        <li class="breadcrumb-item">Menu</li>
                        <li class="breadcrumb-item active">All Orders</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <!-- Foreach PROCESSED orders (Optional: status_updated_at 15 days or more ago) -->
            <!-- Delete Order Modal -->
            <div id="deleteModal_1" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel"><i class="mdi mdi-alert-outline me-2"></i> Warning</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>
                                You are about to permanently delete this processed order. This action
                                <strong>CANNOT</strong> be undone. Continue?
                            </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light waves-effect w-sm" data-bs-dismiss="modal">No</button>
                            <a href="#" class="btn btn-danger waves-effect waves-light w-sm">Yes</a>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div>
        <!-- End if -->


        <div class="col-12">
            <div class="card p-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <h2><strong>Orders</strong></h2>
                            <p class="mb-2">All Caviom Orders</p>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>User</th>
                                <th>Order Date</th>
                                <th>No. of Items</th>
                                <th>Order Status</th>
                                <th>Remarks Subject</th>
                                <th>Action</th>
                            </tr>
                        </thead>


                        <tbody>
                            <tr>
                                <td>1</td>
                                <td><a href="#">Pangilinan, J.</a></td>
                                <td>2015-04-21 22:32:05</td>
                                <td>2</td>
                                <td class="text-warning">Pending</td>
                                <td>---</td>
                                <td>
                                    <a href="{{ route('admin.orders.view') }}" class="btn btn-sm btn-outline-primary waves-effect waves-light">
                                        <i class="mdi mdi-open-in-new"></i> View
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td><a href="#">Liwanag, C.</a></td>
                                <td>2015-04-21 22:32:05</td>
                                <td>1</td>
                                <td class="text-danger">Rejected</td>
                                <td>Inexact Amount</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-outline-primary waves-effect waves-light">
                                        <i class="mdi mdi-open-in-new"></i> View
                                    </a>
                                    <!-- If order is completed -->
                                    <button class="btn btn-sm btn-outline-danger waves-effect waves-light" data-bs-target="#deleteModal_1" data-bs-toggle="modal">
                                        <i class="mdi mdi-trash-can"></i> Delete
                                    </button>
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