@extends('charity.charity_master')
@section('title', 'Leads')
@section('charity')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="p-2">
                    <h1 class="mb-0" style="color: #62896d"><strong>LEADS</strong></h1>
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item">Donors and Donations</li>
                        <li class="breadcrumb-item active">Leads</li>
                    </ol>

                    @include('charity.modals.leads')
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="col-12">
            <div class="card p-3">
                <div class="card-body">
                    <h2><strong>Leads</strong></h2>
                    <p class="mb-5">List of All Leads</p>
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
                            @foreach ($leads as $key => $item)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$item->last_name}}</td>
                                <td>{{$item->first_name}}</td>
                                <td>{{$item->middle_name}}</td>
                                <td>{{$item->email_address}}</td>
                                <td>{{$item->mode_of_donation}}</td>
                                <td>{{$item->paid_at}}</td>
                                <td>
                                    <a href="{{ route('leads.view',$item->code) }}" class="btn btn-outline-primary waves-effect waves-light btn-sm">
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