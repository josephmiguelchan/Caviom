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

                    @include('charity.modals.prospects')
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