@extends('charity.charity_master')
@section('title', 'Projects')
@section('charity')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="p-2">
                    <h1 class="mb-0" style="color: #62896d"><strong>PROJECTS</strong></h1>
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item">Our Charitable Organization</li>
                        <li class="breadcrumb-item active">Projects</li>
                    </ol>
                    @include('charity.modals.projects')
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="col-12">
            <div class="card p-3">
                <div class="card-body">
                    <div class="float-end mt-4 mb-2">
                        @if(Auth::user()->role == "Charity Admin")
                            <a href="{{ route('charity.projects.add') }}" class="btn btn-rounded btn-sm w-lg btn-success waves-effect waves-light">
                                <i class="mdi mdi-plus-circle-outline"></i> Add New
                            </a>
                        @endif
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <h2><strong>Projects</strong></h2>
                            <p class="mb-2">List of All Projects</p>
                        </div>
                    </div>
                </div>

                <div class="row px-4">
                    <div class="col-sm-12">
                        <div class="row" data-masonry='{"percentPosition": true }'>
                            <div class="col-lg-4 px-4">
                                <div class="card">
                                    <img class="card-img-top img-fluid" src="{{ asset('upload/test_files/lugaw-for-a-cause.webp') }}" alt="Project #1">
                                    <div class="card-body">
                                        <h4 class="card-title">Lugaw for a Cause</h4>
                                        <p class="card-text">A bottom-up, volunteer-led movement feeding program
                                            with a cause...</p>
                                        <div class="mx-3">
                                            <p class="card-text my-0 mt-3">
                                                <i class="ri-checkbox-blank-circle-fill font-size-10 text-warning align-middle me-2"></i> 4 Pending Tasks
                                            </p>
                                            <p class="card-text my-0">
                                                <i class="ri-checkbox-blank-circle-fill font-size-10 text-primary align-middle me-2"></i> 50 In-progress Tasks
                                            </p>
                                            <p class="card-text my-0 mb-3">
                                                <i class="ri-checkbox-blank-circle-fill font-size-10 text-success align-middle me-2"></i> 21 Finished Tasks
                                            </p>
                                        </div>
                                            <p class="card-text">
                                                <small class="text-muted">Last updated 3 mins ago</small>
                                            </p>
                                            <a href="{{ route('charity.projects.view') }}" class="btn btn-dark waves-effect waves-light w-100">
                                                <i class="mdi mdi-open-in-new"></i> View Project
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 px-4">
                                <div class="card">
                                    <img class="card-img-top img-fluid" src="{{ asset('upload/test_files/values-formation.jpg') }}" alt="Project #2">
                                    <div class="card-body">
                                        <h4 class="card-title">Values Formation</h4>
                                        <p class="card-text">A seminar held as part of remedial reading joint
                                            project of RC Pasay South. It is a one-hour a day program about...</p>
                                        <div class="mx-3">
                                            <p class="card-text my-0 mt-3">
                                                <i class="ri-checkbox-blank-circle-fill font-size-10 text-warning align-middle me-2"></i> 12 Pending Tasks
                                            </p>
                                            <p class="card-text my-0">
                                                <i class="ri-checkbox-blank-circle-fill font-size-10 text-primary align-middle me-2"></i> 16 In-progress Tasks
                                            </p>
                                            <p class="card-text my-0 mb-3">
                                                <i class="ri-checkbox-blank-circle-fill font-size-10 text-success align-middle me-2"></i> 31 Finished Tasks
                                            </p>
                                            </div>
                                            <p class="card-text">
                                                <small class="text-muted">Last updated 3 mins ago</small>
                                            </p>
                                        <a href="#" class="btn btn-dark waves-effect waves-light w-100">
                                            <i class="mdi mdi-open-in-new"></i> View Project
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 px-4">
                                <div class="card">
                                    <img class="card-img-top img-fluid" src="{{ asset('upload/test_files/feeding-program.jpg') }}" alt="Project #3">
                                    <div class="card-body">
                                        <h4 class="card-title">Children Feeding Program</h4>
                                        <p class="card-text">A project held for feeding programs to better address the scarcity of
                                            nutritious food available to children of Brgy...</p>
                                        <div class="mx-3">
                                            <p class="card-text my-0 mt-3">
                                                <i class="ri-checkbox-blank-circle-fill font-size-10 text-warning align-middle me-2"></i> 0 Pending Tasks
                                            </p>
                                            <p class="card-text my-0">
                                                <i class="ri-checkbox-blank-circle-fill font-size-10 text-primary align-middle me-2"></i> 1 In-progress Tasks
                                            </p>
                                            <p class="card-text my-0 mb-3">
                                                <i class="ri-checkbox-blank-circle-fill font-size-10 text-success align-middle me-2"></i> 53 Finished Tasks
                                            </p>
                                            </div>
                                            <p class="card-text">
                                                <small class="text-muted">Last updated 3 mins ago</small>
                                            </p>
                                        <a href="#" class="btn btn-dark waves-effect waves-light w-100">
                                            <i class="mdi mdi-open-in-new"></i> View Project
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 px-4">
                                <div class="card">
                                    <img class="card-img-top img-fluid" src="{{ asset('backend/assets/images/small/img-5.jpg') }}" alt="Project #4">
                                    <div class="card-body">
                                        <h4 class="card-title">Project Title</h4>
                                        <p class="card-text">Long project description cut short into 1-2 sentence(s)...</p>
                                        <div class="mx-3">
                                            <p class="card-text my-0 mt-3">
                                                <i class="ri-checkbox-blank-circle-fill font-size-10 text-warning align-middle me-2"></i> 4 Pending Tasks
                                            </p>
                                            <p class="card-text my-0">
                                                <i class="ri-checkbox-blank-circle-fill font-size-10 text-primary align-middle me-2"></i> 50 In-progress Tasks
                                            </p>
                                            <p class="card-text my-0 mb-3">
                                                <i class="ri-checkbox-blank-circle-fill font-size-10 text-success align-middle me-2"></i> 21 Finished Tasks
                                            </p>
                                            </div>
                                            <p class="card-text">
                                                <small class="text-muted">Last updated 3 mins ago</small>
                                            </p>
                                        <a href="#" class="btn btn-dark waves-effect waves-light w-100">
                                            <i class="mdi mdi-open-in-new"></i> View Project
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 px-4">
                                <div class="card">
                                    <img class="card-img-top img-fluid" src="{{ asset('backend/assets/images/small/img-4.jpg') }}" alt="Project #5">
                                    <div class="card-body">
                                        <h4 class="card-title">Project Title</h4>
                                        <p class="card-text">Long project description cut short into 1-2 sentence(s)...</p>
                                        <div class="mx-3">
                                            <p class="card-text my-0 mt-3">
                                                <i class="ri-checkbox-blank-circle-fill font-size-10 text-warning align-middle me-2"></i> 4 Pending Tasks
                                            </p>
                                            <p class="card-text my-0">
                                                <i class="ri-checkbox-blank-circle-fill font-size-10 text-primary align-middle me-2"></i> 50 In-progress Tasks
                                            </p>
                                            <p class="card-text my-0 mb-3">
                                                <i class="ri-checkbox-blank-circle-fill font-size-10 text-success align-middle me-2"></i> 21 Finished Tasks
                                            </p>
                                            </div>
                                            <p class="card-text">
                                                <small class="text-muted">Last updated 3 mins ago</small>
                                            </p>
                                        <a href="#" class="btn btn-dark waves-effect waves-light w-100">
                                            <i class="mdi mdi-open-in-new"></i> View Project
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->


    </div>

</div>

@endsection