@extends('charity.charity_master')
@section('title', 'Public Profile')
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

                    @include('charity.modals.profile')
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="col-12">
            <div class="card p-3">

                <div class="card-body">
                    <div class="text-center">
                        <h1 style="color: #62896d"><strong>PUBLIC PROFILE</strong></h1>

                        @if (Auth::user()->charity->profile_status == 'Unset')
                        <div class="col-lg-12">
                            <div class="row justify-content-center">
                                <p class="mb-5">Introduce your nonprofit to the community by creating your Charitable Organization a public profile.</p>
                                <div class="col-lg-3">
                                    <a type="button" style="background-color: #62896d" href="{{ route('charity.profile.setup') }}" class="btn btn-rounded btn-dark w-100 waves-effect waves-light">
                                        Start
                                    </a>
                                    <p class="text-muted text-center font-size-12 mt-2">
                                        <em>
                                            Click the <strong>start</strong> button to begin setup.
                                        </em>
                                    </p>
                                </div>
                            </div>
                        </div>

                        @else
                        <p class="mb-5">Kindly select from these:</p>
                        <div class="row justify-content-center">
                            <div class="col-lg-3">
                                <div class="mb-3">

                                    @if (Auth::user()->charity->verification_status == 'Pending')
                                        <button type="button" href="javascript: void(0);" class="btn btn-outline-secondary w-100 waves-effect waves-light" disabled>
                                            <i class="mdi mdi-check-decagram"></i> Pending for Review
                                        </button>

                                    @elseif (Auth::user()->charity->verification_status == 'Verified')
                                        <button type="button" href="javascript: void(0);" class="btn btn-outline-dark w-100 waves-effect waves-light" disabled>
                                            <i class="mdi mdi-check-decagram"></i> Already Verified
                                        </button>

                                    @elseif (Auth::user()->charity->verification_status == 'Declined')
                                        <button data-bs-toggle="modal" data-bs-target="#reapply_modal" type="button" class="btn btn-outline-dark w-100 waves-effect waves-light" >
                                            <i class="mdi mdi-check-decagram"></i> Re-Apply for Verification
                                        </button>

                                        <!-- Re-Apply Modal -->
                                        <div id="reapply_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="myModalLabel"><i class="mdi mdi-alert-outline me-2"></i> Warning</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-start">
                                                        <p>
                                                            Your previously submitted documents has been declined. You can re-apply again for verification, but your currently submitted
                                                            documents will be removed and replaced. Continue?
                                                        </p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-light waves-effect w-sm" data-bs-dismiss="modal">No</button>
                                                        <a href="{{ route('charity.profile.reverify') }}" class="btn btn-dark waves-effect waves-light w-sm">Yes</a>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div>

                                    @elseif (Auth::user()->charity->verification_status == 'Unverified')
                                        <a type="button" href="{{ route('charity.profile.verify') }}" class="btn btn-outline-dark w-100 waves-effect waves-light">
                                            <i class="mdi mdi-check-decagram"></i> Apply for Verification
                                        </a>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <button type="button" onclick="location.href='{{Auth::user()->charity->profile_status == 'Visible' ? route('charities.view', Auth::user()->charity->code) : '' }}'" target="_blank"
                                        class="btn btn-secondary w-100 waves-effect waves-light" {{Auth::user()->charity->profile_status != 'Visible' ? 'disabled' : ''}}>
                                        <i class="mdi mdi-eye-outline"></i> View Public Profile
                                    </button>
                                    @if(Auth::user()->charity->profile_status != 'Visible')
                                    <p class="text-muted text-center font-size-12">
                                        <em>
                                            <small>
                                                Public Profile is {{Auth::user()->charity->profile_status}}
                                            </small>
                                        </em>
                                    </p>
                                    @endif
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <a type="button" style="background-color: #62896d" href="{{ route('charity.profile.setup') }}"
                                        class="btn btn-dark w-100 waves-effect waves-light">
                                        <i class="mdi mdi-circle-edit-outline"></i> Make Changes
                                    </a>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <div class="dropdown mb-1">
                                        <button class="btn btn-outline-dark w-100 waves-effect waves-light dropdown-toggle" type="button" id="dropdownMenuButton"
                                            data-bs-toggle="dropdown" aria-expanded="false" {{Auth::user()->charity->profile_status == 'Locked'?'disabled':''}}>
                                            Set Visibility <i class="mdi mdi-chevron-down"></i>
                                        </button>
                                        @unless (Auth::user()->charity->profile_status == 'Locked')
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="{{route('charity.profile.hide')}}">Hidden</a>
                                            <a class="dropdown-item" href="{{route('charity.profile.show')}}">Visible</a>
                                        </div>
                                        @endunless
                                    </div>
                                    @if(Auth::user()->charity->profile_status == 'Locked')
                                    <p class="text-muted text-center font-size-12">
                                        <em>
                                            <small>
                                                <span data-bs-toggle="tooltip" data-bs-placement="left"
                                                    title="If you wish to appeal, send email to support@caviom.org"
                                                    data-bs-original-title="yes">
                                                    <i class="mdi mdi-information-outline"></i>
                                                </span>Public Profile locked due to violation/s.
                                            </small>
                                        </em>
                                    </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endif

                    </div>

                </div>
            </div>

            @unless (Auth::user()->charity->profile_status == 'Unset')
            <div class="card p-3">
                <div class="card-body">
                    <div class="text-center">
                        <h1 style="color: #62896d"><strong>FEATURED PROJECTS</strong></h1>

                        <div class="col-lg-12 mb-5">
                            <div class="row justify-content-center">
                                <p class="mb-5">Share your Charitable Organization's existing projects to your public profile.</p>

                                <div class="col-lg-3">
                                    <a style="background-color: #92713e; border-color: #92713e" href="{{ route('charity.profile.feat-project.all') }}"
                                    class="btn btn-dark w-100 waves-effect waves-light"><i class="mdi mdi-view-split-horizontal"></i> View Featured Projects</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            @endunless
        </div> <!-- end col -->

    </div>

</div>

@endsection