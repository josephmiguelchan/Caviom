@extends('charity.charity_master')
@section('title', 'View Volunteer')
@section('charity')

    @php
        $avatar = 'upload/charitable_org/volunteer_photos/';
        $defaultAvatar = 'upload/charitable_org/volunteer_photos/no_avatar.png';
    @endphp

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="p-2">
                        <h1 class="mb-0" style="color: #62896d"><strong>VOLUNTEERS</strong></h1>
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item">Our Charitable Organization</li>
                            <li class="breadcrumb-item"><a href="{{ route('charity.volunteers.all') }}">Volunteers</a></li>
                            <li class="breadcrumb-item active">View</li>
                        </ol>

                        @include('charity.modals.volunteers')
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="p-4">
                                <a href="{{ route('charity.volunteers.all') }}" class="text-link">
                                    <i class="ri-arrow-left-line"></i> Go Back
                                </a>
                            </div>
                            <div class="text-center">
                                <div class="user-profile text-center mt-3">
                                    <div class="">
                                        <img src="{{ (!empty($volunteer->profile_photo))?url($avatar.$volunteer->profile_photo):url($defaultAvatar) }}"
                                             alt="Profile Picture" class="avatar-xl rounded-circle">
                                    </div>
                                    <div class="mt-3">
                                        <p class="text-muted"><span class="badge bg-light">ID No. {{ $volunteer->id }}</span></p>
                                        <h1 class="mb-5" style="color: #62896d">
                                            <strong>
                                                {{ $volunteer->last_name . ', ' . $volunteer->first_name .' '. $volunteer->middle_name}}
                                            </strong>
                                        </h1>
                                    </div>
                                </div>
                            </div>
                            <div class="row px-5">
                                <dl class="row col-lg-6">
                                    <dt class="col-md-6"><h4 class="font-size-15"><strong>Date Added:</strong></h4></dt>
                                    <dt class="col-md-6">{{ Carbon\Carbon::parse($volunteer->created_at)->toFormattedDateString() }}</dt>
                                </dl>
                                <dl class="row col-lg-6">
                                    <dt class="col-md-6"><h4 class="font-size-15"><strong>Last Updated at:</strong></h4></dt>
                                    <dt class="col-md-6">{{ Carbon\Carbon::parse($volunteer->updated_at)->diffForHumans() }}</dt>
                                    <dt class="col-md-6"><h4 class="font-size-15"><strong>Last Updated by:</strong></h4></dt>
                                    <dt class="col-md-6">
                                        {{ $userInfo->last_name . ', ' . $userInfo->first_name .' ' . $userInfo->middle_name}}
                                    </dt>
                                </dl>
                                <hr class="my-3">
                                <dl class="row col-lg-6 mb-0">
                                    <dt class="col-md-6"><h4 class="font-size-15"><strong>Email Address:</strong></h4></dt>
                                    <dt class="col-md-6">
                                        <a href="mailto: {{ $volunteer->email_address }}">{{ $volunteer->email_address }}</a>
                                    </dt>
                                    <dt class="col-md-6"><h4 class="font-size-15"><strong>Cel No:</strong></h4></dt>
                                    <dt class="col-md-6">{{ $volunteer->cel_no }}</dt>
                                    <dt class="col-md-6"><h4 class="font-size-15"><strong>Tel No:</strong></h4></dt>
                                    <dt class="col-md-6">{{ $volunteer->tel_no }}</dt>
                                </dl>
                                <dl class="row col-lg-6 mb-0">
                                    <dt class="col-md-6"><h4 class="font-size-15"><strong>Category:</strong></h4></dt>
                                    <dt class="col-md-6">{{ $volunteer->category }}</dt>
                                    <dt class="col-md-6"><h4 class="font-size-15"><strong>Label:</strong></h4></dt>
                                    <dt class="col-md-6">{{ $volunteer->label }}</dt>
                                </dl>
                                <dl class="row col-lg-12">
                                    <dt class="col-md-3"><h4 class="font-size-15"><strong>Address:</strong></h4></dt>
                                    <dt class="col-md-9 px-1">
                                        {{ $volunteer->Address->address_line_two.' '.$volunteer->Address->address_line_one.', '.
                                            $volunteer->Address->barangay.', '.$volunteer->Address->city.', '
                                            .$volunteer->Address->postal_code.' '.$volunteer->Address->province. ' ' . $volunteer->Address->region}}
                                    </dt>
                                </dl>
                            </div>
                            <div class="row p-3">
                                <div class="">
                                    <a href="{{ route('charity.volunteers.edit', $volunteer->code) }}" class="btn btn-dark btn-rounded w-md waves-effect waves-light float-end">
                                        <i class="ri-edit-line"></i> Edit
                                    </a>
                                    <button type="button" class="btn btn-outline-danger btn-rounded w-md waves-effect waves-light float-end mx-2"
                                            data-bs-toggle="modal" data-bs-target="#deleteModal">
                                        <i class="ri-delete-bin-line"></i> Delete
                                    </button>
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
                                            <p>You are about to delete the selected volunteer [<strong>
                                                    {{ $volunteer->last_name . ', ' . $volunteer->first_name .' '. $volunteer->middle_name}}
                                                </strong>] permanently. This action
                                                cannot be undone and will notify all other users in your Charitable Organization. Continue?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light waves-effect w-sm" data-bs-dismiss="modal">No</button>
                                            <form method="GET" action="{{ route('charity.volunteers.delete', $volunteer->code) }}">
                                                @csrf
                                                <button type="submit" class="btn btn-danger waves-effect waves-light w-sm">Yes</button>
                                            </form>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div>
                        </div><!-- end cardbody -->
                    </div><!-- end card -->
                </div><!-- end col -->
            </div>
            <!-- end row -->
        </div>
    </div>
@endsection
