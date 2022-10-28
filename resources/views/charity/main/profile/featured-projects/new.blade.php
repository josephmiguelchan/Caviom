@extends('charity.charity_master')
@section('title', 'Featured Project')
@section('charity')
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.js"></script> --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="p-2">
                    <h1 class="mb-0" style="color: #62896d"><strong>PROJECTS</strong></h1>
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item">Our Charitable Organization</li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('charity.profile') }}">Public Profile</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <a href="{{ route('charity.profile.feat-project.all') }}">Featured Projects</a>
                        </li>
                        <li class="breadcrumb-item active">New</li>
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
                                <h2><strong>Create New Featured Project</strong></h2>
                            </div>
                            <div class="col-lg-4 mt-4">
                                <a href="{{ route('charity.profile.feat-project.all') }}" class="text-link float-end">
                                    <i class="ri-arrow-left-line"></i> Go Back
                                </a>
                            </div>
                        </div>

                        <hr class="my-3">

                        <form action="{{route('charity.profile.feat-project.new.store')}}" id="add_form" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group mb-3 row">
                                <!-- Project Name -->
                                <div class="col-md-9">
                                    <label for="name" class="form-label">*Featured Project Name:</label>
                                    <input type="text" class="form-control" name="name" id="name"
                                        value="{{old('name')}}" placeholder="Enter name of the project">
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
                                            *Cover Photo
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
                                                value="{{old('started_on')}}" placeholder="Enter date of the activity">
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
                                                value="{{old('total_beneficiaries')}}" min="1" max="1000" placeholder="Choose between 1 to 1000...">
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
                                                value="{{old('sponsors')}}" placeholder="Enter sponsors...">
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
                                                value="{{old('venue')}}" placeholder="Enter venue of the project...">
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
                                        <img id="show_cover_photo" class="img-fluid rounded" alt="Cover Photo Preview" src="{{ asset('backend/assets/images/placeholder-image.jpg') }}">
                                </div>
                            </div>

                            <div class="form-group mb-5 row">
                                <!-- Project Objective -->
                                <div class="col-md-6">
                                    <label for="objective" class="form-label">*Objective:</label>
                                    <textarea id="elm1" rows="7" name="objective" placeholder="Enter your project's objective/s..."
                                        maxlength="500">
                                        {{old('objective')}}
                                    </textarea>
                                    @error('objective')
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
                                        {{old('message')}}
                                    </textarea>
                                    @error('message')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12">
                                <p class="text-muted font-size-12 mt-2">
                                    <em>
                                        Recommended image size is <strong>* 1920 x 380 </strong>
                                        Must not exceed 2MB.
                                    </em>
                                </p>
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
                                            <img id="showImage1" class="img-fluid rounded" alt="Featured Project Photo Preview" src="{{ asset('backend/assets/images/placeholder-image.jpg') }}">
                                        </div>
                                    </div>

                                    <!-- Featured Photo 2 -->
                                    <div class="col-md-2">
                                        <label for="featured_photo_1" class="form-label">Featured Photo 2</label>
                                        <input type="file" name="featured_photo_2" id="featured_photo_2" class="form-control">
                                        @error('featured_photo_2')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <!-- Preview -->
                                        <div>
                                            <img id="showImage2" class="img-fluid rounded" alt="Featured Project Photo Preview" src="{{ asset('backend/assets/images/placeholder-image.jpg') }}">
                                        </div>
                                    </div>

                                    <!-- Featured Photo 3 -->
                                    <div class="col-md-2">
                                        <label for="featured_photo_3" class="form-label">Featured Photo 3</label>
                                        <input type="file" name="featured_photo_3" id="featured_photo_3" class="form-control">
                                        @error('featured_photo_3')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <!-- Preview -->
                                        <div>
                                            <img id="showImage3" class="img-fluid rounded" alt="Featured Project Photo Preview" src="{{ asset('backend/assets/images/placeholder-image.jpg') }}">
                                        </div>
                                    </div>

                                    <!-- Featured Photo 4 -->
                                    <div class="col-md-2">
                                        <label for="featured_photo_4" class="form-label">Featured Photo 4</label>
                                        <input type="file" name="featured_photo_4" id="featured_photo_4" class="form-control">
                                        @error('featured_photo_4')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <!-- Preview -->
                                        <div>
                                            <img id="showImage4" class="img-fluid rounded" alt="Featured Project Photo Preview" src="{{ asset('backend/assets/images/placeholder-image.jpg') }}">
                                        </div>
                                    </div>

                                    <!-- Featured Photo 5 -->
                                    <div class="col-md-2">
                                        <label for="featured_photo_5" class="form-label">Featured Photo 5</label>
                                        <input type="file" name="featured_photo_5" id="featured_photo_5" class="form-control">
                                        @error('featured_photo_5')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        <!-- Preview -->
                                        <div>
                                                 <img id="showImage5" class="img-fluid rounded" alt="Featured Project Photo Preview" src="{{ asset('backend/assets/images/placeholder-image.jpg') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row px-5">
                                <ul class="list-inline mb-0 mt-4 float-end">
                                    <button type="button" class="btn btn-dark btn-rounded w-lg waves-effect waves-light float-end" data-bs-target="#bs-add-modal-center" data-bs-toggle="modal">
                                        <i class="ri-edit-2-line"></i> Submit
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

<script type="text/javascript">
    $(document).ready(function(){
        $('#featured_photo_1').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage1').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });

    $(document).ready(function(){
        $('#featured_photo_2').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage2').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });


    $(document).ready(function(){
        $('#featured_photo_3').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage3').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });

    $(document).ready(function(){
        $('#featured_photo_4').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage4').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });

    $(document).ready(function(){
        $('#featured_photo_5').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage5').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });


    $(document).ready(function(){
        $('#cover_photo').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#show_cover_photo').attr('src',e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>

@endsection