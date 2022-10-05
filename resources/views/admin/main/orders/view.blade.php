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
                        <li class="breadcrumb-item"><a href="{{route('admin.orders')}}">All Orders</a></li>
                        <li class="breadcrumb-item active">View</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <!-- IF this Order's Status == 'PENDING' -->
            <!-- Reject Modal -->
            <div id="rejectModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel"><i class="mdi mdi-alert-outline me-2"></i> Warning</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="#" method="POST">
                                @csrf

                                <h4 class="fw-bold">Remarks for Rejection</h4>
                                <div class="m-3">
                                    <!-- Foreach ($notifiers (in featured project category) as $item) -->
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="remarks_subject"
                                            id="remarks_subject_1" value="Misleading Pictures" checked>
                                        <label class="form-check-label" for="remarks_subject_1">
                                            <!-- $notifier->subject -->
                                            Invalid Reference No.
                                        </label>
                                        <p>
                                            <!-- $notifier->message -->
                                            The reference no. you provided is invalid/cannot be found on our end.
                                            Please try again or email us at support@caviom.org
                                        </p>
                                    </div>
                                    <!-- End iF -->

                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="remarks_subject"
                                            id="remarks_subject_2" value="Inexact Amount">
                                        <label class="form-check-label" for="remarks_subject_2">Inexact Amount</label>
                                        <p>
                                            Based on your provided receipt, you have sent less than the instructed amount.
                                            Please send only the exact amount provided by the system, and try again. Kindly
                                            expect your refund with 3-5 business days back to your e-wallet/bank account.
                                        </p>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="remarks_subject"
                                            id="remarks_subject_3" value="Invalid Receipt">
                                        <label class="form-check-label" for="remarks_subject_3">Invalid Receipt</label>
                                        <p>
                                            It seems that you have submitted an invalid (or illegitimate) receipt/proof of payment. Please try again
                                            or email us at support@caviom.org
                                        </p>
                                    </div>

                                </div>

                                <p class="m-1">
                                    You are about to <strong>REJECT</strong> this Order with the following remarks above. This action <strong>CANNOT</strong> be undone and
                                    will notify all other users in their Charitable Organization. Continue?
                                </p>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light waves-effect w-sm" data-bs-dismiss="modal">No</button>
                            <a href="#" class="btn btn-danger waves-effect waves-light w-sm">Yes</a>
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
                            <a href="#" class="btn btn-dark waves-effect waves-light w-sm">Yes</a>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div>
        <!-- end IF -->


        <div class="col-12">
            <div class="card p-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-8">
                            <h2><strong>Order ID: 84D3AD</strong></h2>
                        </div>
                        <div class="col-lg-4 mt-4">
                            <a href="{{ route('admin.orders') }}" class="text-link float-end">
                                <i class="ri-arrow-left-line"></i> Go Back
                            </a>
                        </div>

                    </div>
                    <hr>
                    <div class="row mt-5 px-2">
                        <div class="col-lg-6">
                            <div class="row">
                                <dt class="col-md-4"><h4 class="font-size-15"><strong>Charitable Organization:</strong></h4></dt>
                                <dt class="col-md-8">Aloutte Foundation</dt>
                                <dt class="col-md-4"><h4 class="font-size-15"><strong>Order Date:</strong></h4></dt>
                                <dt class="col-md-8">Mar 18, 2022</dt>
                                <dt class="col-md-4"><h4 class="font-size-15"><strong>No. of Items:</strong></h4></dt>
                                <dt class="col-md-8">2</dt>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <dt class="col-md-4"><h4 class="font-size-15"><strong>Payment Method:</strong></h4></dt>
                                <dt class="col-md-8">GCASH</dt>
                                <dt class="col-md-4"><h4 class="font-size-15"><strong>Date of Payment:</strong></h4></dt>
                                <dt class="col-md-8">Thu, Mar 18, 2022 2:15 PM</dt>
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
                                            <tr>
                                                <td>3000 STAR TOKENS</td>
                                                <td class="text-center">₱ 109.00</td>
                                                <td class="text-center">1</td>
                                                <td class="text-end">₱ 109.00</td>
                                            </tr>
                                            <tr>
                                                <td>CAVIOM PRO</td>
                                                <td class="text-center">₱ 249.00</td>
                                                <td class="text-center">1</td>
                                                <td class="text-end">₱ 249.00</td>
                                            </tr>
                                            <tr>
                                                <td class="thick-line"></td>
                                                <td class="thick-line"></td>
                                                <td class="thick-line text-center">
                                                    <strong>Total</strong></td>
                                                <td class="thick-line text-end">₱ 358.00</td>
                                            </tr>
                                            <tr>
                                                <td class="no-line"></td>
                                                <td class="no-line"></td>
                                                <td class="no-line text-center">
                                                    <strong>Payment Amount</strong></td>
                                                <td class="no-line text-end"><h4 class="m-0">₱358.00</h4></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </dl>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="text-center">
                                <a class="image-popup-no-margins" title="Gcash Receipt of Eveline" href="{{ asset('upload/gcash-sample-receipt.png') }}">
                                    <img class="img-fluid rounded" alt="Donation Proof" src="{{ asset('upload/gcash-sample-receipt.png') }}" style="max-height: 60vh">
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-lg-8">
                            <!-- Show these buttons only IF this Order's Status == 'PENDING' -->
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
                            <!-- End IF -->
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-0 text-center">
                                <h5><strong>Reference No:</strong></h5>
                                <u>1234 5678 9</u>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row mt-5 px-3">
                        <div class="col-lg-8">
                            <dl class="row col-md-12">
                                <dt class="col-md-4"><h4 class="font-size-15"><strong>Remarks:</strong></h4></dt>
                                <dt class="col-md-8">---</dt>
                            </dl>
                        </div>
                        <div class="col-lg-4">
                            <div class="row">
                                <dt class="col-md-4"><h4 class="font-size-15"><strong>Order Status:</strong></h4></dt>
                                <dt class="col-md-8 text-warning">PENDING</dt>
                                <dt class="col-md-4"><h4 class="font-size-15"><strong>Status Updated at:</strong></h4></dt>
                                <dt class="col-md-8">2 days ago</dt>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div> <!-- end col -->


    </div>

</div>

@endsection