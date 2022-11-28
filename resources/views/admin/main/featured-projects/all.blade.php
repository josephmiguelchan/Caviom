@extends('admin.admin_master')
@section('title', 'View Featured Projects')
@section('charity')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="p-2">
                    <h1 class="mb-0" style="color: #62896d"><strong>FEATURED PROJECTS</strong></h1>
                    <ol class="breadcrumb m-0 p-0 mb-3">
                        <li class="breadcrumb-item">Menu</li>
                        <li class="breadcrumb-item active">Featured Projects</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="col-12">
            <div class="card p-3">
                <div class="card-body">
                    <div class="row px-2">
                        <div class="col-lg-11">
                            <h2><strong>Featured Project Requests</strong></h2>
                            <p class="mb-2">All Featured Projects</p>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Project Name</th>
                                <th>Date of Event</th>
                                <th>Visibility Status</th>
                                <th>Remarks</th>
                                <th>Date Added</th>
                                <th>Action</th>
                            </tr>
                        </thead>


                        <tbody>
                            @foreach ($fps as $key => $item)
                          
                           
                            <tr>
                                <td>{{$key+1}}</td>

                                <td>
                                    @if ($item->approval_status == 'Pending')
                                    <span class="badge bg-warning">PENDING</span> 
                                    @elseif($item->approval_status == 'Approved')         
                                    <span class="badge bg-success">APPROVED</span>     
                                    @elseif($item->approval_status == 'Rejected')         
                                    <span class="badge bg-danger">REJECTED</span>   
                                    @endif
                                    {{$item->name}}</a></td>

                                <td>{{$item->started_on}}</td>

                                @if ($item->visibility_status == "Hidden")
                                <td><i class="ri-eye-off-line"></i> {{$item->visibility_status}}</td>
                                @elseif($item->visibility_status == "Visible")
                                <td><i class="ri-eye-line"></i> {{$item->visibility_status}}</td>
                                @endif
                                <td>  {{ (!empty($item->remarks_subject))? $item->remarks_subject:'---' }}</td>
                        
                                <td>{{$item->created_at}}</td>
                                <td>
                                    <a href="{{ route('admin.feat-projects.view',$item->code) }}" class="btn btn-sm btn-outline-primary waves-effect waves-light">
                                        <i class="mdi mdi-open-in-new"></i> View
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div> <!-- end col -->


    </div>

</div>

@endsection