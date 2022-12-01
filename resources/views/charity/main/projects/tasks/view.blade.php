@extends('charity.charity_master')
@section('title', 'View Project Task')
@section('charity')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="p-2">
                    <h1 class="mb-0" style="color: #62896d"><strong>PROJECT</strong></h1>
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item">Our Charitable Organization</li>
                        <li class="breadcrumb-item"><a href="{{ route('charity.projects.all') }}">Projects</a></li>
                        <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Tasks</a></li>
                        <li class="breadcrumb-item active">View</li>
                    </ol>

                    @include('charity.modals.project-tasks')
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body p-5">
                        <div class="row">
                            <div class="col-lg-8">
                                <h2><strong>Project: {{$task->project->name}}</strong></h2>
                            </div>
                            <div class="col-lg-4 mt-4">
                                <a href="{{ url()->previous() }}" class="text-link float-end">
                                    <i class="ri-arrow-left-line"></i> Go Back
                                </a>
                            </div>
                        </div>

                        <hr>

                        <div class="row mt-5">
                            <div class="col-lg-12">
                                <div class="row">
                                    <form action="{{route('charity.projects.tasks.update',$task->code)}}" method="POST" id="edit_form">
                                        @csrf
                                        <dl class="row col-md-12">
                                            <dt class="col-md-2 py-2"><h4 class="font-size-15"><strong>Task:</strong></h4></dt>
                                            <dt class="col-md-10 py-2">
                                               {{$task->title}}
                                            </dt>

                                            <!-- Edit note textarea should only be visible to whom the task is assigned to; otherwise, read only. -->
                                            <dt class="col-md-2 py-2"><h4 class="font-size-15"><strong>Note:</strong></h4></dt>

                                            <dt class="col-md-10 py-2">
                                                <textarea class="form-control" placeholder="Enter notes for this task (optional)..."
                                                    maxlength="280" name="note" id="textarea" rows="5" {{ (Auth::user()->id != $task->assigned_to ) ? 'readonly' : '' }}>{{$task->note}}</textarea>
                                            </dt>



                                            <!-- Edit status dropdown should only be visible to whom the task is assigned to; otherwise, read only. -->
                                            <dt class="col-md-2 py-2"><h4 class="font-size-15"><strong>Status:</strong></h4></dt>
                                            <dt class="col-md-10 py-2">
                                                {{-- <span class="badge bg-warning">Pending</span> --}}
                                                <select class="form-control select2-search-disable" name="task_status" id="task_status" {{ (Auth::user()->id != $task->assigned_to) ? 'disabled' : '' }} required>
                                                    <option disabled>Select status...</option>
                                                    <option value="Pending" {{$task->status == 'Pending' ?'selected':''}}>Pending</option>
                                                    <option value="In-Progress" {{$task->status == 'In-Progress' ?'selected':''}}>In-Progress</option>
                                                    <option value="Completed"{{$task->status == 'Completed' ?'selected':''}}>Completed</option>
                                                </select>
                                            </dt>

                                            <dt class="col-md-2 py-2"><h4 class="font-size-15"><strong>Assigned by:</strong></h4></dt>
                                            <dt class="col-md-10 py-2">
                                                @unless ($task->AssignedBy == null)
                                                <a target="_blank" href="{{route('charity.users.view',$task->AssignedBy->code)}}">{{$task->AssignedBy->username}}</a>
                                                @else()
                                                <span class="text-muted">[ Deleted User ]</span>
                                                @endunless
                                            </dt>
                                            <dt class="col-md-2 py-2"><h4 class="font-size-15"><strong>Assigned To:</strong></h4></dt>
                                            <dt class="col-md-10 py-2">
                                                @unless ($task->AssignedTo == null)
                                                <a target="_blank" href="{{route('charity.users.view',$task->AssignedTo->code)}}">{{$task->AssignedTo->username}}</a>
                                                @else()
                                                <span class="text-muted">[ Deleted User ]</span>
                                                @endunless
                                            </dt>
                                            <dt class="col-md-2 py-2"><h4 class="font-size-15"><strong>Deadline Set:</strong></h4></dt>
                                            <dt class="col-md-10 py-2">
                                                {!! (Carbon\Carbon::today() > $task->deadline) ? '<span class="badge rounded-pill bg-danger"> Late' : '' !!}</span> {{Carbon\Carbon::parse($task->deadline)->isoFormat('LL')}}
                                            </dt>

                                        </dl>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Date Created and Modified -->
                        <div class="row">
                            <dl class="row mb-0 col-lg-6 my-5">
                                <dt class="col-md-6"><h4 class="font-size-15 float-end"><strong>Date Assigned</strong></h4></dt>
                                <dt class="col-md-6">{{Carbon\Carbon::parse($task->created_at)->isoFormat('LL')}}</dt>
                            </dl>
                            <dl class="row mb-0 col-lg-6 mt-5">
                                <dt class="col-md-6"><h4 class="font-size-15 float-end"><strong>Last Updated at</strong></h4></dt>
                                <dt class="col-md-6">{{Carbon\Carbon::parse($task->updated_at)->diffForHumans()}}</dt>
                            </dl>
                        </div>

                        <div class="row mt-5">
                            <div class="col-lg-8">
                            </div>
                            <div class="col-lg-4">
                                <ul class="list-inline mb-0 float-end">
                                    <!-- Delete button should only appear if the task is creator or a Charity Admin-->
                                    @if (   Auth::user()->id == $task->assigned_by || Auth::user()->role =='Charity Admin')
                                    <button type="button" class="btn btn-outline-danger waves-effect waves-light w-xl mb-2" data-bs-toggle="modal" data-bs-target="#deleteModal">
                                        <i class="ri-delete-bin-line"></i> Delete
                                    </button>
                                    @endif

                                    @if (  Auth::user()->id == $task->assigned_to )
                                    <!-- Edit/Save action should only be accessible to whom the task is assigned to -->
                                    <button type="submit" form="edit_form" class="btn btn-dark waves-effect waves-light w-xl mb-2">
                                        <i class="ri-edit-line"></i> Save
                                    </button>
                                    @endif
                                </ul>
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
                                            Only Charity Admins and its creator can delete tasks.
                                            Are you sure you want to delete this? This action will notify the assigned user of the task.
                                        </p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light waves-effect w-sm" data-bs-dismiss="modal">No</button>
                                        <a type="button" href="{{route('charity.projects.tasks.delete',$task->code)}}" class="btn btn-danger waves-effect waves-light w-sm">Yes</a>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div>


                        {{-- <!-- Edit Modal -->
                        <div id="editModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="myModalLabel"><i class="mdi mdi-alert-outline me-2"></i> Warning</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>
                                            Only the assigned user can edit this task. Are you sure you want to edit this?
                                        </p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light waves-effect w-sm" data-bs-dismiss="modal">No</button>
                                        <button type="button" class="btn btn-success waves-effect waves-light w-sm">Yes</button>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div> --}}

                    </div>
                </div>
            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
</div>
@endsection