@extends('charity.charity_master')
@section('title', 'Edit Volunteer')
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
                        <li class="breadcrumb-item active">Edit</li>
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
                            <a href="{{ url()->previous() }}" class="text-link">
                                <i class="ri-arrow-left-line"></i> Go Back
                            </a>
                        </div>
                        <div class="text-center">
                            <div class="user-profile text-center mt-3">
                                <div class="">
                                    <img src="{{ (!empty(Auth::user()->profile_image))? url($avatar):url($defaultAvatar) }}"
                                        alt="Profile Picture" class="avatar-xl rounded-circle" id="showImage">
                                </div>
                                <div class="mt-3">
                                    <p class="text-muted mb-1"><span class="badge bg-light">ID No. 1</span></p>
                                    <h1 class="py-3" style="color: #62896d">
                                        <strong>
                                            {{-- {{ Auth::user()->info->last_name . ', ' . Auth::user()->info->first_name }}
                                            @if (Auth::user()->info->middle_name)
                                            {{
                                                ' ' . Str::substr(Auth::user()->info->middle_name, 0, 1) . '.'
                                            }}
                                            @endif --}}
                                            Laurel, Loius Kyle Ilagan
                                        </strong>
                                    </h1>
                                </div>
                            </div>
                        </div>
                        <div class="row px-5">
                            <dl class="row col-lg-6">
                                <dt class="col-md-6"><h4 class="font-size-15"><strong>Date Added:</strong></h4></dt>
                                <dt class="col-md-6">{{ Carbon\Carbon::parse(Auth::user()->created_at)->toFormattedDateString() }}</dt>
                            </dl>
                            <dl class="row col-lg-6">
                                <dt class="col-md-6"><h4 class="font-size-15"><strong>Last Updated at:</strong></h4></dt>
                                <dt class="col-md-6">{{ Carbon\Carbon::parse(Auth::user()->updated_at)->diffForHumans() }}</dt>
                                <dt class="col-md-6"><h4 class="font-size-15"><strong>Last Updated by:</strong></h4></dt>
                                <dt class="col-md-6">N/a</dt>
                            </dl>
                            <hr class="my-3">
                            <form method="POST" action="" enctype="multipart/form-data" class="form-horizontal">
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
                                        value="louis_kyle@gmail.com" required>
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
                                                value="Loius Kyle" required>
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
                                                value="Ilagan" required>
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
                                        value="Laurel" required>
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
                                                value="09981235678">
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
                                                value="82571234">
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
                                                value="Parent Volunteers">
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
                                                value="Head Volunteer">
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
                                            value="113 Epifanio Santos Ave.">
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
                                                value="Metro Manila">
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
                                                value="Pasay City">
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
                                                value="Brgy. Santolan">
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
                                                value="1021">
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
                                        <input type="submit" class="btn btn-dark btn-rounded w-lg waves-effect waves-light float-end" style="background-color: #62896d;" value="Save">
                                        <a class="btn list-inline-item float-end mx-4" href="{{ url()->previous() }}">Cancel</a>
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