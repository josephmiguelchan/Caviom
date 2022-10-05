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
                            <li class="breadcrumb-item active">Edit</li>
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
                                <h2 class="fw-bold">Edit Notifier</h2>
                            </div>
                            <div class="col-lg-4 mt-4">
                                <a href="{{ url()->previous() }}" class="text-link float-end">
                                    <i class="ri-arrow-left-line"></i> Go Back
                                </a>
                            </div>
                        </div>

                        <!-- Modal for Edit Notifier -->
                        <div class="modal fade" id="edit_notifier" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="myModalLabel"><i class="mdi mdi-alert-outline me-2"></i> Warning</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>
                                            Are you sure you want to <strong>UPDATE</strong> this notifier record?
                                        </p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light waves-effect w-sm" data-bs-dismiss="modal">No</button>
                                        <button type="submit" form="add_form" class="btn btn-dark waves-effect waves-light w-sm">Yes</button>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->

                        <hr class="my-3">

                        <form method="POST" action="{{route('admin.notifiers.update', $notifier->id)}}" enctype="multipart/form-data" id="add_form">
                            @csrf

                            <div class="row mt-5">
                                <div class="col-lg-12">
                                    <dl class="row col-md-12">
                                        <dt class="col-md-2"><h4 class="font-size-15"><strong>Category:</strong></h4></dt>
                                        <dt class="col-md-6">
                                            <select class="form-control select2-search-disable" name="category">
                                                <option disabled>Select category...</option>
                                                <option value="Public Profile" {{$notifier->category == 'Public Profile' ? 'selected' : ''}}>Public Profile</option>
                                                <option value="Charity Admins" {{$notifier->category == 'Charity Admins' ? 'selected' : ''}}>Charity Admins</option>
                                                <option value="Charity Associates" {{$notifier->category == 'Charity Associates' ? 'selected' : ''}}>Charity Associates</option>
                                                <option value="Star Token Order" {{$notifier->category == 'Star Token Order' ? 'selected' : ''}}>Star Token Order</option>
                                                <option value="Featured Project Request" {{$notifier->category == 'Featured Project Request' ? 'selected' : ''}}>Featured Project Request</option>
                                            </select>
                                        </dt>
                                        @error('category')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </dl>
                                    <dl class="row col-md-12">
                                        <dt class="col-md-2"><h4 class="font-size-15"><strong>Subject:</strong></h4></dt>
                                        <dt class="col-md-10">
                                            <input type="text" class="form-control" name="subject" id="subject" placeholder="Enter subject..." value="{{$notifier->subject}}">
                                            @error('subjects')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </dt>
                                    </dl>
                                    <dl class="row col-md-12">
                                        <dt class="col-md-2"><h4 class="font-size-15"><strong>Message:</strong></h4></dt>
                                        <dt class="col-md-10">
                                            <textarea name="remarks" class="form-control" rows="10" placeholder="Enter remarks for this prospect..."
                                                placeholder="Enter message...">{{$notifier->message}}</textarea>

                                            @error('remarks')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                            <button type="button" class="btn btn-primary w-md waves-effect waves-light w-md mt-4 float-end"
                                                data-bs-target="#edit_notifier" data-bs-toggle="modal">Save</button>
                                        </dt>
                                    </dl>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div><!-- end col -->
        </div>
        <!-- end row -->
    </div>
</div>
@endsection