@extends('charity.charity_master')
@section('title', 'Setup Public Profile')
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
                        <li class="breadcrumb-item">Public Profile</li>
                        <li class="breadcrumb-item active">Apply for Verification</li>
                    </ol>
                    <button type="button" data-bs-target=".bs-example-modal-center" title="Learn more" class="btn btn-link waves-effect p-0 mb-3" data-bs-toggle="modal">
                        <small>
                            <i class="mdi mdi-information"></i> Learn more about the Verification Process
                        </small>
                    </button>

                    <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">What is a Verified Public Profile?</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>
                                        Caviom administrators carefully reviews requirements submitted by
                                        Charitable Organizations before they get verified.
                                    </p>
                                    <p>
                                        Public Profiles can only be verified after any of the members have
                                        done setting up their Non-profit's profile. Once verified, their mode/s
                                        of Donation will be allowed to get displayed on their public profile.
                                    </p>
                                    <p class="mb-0">
                                        Processing of requirements usually takes 2-3 business days. We will notify
                                        you updates about your verification process via in-app notifications.
                                    </p>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="p-3">

                        <div class="col-lg-12">
                            <div class="">
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
                                    <div class="col-lg-4">
                                        <label class="form-label" for="sec_registration">SEC Registration</label>
                                        <input class="form-control" name="sec_registration" id="sec_registration" type="file">
                                        @error('sec_registration')
                                            <div class="text-danger">
                                                <small>
                                                    {{ $message }}
                                                </small>
                                            </div>
                                        @enderror
                                        <a class="image-popup-no-margins" title="Photo Story" href="{{ asset('backend/assets/images/placeholder-image.jpg') }}">
                                            <img class="img-fluid rounded" alt="Our Story's Photo Preview" src="{{ asset('backend/assets/images/placeholder-image.jpg') }}" width="230">
                                        </a>
                                    </div>


                                    <!-- Certificate of Registration -->
                                    <div class="col-lg-4">
                                        <label class="form-label" for="dswd_certificate">Certificate of Registration from DSWD</label>
                                        <input class="form-control" name="dswd_certificate" id="dswd_certificate" type="file">
                                        @error('dswd_certificate')
                                            <div class="text-danger">
                                                <small>
                                                    {{ $message }}
                                                </small>
                                            </div>
                                        @enderror
                                        <a class="image-popup-no-margins" title="Photo Story" href="{{ asset('backend/assets/images/placeholder-image.jpg') }}">
                                            <img class="img-fluid rounded" alt="Our Story's Photo Preview" src="{{ asset('backend/assets/images/placeholder-image.jpg') }}" width="230">
                                        </a>
                                    </div>

                                    <!-- Valid Government ID -->
                                    <div class="col-lg-4">
                                        <label class="form-label" for="valid_id">Valid Government ID</label>
                                        <input class="form-control" name="valid_id" id="valid_id" type="file">
                                        @error('valid_id')
                                            <div class="text-danger">
                                                <small>
                                                    {{ $message }}
                                                </small>
                                            </div>
                                        @enderror
                                        <a class="image-popup-no-margins" title="Photo Story" href="{{ asset('backend/assets/images/placeholder-image.jpg') }}">
                                            <img class="img-fluid rounded" alt="Our Story's Photo Preview" src="{{ asset('backend/assets/images/placeholder-image.jpg') }}" width="230">
                                        </a>
                                    </div>

                                </div>

                                <p class="text-muted font-size-12 mt-2">
                                    <em>
                                        <strong>Note:</strong> File size must not exceed 2mb. Only allowed file types are: PNG, JPG, and PDF.
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