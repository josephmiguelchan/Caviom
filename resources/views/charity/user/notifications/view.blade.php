@extends('charity.charity_master')
@section('title', 'View Notification')
@section('charity')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="">
                    <div class="p-2 mb-4">
                        <h1 class="mb-0" style="color: #62896d"><strong>NOTIFICATIONS</strong></h1>
                        <ol class="breadcrumb m-0 p-0 mb-3">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">
                                <a href="javascript: void(0);">My Account</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{route('notifications.all')}}">All Notifications</a>
                            </li>
                            <li class="breadcrumb-item active">View</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <!-- Delete Modal -->
        <div id="deleteModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel"><i class="mdi mdi-alert-outline me-2"></i> Warning</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>This will permanently delete this notification. Continue?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light waves-effect w-sm" data-bs-dismiss="modal">No</button>
                        <a href="{{route('notifications.delete',$notification->code)}}" class="btn btn-danger waves-effect waves-light w-sm">Yes</a>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card p-3">
                    <div class="card-body">

                        <div class="row px-2">
                            <div class="col-lg-8">
                                <h2><strong>{{$notification->subject}}</strong></h2>
                                <h6 class="text-muted">{{$notification->category}}</h6>
                            </div>
                            <div class="col-lg-4 pt-5 pb-0">
                                <a href="{{route('notifications.all')}}" class="text-link float-end">
                                    <i class="ri-arrow-left-line"></i> Go Back
                                </a>
                            </div>
                        </div>

                        <hr>

                        <div class="row p-3">
                            <dl class="row col-lg-9 mb-0">
                                <dt class="col-md-3"><h4 class="font-size-15"><strong>Message:</strong></h4></dt>
                                <dt class="col-md-9">
                                    <p>
                                        {{$notification->message}}
                                        {{-- <a href="{{ route('star.tokens.view') }}" target="_blank">here</a>. --}}
                                    </p>
                                </dt>

                            </dl>

                            <div class="row mt-5">
                                <div class="col-lg-9">
                                    <dl class="row">
                                        <dt class="col-md-3"><h4 class="font-size-15"><strong>Date Received:</strong></h4></dt>
                                        <dt class="col-md-9">{{Carbon\Carbon::parse($notification->created_at)->diffForHumans()}}</dt>
                                    </dl>
                                </div>
                                <div class="col-lg-3">
                                    <ul class="list-inline mb-0 float-end">
                                        <a type="button"  class="btn btn-outline-danger btn-rounded waves-effect waves-light w-xl mb-2"
                                            data-bs-toggle="modal" data-bs-target="#deleteModal" title="Delete">
                                            <i class="ri-delete-bin-line"></i> Delete
                                        </a>
                                    </ul>
                                </div>
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