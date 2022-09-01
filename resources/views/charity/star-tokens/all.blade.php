@extends('charity.charity_master')
@section('title', 'View Orders History')
@section('charity')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="p-2">
                    <h1 class="mb-0" style="color: #62896d"><strong>STAR TOKENS</strong></h1>
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('star.tokens.balance') }}">Star Tokens</a>
                        </li>
                        <li class="breadcrumb-item active">View All Orders</li>
                    </ol>

                    @include('charity.modals.star-tokens')
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="col-12">
            <div class="card p-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <h2><strong>Transactions History</strong></h2>
                            <p class="mb-2">All Star Token Orders</p>
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
                                <th>Remarks</th>
                                <th>Action</th>
                            </tr>
                        </thead>


                        <tbody>
                            <tr>
                                <td>1</td>
                                <td><a href="{{ route('charity.users.view') }}">Liwanag, C.</a></td>
                                <td>March 16, 2022</td>
                                <td>2</td>
                                <td class="text-danger">Failed</td>
                                <td>Total amount is incorrect from the specifie...</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-outline-primary waves-effect waves-light">
                                        <i class="mdi mdi-open-in-new"></i> View
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td><a href="{{ route('charity.users.view') }}">Pangilinan, J.</a></td>
                                <td>March 18, 2022</td>
                                <td>2</td>
                                <td class="text-success">Completed</td>
                                <td></td>
                                <td>
                                    <a href="{{ route('star.tokens.view') }}" class="btn btn-sm btn-outline-primary waves-effect waves-light">
                                        <i class="mdi mdi-open-in-new"></i> View
                                    </a>
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