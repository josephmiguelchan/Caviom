@extends('charity.charity_master')
@section('title', 'Setup Public Profile')
@section('charity')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="p-2">
                    <h1 class="mb-0" style="color: #62896d"><strong>PUBLIC PROFILE</strong></h1>
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item">Our Charitable Organization</li>
                        <li class="breadcrumb-item active">Public Profile</li>
                    </ol>
                    <button type="button" data-bs-target=".bs-example-modal-center" title="Learn more" class="btn btn-link waves-effect p-0 mb-3" data-bs-toggle="modal">
                        <small>
                            <i class="mdi mdi-information"></i> Learn more about Public Profiles
                        </small>
                    </button>

                    <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">What is a Public Profile?</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Public profile is your eme eme.</p>
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
            <div class="card p-3">
                <div class="card-body">
                    <h2 class="mb-1 text-center" style="color: #62896d"><strong>SAN ROQUE UNITED, INC.</strong></h2>
                    <p class="text-muted text-center font-size-12 mb-3">
                        <em>
                            Setup your Charitable Organization's public profile and have it verified by us first so it can be featured publicly.
                        </em>
                    </p>

                    <div id="progrss-wizard" class="twitter-bs-wizard">
                        <ul class="twitter-bs-wizard-nav nav-justified">
                            <li class="nav-item">
                                <a href="#progress-primary-details" class="nav-link" data-toggle="tab">
                                    <span class="step-number">01</span>
                                    <span class="step-title">Primary Information</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#progress-secondary-document" class="nav-link" data-toggle="tab">
                                    <span class="step-number">02</span>
                                    <span class="step-title">Secondary Information</span>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="#progress-programs-detail" class="nav-link" data-toggle="tab">
                                    <span class="step-number">03</span>
                                    <span class="step-title">Programs & Activities</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#progress-donations-detail" class="nav-link" data-toggle="tab">
                                    <span class="step-number">04</span>
                                    <span class="step-title">Modes of Donation</span>
                                </a>
                            </li>
                        </ul>

                        <div id="bar" class="progress mt-4">
                            <div class="progress-bar bg-success progress-bar-striped progress-bar-animated"></div>
                        </div>

                        <div class="tab-content twitter-bs-wizard-tab-content">
                            <div class="tab-pane" id="progress-primary-details">
                                <!-- Primary Info -->
                                @include('charity.main.profile.components.primary')
                            </div>

                        <div class="tab-pane" id="progress-secondary-document">
                            <div>
                                <!-- Secondary Info -->
                                @include('charity.main.profile.components.secondary')
                            </div>
                        </div>

                        <div class="tab-pane" id="progress-programs-detail">
                            <div>
                                <!-- Programs -->
                                @include('charity.main.profile.components.programs')
                            </div>
                        </div>

                        <div class="tab-pane" id="progress-donations-detail">
                            <div class="row justify-content-center">
                                <div class="col-lg-6">
                                    <div class="text-center">
                                        <div class="mb-4">
                                            <i class="mdi mdi-check-circle-outline text-success display-4"></i>
                                        </div>
                                        <div>
                                            <h5>Confirm Detail</h5>
                                            <p class="text-muted">If several languages coalesce, the grammar of the resulting</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="text-muted text-center font-size-12 mt-2">
                            <em>
                                Please click on <strong>Save</strong> first before proceeding to the next.
                            </em>
                        </p>
                        <ul class="pager wizard twitter-bs-wizard-pager-link">
                            <li class="previous"><a href="javascript: void(0);">Previous</a></li>
                            <li class="next"><a href="javascript: void(0);">Next</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->


    </div>

</div>

@endsection