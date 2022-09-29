@extends('admin.admin_master')
@section('title', 'View Admin User')
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
                    <ol class="breadcrumb m-0 p-0 mb-3">
                        <li class="breadcrumb-item">Menu</li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.users') }}">Users</a></li>
                        <li class="breadcrumb-item active">View</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="p-4">
                            <a href="{{ route('admin.users') }}" class="text-link">
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
                                    <p class="text-dark mb-1"><span class="badge bg-light">{{$User->info->organizational_id_no}}</span></p>
                                    <h4 class="font-size-12 text-dark">{{$User->role}}</h4>
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
                                <dt class="col-md-6">
                                    @isset($User->username)
                                        {{'@'.$User->username}}
                                    @endisset
                                </dt>
                                <dt class="col-md-6"><h4 class="font-size-15"><strong>Email Address:</strong></h4></dt>
                                <dt class="col-md-6"><a href="mailto:{{$User->email}}">{{$User->email}}</a></dt>
                                <dt class="col-md-6"><h4 class="font-size-15"><strong>Account Status:</strong></h4></dt>
                                <dt class="col-md-6">{{ $User->status}}</dt>


                            </dl>
                            <dl class="row mb-0 col-lg-6">
                                <dt class="col-md-6"><h4 class="font-size-15"><strong>Date Registered:</strong></h4></dt>
                                <dt class="col-md-6">{{ Carbon\Carbon::parse($User->created_at)->toFormattedDateString() }}</dt>
                                <dt class="col-md-6"><h4 class="font-size-15"><strong>Last Updated:</strong></h4></dt>
                                <dt class="col-md-6">{{ Carbon\Carbon::parse($User->info->updated_at)->diffForHumans() }}</dt>
                                <dt class="col-md-6"><h4 class="font-size-15"><strong>Remarks:</strong></h4></dt>
                                <dt class="col-md-6">{{ !empty($User->remarks)? $User->remarks: '---' }}</dt>
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
                                <dt class="col-md-6">{{!empty($User->info->tel_no)? $User->info->tel_no: '---'}}</dt>
                            </dl>
                        </div>
                    </div><!-- end cardbody -->
                </div><!-- end card -->
            </div><!-- end col -->
        </div>
        <!-- end row -->
    </div>
</div>
@endsection