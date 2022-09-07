@extends('charity.charity_master')
@section('title', 'Beneficiaries')
@section('charity')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="p-2">
                    <h1 class="mb-0" style="color: #62896d"><strong>BENEFICIARIES</strong></h1>
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item">Our Charitable Organization</li>
                        <li class="breadcrumb-item active">Beneficiaries</li>
                    </ol>

                    @include('charity.modals.beneficiaries')
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="col-12">
            <div class="card p-3">
                <div class="card-body">
                    <div class="float-end">
                        {{-- <div class="dropdown mx-0 my-2">
                            <a href="#" class="dropdown-toggle arrow-none card-drop float-end" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <button type="button"  data-bs-toggle="modal" data-bs-target="#exportModal" class="dropdown-item">
                                    <i class="mdi mdi-download"></i> Export to Excel</button>
                            </div>
                        </div> --}}
                        {{-- <a href="{{ route('charity.beneficiaries.add') }}" class="btn btn-rounded btn-sm w-lg btn-success waves-effect waves-light mt-4">
                            <i class="mdi mdi-plus-circle-outline"></i> Add New
                        </a> --}}

                        <div class="row mt-4">
                            <div class="col-md-5">
                                <div class="btn-group" role="group" aria-label="Actions">
                                    <a type="button" data-bs-toggle="modal" data-bs-target="#exportModal" class="btn btn-sm w-lg btn-warning waves-effect waves-light">
                                        <i class="mdi mdi-download"></i> Export to Excel
                                    </a>
                                    <a type="button" href="{{ route('charity.beneficiaries.add') }}" class="btn btn-sm w-lg btn-success waves-effect waves-light mx-1">
                                        <i class="mdi mdi-plus"></i> Add New
                                    </a>
                                </div>
                            </div>
                        </div>


                    </div>
                    <!-- Export to Excel Modal -->
                    <div id="exportModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="myModalLabel"><i class="mdi mdi-alert-outline me-2"></i> Warning</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>You are about to attempt to backup all your beneficiaries. This action
                                        will notify all other users in your Charitable Organization. Continue?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light waves-effect w-sm" data-bs-dismiss="modal">No</button>
                                    <button type="button" class="btn btn-dark waves-effect waves-light w-sm">Yes</button>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <h2><strong>Beneficiaries</strong></h2>
                            <p class="mb-2">List of All Beneficiaries</p>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Last Name</th>
                                <th>First Name</th>
                                <th>Nickname</th>
                                <th>Birth Date</th>
                                <th>
                                    <span data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="yes"
                                        title="This is the beneficiary's recorded age during his/her interview.">
                                        <i class="mdi mdi-information-outline"></i> Age
                                    </span>
                                </th>
                                <th>Category</th>
                                <th>Label</th>
                                <th>Action</th>
                            </tr>
                        </thead>


                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Olarte</td>
                                <td>Clark Louis</td>
                                <td>Clark</td>
                                <td>Aug. 11, 2018</td>
                                <td>4</td>
                                <td>ADB Scholar</td>
                                <td>Unrenewed Sponsor</td>
                                <td>
                                    <a href="{{ route('charity.beneficiaries.view') }}" class="btn btn-sm btn-outline-primary waves-effect waves-light">
                                        <i class="mdi mdi-open-in-new"></i> View
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div> <!-- end col -->


    </div>

</div>

@endsection