@extends('admin.admin_master')
@section('title', 'All Charitable Organizations')
@section('charity')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="p-2">
                    <h1 class="mb-0" style="color: #62896d"><strong>CHARITABLE ORGANIZATIONS</strong></h1>
                    <ol class="breadcrumb m-0 p-0 mb-3">
                        <li class="breadcrumb-item">Menu</li>
                        <li class="breadcrumb-item active">Charitable Organizations</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="col-12">
            <div class="card p-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <h2><strong>Charitable Organizations</strong></h2>
                            <p class="mb-2">All Organizations in Caviom</p>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Charitable Organization Name</th>
                                <th>Visibility Status</th>
                                <th>Verification Status</th>
                                <th>Remarks</th>
                                <th>Action</th>
                            </tr>
                        </thead>


                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>
                                    <img src="{{asset('upload/charitable_org/profile_photo/no_avatar.png') }}" alt="OLSOFI Profile Photo" class="rounded avatar-xs"> Our Lady of Sorrows Outreach Foundation, Inc.
                                </td>
                                <td><i class="ri-eye-line"></i> Visible</td>
                                <td class="text-warning">Pending</td>
                                <td>---</td>
                                <td>
                                    <a href="{{route('admin.charities.view')}}" class="btn btn-sm btn-outline-primary waves-effect waves-light">
                                        <i class="mdi mdi-open-in-new"></i> View
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>
                                    <img src="{{asset('upload/charitable_org/profile_photo/OLSOFI.jpg') }}" alt="SPECS Profile Photo" class="rounded avatar-xs"> Specs Foundation, Inc.
                                </td>
                                <td class="text-danger"><i class="ri-lock-line"></i> Locked</td>
                                <td class="text-success">Verified</td>
                                <td>
                                    <h6>Violated Community Guidelines</h6>
                                </td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-outline-primary waves-effect waves-light">
                                        <i class="mdi mdi-open-in-new"></i> View
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>
                                    <img src="{{asset('upload/charitable_org/profile_photo/SaRU.jpg') }}" alt="SARU Profile Photo" class="rounded avatar-xs"> San Roque United, Inc.
                                </td>
                                <td><i class="ri-eye-off-line"></i> Hidden</td>
                                <td>Unverified</td>
                                <td>---</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-outline-primary waves-effect waves-light">
                                        <i class="mdi mdi-open-in-new"></i> View
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>
                                    <img src="{{asset('upload/charitable_org/profile_photo/no_avatar.png') }}" alt="GAWAD Profile Photo" class="rounded avatar-xs"> Gawad Kalinga, Inc.
                                </td>
                                <td><i class="ri-eye-line"></i> Visible</td>
                                <td class="text-danger">Declined</td>
                                <td>
                                    <h6>[Re-Apply] Incomplete Requirements</h6>
                                </td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-outline-primary waves-effect waves-light">
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