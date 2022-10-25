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

                            @php
                                $default = 'backend/assets/images/placeholder-image.jpg';
                                $path = 'upload/charitable_org/requirements/';
                            @endphp

                            <form action="{{ route('charity.profile.apply')}}" class="form-horizontal" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="row">

                                    <!-- SEC Registration -->
                                    <div class="col-lg-3">
                                        <label class="form-label" for="sec_registration">*SEC Registration</label>
                                        <input class="form-control" name="sec_registration" id="sec_registration" type="file">
                                        @error('sec_registration')
                                            <div class="text-danger">
                                                <small>
                                                    {{ $message }}
                                                </small>
                                            </div>
                                        @enderror
                                        <img class="img-fluid rounded mt-2" id="showSECImage" alt="SEC Registration Photo Preview" width="290"
                                            src="{{ asset($default) }}">
                                    </div>


                                    <!-- Certificate of Registration -->
                                    <div class="col-lg-3">
                                        <label class="form-label" for="dswd_certificate">*DSWD Registration</label>
                                        <input class="form-control" name="dswd_certificate" id="dswd_certificate" type="file">
                                        @error('dswd_certificate')
                                            <div class="text-danger">
                                                <small>
                                                    {{ $message }}
                                                </small>
                                            </div>
                                        @enderror
                                            <img class="img-fluid rounded mt-2" id="showDSWDImage" alt="DSWD Registration Photo Preview" width="290"
                                                src="{{ asset($default) }}">
                                    </div>

                                    <!-- Valid Government ID -->
                                    <div class="col-lg-3">
                                        <label class="form-label" for="valid_id">*Valid Government ID</label>
                                        <input class="form-control" name="valid_id" id="valid_id" type="file">
                                        @error('valid_id')
                                            <div class="text-danger">
                                                <small>
                                                    {{ $message }}
                                                </small>
                                            </div>
                                        @enderror
                                        <img class="img-fluid rounded mt-2" id="showIDImage" alt="Valid Government ID Photo Preview" width="290"
                                            src="{{ asset($default) }}">
                                    </div>

                                    <!-- Person Holding ID -->
                                    <div class="col-lg-3">
                                        <label class="form-label" for="photo_holding_id">*Photo of you holding your ID</label>
                                        <input class="form-control" name="photo_holding_id" id="photo_holding_id" type="file">
                                        @error('photo_holding_id')
                                            <div class="text-danger">
                                                <small>
                                                    {{ $message }}
                                                </small>
                                            </div>
                                        @enderror
                                        <img class="img-fluid rounded mt-2" id="showHoldingIDImage" alt="Person Holding ID Photo Preview" width="290"
                                            src="{{ asset($default) }}">
                                    </div>

                                </div>

                                <p class="text-muted font-size-12 mt-2">
                                    <em>
                                        <strong>Note:</strong> File size must not exceed 2mb per file. Only allowed file types are: JPEG, PNG and JPG.
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

<script type="text/javascript">
    $(document).ready(function() {
        $('#sec_registration').change(function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#showSECImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
        $('#dswd_certificate').change(function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#showDSWDImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
        $('#valid_id').change(function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#showIDImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
        $('#photo_holding_id').change(function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#showHoldingIDImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>

@endsection