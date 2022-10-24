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
                        <li class="breadcrumb-item"><a href="{{ route('charity.projects.all') }}">Projects</a></li>
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
                            <a href="{{route('charity.projects.all')}}" class="text-link">
                                <i class="ri-arrow-left-line"></i> Go Back
                            </a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="bg-secondary rounded mt-3">
                                <a class="image-popup-vertical-fit" title="{{$project->name}} (Cover Photo)" href="{{($project->cover_photo)?url('upload/charitable_org/project_photo/'.$project->cover_photo):url('upload/charitable_org/placeholder.png')}}">
                                    <div id="carouselExampleCaption" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-inner" role="listbox">
                                            <div class="carousel-item active">
                                                <img src="{{($project->cover_photo)?url('upload/charitable_org/project_photo/'.$project->cover_photo):url('upload/charitable_org/placeholder.png')}}" class="rounded"
                                                    style="width: 100%; height: 30vh; object-fit: cover; opacity:.4;"
                                                    alt="Cover Photo of Project:{{$project->name}}">
                                                <div class="carousel-caption d-none d-md-block text-white-50 my-4">
                                                    <h1 class="text-white"><strong>{{$project->name}}</strong></h1>
                                                    <p>{{$project->created_at->isoFormat('MMMM D, YYYY')}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="mt-4">
                                {!!$project->objective!!}
                            </div>
                          
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-lg-8">
                            <dl class="row col-md-12">
                                <dt class="col-md-4"><h4 class="font-size-15"><strong>Last updated:</strong></h4></dt>
                                <dt class="col-md-8">{{$project->updated_at->diffForHumans()}}</dt>
                            </dl>
                        </div>
                        <div class="col-lg-4">
                            @if(Auth::user()->role == "Charity Admin")
                                <ul class="list-inline mb-0 float-end">
                                    <a href="{{ route('charity.profile.feat-project.add.project',$project->code)}}" class="btn btn-primary waves-effect w-xl waves-light mb-2">
                                        <i class="mdi mdi-star-outline"></i> Feature Project
                                    </a>
                                    <a href="{{ route('charity.projects.edit',$project->code)}}" class="btn btn-dark waves-effect w-xl waves-light mb-2">
                                        <i class="mdi mdi-square-edit-outline"></i> Modify Details
                                    </a>
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
                                        The selected project and <strong>ALL OF ITS TASKS</strong>
                                        will be permanently removed. This action cannot be undone and will notify
                                        every users in your Charitable Organization. Continue?
                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light waves-effect w-sm" data-bs-dismiss="modal">No</button>
                                    <a href="{{route('charity.projects.delete',$project->code)}}" type="button" class="btn btn-danger waves-effect waves-light w-sm">Yes</a>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div>

                    <!-- Tasks Table -->
                    @include('charity.main.projects.tasks.all')

                </div>
            </div>
        </div> <!-- end col -->


    </div>

</div>

@endsection