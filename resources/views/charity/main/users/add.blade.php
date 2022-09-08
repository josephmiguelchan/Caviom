@extends('charity.charity_master')
@section('title', 'Add User')
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
                    <h1 class="mb-0" style="color: #62896d"><strong>ADD USER</strong></h1>
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item">Our Charitable Organization</li>
                        <li class="breadcrumb-item"><a href="{{ route('charity.users') }}">Users</a></li>
                        <li class="breadcrumb-item active">Add</li>
                    </ol>

                    @include('charity.modals.users')

                    @include('charity.modals.toc.terms-of-service')
                    @include('charity.modals.toc.privacy-policy')

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
                                <h2><strong>Add New Charity User</strong></h2>
                            </div>
                            <div class="col-lg-4 mt-4">
                                <a href="{{route('charity.users')}}" class="text-link float-end">
                                    <i class="ri-arrow-left-line"></i> Go Back
                                </a>
                            </div>
                        </div>
                        <hr class="my-3">
                        <form method="POST" action="" enctype="multipart/form-data" id="add_form">
                            @csrf

                            <h4 class="mt-4" style="color: #62896d">Account</h4>

                            <div class="form-group mb-3 row">
                                <!-- User Role -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="user_role" class="form-label">*Account Type</label>
                                        <button type="button" data-bs-target=".bs-example-modal-center" title="Learn more" class="btn btn-sm btn-link" data-bs-toggle="modal">
                                            <i class="mdi mdi-information-outline"></i> What are Account Types?
                                        </button>
                                        <select class="form-control select2-search-disable" name="user_role" id="user_role">
                                            <option selected disabled>Select an Account Type</option>
                                            <option value="Charity Admin">Charity Admin ( 2000 Star Tokens )</option>
                                            <option value="Charity Associate">Charity Associate ( 1500 Star Tokens )</option>
                                        </select>
                                        @error('user_role')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Charitable Organization -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="charitable_organization" class="form-label">Charitable Organization</label>
                                        <input class="form-control" id="charitable_organization" type="text"
                                            value="{{ Auth::user()->charity->name }}" disabled readonly>
                                    </div>
                                </div>

                                <!-- Organizational ID No. -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="organizational_id_no" class="form-label">
                                            Organizational ID Number (Permanent)
                                            <span data-bs-toggle="tooltip" data-bs-placement="bottom" title="Leave blank if you wish to autogenerate a 10-digit ID No.
                                                It must consist of numbers only (No character / Special Symbols).
                                                Maximum length of ID must be up to 10 digits only. Each ID no. must be unique in the Charitable Organization." data-bs-original-title="yes">
                                                <i class="mdi mdi-information-outline"></i>
                                            </span>
                                        </label>
                                        <input class="form-control" name="organizational_id_no" id="organizational_id_no" type="text"
                                            placeholder="@unless($errors->any())(Leave blank if you wish to auto-generate your ID no.) @endunless"
                                            value="{{ old('organizational_id_no') }}">
                                        @error('organizational_id_no')
                                            <div class="text-danger">
                                                <small>
                                                    {{ $message }}
                                                </small>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

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
                                    <label for="email" class="form-label">*Email Address (Permanent)</label>
                                    <input type="email" class="form-control" name="email" id="email"
                                    value="" placeholder="@unless($errors->any())Enter the email address where the link will be sent to @endunless">
                                    @error('email')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group mb-3 row">
                                <!-- Password -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password" class="form-label">
                                            *Temporary Password
                                            <span data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                title="Password must have at least 8-20 characters with a symbol, a number, an uppercase and a lowercase letter."
                                                data-bs-original-title="yes">
                                                <i class="mdi mdi-information-outline"></i>
                                            </span>
                                        </label>
                                        <input class="form-control" name="password" id="password" type="password"
                                            placeholder="Enter password" value="">

                                        @error('password')
                                            <div class="text-danger">
                                                <small>
                                                    {{ $message }}
                                                </small>
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Confirm Password -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password_confirmation" class="form-label">*Confirm Password</label>
                                        <input class="form-control" name="password_confirmation" data-parsley-equalto="#password"
                                            id="password_confirmation" type="password" placeholder="Retype password">
                                        @error('password_confirmation')
                                            <div class="text-danger">
                                                <small>
                                                    {{ $message }}
                                                </small>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="p3">
                                <div class="alert alert-primary alert-dismissible fade show p-4" role="alert">
                                    <p class="font-size-15 mb-1"><strong>Temporary password must contain at least:</strong></p>
                                    <ul class="mb-0">
                                        <li>8-20 characters</li>
                                        <li>one uppercase and one lowercase letter</li>
                                        <li>one symbol</li>
                                        <li>one number</li>
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            </div>

                            <h4 class="mt-5" style="color: #62896d">Personal Information</h4>

                            <div class="form-group mb-3 row">
                                <!-- First Name -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="first_name" class="form-label">*First Name</label>
                                        <input type="text" class="form-control" name="first_name" id="first_name"
                                            value="" placeholder="@unless($errors->any())Enter first name @endunless">
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
                                        <label for="middle_name" class="form-label">Middle Name (Optional)</label>
                                        <input type="text" class="form-control" name="middle_name" id="middle_name"
                                            value="" placeholder="@unless($errors->any())Enter middle name @endunless">
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
                                        value="" placeholder="@unless($errors->any())Enter last name @endunless">
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
                                        <input class="form-control" name="cel_no" id="cel_no" type="tel"
                                            value="" placeholder="@unless($errors->any())Enter mobile number @endunless">
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
                                        <input class="form-control" name="tel_no" id="tel_no" type="tel"
                                            value="" placeholder="@unless($errors->any())Enter telephone number @endunless">
                                        @error('tel_no')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <h4 class="mt-5" style="color: #62896d">Current Address</h4>

                            <!-- Address Line 1 -->
                            <div class="form-group mb-3 row">
                                <div class="col-12">
                                    <label for="address_line_one" class="form-label">*Address Line 1</label>
                                    <input class="form-control" name="address_line_one" id="address_line_one" type="text"
                                        value="" placeholder="@unless($errors->any())Enter street no, street address, building name, etc.  @endunless">
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
                                        value="" placeholder="@unless($errors->any())Enter apartment, unit, building, floor no, etc. @endunless">
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
                                        <input class="form-control" name="province" id="province" type="text"
                                            value="" placeholder="@unless($errors->any())Enter province @endunless">
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
                                        <input class="form-control" name="city" id="city" type="text"
                                            value="" placeholder="@unless($errors->any())Enter city @endunless">
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
                                        <input class="form-control" name="barangay" id="barangay" type="text"
                                            value="" placeholder="@unless($errors->any())Enter barangay @endunless">
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
                                        <input class="form-control" name="postal_code" id="postal_code" type="text"
                                            value="" placeholder="@unless($errors->any())Enter postal code @endunless">
                                        @error('postal_code')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Term & Conditions -->
                            <div class="row">
                                <div class="col-12 mt-4 text-center">
                                    <label class="form-label m-0 fw-normal" for="is_agreed">By creating an account, I have read and agree to Caviom's
                                        <a href="javascript: void(0);" data-bs-toggle="modal" data-bs-target="#terms_of_service" class="text-link"><strong>Terms of Service</strong></a> and
                                        <a href="javascript: void(0);" data-bs-toggle="modal" data-bs-target="#privacy_policy" class="btn-link"><strong>Privacy Policy</strong></a>.
                                    </label>
                                </div>
                            </div>

                            <div class="row p-5">
                                <ul class="list-inline mb-0 float-end">
                                    <button type="button" class="btn btn-dark btn-rounded w-xl waves-effect waves-light float-end" data-bs-target="#bs-register-modal-center"  data-bs-toggle="modal">
                                        <i class="ri-user-add-line"></i> Create Account
                                    </button>
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
    }),
</script>
@endsection