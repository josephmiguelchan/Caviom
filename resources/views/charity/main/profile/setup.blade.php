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
                        <li class="breadcrumb-item">
                            <a href="{{ route('charity.profile') }}">Public Profile</a>
                        </li>
                        <li class="breadcrumb-item active">Setup</li>
                    </ol>

                    @include('charity.modals.profile')
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="col-12">
            <div class="card p-3">
                <div class="card-body">
                    <h2 class="mb-1 text-center" style="color: #62896d"><strong>{{ Auth::user()->charity->name }}</strong></h2>
                    <p class="text-muted text-center font-size-12 mb-3">
                        <em>
                            Setup your Charitable Organization's public profile so it can be published and featured publicly.
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
                            <li class="nav-item">
                                <a href="#progress-finish-detail" class="nav-link" data-toggle="tab">
                                    <span class="step-number">05</span>
                                    <span class="step-title">Review & Confirm</span>
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
                                <!-- Programs and Activities -->
                                @include('charity.main.profile.components.programs')
                            </div>
                        </div>

                        <div class="tab-pane" id="progress-donations-detail">
                            <div>
                                <!-- Modes of Donation -->
                                @include('charity.main.profile.components.donation')
                            </div>
                        </div>

                        <div class="tab-pane" id="progress-finish-detail">
                            <div>
                                <!-- Modes of Donation -->
                                @include('charity.main.profile.components.finish')
                            </div>
                        </div>

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