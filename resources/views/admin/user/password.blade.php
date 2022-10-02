@extends('admin.admin_master')
@section('title', 'Change Password')
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
                        <h1 class="mb-0" style="color: #62896d"><strong>CHANGE PASSWORD</strong></h1>
                        <ol class="breadcrumb m-0 p-0 mb-3">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">
                                <a href="javascript: void(0);">My Account</a>
                            </li>
                            <li class="breadcrumb-item active">Change Password</li>
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
                                    <img src="{{ (!empty(Auth::user()->profile_image))? url($avatar):url($defaultAvatar) }}"
                                        alt="Profile Picture" class="avatar-xl rounded-circle">
                                </div>
                                <div class="mt-3">
                                    <p class="text-muted mb-1">ID No. {{ Auth::user()->info->organizational_id_no }}</p>
                                    <h4 class="font-size-12 text-dark">{{ Str::of(Auth::user()->role)->upper() }}</h4>
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
                        </div>
                        <div class="row p-4">
                            <div>
                                <div class="alert alert-primary alert-dismissible fade show p-4" role="alert">
                                    <p class="font-size-15 mb-1"><strong>Your password must contain at least:</strong></p>
                                    <ul class="mb-0">
                                        <li>8-20 characters</li>
                                        <li>one uppercase and one lowercase letter</li>
                                        <li>one symbol</li>
                                        <li>one number</li>
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>
                            <form method="POST" action="{{ route('user.password.store') }}" class="form-horizontal">
                                @csrf
                                <!-- Current Password -->
                                <div class="form-group mb-3 row">
                                    <div class="col-12">
                                        <label for="old_password" class="form-label">*Current Password</label>
                                        <input class="form-control" name="old_password" id="old_password" type="password" placeholder="Enter your old password" required>
                                        @error('old_password')
                                            <div class="text-danger my-2">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        @if (Session::has('error_msg'))
                                            <div class="text-danger my-2">
                                                {{ Session::get('error_msg') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group mb-3 row">
                                    <!-- New Password -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="new_password" class="form-label">
                                                *New Password
                                                <span data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                    title="Password must have at least 8-20 characters with a symbol, a number, an uppercase and a lowercase letter."
                                                    data-bs-original-title="yes">
                                                    <i class="mdi mdi-information-outline"></i>
                                                </span>
                                            </label>
                                            <input class="form-control" name="new_password" id="new_password" type="password" required
                                                placeholder="Enter new password" value="">
                                            @error('new_password')
                                                <div class="text-danger my-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Confirm Password -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="confirm_password" class="form-label">*Confirm Password</label>
                                            <input class="form-control" name="confirm_password" data-parsley-equalto="#new_password"
                                                id="confirm_password" type="password" placeholder="Retype password" required>
                                            @error('confirm_password')
                                                <div class="text-danger my-2">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row px-3">
                                    <ul class="list-inline mb-0 mt-4 float-end">
                                        <input type="submit" class="btn btn-dark btn-rounded w-xl waves-effect waves-light float-end" style="background-color: #62896d;" value="Change Password">
                                    </ul>
                                </div>
                            </form>
                        </div>
                    </div><!-- end cardbody -->
                </div><!-- end card -->
            </div><!-- end col -->
        </div>
        <!-- end row -->
    </div>
</div>
@endsection