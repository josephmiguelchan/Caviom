@extends('charity.charity_master')
@section('title', 'View User')
@section('charity')

@php
    $avatar = 'upload/avatar_img/'.$User->profile_image;
    $defaultAvatar = 'upload/avatar_img/no_avatar.png';
@endphp

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="p-2">
                    <h1 class="mb-0" style="color: #62896d"><strong>USERS</strong></h1>
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item">Our Charitable Organization</li>
                        <li class="breadcrumb-item"><a href="{{ route('charity.users') }}">Users</a></li>
                        <li class="breadcrumb-item active">View</li>
                    </ol>

                    @include('charity.modals.users')
                </div>
            </div>
        </div>
        <!-- end page title -->

        @if(Auth::user()->role == "Charity Admin" and $User->status == "Pending Unlock")

        <!-- Delete User Modal -->
        <div id="deleteModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel"><i class="mdi mdi-alert-outline me-2"></i> Warning</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>You are about to permanently delete this Pending User's account. This action
                            will not refund your Star Tokens and will notify all other users in your Charitable Organization. Continue?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light waves-effect w-sm" data-bs-dismiss="modal">No</button>
                        <a href="{{route('charity.users.delete', $User->code)}}" class="btn btn-danger waves-effect waves-light w-sm">Yes</a>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
        @endif

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="p-4">
                            <a href="{{ route('charity.users') }}" class="text-link">
                                <i class="ri-arrow-left-line"></i> Go Back
                            </a>
                        </div>
                        <div class="text-center">
                            <div class="user-profile text-center mt-3">
                                <div class="">
                                    <img src="{{ (!empty($User->profile_image))?url($avatar):url($defaultAvatar) }}"
                                        alt="Profile Picture" class="avatar-xl rounded-circle">
                                </div>
                                <div class="mt-3">
                                    <p class="text-muted mb-1"><span class="badge bg-light">{{$User->info->organizational_id_no}}</span></p>
                                    <h4 class="font-size-12">{{$User->role}}</h4>
                                    <h1 class="py-3" style="color: #62896d">
                                        <strong>
                                            {{ $User->info->last_name . ', ' . $User->info->first_name }}
                                            @if ($User->info->middle_name)
                                            {{
                                                ' ' . $User->info->middle_name
                                            }}
                                            @endif
                                        </strong>
                                    </h1>
                                </div>
                            </div>
                        </div>
                        <div class="row px-5 mb-5">
                            <dl class="row mb-0 col-lg-6">
                                <dt class="col-md-6"><h4 class="font-size-15"><strong>Username:</strong></h4></dt>
                                <dt class="col-md-6">{{($User->username)?'@'.$User->username:'---'}}
                                </dt>
                            </dl>
                            <dl class="row mb-0 col-lg-6">
                                <dt class="col-md-6"><h4 class="font-size-15"><strong>Last Updated:</strong></h4></dt>
                                <dt class="col-md-6">{{ Carbon\Carbon::parse($User->info->updated_at)->diffForHumans() }}</dt>
                            </dl>
                            <dl class="row mb-0 col-lg-6">
                                <dt class="col-md-6"><h4 class="font-size-15"><strong>Email Address:</strong></h4></dt>
                                <dt class="col-md-6"><a href="mailto:{{$User->email}}">{{$User->email}}</a></dt>
                            </dl>
                            <dl class="row mb-0 col-lg-6">
                                <dt class="col-md-6"><h4 class="font-size-15"><strong>Date Registered:</strong></h4></dt>
                                <dt class="col-md-6">{{ Carbon\Carbon::parse($User->created_at)->toFormattedDateString() }}</dt>
                            </dl>
                            <dl class="row mb-0 col-lg-6">
                                <dt class="col-md-6"><h4 class="font-size-15"><strong>Account Status:</strong></h4></dt>
                                <dt class="col-md-6">{{$User->status}}</dt>
                            </dl>
                            <dl class="row mb-0 col-lg-6">
                                <dt class="col-md-6"><h4 class="font-size-15"><strong>Remarks:</strong></h4></dt>
                                <dt class="col-md-6"><h6 class="fw-bold">{{ empty($User->remarks)? '---': $User->remarks }}</h6></dt>
                                <dt class="col-md-6 offset-md-6">{{ empty($User->remarks)? '': $User->remarks_message }}</dt>
                            </dl>
                            <hr class="my-3">
                            <dl class="row mb-0 col-lg-6">
                                <dt class="col-md-6"><h4 class="font-size-15"><strong>Job Position:</strong></h4></dt>
                                <dt class="col-md-6">{{$User->info->work_position }}</dt>
                                <dt class="col-md-6"><h4 class="font-size-15"><strong>Address:</strong></h4></dt>
                                <dt class="col-md-6">
                                    {{
                                        $User->info->address->address_line_two . ' ' . $User->info->address->address_line_one . ', ' .
                                        $User->info->address->barangay . ', ' . $User->info->address->city . ' ' . $User->info->address->postal_code
                                    }}
                                </dt>
                            </dl>
                            <dl class="row mb-0 col-lg-6">
                                <dt class="col-md-6"><h4 class="font-size-15"><strong>Cel No:</strong></h4></dt>
                                <dt class="col-md-6">{{$User->info->cel_no}}</dt>
                                <dt class="col-md-6"><h4 class="font-size-15"><strong>Tel No:</strong></h4></dt>
                                <dt class="col-md-6">{{!empty($User->info->tel_no)? $User->info->tel_no: '-------'}}</dt>
                            </dl>
                        </div>

                        <hr class="my-3">

                        <div class="float-end">
                            <div class="row my-3 mx-2">
                                <div class="col-md-12">
                                    <div class="btn-group" role="group" aria-label="Actions">

                                        @if(Auth::user()->role == "Charity Admin" and $User->status == "Pending Unlock")
                                            <a type="button" data-bs-toggle="modal" data-bs-target="#deleteModal" class="btn w-lg btn-outline-danger waves-effect waves-light">
                                                <i class="mdi mdi-trash-can-outline"></i> Delete Account
                                            </a>

                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- end cardbody -->
                </div><!-- end card -->
            </div><!-- end col -->
        </div>
        <!-- end row -->
    </div>
</div>
@endsection