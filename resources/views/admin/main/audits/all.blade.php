@extends('admin.admin_master')
@section('title', 'Audit Logs')
@section('charity')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="p-2">
                    <h1 class="mb-0" style="color: #62896d"><strong>AUDIT LOGS</strong></h1>
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item">Menu</li>
                        <li class="breadcrumb-item active">Audit Logs</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="modal fade bs-example-modal-xl" tabindex="-1" role="dialog"
            aria-labelledby="myExtraLargeModalLabel" aria-hidden="true" id="modal_view_2">
            <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myExtraLargeModalLabel">Log Details #2</h5>
                        <button type="button" class="btn-close"
                            data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <dl class="row mb-0">
                            <dt class="col-sm-3">Event</dt>
                            <dd class="col-sm-9">UPDATE</dd>

                            <dt class="col-sm-3">Event Log Date</dt>
                            <dd class="col-sm-9">2022-01-13 14:15:19</dd>

                            <dt class="col-sm-3">User</dt>
                            <dd class="col-sm-9"><a href="#">Pangilinan, J.</a></dd>

                            <dt class="col-sm-3">Table</dt>
                            <dd class="col-sm-9">Gift Giving</dd>

                            <dt class="col-sm-3">Record ID</dt>
                            <dd class="col-sm-9">139e93ef-7823-406c-8c4f-00294d1e3b64</dd>

                            <dt class="col-sm-3">Action</dt>
                            <dd class="col-sm-9">Charity Admin generated gift giving tickets for [ $name ].</dd>

                            {{-- <dt class="col-sm-3">Fields</dt>
                            <dd class="col-sm-9">description</dd>
                            <dd class="col-sm-9 offset-sm-3">venue</dd>
                            <dd class="col-sm-9 offset-sm-3">sponsor</dd>

                            <dt class="col-sm-3">Old Value(s)</dt>
                            <dd class="col-sm-9">"The quick brown fox jumps over the lazy dog."</dd>
                            <dd class="col-sm-9 offset-sm-3">MCU Rotonda</dd>
                            <dd class="col-sm-9 offset-sm-3">...</dd>

                            <dt class="col-sm-3">New Value(s)</dt>
                            <dd class="col-sm-9">"Orange is the new black."</dd>
                            <dd class="col-sm-9 offset-sm-3">SM Novaliches</dd>
                            <dd class="col-sm-9 offset-sm-3">SMDC</dd> --}}
                        </dl>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->


        <div class="col-12">
            <div class="card p-3">
                <div class="card-body">
                    <h2><strong>Audit Logs</strong></h2>
                    <p>Transactions of Caviom</p>
                </div>

                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Event</th>
                                <th>Charitable Organization</th>
                                <th>Log Date</th>
                                <th>User</th>
                                <th>Table</th>
                                <th>Record ID</th>
                                <th>Action</th>
                            </tr>
                        </thead>


                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>SIGN OUT</td>
                                <td>San Roque United, Inc.</td>
                                <td>2022-01-13 14:15:16</td>
                                <td>@jd.cruz</td>
                                <td></td>
                                <td></td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary waves-effect waves-light">
                                        <i class="mdi mdi-open-in-new"></i> View
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>UPDATE</td>
                                <td>Gawad Kalinga</td>
                                <td>2022-01-13 14:15:19</td>
                                <td>@jd.cruz</td>
                                <td>Prospects</td>
                                <td>24</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#modal_view_2">
                                        <i class="mdi mdi-open-in-new"></i> View
                                    </button>
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