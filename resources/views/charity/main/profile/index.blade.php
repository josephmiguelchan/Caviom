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
                    <div class="text-center">
                        <h1 style="color: #62896d"><strong>PUBLIC PROFILE</strong></h1>

                        <!-- if (Auth::user->charity->profile_status == 'Unset') -->
                        <div class="col-lg-12">
                            <div class="text-center">
                                <p class="mb-5">Introduce your nonprofit to the community by creating your Charitable Organization a public profile.</p>
                                <a type="button" style="background-color: #62896d" href="{{ route('charity.profile.setup') }}" class="btn btn-rounded btn-dark w-xl waves-effect waves-light">
                                    Start
                                </a>
                                <p class="text-muted text-center font-size-12 mt-2">
                                    <em>
                                        Click the <strong>start</strong> button to begin setup.
                                    </em>
                                </p>
                            </div>
                        </div>

                        <!-- else () -->
                        {{-- <p class="mb-5">Kindly select from these:</p>
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <a type="button" href="" class="btn btn-outline-dark w-100 waves-effect waves-light">
                                        <i class="mdi mdi-check-decagram"></i> Apply for Verification
                                    </a>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <a type="button" style="background-color: #62896d" href=""
                                        class="btn btn-dark w-100 waves-effect waves-dark">
                                        <i class="mdi mdi-eye-outline"></i> View Public Profile
                                    </a>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <a type="button" href="{{ route('charity.profile.setup') }}"
                                        class="btn btn-secondary w-100 waves-effect waves-light">
                                        <i class="mdi mdi-circle-edit-outline"></i> Make Changes
                                    </a>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="mb-3">
                                    <div class="dropdown">
                                        <button class="btn btn-outline-secondary w-100 waves-effect waves-light dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                            Set Visibility <i class="mdi mdi-chevron-down"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="#">Hidden</a>
                                            <a class="dropdown-item" href="#">Visible</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}

                    </div>
                </div>
            </div>
        </div> <!-- end col -->

    </div>

</div>

@endsection