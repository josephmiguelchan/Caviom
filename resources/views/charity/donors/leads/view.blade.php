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
                        <li class="breadcrumb-item active">Leads</li>
                    </ol>
                    <button type="button" data-bs-target=".bs-example-modal-center" title="Learn more" class="btn btn-link waves-effect p-0 mb-3" data-bs-toggle="modal">
                        <small>
                            <i class="mdi mdi-information"></i> Learn more about Leads
                        </small>
                    </button>

                    <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">What are Leads?</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Leads are eme eme</p>
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
                                    <dt class="col-md-8 py-2">PHP 1,000</dt>
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
                                <dt class="col-md-4"><h4 class="font-size-15"><strong>Date Added:</strong></h4></dt>
                                <dt class="col-md-8">May 20, 2022</dt>
                            </dl>
                        </div>
                        <div class="col-lg-4">
                            <ul class="list-inline mb-0 text-center">
                                <button type="button" class="btn btn-outline-danger waves-effect waves-light w-xl mb-2">
                                    <i class="ri-delete-bin-line"></i> Delete
                                </button>
                                <button type="button" class="btn btn-success waves-effect waves-light w-xl mb-2">
                                    <i class="ri-user-add-line"></i> Add to Prospects
                                </button>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div> <!-- end col -->


    </div>

</div>

@endsection