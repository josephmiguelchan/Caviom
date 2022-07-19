@extends('charity.charity_master')
@section('title', 'My Profile')
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
                <div class="">
                    <div class="p-2">
                        <h1 class="mb-0" style="color: #62896d"><strong>PROFILE</strong></h1>
                        <ol class="breadcrumb m-0 p-0 mb-3">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">
                                <a href="javascript: void(0);">My Account</a>
                            </li>
                            <li class="breadcrumb-item active">Profile</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            <div class="user-profile text-center mt-3">
                                <div class="">
                                    <img src="{{ (!empty(Auth::user()->profile_image))?url($avatar):url($defaultAvatar) }}"
                                        alt="Profile Picture" class="avatar-xl rounded-circle">
                                </div>
                                <div class="mt-3">
                                    <p class="text-muted mb-1">ID No. {{ Auth::user()->info->organizational_id_no }}</p>
                                    <h4 class="font-size-12">{{ Str::of(Auth::user()->role)->upper() }}</h4>
                                    <h1 class="py-3" style="color: #62896d">
                                        <strong>
                                            {{ Auth::user()->info->last_name . ', ' . Auth::user()->info->first_name }}
                                            @if (Auth::user()->info->middle_name)
                                            {{
                                                ' ' . Str::substr(Auth::user()->info->middle_name, 0, 1) . '.'
                                            }}
                                            @endif
                                        </strong>
                                    </h1>
                                </div>
                            </div>
                        </div>
                        <div class="row px-5">
                            <dl class="row mb-0 col-lg-6">
                                <dt class="col-md-6"><h4 class="font-size-15"><strong>Username:</strong></h4></dt>
                                <dt class="col-md-6">{{ Auth::user()->username }}</dt>
                                <dt class="col-md-6"><h4 class="font-size-15"><strong>Email Address:</strong></h4></dt>
                                <dt class="col-md-6">{{ Auth::user()->email }}</dt>
                                <dt class="col-md-6"><h4 class="font-size-15"><strong>Account Status:</strong></h4></dt>
                                <dt class="col-md-6">{{ Auth::user()->status }}</dt>
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
                                    {{
                                        Auth::user()->info->address->address_line_two . ' ' . Auth::user()->info->address->address_line_one . ', ' .
                                        Auth::user()->info->address->barangay . ', ' . Auth::user()->info->address->city . ' ' . Auth::user()->info->address->postal_code
                                    }}
                                </dt>
                            </dl>
                            <dl class="row mb-0 col-lg-6">
                                <dt class="col-md-6"><h4 class="font-size-15"><strong>Cel No:</strong></h4></dt>
                                <dt class="col-md-6">{{Auth::user()->info->cel_no}}</dt>
                                <dt class="col-md-6"><h4 class="font-size-15"><strong>Tel No:</strong></h4></dt>
                                <dt class="col-md-6">{{Auth::user()->info->tel_no}}</dt>
                            </dl>
                        </div>
                        <div class="row p-5">
                            <div class="">
                                <a href="{{ route('user.profile.edit') }}" class="btn btn-outline-dark btn-rounded w-xl waves-effect waves-light float-end">
                                    <i class="ri-edit-line"></i> Edit Profile
                                </a>
                                {{-- <small class="text-muted ">Last Updated {{ Carbon\Carbon::parse(Auth::user()->info->updated_at)->diffForHumans() }}</small> --}}
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