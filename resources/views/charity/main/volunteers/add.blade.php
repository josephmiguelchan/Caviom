@extends('charity.charity_master')
@section('title', 'Add Volunteer')
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
                <div class="p-2">
                    <h1 class="mb-0" style="color: #62896d"><strong>VOLUNTEERS</strong></h1>
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item">Our Charitable Organization</li>
                        <li class="breadcrumb-item"><a href="{{ route('charity.volunteers') }}">Volunteers</a></li>
                        <li class="breadcrumb-item active">Add</li>
                    </ol>

                    @include('charity.modals.volunteers')
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-md-12">
                <div class="card p-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-8">
                                <h2><strong>Add New Volunteer</strong></h2>
                            </div>
                            <div class="col-lg-4 mt-4">
                                <a href="{{route('charity.volunteers')}}" class="text-link float-end">
                                    <i class="ri-arrow-left-line"></i> Go Back
                                </a>
                            </div>
                        </div>
                        <hr class="my-3">
                        <form method="POST" action="" enctype="multipart/form-data">
                            @csrf

                            <h4 class="mt-4" style="color: #62896d">Personal Information</h4>

                            <div class="form-group mb-3 row">
                                <!-- Profile Photo -->
                                <div class="col-md-6">
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

                                <!-- Email Address -->
                                <div class="col-md-6">
                                    <label for="email" class="form-label">*Email Address</label>
                                    <input type="email" class="form-control" name="email" id="email"
                                    value="" required>
                                    @error('email')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group mb-3 row">
                                <!-- First Name -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="first_name" class="form-label">*First Name</label>
                                        <input type="text" class="form-control" name="first_name" id="first_name"
                                            value="" required>
                                        @error('first_name')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Middle Name -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="middle_name" class="form-label">Middle Name</label>
                                        <input type="text" class="form-control" name="middle_name" id="middle_name"
                                            value="" required>
                                        @error('middle_name')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Last Name -->
                                <div class="col-md-4">
                                    <label for="last_name" class="form-label">*Last Name</label>
                                    <input type="text" class="form-control" name="last_name" id="last_name"
                                        value="" required>
                                    @error('last_name')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group mb-3 row">
                                <!-- Cellphone -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="cel_no" class="form-label">*Cellphone No.</label>
                                        <input class="form-control" name="cel_no" id="cel_no" type="tel" required
                                            value="">
                                        @error('cel_no')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Telephone -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tel_no" class="form-label">Telephone No.</label>
                                        <input class="form-control" name="tel_no" id="tel_no" type="tel" required
                                            value="">
                                        @error('tel_no')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-3 row">
                                <!-- Category -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="category" class="form-label">Category</label>
                                        <input class="form-control" name="category" id="category" type="text"
                                            value="">
                                        @error('category')
                                            <div class="text-danger"><small>
                                                {{ $message }}
                                            </small></div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Label -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="label" class="form-label">Label</label>
                                        <input class="form-control" name="label" id="label" type="text"
                                            value="">
                                        @error('label')
                                            <div class="text-danger"><small>
                                                {{ $message }}
                                            </small></div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <h4 class="mt-5" style="color: #62896d">Current Address</h4>

                            <!-- Address Line 1 -->
                            <div class="form-group mb-3 row">
                                <div class="col-12">
                                    <label for="address_line_one" class="form-label">*Address Line 1</label>
                                    <input class="form-control" name="address_line_one" id="address_line_one" type="text" required
                                        value="">
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
                                        value="">
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
                                            value="">
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
                                            value="">
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
                                            value="">
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
                                            value="">
                                        @error('postal_code')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row p-5">
                                <ul class="list-inline mb-0 mt-4 float-end">
                                    <button type="submit" class="btn btn-dark btn-rounded w-lg waves-effect waves-light float-end"><i class="ri-edit-2-line"></i> Save</button>
                                    <a class="btn list-inline-item float-end mx-4" href="{{ url()->previous() }}">Cancel</a>
                                </ul>
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