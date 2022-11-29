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
                            @foreach ($orders as $key => $item)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td><a href="">{{$item->User->username}}</a></td>
                                    <td>{{ Carbon\Carbon::parse($item->created_at)->toDayDateTimeString() }}</td>
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
                                        <a href="{{ route('star.tokens.view', $item->code) }}" class="btn btn-sm btn-outline-primary waves-effect waves-light">
                                            <i class="mdi mdi-open-in-new"></i> View
                                        </a>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>

                    <p class="fst-italic small">
                        Caviom only shows up to 1 year of order history.
                    </p>
                </div>
            </div>
        </div> <!-- end col -->


    </div>

</div>

@endsection
