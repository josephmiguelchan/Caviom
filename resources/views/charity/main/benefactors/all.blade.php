@extends('charity.charity_master')
@section('title', 'Benefactors')
@section('charity')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="p-2">
                    <h1 class="mb-0" style="color: #62896d"><strong>BENEFACTORS</strong></h1>
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item">Our Charitable Organization</li>
                        <li class="breadcrumb-item active">Benefactors</li>
                    </ol>
                    @include('charity.modals.benefactors')
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="col-12">
            <div class="card p-3">
                <div class="card-body">

                    <div class="float-end">
                        <div class="row mt-4">
                            <div class="col-md-5">
                                <div class="btn-group" role="group" aria-label="Actions">
                                    <a type="button" data-bs-toggle="modal" data-bs-target="#exportModal" class="btn btn-sm w-lg btn-warning waves-effect waves-light">
                                        <i class="mdi mdi-download"></i> Export to Excel
                                    </a>
                                    <a type="button" href="{{ route('charity.benefactors.create') }}" class="btn btn-sm w-lg btn-success waves-effect waves-light mx-1">
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
                                    <p>You are about to attempt to backup all your benefactors. This action
                                        will notify all other users in your Charitable Organization. Continue?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light waves-effect w-sm" data-bs-dismiss="modal">No</button>
                                    <button type="button" class="btn btn-danger waves-effect waves-light w-sm">Yes</button>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div>

                    <div class="row">
                        <div class="col-lg-4">
                            <h2><strong>Benefactors</strong></h2>
                            <p class="mb-2">List of All Benefactors</p>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead class="table-light">
                            <tr>
                                <th>No.</th>
                                <th>Last Name</th>
                                <th>First Name</th>
                                <th>Email Address</th>
                                <th>Cel No.</th>
                                <th>Tel No.</th>
                                <th>Category</th>
                                <th>Label</th>
                                <th>Action</th>
                            </tr>
                        </thead>


                        <tbody>
                        @foreach($benefactors as $key => $benefactor)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $benefactor->last_name }}</td>
                                <td>{{ $benefactor->first_name }}</td>
                                <td>{{ $benefactor->email_address }}</td>
                                <td>{{ $benefactor->cel_no }}</td>
                                <td>{{ $benefactor->tel_no }}</td>
                                <td>{{ $benefactor->category }}</td>
                                <td>{{ $benefactor->label }}</td>
                                <td>
                                    <a href="{{ route('charity.benefactors.view', $benefactor->code) }}" class="btn btn-sm btn-outline-primary waves-effect waves-light">
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
