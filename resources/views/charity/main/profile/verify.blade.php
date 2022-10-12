@extends('charity.charity_master')
@section('title', 'Apply for Verification')
@section('charity')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="p-2">
                    <h1 class="mb-0" style="color: #62896d"><strong>PUBLIC PROFILE</strong></h1>
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item">Our Charitable Organization</li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('charity.profile') }}">Public Profile</a>
                        </li>
                        <li class="breadcrumb-item active">Apply for Verification</li>
                    </ol>

                    @include('charity.modals.profile')
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="p-3">

                        <div class="col-lg-12">
                            <div>
                                <a href="{{ route('charity.profile') }}" class="text-link float-end">
                                    <i class="ri-arrow-left-line"></i> Go Back
                                </a>
                                <h2><strong>APPLY FOR VERIFICATION</strong></h2>
                                <p class="mb-5">Submit valid required documents to get verified. Subject to review and approval by Caviom.</p>

                            </div>

                            <form action="" class="form-horizontal" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row">

                                    <!-- SEC Registration -->
                                    <div class="col-lg-3">
                                        <label class="form-label" for="sec_registration">SEC Registration</label>
                                        <input class="form-control" name="sec_registration" id="sec_registration" type="file">
                                        @error('sec_registration')
                                            <div class="text-danger">
                                                <small>
                                                    {{ $message }}
                                                </small>
                                            </div>
                                        @enderror
                                        <a class="image-popup-no-margins" title="SEC Registration" href="{{ asset('backend/assets/images/placeholder-image.jpg') }}">
                                            <img class="img-fluid rounded" alt="SEC Registration Photo Preview" src="{{ asset('backend/assets/images/placeholder-image.jpg') }}" width="230">
                                        </a>
                                    </div>


                                    <!-- Certificate of Registration -->
                                    <div class="col-lg-3">
                                        <label class="form-label" for="dswd_certificate">DSWD Registration</label>
                                        <input class="form-control" name="dswd_certificate" id="dswd_certificate" type="file">
                                        @error('dswd_certificate')
                                            <div class="text-danger">
                                                <small>
                                                    {{ $message }}
                                                </small>
                                            </div>
                                        @enderror
                                        <a class="image-popup-no-margins" title="DSWD Registration" href="{{ asset('backend/assets/images/placeholder-image.jpg') }}">
                                            <img class="img-fluid rounded" alt="DSWD Registration Photo Preview" src="{{ asset('backend/assets/images/placeholder-image.jpg') }}" width="230">
                                        </a>
                                    </div>

                                    <!-- Valid Government ID -->
                                    <div class="col-lg-3">
                                        <label class="form-label" for="valid_id">Valid Government ID</label>
                                        <input class="form-control" name="valid_id" id="valid_id" type="file">
                                        @error('valid_id')
                                            <div class="text-danger">
                                                <small>
                                                    {{ $message }}
                                                </small>
                                            </div>
                                        @enderror
                                        <a class="image-popup-no-margins" title="Valid Government ID" href="{{ asset('backend/assets/images/placeholder-image.jpg') }}">
                                            <img class="img-fluid rounded" alt="Valid Government ID Photo Preview" src="{{ asset('backend/assets/images/placeholder-image.jpg') }}" width="230">
                                        </a>
                                    </div>

                                    <!-- Person Holding ID -->
                                    <div class="col-lg-3">
                                        <label class="form-label" for="photo_holdind_id">Photo of you holding your ID</label>
                                        <input class="form-control" name="photo_holdind_id" id="photo_holdind_id" type="file">
                                        @error('photo_holdind_id')
                                            <div class="text-danger">
                                                <small>
                                                    {{ $message }}
                                                </small>
                                            </div>
                                        @enderror
                                        <a class="image-popup-no-margins" title="Person Holding ID" href="{{ asset('backend/assets/images/placeholder-image.jpg') }}">
                                            <img class="img-fluid rounded" alt="Person Holding ID Photo Preview" src="{{ asset('backend/assets/images/placeholder-image.jpg') }}" width="230">
                                        </a>
                                    </div>

                                </div>

                                <p class="text-muted font-size-12 mt-2">
                                    <em>
                                        <strong>Note:</strong> File size must not exceed 2mb. Only allowed file types are: PNG and JPG.
                                    </em>
                                </p>

                                <div class="row float-end">
                                    <ul class="list-inline mt-2">
                                        <input type="submit" class="btn btn-dark btn-rounded w-xl waves-effect waves-light"
                                            style="background-color: #62896d;" value="Submit">
                                    </ul>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->

    </div>

</div>

@endsection