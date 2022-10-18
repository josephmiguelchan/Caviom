@extends('charity.charity_master')
@section('title', 'View Lead')
@section('charity')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="p-2">
                    <h1 class="mb-0" style="color: #62896d"><strong>LEADS</strong></h1>
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item">Donors and Donations</li>
                        <li class="breadcrumb-item"><a href="{{ route('leads.all') }}">Leads</a></li>
                        <li class="breadcrumb-item active">View</li>
                    </ol>

                    @include('charity.modals.leads')
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="col-12">
            <div class="card">
                <div class="card-body p-5">
                    <div class="row">
                        <div class="col-lg-8">
                            <h2><strong>{{$lead->last_name.', '.$lead->first_name.' '.$lead->middle_name}}</strong></h2>
                        </div>
                        <div class="col-lg-4 mt-4">
                            <a href="{{route('leads.all')}}" class="text-link float-end">
                                <i class="ri-arrow-left-line"></i> Go Back
                            </a>
                        </div>
                    </div>

                    <hr>

                    <div class="row mt-5">
                        <div class="col-lg-8">
                            <div class="row">
                                <dl class="row col-md-12">
                                    <dt class="col-md-4 py-2"><h4 class="font-size-15"><strong>Amount Donated:</strong></h4></dt>
                                    <dt class="col-md-8 py-2">₱ {{number_format($lead->amount,2)}}</dt>
                                    <dt class="col-md-4 py-2"><h4 class="font-size-15"><strong>Mode of Donation:</strong></h4></dt>
                                    <dt class="col-md-8 py-2">{{$lead->mode_of_donation}}</dt>
                                    <dt class="col-md-4 py-2"><h4 class="font-size-15"><strong>Message:</strong></h4></dt>
                                    <dt class="col-md-8 py-2">
                                        <em>
                                           {{$lead->message}}
                                        </em>
                                    </dt>
                                    <dt class="col-md-4 py-2"><h4 class="font-size-15"><strong>Date of Payment:</strong></h4></dt>
                                    <dt class="col-md-8 py-2">{{Carbon\Carbon::parse($lead->paid_at)->isoFormat('LL (h:mm A)')}}</dt>
                                    <dt class="col-md-4 py-2"><h4 class="font-size-15"><strong>Email Address:</strong></h4></dt>
                                    <dt class="col-md-8 py-2">{{$lead->email_address}}</dt>
                                </dl>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="text-center">
                                <h4 class="font-size-15"><strong>Proof of Payment</strong></h4>
                                @isset($lead->proof_of_payment_photo)
                                <a class="image-popup-no-margins" title="{{$lead->mode_of_donation}} Receipt - {{$lead->first_name}}" href="{{ url('upload/charitable_org/donates/'.$lead->proof_of_payment_photo) }}">
                                    <img class="img-fluid rounded" alt="Donation Proof" src="{{ url('upload/charitable_org/donates/'.$lead->proof_of_payment_photo) }}" style="max-height: 60vh">
                                </a>
                                @else
                                ---
                                @endisset
                            </div>
                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="col-lg-8">
                            <dl class="row col-md-12">
                                <dt class="col-md-4"><h4 class="font-size-15"><strong>Date Added:</strong></h4></dt>
                                <dt class="col-md-8">{{Carbon\Carbon::parse($lead->created_at)->isoFormat('LL (h:mm A)')}}</dt>
                            </dl>
                        </div>
                        <div class="col-lg-4">
                            <ul class="list-inline mb-0 text-center">
                                <button type="button" class="btn btn-outline-danger waves-effect waves-light w-xl mb-2" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                    <i class="ri-delete-bin-line"></i> Delete
                                </button>
                                <button type="button" class="btn btn-success waves-effect waves-light w-xl mb-2" data-bs-toggle="modal" data-bs-target="#addModal">
                                    <i class="ri-user-add-line"></i> Add to Prospects
                                </button>
                            </ul>
                        </div>
                    </div>

                    <!-- Delete Modal -->
                    <div id="deleteModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="myModalLabel"><i class="mdi mdi-alert-outline me-2"></i> Are you sure?</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Delete the selected lead [ <strong>{{$lead->last_name.', '.$lead->first_name.}} </strong> ]?
                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button"  class="btn btn-light waves-effect w-sm" data-bs-dismiss="modal">No</button>
                                    <a type="button" href="{{route('leads.delete',$lead->code)}}" class="btn btn-danger waves-effect waves-light w-sm">Yes</a>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div>


                    <!-- Add to Prospects Modal -->
                    <div id="addModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="myModalLabel"><i class="mdi mdi-information-outline me-2"></i> Warning</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>You are about to add the selected lead [ <strong>{{$lead->last_name.', '.$lead->first_name.}} </strong> ] to your prospects. Continue?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light waves-effect w-sm" data-bs-dismiss="modal">No</button>
                                    <a type="button" href="{{route('move.to.prospect',$lead->code)}}" class="btn btn-success waves-effect waves-light w-sm">Yes</a>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div>

                </div>
            </div>
        </div> <!-- end col -->


    </div>

</div>

@endsection