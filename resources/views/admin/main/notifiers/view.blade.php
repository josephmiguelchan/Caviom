@extends('admin.admin_master')
@section('title', 'Edit Notifier')
@section('charity')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="">
                    <div class="p-2 mb-4">
                        <h1 class="mb-0" style="color: #62896d"><strong>NOTIFIERS</strong></h1>
                        <ol class="breadcrumb m-0 p-0 mb-3">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">
                                <a href="javascript: void(0);">Menu</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{route('admin.notifiers')}}">Notifiers</a></li>
                            <li class="breadcrumb-item active">View</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-md-12">
                <div class="card p-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-8">
                                <h2 class="fw-bold">View Notifier</h2>
                            </div>
                            <div class="col-lg-4 mt-4">
                                <a href="{{route('admin.notifiers')}}" class="text-link float-end">
                                    <i class="ri-arrow-left-line"></i> Go Back
                                </a>
                            </div>
                        </div>

                        <!-- Modal for Delete Notifier -->
                        <div class="modal fade" id="delete_notifier" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="myModalLabel"><i class="mdi mdi-alert-outline me-2"></i> Warning</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>
                                            Are you sure you want to <strong>DELETE</strong> this record?
                                        </p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light waves-effect w-sm" data-bs-dismiss="modal">No</button>
                                        <a href="{{ route('admin.notifiers.delete', $notifier->id)}}" class="btn btn-danger waves-effect waves-light w-sm">Yes</a>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->

                        <hr class="my-3">

                        <div class="row mt-5">
                            <div class="col-lg-12">
                                <dl class="row col-md-12">
                                    <dt class="col-md-2"><h4 class="font-size-15"><strong>Category:</strong></h4></dt>
                                    <dt class="col-md-6">{{$notifier->category}}</dt>
                                </dl>
                                <dl class="row col-md-12">
                                    <dt class="col-md-2"><h4 class="font-size-15"><strong>Subject:</strong></h4></dt>
                                    <dt class="col-md-10">{{$notifier->subject}}</dt>
                                </dl>
                                <dl class="row col-md-12">
                                    <dt class="col-md-2"><h4 class="font-size-15"><strong>Message:</strong></h4></dt>
                                    <dt class="col-md-10">
                                        <p>
                                            {{$notifier->message}}
                                            {{-- <a href="mailto: support@caviom.org">support@caviom.org</a>. --}}
                                        </p>
                                    </dt>
                                </dl>
                                <a href="{{ route('admin.notifiers.edit', $notifier->id) }}" class="btn btn-dark w-md float-end waves-effect waves-light">
                                    <i class="ri-edit-line"></i> Edit
                                </a>
                                <button type="button" data-bs-target="#delete_notifier" data-bs-toggle="modal"
                                    class="mx-1 btn btn-outline-danger w-md float-end waves-effect waves-light">
                                    <i class="ri-delete-bin-line"></i> Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div><!-- end col -->
        </div>
        <!-- end row -->
    </div>
</div>
@endsection