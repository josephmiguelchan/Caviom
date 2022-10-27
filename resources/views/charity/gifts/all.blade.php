@extends('charity.charity_master')
@section('title', 'Users')
@section('charity')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="p-2">
                    <h1 class="mb-0" style="color: #62896d"><strong>GIFT GIVING</strong></h1>
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item active">All Gift Givings</li>
                    </ol>

                    @include('charity.modals.gift-giving')
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="col-12">
            <div class="card p-3">
                <div class="card-body">

                    <div class="row px-2">
                        <div class="col-lg-11">
                            <h2><strong>Gift Givings</strong></h2>
                            <p>List of All Gift Giving / Ticketing Events</p>
                        </div>
                        @if(Auth::user()->role == "Charity Admin")
                            <div class="col-lg-1 mt-4">
                                <div class="row justify-content-end">
                                    <a type="button" href="{{ route('gifts.add') }}" class="btn btn-sm w-lg btn-success waves-effect waves-light mx-1">
                                        <i class="mdi mdi-plus"></i> Add New
                                    </a>
                                </div>
                                @if (Auth::user()->charity->subscription == 'Free')
                                <small class="text-center"><em>(300 Star Tokens)</em></small>
                                @endif
                            </div>
                        @endif
                    </div>

                </div>

                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Gift Giving Project Name</th>
                                <th>Project Date</th>
                                <th>Amount per Pack</th>
                                <th>Beneficiaries</th>
                                <th>Total Budget</th>
                                <th>Actions</th>
                            </tr>
                        </thead>


                        <tbody>
                            @foreach($GiftGivings as $key => $item)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->start_at->toDayDateTimeString()}}</td>
                                <td>PHP {{number_format($item->amount_per_pack,2)}}</td>
                                <td>{{DB::table('gift_giving_beneficiaries')->where('gift_giving_id',  $item->id)->count()}} / {{$item->no_of_packs}}</td>
                                <td>PHP {{number_format($item->total_budget,2)}}</td>
                                <td>
                                    <a data-bs-toggle="modal"  data-bs-target="#download_modal_{{$key+1}}" class="btn btn-sm btn-outline-dark waves-effect waves-light"
                                        title="Generate Tickets">
                                        <i class="mdi mdi-ticket-confirmation-outline"></i> Download..
                                    </a>
                                    <a href="{{ route('gifts.view',$item->code) }}" class="btn btn-sm btn-outline-primary waves-effect waves-light">
                                        <i class="mdi mdi-open-in-new"></i> View
                                    </a>
                                </td>

                                <!-- Download Modal -->
                                <div id="download_modal_{{$key+1}}" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="myModalLabel"><i class="mdi mdi-alert-outline me-2"></i> Warning</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>
                                                    You are about to attempt to generate tickets for the selected Gift Giving [ <strong>{{$item->name}}</strong> ].
                                                    This action will increment the batch no. and will notify every users in your Charitable Organization. Continue?
                                                </p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light waves-effect w-sm" data-bs-dismiss="modal">No</button>
                                                <a href="{{route('gifts.generate.ticket',$item->code)}}" class="btn btn-dark waves-effect waves-light w-sm">Yes</a>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div>
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