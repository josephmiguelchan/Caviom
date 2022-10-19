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

        <!-- Export to PDF Modal -->
        <div id="exportModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel"><i class="mdi mdi-alert-outline me-2"></i> Warning</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>You are about to attempt to generate a trail report of Donations from Prospects. This action
                            will notify all other users in your Charitable Organization. Continue?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light waves-effect w-sm" data-bs-dismiss="modal">No</button>
                        <a type="button" href="{{route('generate.donation.report')}}"  class="btn btn-dark waves-effect waves-light w-sm">Yes</a>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>

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
                                <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exportModal">
                                    <i class="mdi mdi-download"></i> Export to PDF
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <h2><strong>PHP {{!empty($totaldonation) ? number_format($totaldonation,2) : '0.00'}}</strong></h2>
                            <p>Total Acknowledged Donations</p>
                        </div>
                        <div class="col-lg-8 mt-2">
                            <ul class="list-inline">
                                <form method="POST" action="#">
                                    @csrf
                                    <li class="list-inline-item col-md-5">
                                        <input class="form-control" min="{{Carbon\Carbon::parse(Auth::user()->charity->created_at)->isoFormat('YYYY-M')}}"
                                            max="{{Carbon\Carbon::now()->isoFormat('YYYY-M')}}" type="month" value="{{Carbon\Carbon::now()->isoFormat('YYYY-M')}}">
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
                            @foreach ($prospects as $key=> $item)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$item->last_name}}</td>
                                <td>{{$item->first_name}}</td>
                                <td>{{$item->middle_name}}</td>
                                <td>{{$item->email_address}}</td>
                                <td>{{$item->mode_of_donation}}</td>
                                <td>{{$item->paid_at}}</td>
                                <td>
                                    <a href="{{ route('prospects.view',$item->code) }}" class="btn btn-outline-primary waves-effect waves-light btn-sm">
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