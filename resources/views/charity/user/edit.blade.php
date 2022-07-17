@extends('charity.charity_master')
@section('title', 'Edit Profile')
@section('charity')

@php
    $avatar = 'upload/avatar_img/'.Auth::user()->profile_image;
    $defaultAvatar = 'upload/avatar_img/no_avatar.png';
@endphp

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="">
                    <div class="p-2">
                        <h1 class="mb-0" style="color: #62896d"><strong>EDIT PROFILE</strong></h1>
                        <ol class="breadcrumb m-0 p-0 mb-3">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">
                                <a href="javascript: void(0);">My Account</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{route('user.profile')}}">Profile</a>
                            </li>
                            <li class="breadcrumb-item active">Edit</li>
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
                                        alt="Profile Picture" class="avatar-xl rounded-circle" id="showImage">
                                </div>
                                <div class="mt-3">
                                    <p class="text-muted mb-1">ID No. {{ $userData->organizational_id_no }}</p>
                                    <h4 class="font-size-12">{{ Str::of(Auth::user()->role)->upper() }}</h4>
                                    <h1 class="py-3" style="color: #62896d">
                                        <strong>
                                            {{ $userData->last_name . ', ' . $userData->first_name }}
                                            @if ($userData->middle_name)
                                            {{
                                                ' ' . Str::substr($userData->middle_name, 0, 1) . '.'
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
                                <dt class="col-md-6">{{ Carbon\Carbon::parse($userData->updated_at)->diffForHumans() }}</dt>
                                <dt class="col-md-6"><h4 class="font-size-15"><strong>Remarks:</strong></h4></dt>
                                <dt class="col-md-6">{{ Auth::user()->remarks }}</dt>
                            </dl>
                            <hr class="my-3">

                            <form method="POST" action="{{ route('user.profile.store') }}" enctype="multipart/form-data"
                                class="form-horizontal">
                                @csrf

                                <h4 class="mt-4" style="color: #62896d">Personal Information</h4>

                                <!-- Profile Photo -->
                                <div class="form-group mb-3 row">

                                    <!-- Profile Photo Input -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="profile_image" class="form-label">
                                                Profile Photo (Optional)
                                                <span data-bs-toggle="tooltip" data-bs-placement="bottom" title="Recommended image resolution of 512x512. Must not
                                                    exceed 2mb." data-bs-original-title="yes">
                                                    <i class="mdi mdi-information-outline"></i>
                                                </span>
                                            </label>
                                            <input class="form-control" name="profile_image" id="profile_image" type="file">
                                            @error('profile_image')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-3 row">
                                    <!-- First Name -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="first_name" class="form-label">*First Name</label>
                                            <input type="text" class="form-control" name="first_name" id="first_name"
                                                value="{{ (empty($errors->has('first_name')))?old('first_name',$userData->first_name):$userData->first_name}}" required>
                                            @error('first_name')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Middle Name -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="middle_name" class="form-label">Middle Name</label>
                                            <input type="text" class="form-control" name="middle_name" id="middle_name"
                                                value="{{ (empty($errors->has('middle_name')))?old('middle_name',$userData->middle_name):$userData->middle_name}}" required>
                                            @error('middle_name')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Last Name -->
                                <div class="row form-group mb-3">
                                    <div class="col-md-12">
                                        <label for="last_name" class="form-label">*Last Name</label>
                                        <input type="text" class="form-control" name="last_name" id="last_name"
                                        value="{{ (empty($errors->has('last_name')))?old('last_name',$userData->last_name):$userData->last_name}}" required>
                                        @error('last_name')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Cellphone -->
                                    <div class="col-md-6">
                                        <div class="form-group mb-3 row">
                                            <div class="col-12">
                                                <label for="cel_no" class="form-label">*Cellphone No.</label>
                                                <input class="form-control" name="cel_no" id="cel_no" type="tel" required
                                                    value="{{ (empty($errors->has('cel_no')))?old('cel_no',$userData->cel_no):$userData->cel_no}}">
                                                @error('cel_no')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Telephone -->
                                    <div class="col-md-6">
                                        <div class="form-group mb-3 row">
                                            <div class="col-12">
                                                <label for="tel_no" class="form-label">Telephone No.</label>
                                                <input class="form-control" name="tel_no" id="tel_no" type="tel" required
                                                    value="{{ (empty($errors->has('tel_no')))?old('tel_no',$userData->tel_no):$userData->tel_no}}">
                                                @error('tel_no')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Work Position -->
                                <div class="form-group mb-3 row">
                                    <div class="col-12">
                                        <label for="work_position" class="form-label">*Position in the Organization</label>
                                        <input class="form-control" name="work_position" id="work_position" type="text" required
                                            value="{{ (empty($errors->has('work_position')))?old('work_position',$userData->work_position):$userData->work_position}}">
                                        @error('work_position')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <h4 class="mt-4" style="color: #62896d">Current Address</h4>

                                <!-- Address Line 1 -->
                                <div class="form-group mb-3 row">
                                    <div class="col-12">
                                        <label for="address_line_one" class="form-label">*Address Line 1</label>
                                        <input class="form-control" name="address_line_one" id="address_line_one" type="text" required
                                            value="{{ (empty($errors->has('address_line_one')))?old('address_line_one',$userAddress->address_line_one):$userAddress->address_line_one}}">
                                        @error('address_line_one')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Address Line 2 -->
                                <div class="form-group mb-3 row">
                                    <div class="col-12">
                                        <label for="address_line_two" class="form-label">Address Line 2 (Optional)</label>
                                        <input class="form-control" name="address_line_two" id="address_line_two" type="text"
                                            value="{{ (empty($errors->has('address_line_two')))?old('address_line_two',$userAddress->address_line_two):$userAddress->address_line_two}}">
                                        @error('address_line_two')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group mb-3 row">
                                    <!-- Province -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="province" class="form-label">*Province</label>
                                            <input class="form-control" name="province" id="province" type="text" required
                                                value="{{ (empty($errors->has('province')))?old('province',$userAddress->province):$userAddress->province}}">
                                            @error('province')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- City -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="city" class="form-label">*City / Municipality</label>
                                            <input class="form-control" name="city" id="city" type="text" required
                                                value="{{ (empty($errors->has('city')))?old('city',$userAddress->city):$userAddress->city}}">
                                            @error('city')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-3 row">
                                    <!-- Barangay -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="barangay" class="form-label">*Barangay</label>
                                            <input class="form-control" name="barangay" id="barangay" type="text" required
                                                value="{{ (empty($errors->has('barangay')))?old('barangay',$userAddress->barangay):$userAddress->barangay}}">
                                            @error('barangay')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            </div>
                                    </div>

                                    <!-- Postal Code -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="postal_code" class="form-label">*Postal Code</label>
                                            <input class="form-control" name="postal_code" id="postal_code" type="text" required
                                                value="{{ (empty($errors->has('postal_code')))?old('postal_code',$userAddress->postal_code):$userAddress->postal_code}}">
                                            @error('postal_code')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row p-5">
                                    <ul class="list-inline mb-0 mt-4 float-end">
                                        <input type="submit" class="btn btn-dark btn-rounded w-lg waves-effect waves-light float-end" style="background-color: #62896d;" value="Save">
                                        <a class="btn list-inline-item float-end mx-4" href="{{ route('user.profile') }}">Cancel</a>
                                    </ul>
                                </div>
                            </div>
                        </form>
                    </div><!-- end cardbody -->
                </div><!-- end card -->
            </div><!-- end col -->
        </div>
        <!-- end row -->
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#profile_image').change(function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        })
    })
</script>
@endsection