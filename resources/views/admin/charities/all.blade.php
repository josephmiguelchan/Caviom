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
                            @foreach ($CharityOrganizations as $key => $item)
                                
                          
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>

                        
                                    <img src="{{(!empty($item->profile_photo)) ?$item->profile_photo: asset('upload/charitable_org/profile_photo/no_avatar.png') }}" alt="Organization Profile Photo" class="rounded avatar-xs"> {{$item->name}}
                                </td>

                                @if ($item->profile_status == 'Visible')
                                    <td><i class="ri-eye-line"></i> Visible</td>
                                @elseif($item->profile_status == 'Unset')                                
                                    <td><i class="mdi mdi-cog-off-outline"></i> Unset</td>                                
                                @elseif($item->profile_status == 'Locked')                                
                                    <td class="text-danger"><i class="ri-lock-line"></i> Locked</td>                                
                                @elseif($item->profile_status == 'Hidden')
                                    <td><i class="ri-eye-off-line"></i> Hidden</td>
                                @endif
                          
                                @if ($item->verification_status == 'Pending')
                                    <td class="text-warning"> Pending</td>
                                @elseif($item->verification_status == 'Verified')
                                    <td class="text-success"> Verified</td>
                                @elseif($item->verification_status == 'Unverified')
                                    <td>Unverified</td>
                                @elseif($item->verification_status == 'Declined')
                                    <td class="text-danger"> Declined</td>
                                @endif
                                

                         

                                <td> {{ (!empty($item->remarks_subject))? $item->remarks_subject:'---' }}</td>
                                <td>
                                    <a href="{{route('admin.charities.view',$item->code)}}" class="btn btn-sm btn-outline-primary waves-effect waves-light">
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