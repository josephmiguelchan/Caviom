@extends('charity.charity_master')
@section('title', 'View Project')
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
                        <li class="breadcrumb-item"><a href="{{ route('charity.projects') }}">Projects</a></li>
                        <li class="breadcrumb-item active">View</li>
                    </ol>

                    @include('charity.modals.projects')
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="col-12">
            <div class="card">
                <div class="card-body p-5">
                    <div class="row">
                        <div class="col-lg-4">
                            <a href="{{route('charity.projects')}}" class="text-link">
                                <i class="ri-arrow-left-line"></i> Go Back
                            </a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="bg-secondary rounded mt-3">
                                <a class="image-popup-vertical-fit" title="Lugaw for a Cause (Cover Photo)" href="{{ asset('upload/test_files/lugaw-for-a-cause.webp') }}">
                                    <div id="carouselExampleCaption" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-inner" role="listbox">
                                            <div class="carousel-item active">
                                                <img src="{{ asset('upload/test_files/lugaw-for-a-cause.webp') }}" class="rounded"
                                                    style="width: 100%; height: 30vh; object-fit: cover; opacity:.4;"
                                                    alt="Cover Photo of Project: Lugaw for a Cause">
                                                <div class="carousel-caption d-none d-md-block text-white-50 my-4">
                                                    <h2 class="text-white"><strong>LUGAW FOR A CAUSE</strong></h2>
                                                    <p>May 20, 2022</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
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
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-lg-8">
                            <dl class="row col-md-12">
                                <dt class="col-md-4"><h4 class="font-size-15"><strong>Last updated:</strong></h4></dt>
                                <dt class="col-md-8">Just now</dt>
                            </dl>
                        </div>
                        <div class="col-lg-4">
                            @if(Auth::user()->role == "Charity Admin")
                                <ul class="list-inline mb-0 float-end">
                                    <button type="button" class="btn btn-primary waves-effect w-xl waves-light mb-2">
                                        <i class="mdi mdi-star-outline"></i> Feature Project
                                    </button>
                                    <button type="button" class="btn btn-dark waves-effect w-xl waves-light mb-2">
                                        <i class="mdi mdi-square-edit-outline"></i> Modify Details
                                    </button>
                                    <button type="button" class="btn btn-outline-danger waves-effect w-xl waves-light mb-2" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                        <i class="mdi mdi-trash-can-outline"></i> Delete Project
                                    </button>
                                </ul>
                            @endif
                        </div>
                    </div>

                    <!-- Delete Modal -->
                    <div id="deleteModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="myModalLabel"><i class="mdi mdi-alert-outline me-2"></i> Warning</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>
                                        The selected project [<strong> Lugaw for a Cause </strong>] and all of its tasks
                                        will be permanently removed. This action cannot be undone and will notify
                                        every users in your Charitable Organization. Continue?
                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light waves-effect w-sm" data-bs-dismiss="modal">No</button>
                                    <button type="button" class="btn btn-danger waves-effect waves-light w-sm">Yes</button>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div>

                    <!-- Tasks Table -->
                    <div class="card-body p-0 mt-5">
                        <h1><strong>Tasks</strong></h1>
                        <a href="" class="btn btn-rounded btn-sm w-lg btn-success waves-effect waves-light mb-3">
                            <i class="mdi mdi-plus-circle-outline"></i> Add New
                        </a>
                        <table id="datatable" class="table table-bordered dt-responsive nowrap"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Task</th>
                                    <th>Note</th>
                                    <th>Assigned By</th>
                                    <th>Assigned To</th>
                                    <th>Status</th>
                                    <th>Deadline</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>
                                        Prepare the program flow for the opening of Dress Making Training 2022.
                                    </td>
                                    <td>Prioritize</td>
                                    <td>Pangilinan, J.</td>
                                    <td>Galleno, J.</td>
                                    <td>
                                        <span class="text-warning">Pending</span>
                                    </td>
                                    <td>Thu, Dec 25, 2022 2:15 PM</td>
                                    <td>
                                        <a href="" class="btn btn-sm btn-outline-primary waves-effect waves-light">
                                            <i class="mdi mdi-open-in-new"></i> Edit
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div> <!-- end col -->


    </div>

</div>

@endsection