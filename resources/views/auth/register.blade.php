@extends('auth_master')
@section('title', 'Register')
@section('auth')

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-5">
            <div class="text-center">
                <img src="{{ asset('backend/assets/images/auth/register-1.svg') }}" style="height: 30vh;" class="mt-4">
                <h6 class="mt-3">
                    <h1 style="color: #62896d"><strong>WELCOME</strong></h1>
                    <ul class="list-inline px-5">
                        <li class="list-inline-item">Philantropists, Charity Founders, Fundraisers, Aspring Givers in general..</li>
                    </ul>
                </h6>
            </div>
            <div class="my-4 px-5">
                <h2><strong>What is a Charity Admin?</strong></h2>
                <p class="fst-normal">
                    Charity Admin is a type of <b>user role</b> of the platform alongside with Charity Asscoiate.
                    Charity Admin has the <b>highest level of access on CAVIOM</b> compared to the latter. Hence,
                    <b>capable of using all the features</b> available in the platform.
                </p>
            </div>
        </div>
        <div class="col-sm-7">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 p-5">

                            @include('charity.modals.toc.terms-of-service')
                            @include('charity.modals.toc.privacy-policy')

                            <!-- Confirm Modal of Register -->
                            <div id="registerModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="myModalLabel"><i class="mdi mdi-alert-outline me-2"></i> Warning</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Please double check the provided information as you cannot change
                                                some information in the future. Continue?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-light waves-effect w-sm" data-bs-dismiss="modal">No</button>
                                            <button type="submit" form="registrationForm" class="btn btn-dark waves-effect waves-light w-sm">Yes</button>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div>

                            <div class="p-2">
                                <form class="form-horizontal" id="registrationForm"
                                    action="{{ route('register') }}" method="POST" novalidate enctype='multipart/form-data'>
                                    @csrf

                                    <h1 style="color: #62896d"><strong>REGISTER</strong></h1>

                                    <h4 class="mt-4" style="color: #62896d">Personal Information</h4>

                                    <div class="form-group mb-3 row">
                                        <!-- First Name -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="first_name" class="form-label">*First Name</label>
                                                <input type="text" class="form-control" name="first_name" id="first_name" placeholder="@unless($errors->any())Ex. Juan @endunless"
                                                    value="{{ old('first_name') }}" required>
                                                @error('first_name')
                                                    <div class="text-danger">
                                                        <small>
                                                            {{ $message }}
                                                        </small>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Middle Name -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="middle_name" class="form-label">Middle Name</label>
                                                <input type="text" class="form-control" name="middle_name" id="middle_name"
                                                    placeholder="@unless($errors->any())Ex. De La @endif" value="{{ old('middle_name') }}">
                                                @error('middle_name')
                                                    <div class="text-danger">
                                                        <small>
                                                            {{ $message }}
                                                        </small>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Last Name -->
                                    <div class="row form-group mb-3">
                                        <div class="col-md-12">
                                            <label for="last_name" class="form-label">*Last Name</label>
                                            <input type="text" class="form-control" name="last_name" id="last_name" placeholder="@unless($errors->any())Ex. Cruz @endunless"
                                            value="{{ old('last_name') }}" required>
                                            @error('last_name')
                                                <div class="text-danger">
                                                    <small>
                                                        {{ $message }}
                                                    </small>
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
                                                    <span data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="yes" title="Ex. +63 998 123 4567">
                                                        <i class="mdi mdi-information-outline"></i>
                                                    </span>
                                                    <input class="form-control input-mask" name="cel_no" id="cel_no" type="tel"
                                                        placeholder="Ex. +63 998 123 4567" required
                                                        value="{{ old('cel_no') }}" data-inputmask="'mask': '+63 \\999 999 9999'">
                                                    @error('cel_no')
                                                        <div class="text-danger">
                                                            <small>
                                                                {{ $message }}
                                                            </small>
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
                                                    <span data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="yes"
                                                        title="Ex. +632 8123 6789">
                                                        <i class="mdi mdi-information-outline"></i>
                                                    </span>
                                                    <input class="form-control input-mask" name="tel_no" id="tel_no" type="tel" required
                                                        placeholder="Ex. +632 8123 6789" value="{{ old('tel_no') }}"
                                                        data-inputmask="'mask': '+632 8999 9999'">
                                                    @error('tel_no')
                                                        <div class="text-danger">
                                                            <small>
                                                                {{ $message }}
                                                            </small>
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
                                            <input class="form-control" name="work_position" id="work_position" type="text"
                                                placeholder="@unless($errors->any())Ex. Head / President / Founder / Director @endunless" required
                                                value="{{ old('work_position') }}">
                                            @error('work_position')
                                                <div class="text-danger">
                                                    <small>
                                                        {{ $message }}
                                                    </small>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Organizational ID No. -->
                                    <div class="form-group mb-3 row">
                                        <div class="col-12">
                                            <label for="organizational_id_no" class="form-label">
                                                Your 10-Digit Organizational ID No. (Permanent)
                                                <span data-bs-toggle="tooltip" data-bs-placement="bottom" title="It must consist of numbers only and should
                                                    only be exactly 10 digits. Ex. 0000123456." data-bs-original-title="yes">
                                                    <i class="mdi mdi-information-outline"></i>
                                                </span>
                                            </label>
                                            <input class="form-control input-mask" name="organizational_id_no" id="organizational_id_no" type="tel"
                                                placeholder="(Leave blank if you wish to auto-generate your ID no.)"
                                                value="{{ old('organizational_id_no') }}" data-inputmask="'mask': '9999999999'">
                                            @error('organizational_id_no')
                                                <div class="text-danger">
                                                    <small>
                                                        {{ $message }}
                                                    </small>
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
                                                placeholder="@unless($errors->any())Ex. 1123 Kahoy St. @endunless"
                                                value="{{ old('address_line_one') }}">
                                            @error('address_line_one')
                                                <div class="text-danger">
                                                    <small>
                                                        {{ $message }}
                                                    </small>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Address Line 2 -->
                                    <div class="form-group mb-3 row">
                                        <div class="col-12">
                                            <label for="address_line_two" class="form-label">Address Line 2 (Optional)</label>
                                            <input class="form-control" name="address_line_two" id="address_line_two" type="text"
                                                placeholder="@unless($errors->any())Ex. Unit 34B 4th Floor @endunless"
                                                value="{{ old('address_line_two') }}">
                                            @error('address_line_two')
                                                <div class="text-danger">
                                                    <small>
                                                        {{ $message }}
                                                    </small>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group mb-3 row">
                                        <!-- Region -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="region" class="form-label">*Region</label>
                                                <input class="form-control" name="region" id="region" type="text" required
                                                    placeholder="@unless($errors->any())Ex. NCR @endunless"
                                                    value="{{ old('region') }}">
                                                @error('region')
                                                    <div class="text-danger">
                                                        <small>
                                                            {{ $message }}
                                                        </small>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- Province -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="province" class="form-label">*Province</label>
                                                <input class="form-control" name="province" id="province" type="text" required
                                                    placeholder="@unless($errors->any())Ex. Metro Manila @endunless"
                                                    value="{{ old('province') }}">
                                                @error('province')
                                                    <div class="text-danger">
                                                        <small>
                                                            {{ $message }}
                                                        </small>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>

                                        <!-- City -->
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="city" class="form-label">*City / Municipality</label>
                                                <input class="form-control" name="city" id="city" type="text"
                                                    placeholder="@unless($errors->any())Ex. Manila City @endunless"
                                                    value="{{ old('city') }}">
                                                @error('city')
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
                                        <!-- Barangay -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="barangay" class="form-label">*Barangay</label>
                                                <input class="form-control" name="barangay" id="barangay" type="text"
                                                    placeholder="@unless($errors->any())Ex. Brgy. 204 @endunless"
                                                    value="{{ old('barangay') }}">
                                                @error('barangay')
                                                    <div class="text-danger">
                                                        <small>
                                                            {{ $message }}
                                                        </small>
                                                    </div>
                                                @enderror
                                                </div>
                                        </div>

                                        <!-- Postal Code -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="postal_code" class="form-label">*Postal Code</label>
                                                <span data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ex. 1013" data-bs-original-title="yes">
                                                    <i class="mdi mdi-information-outline"></i>
                                                </span>
                                                <input class="form-control input-mask" name="postal_code" id="postal_code" type="tel" required
                                                    placeholder="@unless($errors->any())Ex. 1013 @endunless"
                                                    value="{{ old('postal_code') }}" data-inputmask="'mask': '9999'">
                                                @error('postal_code')
                                                    <div class="text-danger">
                                                        <small>
                                                            {{ $message }}
                                                        </small>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <h4 class="mt-4" style="color: #62896d">Login Details</h4>

                                    <!-- Charitable Organization Name -->
                                    <div class="form-group mb-3 row">
                                        <div class="col-12">
                                            <label for="name" class="form-label">*Name of your Charitable Organization (Permanent)</label>
                                            <span data-bs-toggle="tooltip" data-bs-placement="bottom" title="Kindly double check as this will no longer be editable." data-bs-original-title="yes">
                                                <i class="mdi mdi-information-outline"></i>
                                            </span>
                                            <input class="form-control" name="name" id="name" type="text" required
                                                placeholder="@unless($errors->any())Ex. My Charitable Organization, Inc. @endunless"
                                                value="{{ old('name') }}">
                                            @error('name')
                                                <div class="text-danger">
                                                    <small>
                                                        {{ $message }}
                                                    </small>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Username -->
                                    <div class="form-group mb-3 row">
                                        <div class="col-12">
                                            <label for="username" class="form-label">
                                                *Username (Permanent)
                                                <span data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                    title="You cannot change your username once you create one. Make sure it is appropriate."
                                                    data-bs-original-title="yes">
                                                    <i class="mdi mdi-information-outline"></i>
                                                </span>
                                            </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="username">@</span>
                                                </div>
                                                <input type="text" class="form-control" name="username" id="username"
                                                    placeholder="@unless($errors->any())Ex. juan.delacruz @endunless"
                                                    aria-describedby="validationTooltipUsernamePrepend"
                                                    value="{{ old('username') }}" required>
                                            </div>
                                            @error('username')
                                                <div class="text-danger">
                                                    <small>
                                                        {{ $message }}
                                                    </small>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Profile Photo -->
                                    {{-- <div class="form-group mb-3 row">
                                        <div class="col-12">
                                            <label for="profile_photo" class="form-label">Profile Photo (Optional)</label>
                                            <input class="form-control" name="profile_photo" id="profile_photo" type="file">
                                            @error('profile_photo')
                                                <div class="text-danger">
                                                    <small>
                                                        {{ $message }}
                                                    </small>
                                                </div>
                                            @enderror
                                        </div>
                                    </div> --}}

                                    <!-- Email Address -->
                                    <div class="form-group mb-3 row">
                                        <div class="col-12">
                                            <label for="email" class="form-label">*Email Adress (Permanent)</label>
                                            <input class="form-control" name="email" id="email" type="email"
                                                placeholder="@unless($errors->any())Ex. juan.delacruz@mycharity.org @endunless"
                                                value="{{ old('email') }}" required>
                                            @error('email')
                                                <div class="text-danger">
                                                    <small>
                                                        {{ $message }}
                                                    </small>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="form-group mb-3 row">
                                        <div class="p3">
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

                                        <!-- Password -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="password" class="form-label">
                                                    *Password
                                                    <span data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                        title="Password must have at least 8-20 characters with a symbol, a number, an uppercase and a lowercase letter."
                                                        data-bs-original-title="yes">
                                                        <i class="mdi mdi-information-outline"></i>
                                                    </span>
                                                </label>
                                                <input class="form-control" name="password" id="password" type="password" required
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
                                                    id="password_confirmation" type="password" placeholder="Retype password" required>
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

                                    <!-- Term & Conditions -->
                                    <div class="form-check mb-3 row">
                                        <div class="col-12">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="is_agreed" class="form-check-input" id="is_agreed" required>
                                                <label class="form-label ms-1 fw-normal" for="is_agreed">I agree to Caviom's
                                                    <a href="javascript: void(0);" data-bs-toggle="modal" data-bs-target="#terms_of_service" class="text-link"><strong>Terms of Service</strong></a> and
                                                    <a href="javascript: void(0);" data-bs-toggle="modal" data-bs-target="#privacy_policy" class="btn-link"><strong>Privacy Policy</strong></a>.
                                                </label>
                                                @error('is_agreed')
                                                    <div class="text-danger">
                                                        <small>
                                                            {{ $message }}
                                                        </small>
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group text-center row mt-3 pt-1">
                                        <div class="col-12">
                                            <button class="btn btn-dark btn-rounded w-100 waves-effect waves-light" type="button" style="background-color: #62896d"
                                                data-bs-toggle="modal" data-bs-target="#registerModal">
                                                Create Account
                                            </button>
                                        </div>
                                    </div>

                                    <div class="form-group mt-2 mb-0 row">
                                        <div class="col-12 mt-2 text-center">
                                            <a href="{{ route('login') }}" class="text-muted">Already have account?</a>
                                        </div>
                                    </div>
                                </form>
                                <!-- end form -->
                            </div>
                            <!-- end -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end card -->
</div>

<!-- Form Validation JS -->
{{-- <script src="{{ asset('backend/assets/libs/parsleyjs/parsley.min.js') }}"></script> --}}
{{-- <script src="{{ asset('backend/assets/js/pages/form-validation.init.js') }}"></script> --}}

@endsection