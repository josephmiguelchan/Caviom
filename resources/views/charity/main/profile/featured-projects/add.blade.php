@extends('charity.charity_master')
@section('title', 'Featured Project')
@section('charity')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"></script>

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="p-2">
                    <h1 class="mb-0" style="color: #62896d"><strong>PROJECTS</strong></h1>
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('charity.profile') }}">Public Profile</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <a href="{{ route('charity.profile.feat-projects') }}">Featured Projects</a>
                        </li>
                        <li class="breadcrumb-item active">Add</li>
                    </ol>
                    @include('charity.modals.featured-projects')
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card p-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-8">
                                <h2><strong>Add to Featured Projects</strong></h2>
                            </div>
                            <div class="col-lg-4 mt-4">
                                <a href="{{ url()->previous() }}" class="text-link float-end">
                                    <i class="ri-arrow-left-line"></i> Go Back
                                </a>
                            </div>
                        </div>

                        <hr class="my-3">

                        <form action="" id="add_form" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group mb-3 row">
                                <!-- Project Name -->
                                <div class="col-md-9">
                                    <label for="name" class="form-label">*Featured Project Name:</label>
                                    <input type="text" class="form-control" name="name" id="name"
                                        value="Lugaw for a Cause" placeholder="Enter name of the project">
                                    @error('name')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Cover Photo -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="cover_photo" class="form-label">
                                            Cover Photo
                                            <span data-bs-toggle="tooltip" data-bs-placement="bottom" title="Must not exceed 2mb." data-bs-original-title="yes">
                                                <i class="mdi mdi-information-outline"></i>
                                            </span>
                                        </label>
                                        <input class="form-control" name="cover_photo" id="cover_photo" type="file">
                                        @error('cover_photo')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mb-3 row">
                                <div class="col-md-9 mb-3">
                                    <div class="row mb-3">
                                        <!-- Date of Activity -->
                                        <div class="col-md-6">
                                            <label for="started_on" class="form-label">*Date of Activity:</label>
                                            <input type="date" class="form-control" name="started_on" id="started_on"
                                                value="" placeholder="Enter date of the activity">
                                            @error('started_on')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                        <!-- No. of Beneficiaries -->
                                        <div class="col-md-6">
                                            <label for="total_beneficiaries" class="form-label">No. of Beneficiaries (Optional):</label>
                                            <input type="number" class="form-control" name="total_beneficiaries" id="total_beneficiaries"
                                                value="" min="1" max="1000" placeholder="Choose between 1 to 1000...">
                                            @error('total_beneficiaries')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <!-- Sponsors -->
                                        <div class="col-md-6">
                                            <label for="sponsors" class="form-label">Sponsors (Optional):</label>
                                            <input type="text" class="form-control" name="sponsors" id="sponsors"
                                                value="" placeholder="Enter sponsors...">
                                            @error('sponsors')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>

                                        <!-- Venue -->
                                        <div class="col-md-6">
                                            <label for="venue" class="form-label">Venue (Optional):</label>
                                            <input type="text" class="form-control" name="venue" id="venue"
                                                value="" placeholder="Enter venue of the project...">
                                            @error('venue')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Preview of Cover Photo -->
                                <div class="col-md-3">
                                    <a class="image-popup-no-margins" title="Cover Photo Preview" href="{{ asset('backend/assets/images/placeholder-image.jpg') }}">
                                        <img class="img-fluid rounded" alt="Cover Photo Preview" src="{{ asset('backend/assets/images/placeholder-image.jpg') }}">
                                    </a>
                                </div>
                            </div>

                            <div class="form-group mb-5 row">
                                <!-- Project Objective -->
                                <div class="col-md-6">
                                    <label for="objective" class="form-label">*Objective:</label>
                                    <textarea id="elm1" rows="7" name="objective" placeholder="Enter your project's objective/s..."
                                        maxlength="500">
                                        <p class="mt-4">
                                            Bottom-up, volunteer-led movement feeding program with a cause. The organization had
                                            the opportunity to make a partnership with Public Employment Service Office of the
                                            local government of Pasay. Hence this partnership allowed the organization to train 30
                                            single partents. The aim is to teach the beneficiaries how to do dressmaking and other
                                            marketable sewing crafts.
                                        </p>
                                        <p>
                                            <strong>Ace company and J&K Co.</strong> are both garments company that reached out to
                                            the organization. They need 15 workers for their factory and they see the trainees as good
                                            fit for the vacancies. Thus, the organization want to take this opportunity to provice
                                            employment for their beneficiaries.
                                        </p>
                                        <p>
                                            The unchosen trainees for the factory vacancies will have to undergo paid weekly seminar
                                            for 1 month entitle <strong>Kumit at Home</strong> by Tytan Student Entrepreneurs group of
                                            Manila Tytana Colleges.
                                        </p>
                                    </textarea>
                                    @error('name')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Thanksgiving Message -->
                                <div class="col-md-6">
                                    <label for="message" class="form-label">Thanksgiving Message (Optional):</label>
                                    <textarea id="elm2" rows="7" name="message" placeholder="Enter your thanksgiving message to the sponsors..."
                                        maxlength="500">

                                    </textarea>
                                    @error('name')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row" data-masonry='{"percentPosition": true }'>
                                <div class="form-group mb-3 row">
                                    <!-- Featured Photo 1 -->
                                    <div class="col-md-2">
                                        <label for="featured_photo_1" class="form-label">Featured Photo 1</label>
                                        <input type="file" name="featured_photo_1" id="featured_photo_1" class="form-control">
                                        @error('featured_photo_1')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <!-- Preview -->
                                        <div>
                                            <a class="image-popup-no-margins" title="Featured Project Photo Preview" href="{{ asset('backend/assets/images/placeholder-image.jpg') }}">
                                                <img id="featured_photo_1_preview" class="img-fluid rounded" alt="Featured Project Photo Preview" src="{{ asset('backend/assets/images/placeholder-image.jpg') }}">
                                            </a>
                                        </div>
                                    </div>

                                    <!-- Featured Photo 2 -->
                                    <div class="col-md-2">
                                        <label for="featured_photo_1" class="form-label">Featured Photo 2</label>
                                        <input type="file" name="featured_photo_1" id="featured_photo_1" class="form-control">
                                        @error('featured_photo_1')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <!-- Preview -->
                                        <div>
                                            <a class="image-popup-no-margins" title="Featured Project Photo Preview" href="{{ asset('backend/assets/images/placeholder-image.jpg') }}">
                                                <img id="featured_photo_2_preview" class="img-fluid rounded" alt="Featured Project Photo Preview" src="{{ asset('backend/assets/images/placeholder-image.jpg') }}">
                                            </a>
                                        </div>
                                    </div>

                                    <!-- Featured Photo 3 -->
                                    <div class="col-md-2">
                                        <label for="featured_photo_1" class="form-label">Featured Photo 3</label>
                                        <input type="file" name="featured_photo_1" id="featured_photo_1" class="form-control">
                                        @error('featured_photo_1')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <!-- Preview -->
                                        <div>
                                            <a class="image-popup-no-margins" title="Featured Project Photo Preview" href="{{ asset('backend/assets/images/placeholder-image.jpg') }}">
                                                <img id="featured_photo_3_preview" class="img-fluid rounded" alt="Featured Project Photo Preview" src="{{ asset('backend/assets/images/placeholder-image.jpg') }}">
                                            </a>
                                        </div>
                                    </div>

                                    <!-- Featured Photo 4 -->
                                    <div class="col-md-2">
                                        <label for="featured_photo_1" class="form-label">Featured Photo 4</label>
                                        <input type="file" name="featured_photo_1" id="featured_photo_1" class="form-control">
                                        @error('featured_photo_1')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <!-- Preview -->
                                        <div>
                                            <a class="image-popup-no-margins" title="Featured Project Photo Preview" href="{{ asset('backend/assets/images/placeholder-image.jpg') }}">
                                                <img id="featured_photo_4_preview" class="img-fluid rounded" alt="Featured Project Photo Preview" src="{{ asset('backend/assets/images/placeholder-image.jpg') }}">
                                            </a>
                                        </div>
                                    </div>

                                    <!-- Featured Photo 5 -->
                                    <div class="col-md-2">
                                        <label for="featured_photo_1" class="form-label">Featured Photo 5</label>
                                        <input type="file" name="featured_photo_1" id="featured_photo_1" class="form-control">
                                        @error('featured_photo_1')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <!-- Preview -->
                                        <div>
                                            <a class="image-popup-no-margins" title="Featured Project Photo Preview" href="{{ asset('backend/assets/images/placeholder-image.jpg') }}">
                                                <img id="featured_photo_5_preview" class="img-fluid rounded" alt="Featured Project Photo Preview" src="{{ asset('backend/assets/images/placeholder-image.jpg') }}">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row px-5">
                                <ul class="list-inline mb-0 mt-4 float-end">
                                    <button type="button" class="btn btn-dark btn-rounded w-lg waves-effect waves-light float-end" data-bs-target="#bs-add-modal-center"  data-bs-toggle="modal">
                                        <i class="ri-edit-2-line"></i> Add to Featured Projects
                                    </button>
                                    <a class="btn list-inline-item float-end mx-4" href="{{ url()->previous() }}">Cancel</a>
                                </ul>
                            </div>
                            <div class="float-end row p-3">
                                <p class="text-muted font-size-12 mt-2">
                                    <em>
                                        <strong>*Featured projects are subject for approval by Caviom </strong>
                                        before it can be displayed on your Charitable Organization's public profile.
                                        The processing times for approval may usually take from 2 to 3 working days.
                                    </em>
                                </p>
                            </div>

                        </form>
                    </div>
                </div>
            </div> <!-- end col -->

        </div>

    </div>
</div>

@endsection