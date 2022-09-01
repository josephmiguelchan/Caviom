@extends('charity.charity_master')
@section('title', 'View Order')
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
                        <li class="breadcrumb-item">View All Orders</li>
                        <li class="breadcrumb-item active">Order</li>
                    </ol>

                    @include('charity.modals.star-tokens')
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="col-12">
            <div class="card p-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-8">
                            <h2><strong>Order ID: 84D3AD</strong></h2>
                        </div>
                        <div class="col-lg-4 mt-4">
                            <a href="{{ route('star.tokens.history') }}" class="text-link float-end">
                                <i class="ri-arrow-left-line"></i> Go Back
                            </a>
                        </div>

                    </div>
                    <hr>
                    <div class="row mt-5 px-2">
                        <div class="col-lg-6">
                            <div class="row">
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
                            <dl class="row col-md-12">
                            </dl>
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
                                <dt class="col-md-8 text-success">COMPLETED</dt>
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