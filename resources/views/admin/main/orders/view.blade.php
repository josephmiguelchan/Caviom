@extends('admin.admin_master')
@section('title', 'View Order')
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
                        <li class="breadcrumb-item"><a href="{{route('admin.orders.all')}}">All Orders</a></li>
                        <li class="breadcrumb-item active">View</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- end page title -->

        @if ($order->status == 'Pending')
            <!-- Reject Modal -->
            <div id="rejectModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel"><i class="mdi mdi-alert-outline me-2"></i> Warning</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('admin.orders.reject',$order->code)}}" method="POST">
                                @csrf

                                <h4 class="fw-bold">Remarks for Rejection</h4>
                                <div class="m-3">
                                    @foreach ($stRemarks as $key => $item)
                                    <!-- Foreach ($notifiers (in Star Token Order category) as $item) -->
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="remarks_subject"
                                            id="remarks_subject_{{$key+1}}" value="{{$item->subject}}" checked>
                                        <label class="form-check-label" for="remarks_subject_{{$key+1}}">
                                            <!-- $notifier->subject -->
                                            {{$item->subject}}
                                        </label>
                                        <p>
                                            {{$item->message}}
                                        </p>
                                    </div>
                                    <!-- End iF -->
                                    @endforeach
                                </div>

                                <p class="m-1">
                                    You are about to <strong>REJECT</strong> this Order with the following remarks above. This action <strong>CANNOT</strong> be undone and
                                    will notify all other users in their Charitable Organization. Continue?
                                </p>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light waves-effect w-sm" data-bs-dismiss="modal">No</button>
                                    <button type="submit" class="btn btn-danger waves-effect waves-light w-sm">Yes</button>
                                </div>
                            </form>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div>

            <!-- Approve Modal -->
            <div id="approveModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel"><i class="mdi mdi-alert-outline me-2"></i> Warning</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>
                                You are about to <strong>CONFIRM</strong> this order and release the amount of Star Tokens and/or Subscriptions.
                                This action <strong>CANNOT</strong> be undone.
                            </p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light waves-effect w-sm" data-bs-dismiss="modal">No</button>
                            <a href={{route('admin.orders.approved',$order->code)}} class="btn btn-dark waves-effect waves-light w-sm">Yes</a>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div>
        @endif



        <div class="col-12">
            <div class="card p-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-8">
                            <h2><strong>Order ID: {{ Str::upper(Str::limit($order->code,6, '')) }}</strong></h2>
                        </div>
                        <div class="col-lg-4 mt-4">
                            <a href="{{ route('admin.orders.all') }}" class="text-link float-end">
                                <i class="ri-arrow-left-line"></i> Go Back
                            </a>
                        </div>

                    </div>
                    <hr>
                    <div class="row mt-5 px-2">
                        <div class="col-lg-6">
                            <div class="row">
                                <dt class="col-md-4"><h4 class="font-size-15"><strong>Charitable Organization:</strong></h4></dt>
                                <dt class="col-md-8">
                                    <a target="_blank" href="{{route('admin.charities.view', $order->charity->code)}}">
                                        {{$order->charity->name}}
                                    </a>
                                </dt>
                                <dt class="col-md-4"><h4 class="font-size-15"><strong>Order Date:</strong></h4></dt>
                                <dt class="col-md-8">{{Carbon\Carbon::parse($order->created_at)->isoFormat('LL (h:mm A)')}}</dt>
                                <dt class="col-md-4"><h4 class="font-size-15"><strong>No. of Items:</strong></h4></dt>
                                <dt class="col-md-8">{{$order->order_items->count()}}</dt>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <dt class="col-md-4"><h4 class="font-size-15"><strong>Payment Method:</strong></h4></dt>
                                <dt class="col-md-8">{{$order->mode_of_payment}}</dt>
                                <dt class="col-md-4"><h4 class="font-size-15"><strong>Date of Payment:</strong></h4></dt>
                                <dt class="col-md-8">{{Carbon\Carbon::parse($order->paid_at)->isoFormat('LL (h:mm A)')}}</dt>
                                <dt class="col-md-4"><h4 class="font-size-15"><strong>Submitted by:</strong></h4></dt>
                                <dt class="col-md-8"><a target="_blank" href="{{route('admin.charities.users.view', $order->user->code)}}">
                                    {{$order->user->username}}
                                </a></dt>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-lg-8">
                            <div class="row">
                                <dl class="col-md-12">
                                    <div class="p-2">
                                        <h3 class="font-size-16"><strong>Order summary</strong></h3>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <td><strong>Item</strong></td>
                                                <td class="text-center"><strong>Price</strong></td>
                                                <td class="text-center"><strong>Quantity</strong>
                                                </td>
                                                <td class="text-end"><strong>Totals</strong></td>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <!-- foreach ($order->lineItems as $line) or some such thing here -->
                                            @foreach ($orderitems as $orderitem)
                                            <tr>
                                                <td>{{$orderitem->name}}</td>
                                                <td class="text-center">₱{{number_format($orderitem->price,2)}}</td>
                                                <td class="text-center">{{$orderitem->quantity}}</td>
                                                <td class="text-end">₱{{number_format($orderitem->subtotal,2)}}</td>
                                            </tr>
                                            @endforeach
                                             <tr>
                                                <td class="no-line"></td>
                                                <td class="no-line"></td>
                                                <td class="no-line text-center">
                                                    <strong>Payment Amount</strong></td>
                                                <td class="no-line text-end"><h4 class="m-0">₱{{number_format($total_price,2)}}</h4></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </dl>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="text-center">
                                <a class="image-popup-no-margins" title="Gcash Receipt of Eveline" href="{{url('upload/orders/'. $order->proof_of_payment)}}">
                                    <img class="img-fluid rounded" alt="Donation Proof" src="{{url('upload/orders/'. $order->proof_of_payment)}}" style="max-height: 60vh">
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-lg-8">
                            <!-- Show these buttons only IF this Order's Status == 'PENDING' -->
                            @if ($order->status == 'Pending')
                            <div class="text-center">
                                <div class="row">

                                    <div class="row my-3 mx-2">
                                        <div class="col-md-12">
                                            <div class="btn-group" role="group" aria-label="Actions">
                                                <button type="button" data-bs-toggle="modal" data-bs-target="#rejectModal" class="btn w-lg btn-outline-danger waves-effect waves-light">
                                                    <i class="mdi mdi-close-thick"></i> Reject
                                                </button>

                                                <button type="button" class="btn w-lg btn-success waves-effect waves-light mx-1" data-bs-target="#approveModal" data-bs-toggle="modal">
                                                    <i class="mdi mdi-check"></i> Confirm
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            @endif
                            <!-- End IF -->
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-0 text-center">
                                <h5><strong>Reference No:</strong></h5>
                                <u>{{$order->reference_no}}</u>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row mt-5 px-3">
                        <div class="col-lg-8">
                            <dl class="row col-md-12">
                                <dt class="col-md-2"><h4 class="font-size-15"><strong>Remarks:</strong></h4></dt>
                                <dt class="col-md-10">{{($order->remarks_subject)?$order->remarks_subject:'---' }}</dt>
                                <dd class="col-md-10 offset-md-2">{{ ($order->remarks_message)?$order->remarks_message:'' }}</dt>
                            </dl>
                        </div>
                        <div class="col-lg-4">
                            <div class="row">
                                <dt class="col-md-4"><h4 class="font-size-15"><strong>Order Status:</strong></h4></dt>
                                @if ($order->status == 'Pending')
                                <dt class="col-md-8 text-warning">PENDING</dt>
                                @elseif($order->status == 'Confirmed')
                                <dt class="col-md-8 text-success">Confirmed</dt>
                                @elseif($order->status == 'Rejected')
                                <dt class="col-md-8 text-danger">Rejected</dt>
                                @endif
                                <dt class="col-md-4"><h4 class="font-size-15"><strong>Status Updated at:</strong></h4></dt>
                                <dt class="col-md-8">{{Carbon\Carbon::parse($order->status_updated_at)->diffForHumans()}}</dt>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div> <!-- end col -->

    </div>

</div>

@endsection