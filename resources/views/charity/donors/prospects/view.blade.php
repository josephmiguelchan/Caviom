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
                    <button type="button" data-bs-target=".bs-example-modal-center" title="Learn more" class="btn btn-link waves-effect p-0 mb-3" data-bs-toggle="modal">
                        <small>
                            <i class="mdi mdi-information"></i> Learn more about Prospects
                        </small>
                    </button>

                    <!-- Learn More Modal -->
                    <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">What are Prospects?</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Prospects are eme eme</p>
                                    <p>Praesent commodo cursus magna, vel scelerisque
                                        nisl consectetur et. Vivamus sagittis lacus vel
                                        augue laoreet rutrum faucibus dolor auctor.</p>
                                    <p class="mb-0">Aenean lacinia bibendum nulla sed consectetur.
                                        Praesent commodo cursus magna, vel scelerisque
                                        nisl consectetur et. Donec sed odio dui. Donec
                                        ullamcorper nulla non metus auctor
                                        fringilla.</p>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="col-12">
            <div class="card">
                <div class="card-body p-5">
                    <div class="row">
                        <div class="col-lg-8">
                            <h1><strong>SALUMBIDES, EVELINE M.</strong></h1>
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
                                    <dt class="col-md-8 py-2">PHP 5.40</dt>
                                    <dt class="col-md-4 py-2"><h4 class="font-size-15"><strong>Mode of Donation:</strong></h4></dt>
                                    <dt class="col-md-8 py-2">GCASH</dt>
                                    <dt class="col-md-4 py-2"><h4 class="font-size-15"><strong>Message:</strong></h4></dt>
                                    <dt class="col-md-8 py-2">
                                        <em>
                                            Ang donasyon na ito ay pangdagdag sa project niyo para sa mga victims ng volcanic erruption sa Taal.
                                            Give ko ang aking contact dahil nais kong mag-share at mag-donate sa gagawin niyong projects para sa
                                            mga street dwellers.
                                        </em>
                                    </dt>
                                    <dt class="col-md-4 py-2"><h4 class="font-size-15"><strong>Date of Payment:</strong></h4></dt>
                                    <dt class="col-md-8 py-2">June 17, 2021</dt>
                                    <dt class="col-md-4 py-2"><h4 class="font-size-15"><strong>Email Address:</strong></h4></dt>
                                    <dt class="col-md-8 py-2">evelynsalumbides@gmail.com</dt>
                                    <dt class="col-md-4 py-2">
                                        <h4 class="font-size-15">
                                            <strong>Running Balance:</strong>
                                            <span data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                title="This is the recorded amount of your charitable organization's total donation at the time
                                                of adding this Prospect." data-bs-original-title="yes">
                                                <i class="mdi mdi-information-outline"></i>
                                            </span>
                                        </h4>
                                    </dt>
                                    <dt class="col-md-8 py-2">PHP 5,403.23</dt>
                                </dl>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="text-center">
                                <h4 class="font-size-15"><strong>Proof of Payment</strong></h4>
                                <a class="image-popup-no-margins" title="Gcash Receipt of Eveline" href="{{ asset('upload/gcash-sample-receipt.png') }}">
                                    <img class="img-fluid rounded" alt="Donation Proof" src="{{ asset('upload/gcash-sample-receipt.png') }}" style="max-height: 500px">
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-5">
                        <div class="col-lg-8">
                            <dl class="row col-md-12">
                                <dt class="col-md-4 py-2"><h4 class="font-size-15"><strong>Date Added:</strong></h4></dt>
                                <dt class="col-md-8 py-2">May 20, 2022</dt>
                                <dt class="col-md-4 py-2"><h4 class="font-size-15"><strong>Last Modified:</strong></h4></dt>
                                <dt class="col-md-8 py-2 ">1 hour ago</dt>
                                <dt class="col-md-4 py-2"><h4 class="font-size-15"><strong>Remarks:</strong></h4></dt>
                                <dt class="col-md-8 py-2">
                                    <textarea name="" class="form-control" rows="5" placeholder="Enter remarks for this prospect..." id=""></textarea>
                                    <button type="button" class="btn btn-info btn-rounded waves-effect waves-light w-md mt-2 float-end">
                                        <i class="ri-edit-line"></i> Save
                                    </button>
                                </dt>
                            </dl>
                        </div>
                        <div class="col-lg-4">
                            <ul class="list-inline mb-0 text-center">
                                <button type="button" class="btn btn-outline-danger waves-effect waves-light w-xl mb-2" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                    <i class="ri-arrow-go-back-line"></i> Move to Leads
                                </button>
                                <button type="button" class="btn btn-success waves-effect waves-light w-xl mb-2" data-bs-toggle="modal" data-bs-target="#addModal">
                                    <i class="ri-user-star-line"></i> Add as Opportunity
                                </button>
                            </ul>
                        </div>
                    </div>

                    <!-- Delete Modal -->
                    <div id="deleteModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="myModalLabel"><i class="mdi mdi-alert-outline me-2"></i> Warning</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>You are about to move the selected prospect [<strong> Salumbides, Eveline M. </strong>] back to leads. Continue?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light waves-effect w-sm" data-bs-dismiss="modal">No</button>
                                    <button type="button" class="btn btn-danger waves-effect waves-light w-sm">Yes</button>
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
                                    <p>Are you sure you want to make this prospect [<strong> Salumbides, Eveline M. </strong>] as your new opportunity?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light waves-effect w-sm" data-bs-dismiss="modal">No</button>
                                    <button type="button" class="btn btn-success waves-effect waves-light w-sm" data-bs-toggle="modal" data-bs-target="#addOpportunityModal">Yes</button>
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
                                    <h1 class="mb-0" style="color: #62896d"><strong>Elizalde, Kei S.</strong></h1>
                                    <p class="mt-5 text-muted">
                                        Kindly select one from these:
                                    </p>
                                    <div class="text-center mb-3">
                                        <a type="button" href="#" class="btn btn-outline-dark w-xl waves-effect waves-light">
                                            Create New Volunteer Record
                                        </a>
                                        <a type="button" href="#" class="btn btn-outline-dark w-xl waves-effect waves-light">
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