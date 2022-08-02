@extends('charity.charity_master')
@section('title', 'Edit Beneficiary')
@section('charity')

@php
    $avatar = 'upload/avatar_img/'.Auth::user()->profile_image;
    $defaultAvatar = 'upload/avatar_img/no_avatar.png';
@endphp

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="p-2">
                    <h1 class="mb-0" style="color: #62896d"><strong>BENEFICIARIES</strong></h1>
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item">Our Charitable Organization</li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('charity.beneficiaries') }}">Beneficiaries</a>
                        </li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                    <button type="button" data-bs-target=".bs-example-modal-center" title="Learn more" class="btn btn-link waves-effect p-0 mb-3" data-bs-toggle="modal">
                        <small>
                            <i class="mdi mdi-information"></i> Learn more about Beneficiaries
                        </small>
                    </button>

                    <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">What are Beneficiaries?</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Beneficiaries are eme eme</p>
                                    <p>Praesent commodo cursus magna, vel scelerisque
                                        nisl consectetur et. Vivamus sagittis lacus vel
                                        augue laoreet rutrum faucibus dolor auctor.</p>
                                    <p class="mb-0">Aenean lacinia bibendum nulla sed consectetur.
                                        Praesent commodo cursus magna, vel scelerisque
                                        nisl consectetur et. Donec sed odio dui. Donec
                                        ullamcorper nulla non metus auctor
                                        fringilla.</p>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-md-12">
                <div class="card p-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 px-4">
                                <a href="{{route('charity.beneficiaries.view')}}" class="text-link">
                                    <i class="mdi mdi-arrow-left"></i> Go Back
                                </a>
                            </div>
                        </div>
                        <div class="text-center">
                            <div class="user-profile text-center mt-3">
                                <div>
                                    <img src="{{ url('upload/avatar_img/no_avatar.png') }}"
                                        alt="Profile Picture" class="avatar-xl rounded-circle">
                                </div>
                                <div class="mt-3">
                                    <p class="text-muted mb-1">ID No. 1</p>
                                    <h1 class="py-3" style="color: #62896d">
                                        <strong>
                                            {{-- {{ Auth::user()->info->last_name . ', ' . Auth::user()->info->first_name }}
                                            @if (Auth::user()->info->middle_name)
                                            {{
                                                ' ' . Auth::user()->info->middle_name
                                            }}
                                            @endif --}}
                                            Olarte, Clark Louse Sinko
                                        </strong>
                                    </h1>
                                </div>
                            </div>
                        </div>
                        <div class="row px-4">
                            <!-- Dates -->
                            <dl class="row mb-0 col-lg-6">
                                <dt class="col-md-6"><h4 class="font-size-15"><strong>Date Added:</strong></h4></dt>
                                <dt class="col-md-6">{{ Carbon\Carbon::parse(Auth::user()->created_at)->toFormattedDateString() }}</dt>
                            </dl>
                            <dl class="row mb-0 col-lg-6">
                                <dt class="col-md-6"><h4 class="font-size-15"><strong>Last Updated at:</strong></h4></dt>
                                <dt class="col-md-6">{{ Carbon\Carbon::parse(Auth::user()->info->updated_at)->diffForHumans() }}</dt>
                                <dt class="col-md-6"><h4 class="font-size-15"><strong>Last Modified by:</strong></h4></dt>
                                <dt class="col-md-6">Martin Agpalza</dt>
                            </dl>
                            <!--End Dates -->
                        </div>

                        <hr class="my-3">

                        <form action="" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!--Basic Info -->
                            @include('charity.main.beneficiaries.edit_components.basic')

                            <!-- Addresses -->
                            @include('charity.main.beneficiaries.edit_components.address')

                            <!--Education, Contact, and Interview -->
                            @include('charity.main.beneficiaries.edit_components.other')

                            <!-- Family Info -->
                            @include('charity.main.beneficiaries.edit_components.family')

                            <!-- Background Info -->
                            @include('charity.main.beneficiaries.edit_components.bg')

                            <!--Prepared and Noted by -->
                            <div class="form-group mt-5 my-3 row">
                                <!-- Prepared by -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="noted_by" class="form-label">Prepared by</label>
                                        <input class="form-control" name="noted_by" id="noted_by" type="text"
                                            value="Shiela Kay">
                                        @error('noted_by')
                                            <div class="text-danger"><small>
                                                {{ $message }}
                                            </small></div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Noted by -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="noted_by" class="form-label">Noted by</label>
                                        <input class="form-control" name="noted_by" id="noted_by" type="text"
                                            value="Justin Coa">
                                        @error('noted_by')
                                            <div class="text-danger"><small>
                                                {{ $message }}
                                            </small></div>
                                        @enderror
                                    </div>
                                </div>
                            </div>


                            <div class="row p-3">
                                <div class="">
                                    <a href="{{ route('charity.beneficiaries.update') }}" class="btn btn-dark btn-rounded w-md waves-effect waves-light float-end">
                                        <i class="ri-edit-line"></i> Save
                                    </a>
                                    <a class="btn list-inline-item float-end mx-4" href="{{route('charity.beneficiaries.view')}}">Cancel</a>
                                </div>
                            </div>

                        </form>


                        <!-- Delete Modal -->
                        <div id="deleteModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="myModalLabel"><i class="mdi mdi-alert-outline me-2"></i> Warning</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>You are about to delete the selected beneficiary [<strong> Olarte, Clark Louise </strong>] permanently . This action
                                            cannot be undone and will notify all other users in your Charitable Organization. Continue?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light waves-effect w-sm" data-bs-dismiss="modal">No</button>
                                        <button type="button" class="btn btn-danger waves-effect waves-light w-sm">Yes</button>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div>


                    </div><!-- end cardbody -->
                </div><!-- end card -->
            </div><!-- end col -->
        </div>
        <!-- end row -->
    </div>
</div>
@endsection