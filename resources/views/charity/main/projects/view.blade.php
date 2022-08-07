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
                        <div class="col-lg-8">
                            <h1><strong>Lugaw for a Cause</strong></h1>
                        </div>
                        <div class="col-lg-4 mt-4">
                            <a href="{{route('charity.projects')}}" class="text-link float-end">
                                <i class="ri-arrow-left-line"></i> Go Back
                            </a>
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="bg-secondary rounded mt-3">
                                <img src="{{ asset('upload/test_files/lugaw-for-a-cause.webp') }}" class="rounded"
                                style="width: 100%; height: 20rem; object-fit: cover; opacity:.7;"
                                alt="Cover Photo of Project: Lugaw for a Cause">
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

                    <div class="row mt-5">
                        <div class="col-lg-8">
                            <dl class="row col-md-12">
                                <dt class="col-md-4"><h4 class="font-size-15"><strong>Date Added:</strong></h4></dt>
                                <dt class="col-md-8">May 20, 2022</dt>
                            </dl>
                        </div>
                        <div class="col-lg-4">
                            @if(Auth::user()->role == "Charity Admin")
                                <ul class="list-inline mb-0 float-end">
                                    <button type="button" class="btn btn-primary waves-effect w-xl waves-light mb-2">
                                        <i class="mdi mdi-star-outline"></i> Feature Project
                                    </button>
                                    <button type="button" class="btn btn-outline-danger waves-effect w-xl waves-light mb-2" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                        <i class="mdi mdi-trash-can-outline"></i> Delete Project
                                    </button>
                                    <button type="button" class="btn btn-outline-dark waves-effect w-xl waves-light mb-2">
                                        <i class="mdi mdi-square-edit-outline"></i> Modify Details
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
                                    <p>Deleting the selected project [<strong> Lugaw for a Cause </strong>] is permanent. This action cannot be undone. Continue?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light waves-effect w-sm" data-bs-dismiss="modal">No</button>
                                    <button type="button" class="btn btn-danger waves-effect waves-light w-sm">Yes</button>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div>


                    <!-- Add to Prospects Modal -->
                    <div id="addModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="myModalLabel"><i class="mdi mdi-information-outline me-2"></i> Are you sure?</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>You are about to add the selected lead [<strong> Salumbides, Eveline M. </strong>] to your prospects. Continue?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light waves-effect w-sm" data-bs-dismiss="modal">No</button>
                                    <button type="button" class="btn btn-success waves-effect waves-light w-sm">Yes</button>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div>

                </div>
            </div>
        </div> <!-- end col -->


    </div>

</div>

@endsection