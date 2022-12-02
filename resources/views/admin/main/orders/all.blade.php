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
                            @foreach ($orders as $key =>$item)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td><a href="">{{$item->User->username}}</a></td>
                                <td>{{$item->created_at}}</td>
                                <td>{{$item->order_items->count()}}</td>

                                @if ($item->status == 'Pending')
                                <td class="text-warning">Pending</td>
                                @elseif($item->status == 'Confirmed')
                                <td class="text-success">Confirmed</td>
                                @elseif($item->status == 'Rejected')
                                <td class="text-danger">Rejected</td>
                                @endif
                                <td>{{$item->remarks_subject ?? '---'}}</td>
                                <td>
                                    <a href="{{ route('admin.orders.view',$item->code) }}" class="btn btn-sm btn-outline-primary waves-effect waves-light">
                                        <i class="mdi mdi-open-in-new"></i> View
                                    </a>

                                    {{-- @if ($item->status != 'Pending') --}}

                                    {{-- <a class="btn btn-sm btn-outline-danger waves-effect waves-light" data-bs-target="#deleteModal_{{$key+1}}" data-bs-toggle="modal">
                                        <i class="mdi mdi-trash-can"></i> Delete
                                    </a> --}}
                                </td>

                                {{-- <!-- Delete Order Modal -->
                                <div id="deleteModal_{{$key+1}}" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
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
                                                <a href="{{ route('admin.orders.delete',$item->code) }} " class="btn btn-danger waves-effect waves-light w-sm">Yes</a>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div> --}}

                            {{-- @endif --}}
                            </tr>

                            @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
        </div> <!-- end col -->


    </div>

</div>

@endsection