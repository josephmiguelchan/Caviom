@extends('charity.charity_master')
@section('title', 'Edit Beneficiary')
@section('charity')

@php
    $avatar = 'upload/charitable_org/beneficiary_photos/';
    $defaultAvatar = 'upload/charitable_org/beneficiary_photos/no_avatar.png';
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
                            <a href="{{ route('charity.beneficiaries.all') }}">Beneficiaries</a>
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
                            <div class="col-lg-8">
                                <h1><strong>Edit Beneficiary</strong></h1>
                            </div>
                            <div class="col-lg-4 mt-4">
                                <a href="{{route('charity.beneficiaries.all')}}" class="text-link float-end">
                                    <i class="ri-arrow-left-line"></i> Go Back
                                </a>
                            </div>
                        </div>

                        <hr class="my-3">

                        <form method="POST" action="{{ route('charity.beneficiaries.update', $beneficiaryEdit->code ) }}" enctype="multipart/form-data">
                            @csrf
                            <h2 class="my-3 mt-5" style="color: #62896d" ><strong>I. Indentifying Information</strong></h2>
                            <!--Basic Info -->
                            @include('charity.main.beneficiaries.edit_components.basic')

                            <!--Education, Contact, and Interview -->
                            @include('charity.main.beneficiaries.edit_components.other')

                            <!-- Addresses -->
                            @include('charity.main.beneficiaries.edit_components.address')

                            <div class="row p-3">
                                <div class="">
                                    <p class="btn list-inline-item float-left mx-4"><strong>1/3</strong></p>
                                    <button type="submit" class="btn btn-dark btn-rounded w-md waves-effect waves-light float-end">
                                        Save
                                    </button>
                                    <a class="btn list-inline-item float-end mx-4" href="{{ route('charity.beneficiaries.show', $beneficiaryEdit->code) }}">Cancel</a>
                                </div>
                            </div>
                        </form>

                    </div><!-- end cardbody -->
                </div><!-- end card -->
            </div><!-- end col -->
        </div>
        <!-- end row -->
    </div>
</div>
@endsection
