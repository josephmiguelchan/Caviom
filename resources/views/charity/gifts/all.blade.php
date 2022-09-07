@extends('charity.charity_master')
@section('title', 'Users')
@section('charity')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="p-2">
                    <h1 class="mb-0" style="color: #62896d"><strong>GIFT GIVING</strong></h1>
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item active">All Gift Givings</li>
                    </ol>

                    @include('charity.modals.gift-giving')
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="col-12">
            <div class="card p-3">
                <div class="card-body">
                    {{-- <div class="mt-4">
                        <div class="row justify-content-end">
                            <div class="col-md-2">
                                <div class="btn-group" role="group" aria-label="Actions">
                                    @if(Auth::user()->role == "Charity Admin")
                                        <a type="button" href="{{ route('gifts.add') }}" class="btn btn-sm w-lg btn-success waves-effect waves-light mx-1">
                                            <i class="mdi mdi-plus"></i> Add New <strong>300 <i class="mdi mdi-star-circle-outline"></i></strong>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <h2><strong>Gift Givings</strong></h2>
                        <p>List of All Gift Giving / Ticketing Events</p>
                    </div> --}}

                    <div class="row px-2">
                        <div class="col-lg-11">
                            <h2><strong>Gift Givings</strong></h2>
                            <p>List of All Gift Giving / Ticketing Events</p>
                        </div>
                        @if(Auth::user()->role == "Charity Admin")
                            <div class="col-lg-1 mt-4">
                                <div class="row justify-content-end">
                                    <a type="button" href="{{ route('gifts.add') }}" class="btn btn-sm w-lg btn-success waves-effect waves-light mx-1">
                                        <i class="mdi mdi-plus"></i> Add New
                                    </a>
                                </div>
                                <small class="text-center"><em>(300 Star Tokens)</em></small>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Gift Giving Project Name</th>
                                <th>Project Date</th>
                                <th>Amount per Pack</th>
                                <th>No. of Packs</th>
                                <th>Total Budget</th>
                                <th>Actions</th>
                            </tr>
                        </thead>


                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Changing the World One Child at a Time</td>
                                <td>July 26, 2022</td>
                                <td>Php 500</td>
                                <td>300</td>
                                <td>Php 150,000</td>
                                <td>
                                    <a data-bs-toggle="modal" data-bs-target="#download_modal" class="btn btn-sm btn-outline-dark waves-effect waves-light"
                                        title="Generate Tickets">
                                        <i class="mdi mdi-ticket-confirmation-outline"></i> Download..
                                    </a>
                                    <a href="{{ route('gifts.view') }}" class="btn btn-sm btn-outline-primary waves-effect waves-light">
                                        <i class="mdi mdi-open-in-new"></i> View
                                    </a>
                                </td>

                                <!-- Download Modal -->
                                <div id="download_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="myModalLabel"><i class="mdi mdi-alert-outline me-2"></i> Warning</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>
                                                    You are about to attempt to generate tickets for the selected Gift Giving [ <strong>Changing the World One Child at a Time</strong> ].
                                                    This action will increment the batch no. and will notify every users in your Charitable Organization. Continue?
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light waves-effect w-sm" data-bs-dismiss="modal">No</button>
                                                <button type="button" class="btn btn-dark waves-effect waves-light w-sm">Yes</button>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div> <!-- end col -->


    </div>

</div>

@endsection