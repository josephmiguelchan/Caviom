@extends('charity.charity_master')
@section('title', 'View Prospect')
@section('charity')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="p-2">
                    <h1 class="mb-0" style="color: #62896d"><strong>PROSPECTS</strong></h1>
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item">Donors and Donations</li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('prospects.all') }}">Prospects</a>
                        </li>
                        <li class="breadcrumb-item active">View</li>
                    </ol>

                    @include('charity.modals.prospects')
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="col-12">
            <div class="card">
                <div class="card-body p-5">
                    <div class="row">
                        <div class="col-lg-8">
                            <h2><strong>{{$prospect->last_name.', '.$prospect->first_name.' '.$prospect->middle_name}}</strong></h2>
                        </div>
                        <div class="col-lg-4 mt-4">
                            <a href="{{route('prospects.all')}}" class="text-link float-end">
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
                                    <dt class="col-md-8 py-2">₱ {{number_format($prospect->amount,2)}}</dt>
                                    <dt class="col-md-4 py-2"><h4 class="font-size-15"><strong>Mode of Donation:</strong></h4></dt>
                                    <dt class="col-md-8 py-2">{{$prospect->mode_of_donation}}</dt>
                                    <dt class="col-md-4 py-2"><h4 class="font-size-15"><strong>Message:</strong></h4></dt>
                                    <dt class="col-md-8 py-2">
                                        <em>
                                            {{$prospect->message}}
                                        </em>
                                    </dt>
                                    <dt class="col-md-4 py-2"><h4 class="font-size-15"><strong>Date of Payment:</strong></h4></dt>
                                    <dt class="col-md-8 py-2">{{Carbon\Carbon::parse($prospect->paid_at)->isoFormat('LL (h:mm A)')}}</dt>
                                    <dt class="col-md-4 py-2"><h4 class="font-size-15"><strong>Email Address:</strong></h4></dt>
                                    <dt class="col-md-8 py-2">{{$prospect->email_address}}</dt>
                                    <dt class="col-md-4 py-2">
                                        <h4 class="font-size-15">
                                            <strong>Running Balance</strong>
                                            <span data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                title="This is the recorded amount of your charitable organization's total donation at the time
                                                of adding this Prospect." data-bs-original-title="yes">
                                                <i class="mdi mdi-information-outline"></i>
                                            </span>
                                        </h4>
                                    </dt>
                                    <dt class="col-md-8 py-2">{{$prospect->total}}</dt>
                                </dl>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="text-center">
                                <h4 class="font-size-15"><strong>Proof of Payment</strong></h4>
                                @isset($prospect->proof_of_payment_photo)
                                <a class="image-popup-no-margins" title="{{$prospect->mode_of_donation}} Receipt - {{$prospect->first_name}}" href="{{ url('upload/charitable_org/donates/'.$prospect->proof_of_payment_photo) }}">
                                    <img class="img-fluid rounded" alt="Donation Proof" src="{{ url('upload/charitable_org/donates/'.$prospect->proof_of_payment_photo) }}" style="max-height: 60vh">
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
                                <dt class="col-md-4 py-2"><h4 class="font-size-15"><strong>Date Added:</strong></h4></dt>
                                <dt class="col-md-8 py-2">{{Carbon\Carbon::parse($prospect->created_at)->isoFormat('LL (h:mm A)')}}</dt>
                                <dt class="col-md-4 py-2"><h4 class="font-size-15"><strong>Last Modified:</strong></h4></dt>
                                <dt class="col-md-8 py-2 ">{{Carbon\Carbon::parse($prospect->updated_at)->diffForHumans()}}</dt>
                                <dt class="col-md-4 py-2"><h4 class="font-size-15"><strong>Remarks:</strong></h4></dt>
                                <dt class="col-md-8 py-2">
                                    <form action="{{route('add.remarks',$prospect->code)}}" method="POST">
                                        @csrf
                                        <textarea name="remarks" class="form-control" rows="5" placeholder="Enter remarks for this prospect..." 
                                            id="remarks">{{ $prospect->remarks ?? old('remarks') }}</textarea>
                                        <button type="submit" class="btn btn-info btn-rounded waves-effect waves-light w-md mt-2 float-end">
                                            <i class="ri-edit-line"></i> Save
                                        </button>
                                    </form>
                                </dt>
                            </dl>
                        </div>
                        <div class="col-lg-4">
                            <ul class="list-inline mb-0 text-center">
                                <button type="button"  class="btn btn-outline-danger waves-effect waves-light w-xl mb-2" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                    <i class="ri-arrow-go-back-line"></i> Move to Leads
                                </button>
                                <button type="button" class="btn btn-success waves-effect waves-light w-xl mb-2" data-bs-toggle="modal" data-bs-target="#addOpportunityModal">
                                    <i class="ri-user-star-line"></i> Add as Opportunity
                                </button>
                            </ul>
                        </div>
                    </div>

                    <!-- Move back to leads Modal -->
                    <div id="deleteModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="myModalLabel"><i class="mdi mdi-alert-outline me-2"></i> Warning</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>You are about to move the selected prospect [<strong> {{$prospect->last_name.', '.$prospect->first_name.' '.$prospect->middle_name}} </strong>] back to leads. Continue?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light waves-effect w-sm" data-bs-dismiss="modal">No</button>
                                    <a type="button" href="{{route('move.back.leads',$prospect->code)}}" class="btn btn-danger waves-effect waves-light w-sm">Yes</a>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div>


                    <!--  Modal content for Add as New Opportunity -->
                    <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="addOpportunityModal">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="myLargeModalLabel">Congratulations!</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-center">
                                    <p class="text-dark">You are about to create a new opportunity for your nonprofit.</p>
                                    <h1 class="mb-0" style="color: #62896d"><strong>{{$prospect->last_name.', '.$prospect->first_name.' '.$prospect->middle_name}}.</strong></h1>
                                    <p class="mt-5 text-muted">
                                        Kindly select one from these:
                                    </p>
                                    <div class="text-center mb-3">
                                        <a type="button" href="{{ route('add.to.volunteer',$prospect->code) }}" class="btn btn-outline-dark w-xl waves-effect waves-light">
                                            Create New Volunteer Record
                                        </a>
                                        <a type="button" href="{{ route('add.to.benefactor',$prospect->code) }}" class="btn btn-outline-dark w-xl waves-effect waves-light">
                                            Create New Benefactor Record
                                        </a>
                                    </div>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->

                </div>
            </div>
        </div> <!-- end col -->


    </div>

</div>

@endsection