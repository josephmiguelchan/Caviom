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
            <div class="card p-2">
                <div class="card-body">
                    <div class="float-end mt-4 mb-2">
                        @if(Auth::user()->role == "Charity Admin")
                            <a href="{{ route('charity.projects.add') }}" class="btn btn-sm w-lg btn-success waves-effect waves-light">
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
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="row" data-masonry='{"percentPosition": true }'>
                        @foreach ($projects as $item)
                        <div class="col-sm-6 col-lg-4 px-3">
                 
                            <div class="card">
                          
                                <img class="card-img-top img-fluid" src="{{ ($item->cover_photo) ?url('upload/charitable_org/project_photo/'.$item->cover_photo):url('upload/charitable_org/placeholder.png') }}" alt="Project Cover Photo">
                                <div class="card-body">
                                    <h4 class="card-title">{{$item->name}}</h4>
                             
                                    <div class="mx-3">
                                        <p class="card-text my-0 mt-3">
                                            <i class="ri-checkbox-blank-circle-fill font-size-10 text-warning align-middle me-2"></i> {{DB::table('project_tasks')->where('project_id',$item->id)->where('status','Pending')->count()}} Pending Tasks
                                        </p>
                                        <p class="card-text my-0">
                                            <i class="ri-checkbox-blank-circle-fill font-size-10 text-primary align-middle me-2"></i> {{DB::table('project_tasks')->where('project_id',$item->id)->where('status','In-Progress')->count()}} In-progress Tasks
                                        </p>
                                        <p class="card-text my-0 mb-3">
                                            <i class="ri-checkbox-blank-circle-fill font-size-10 text-success align-middle me-2"></i> {{DB::table('project_tasks')->where('project_id',$item->id)->where('status','Completed')->count()}} Completed Tasks
                                        </p>
                                    </div>
                                        <p class="card-text">
                                            <small class="text-muted">Last updated {{$item->updated_at->diffForHumans()}}</small>
                                        </p>
                                        <a href="{{ route('charity.projects.view',$item->code) }}" class="btn btn-dark waves-effect waves-light w-100">
                                            <i class="mdi mdi-open-in-new"></i> View Project
                                    </a>
                                </div>
                             
                            </div>
                       
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div> <!-- end col -->


    </div>

</div>

@endsection