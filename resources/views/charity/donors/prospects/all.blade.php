@extends('charity.charity_master')
@section('title', 'Prospects')
@section('charity')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="p-2">
                    <h1 class="mb-0" style="color: #62896d"><strong>PROSPECTS</strong></h1>
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item">Donors and Donations</li>
                        <li class="breadcrumb-item active">Prospects</li>
                    </ol>
                    <button type="button" data-bs-target=".bs-example-modal-center" title="Learn more" class="btn btn-link waves-effect p-0 mb-3" data-bs-toggle="modal">
                        <small>
                            <i class="mdi mdi-information"></i> Learn more about Prospects
                        </small>
                    </button>

                    <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">What are Prospects?</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Prospects are eme eme</p>
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


        <div class="col-12">
            <div class="card p-3">
                <div class="card-body">
                    <div class="float-end">
                        <div class="dropdown mt-3 mx-0">
                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-download"></i> Export to PDF</a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <h2><strong>PHP 5,403.23</strong></h2>
                            <p>Total Acknowledge Donations</p>
                        </div>
                        <div class="col-lg-8 mt-2">
                            <ul class="list-inline">
                                <form method="POST" action="#">
                                    @csrf
                                    <li class="list-inline-item col-md-5">
                                        <!-- min = $charity->created_at  |  max = Carbon::now->month()  -->
                                        <input class="form-control" min="2022-07" max="2023-12" type="month" value="2022-08">
                                    </li>
                                    <li class="list-inline-item">
                                        <button type="submit" class="btn btn-outline-secondary">
                                            <i class="mdi mdi-magnify"></i></a>
                                        </button>
                                    </li>
                                </form>
                            </ul>
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
                                <th>Middle Name</th>
                                <th>Email Address</th>
                                <th>Mode of Donation</th>
                                <th>Date of Payment</th>
                                <th>Action</th>
                            </tr>
                        </thead>


                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Salumbides</td>
                                <td>Eveline</td>
                                <td>Mariano</td>
                                <td>evelinemsalumbides@gmail.com</td>
                                <td>GCASH</td>
                                <td>2022/04/18</td>
                                <td>
                                    <a href="{{ route('prospects.view') }}" class="btn btn-outline-primary waves-effect waves-light btn-sm">
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