@extends('charity.charity_master')
@section('title', 'View User')
@section('charity')

@php
    $avatar = 'upload/avatar_img/'.Auth::user()->profile_image;
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
                                    <img src="{{ url($defaultAvatar) }}"
                                        alt="Profile Picture" class="avatar-xl rounded-circle">
                                </div>
                                <div class="mt-3">
                                    <p class="text-muted mb-1"><span class="badge bg-light">ID No. 2022090831</span></p>
                                    <h4 class="font-size-12">Charity Admin</h4>
                                    <h1 class="py-3" style="color: #62896d">
                                        <strong>
                                            {{-- {{ Auth::user()->info->last_name . ', ' . Auth::user()->info->first_name }}
                                            @if (Auth::user()->info->middle_name)
                                            {{
                                                ' ' . Str::substr(Auth::user()->info->middle_name, 0, 1) . '.'
                                            }}
                                            @endif --}}
                                            Liwanag, Christopher Guevarra
                                        </strong>
                                    </h1>
                                </div>
                            </div>
                        </div>
                        <div class="row px-5 mb-5">
                            <dl class="row mb-0 col-lg-6">
                                <dt class="col-md-6"><h4 class="font-size-15"><strong>Username:</strong></h4></dt>
                                <dt class="col-md-6">@chris_liwanag24</dt>
                                <dt class="col-md-6"><h4 class="font-size-15"><strong>Email Address:</strong></h4></dt>
                                <dt class="col-md-6"><a href="mailto: liwanag.chris@gmail.com">liwanag.chris@gmail.com</a></dt>
                                <dt class="col-md-6"><h4 class="font-size-15"><strong>Account Status:</strong></h4></dt>
                                <dt class="col-md-6">Pending</dt>
                            </dl>
                            <dl class="row mb-0 col-lg-6">
                                <dt class="col-md-6"><h4 class="font-size-15"><strong>Date Registered:</strong></h4></dt>
                                <dt class="col-md-6">{{ Carbon\Carbon::parse(Auth::user()->created_at)->toFormattedDateString() }}</dt>
                                <dt class="col-md-6"><h4 class="font-size-15"><strong>Last Updated:</strong></h4></dt>
                                <dt class="col-md-6">{{ Carbon\Carbon::parse(Auth::user()->info->updated_at)->diffForHumans() }}</dt>
                                <dt class="col-md-6"><h4 class="font-size-15"><strong>Remarks:</strong></h4></dt>
                                <dt class="col-md-6">{{ Auth::user()->remarks }}</dt>
                            </dl>
                            <hr class="my-3">
                            <dl class="row mb-0 col-lg-6">
                                <dt class="col-md-6"><h4 class="font-size-15"><strong>Job Position:</strong></h4></dt>
                                <dt class="col-md-6">{{ Auth::user()->info->work_position }}</dt>
                                <dt class="col-md-6"><h4 class="font-size-15"><strong>Address:</strong></h4></dt>
                                <dt class="col-md-6">
                                    {{-- {{
                                        Auth::user()->info->address->address_line_two . ' ' . Auth::user()->info->address->address_line_one . ', ' .
                                        Auth::user()->info->address->barangay . ', ' . Auth::user()->info->address->city . ' ' . Auth::user()->info->address->postal_code
                                    }} --}}
                                    4312 Dungaw Road, Luntian St. Brgy. 32, Pasay City 1300
                                </dt>
                            </dl>
                            <dl class="row mb-0 col-lg-6">
                                <dt class="col-md-6"><h4 class="font-size-15"><strong>Cel No:</strong></h4></dt>
                                <dt class="col-md-6">{{Auth::user()->info->cel_no}}</dt>
                                <dt class="col-md-6"><h4 class="font-size-15"><strong>Tel No:</strong></h4></dt>
                                <dt class="col-md-6">{{Auth::user()->info->tel_no}}</dt>
                            </dl>
                        </div>

                        <hr class="my-3">

                        <div class="float-end">
                            <div class="row my-3 mx-2">
                                <div class="col-md-12">
                                    <div class="btn-group" role="group" aria-label="Actions">

                                        @if(Auth::user()->role == "Charity Admin") <!-- and IF this $user->status == 'Pending' -->
                                            <a type="button" data-bs-toggle="modal" data-bs-target="#deleteModal" class="btn w-lg btn-outline-danger waves-effect waves-light">
                                                <i class="mdi mdi-trash-can-outline"></i> Delete Account
                                            </a>
                                            <a type="button" href="#" class="btn w-lg btn-primary waves-effect waves-light mx-1">
                                                <i class="mdi mdi-email-send-outline"></i> Resend Link
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