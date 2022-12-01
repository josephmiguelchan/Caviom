@extends('charity.charity_master')
@section('title', 'View Beneficiary')
@section('charity')

@php
    $avatar = 'upload/charitable_org/beneficiary_photos/';
    $defaultAvatar = 'upload/avatar_img/no_avatar.png';
@endphp

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="p-2">
                    <h1 class="mb-0" style="color: #62896d"><strong>BENEFICIARIES</strong></h1>
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item">Our Charitable Organization</li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('charity.beneficiaries.all') }}">Beneficiaries</a>
                        </li>
                        <li class="breadcrumb-item active">View</li>
                    </ol>

                    @include('charity.modals.beneficiaries')
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-md-12">
                <div class="card p-4">
                    <div class="card-body">
                        <div class="float-end">
                            <div class="dropdown mx-0 mt-2">
                                <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="mdi mdi-dots-vertical"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <!-- More Action items -->
                                    <a data-bs-toggle="modal" data-bs-target="#exportPdfModal" href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-download"></i> Export to PDF</a>
                                    <a  data-bs-toggle="modal" data-bs-target="#exportBlankModal" href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-file-download-outline"></i> Export to PDF with Blank Copy</a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <a href="{{route('charity.beneficiaries.all')}}" class="text-link">
                                    <i class="mdi mdi-arrow-left"></i> Go Back
                                </a>
                            </div>
                        </div>

                        <!-- Export to PDF Modal -->
                        <div id="exportPdfModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="myModalLabel"><i class="mdi mdi-alert-outline me-2"></i> Warning</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>You are about to attempt to back up the data of the selected beneficiary [<strong> {{ $beneficiary->last_name . ', ' .
                                            $beneficiary->first_name .' '. $beneficiary->middle_name}} </strong>].
                                            This action will notify all other users in your Charitable Organization. Continue?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light waves-effect w-sm" data-bs-dismiss="modal">No</button>
                                        <a type="button" href="{{route('charity.beneficiaries3generate.pdf',$beneficiary->code)}}" class="btn btn-dark waves-effect waves-light w-sm">Yes</a>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div>

                        <!-- Export to Blank PDF Modal -->
                        <div id="exportBlankModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="myModalLabel"><i class="mdi mdi-alert-outline me-2"></i> Warning</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>You are about to attempt to export a blank copy of the selected beneficiary [<strong> {{$beneficiary->last_name. ', '.$beneficiary->first_name.' '. $beneficiary->middle_name   }} </strong>] for
                                            manual assessment. Continue?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light waves-effect w-sm" data-bs-dismiss="modal">No</button>
                                        <a type="button" href="{{route('charity.beneficiaries3generate.pdf.blank',$beneficiary->code)}}" class="btn btn-dark waves-effect waves-light w-sm">Yes</a>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div>

                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <div class="user-profile text-center mt-3">
                                <div>
                                    <img src="{{ (!empty($beneficiary->profile_photo))?url($avatar.$beneficiary->profile_photo):url($defaultAvatar) }}"
                                         alt="Profile Picture" class="avatar-xl rounded-circle">
                                </div>
                                <div class="mt-3">
                                    <p class="text-muted mb-1"><span class="badge bg-light">ID No. 1</span></p>
                                    <h1 class="py-3" style="color: #62896d">
                                        <strong>
                                            {{ $beneficiary->last_name . ', ' . $beneficiary->first_name .' '. $beneficiary->middle_name}}
                                        </strong>
                                    </h1>
                                </div>
                            </div>
                        </div>
                        <div class="row px-4">
                            <!-- Dates -->
                            <dl class="row mb-0 col-lg-6">
                                <dt class="col-md-6"><h4 class="font-size-15"><strong>Date Added:</strong></h4></dt>
                                <dt class="col-md-6">{{ Carbon\Carbon::parse($beneficiary->created_at)->toDayDateTimeString() }}</dt>
                            </dl>
                            <dl class="row mb-0 col-lg-6">
                                <dt class="col-md-6"><h4 class="font-size-15"><strong>Last Updated at:</strong></h4></dt>
                                <dt class="col-md-6">{{ Carbon\Carbon::parse($beneficiary->updated_at)->diffForHumans() }}</dt>
                                <dt class="col-md-6"><h4 class="font-size-15"><strong>Last Modified by: </strong></h4></dt>
                                <dt class="col-md-6">
                                    @unless ($beneficiary->lastModifiedBy == null)
                                    <a href="{{ ($beneficiary->last_modified_by_id) ? route('charity.users.view', $beneficiary->lastModifiedBy->code) : '#' }}">
                                        {{ ($beneficiary->lastModifiedBy) ? $beneficiary->lastModifiedBy->username:'---' }}
                                    </a>
                                    @else
                                    <span class="text-muted">[ Deleted User ]</span>
                                    @endunless
                                </dt>
                            </dl>
                            <!--End Dates -->

                            <!--Basic Info -->
                            <hr class="my-3">
                            <h4 class="my-3" style="color: #62896d">Personal Information</h4>
                            <dl class="row mb-0 col-lg-6">
                                <dt class="col-md-6"><h4 class="font-size-15"><strong>Nickname:</strong></h4></dt>
                                <dt class="col-md-6">{{ $beneficiary->nick_name }}</dt>
                                <dt class="col-md-6"><h4 class="font-size-15"><strong>Religion:</strong></h4></dt>
                                <dt class="col-md-6">{{ $beneficiary->religion }}</dt>
                            </dl>
                            <dl class="row mb-0 col-lg-6">
                                <dt class="col-md-6"><h4 class="font-size-15"><strong>Date of Birth:</strong></h4></dt>
                                <dt class="col-md-6">{{ Carbon\Carbon::parse($beneficiary->birth_date)->toFormattedDateString() }}</dt>
                                <dt class="col-md-6"><h4 class="font-size-15"><strong>Birth Place:</strong></h4></dt>
                                <dt class="col-md-6">{{ $beneficiary->birth_place }}</dt>
                                <dt class="col-md-6"><h4 class="font-size-15"><strong>Age on Interview:</strong></h4></dt>
                                <dt class="col-md-6">{{ Carbon\Carbon::parse($beneficiary->birth_date)->diff(Carbon\Carbon::parse($beneficiary->interviewed_at))->y }}</dt>
                            </dl>
                            <!--End Basic Info -->

                            <!--Address -->
                            <dl class="row my-4">
                                <dt class="col-md-3"><h4 class="font-size-15"><strong>Permanent Address:</strong></h4></dt>
                                <dt class="col-md-9 px-1">
                                    {{ $permanentAddress->address_line_two.' '.$permanentAddress->address_line_one.', '.
                                       $permanentAddress->barangay.', '.$permanentAddress->city.', '.$permanentAddress->postal_code.' '.$permanentAddress->province}}
                                </dt>
                                <dt class="col-md-3"><h4 class="font-size-15"><strong>Present Address:</strong></h4></dt>
                                <dt class="col-md-9 px-1">
                                    {{ $presentAddress->address_line_two.' '.$presentAddress->address_line_one.', '.
                                       $presentAddress->barangay.', '.$presentAddress->city.', '.$presentAddress->postal_code.' '.$presentAddress->province}}
                                </dt>
                                <dt class="col-md-3"><h4 class="font-size-15"><strong>Provincial Address:</strong></h4></dt>
                                <dt class="col-md-9 px-1">
                                    {{ $provincialAddress->address_line_two.' '.$provincialAddress->address_line_one.' '.
                                       $provincialAddress->barangay.' '.$provincialAddress->city.' '.$provincialAddress->postal_code.' '.$provincialAddress->province}}
                                </dt>
                            </dl>
                            <!--End Address -->

                            <!--Education, Contact, and Interview -->
                            <dl class="row mb-0 col-lg-6">
                                <dt class="col-md-6"><h4 class="font-size-15"><strong>Educational Attainment:</strong></h4></dt>
                                <dt class="col-md-6">{{ $beneficiary->educational_attainment }}</dt>
                                <dt class="col-md-6"><h4 class="font-size-15"><strong>Last School Year Attended:</strong></h4></dt>
                                <dt class="col-md-6">{{ $beneficiary->last_school_year_attended }}</dt>
                            </dl>
                            <dl class="row mb-0 col-lg-6">
                                <dt class="col-md-6"><h4 class="font-size-15"><strong>Contact No:</strong></h4></dt>
                                <dt class="col-md-6">{{ $beneficiary->contact_no }}</dt>
                                <dt class="col-md-6"><h4 class="font-size-15"><strong>Interview Date Time:</strong></h4></dt>
                                <dt class="col-md-6">{{ Carbon\Carbon::parse($beneficiary->interviewed_at)->toDayDateTimeString() }}</dt>
                            </dl>
                            <!--End Education, Contact, and Interview -->

                            <h4 class="my-3 mt-5" style="color: #62896d">Family Economic Information</h4>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="1">ID</th>
                                            <th>Name</th>
                                            <th>Date of Birth</th>
                                            <th>Age on Interview</th>
                                            <th>Relationship</th>
                                            <th>Civil Status</th>
                                            <th>Education</th>
                                            <th>Occupation</th>
                                            <th>Income</th>
                                            <th>Whereabouts</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @if ($beneficiary->families->count() == 0)
                                    <tr>
                                        <td colspan="10" class="text-center small text-muted">
                                            This beneficiary currently has no family records
                                        </td>
                                    </tr>
                                    @endif
                                    @foreach($beneficiary->families as $key => $fi)
                                        <tr>
                                            <th scope="row">{{ $key+1 }}</th>
                                            <td>{{ $fi->last_name . ', ' . $fi->first_name .' '. $fi->middle_name}}</td>
                                            <td>{{ Carbon\Carbon::parse($fi->birth_date)->toFormattedDateString() }}</td>
                                            <td>{{ Carbon\Carbon::parse($fi->birth_date)->diff(Carbon\Carbon::parse($beneficiary->interviewed_at))->y }}</td>
                                            <td>{{ $fi->relationship }}</td>
                                            <td>{{ $fi->civil_status }}</td>
                                            <td>{{ $fi->education }}</td>
                                            <td>{{ $fi->occupation }}</td>
                                            <td>{{ $fi->income }}</td>
                                            <td>{{ $fi->where_abouts }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!--Problem -->
                            <h4 class="my-3 mt-5" style="color: #62896d">Problem Presented</h4>
                            <p>{{ $bgInfo->problem_presented }}</p>
                            <!--End Problem-->


                            <h4 class="my-3" style="color: #62896d">Background Information</h4>

                            <h6>A. About the Client</h6>
                            <p>{{ $bgInfo->about_client }}</p>

                            <h6>B. About the Family</h6>
                            <p>{{ $bgInfo->about_family }}</p>

                            <h6>C. About the Community</h6>
                            <p>{{ $bgInfo->about_community }}</p>


                            <!--Assessment / Recommendation -->
                            <h4 class="my-3" style="color: #62896d">Assessment / Recommendation</h4>
                            <p>{{ $bgInfo->assessment }}</p>
                            <!--End Assessment / Recommendation-->

                            <!-- Category and Label -->
                            <dl class="row mb-0 col-lg-6 mt-3">
                                <dt class="col-md-6"><h4 class="font-size-15 float-end"><strong>Category:</strong></h4></dt>
                                <dt class="col-md-6">{{ $beneficiary->category }}</dt>
                            </dl>
                            <dl class="row mb-0 col-lg-6 mt-3">
                                <dt class="col-md-6"><h4 class="font-size-15 float-end"><strong>Label:</strong></h4></dt>
                                <dt class="col-md-6">{{ $beneficiary->label }}</dt>
                            </dl>
                            <!--End Category and Label -->

                            <!--Prepared and Noted by -->
                            <dl class="row mb-0 col-lg-6 mt-3">
                                <dt class="col-md-6"><h4 class="font-size-15 float-end"><strong>Prepared by:</strong></h4></dt>
                                <dt class="col-md-6">{{ $beneficiary->prepared_by }}</dt>
                            </dl>

                            <dl class="row mb-0 col-lg-6 mt-3">
                                <dt class="col-md-6"><h4 class="font-size-15 float-end"><strong>Noted by:</strong></h4></dt>
                                <dt class="col-md-6">{{ $beneficiary->noted_by }}</dt>
                            </dl>
                            <!--End Prepared and Noted by -->

                        </div>

                        <div class="row p-3">
                            <div class="">
                                <button type="button" class="btn btn-dark btn-rounded w-md waves-effect waves-light float-end"
                                        data-bs-toggle="modal" data-bs-target="#editModal">
                                    <i class="ri-edit-line"></i> Edit
                                </button>
                                <button type="button" class="btn btn-outline-danger btn-rounded w-md waves-effect waves-light float-end mx-2"
                                    data-bs-toggle="modal" data-bs-target="#deleteModal">
                                    <i class="ri-delete-bin-line"></i> Delete
                                </button>
                            </div>
                        </div>


                        <!-- Edit Modal -->
                        <div id="editModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="myModalLabel"><i class="mdi mdi-information-outline me-2"></i> You are about to edit a record</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="POST" action="{{ route('charity.beneficiaries.editPart', $beneficiary->code) }}">
                                        @csrf
                                        <div class="modal-body">
                                                <p>Please the part you want to edit</p>
                                            <div class="form-control">
                                                <input type="radio" id="edit_part1" name="edit_part" value="1">
                                                <label for="edit_part1">Part 1</label>
                                                <p>Indentifying the information of the Beneficiary</p>
                                            </div>
                                            <br/>
                                            <div class="form-control">
                                                <input type="radio" id="edit_part2" name="edit_part" value="2">
                                                <label for="edit_part2">Part 2</label>
                                                <p>Family composition and economic information</p>
                                            </div>
                                            <br/>
                                            <div class="form-control">
                                                <input type="radio" id="edit_part3" name="edit_part" value="3">
                                                <label for="edit_part3">Part 3</label>
                                                <p>Evaluation of the beneficiary</p>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-light waves-effect w-sm" data-bs-dismiss="modal">Proceed</button>
                                        </div>
                                    </form>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div>

                        <!-- Delete Modal -->
                        <div id="deleteModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="myModalLabel"><i class="mdi mdi-alert-outline me-2"></i> Warning</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>You are about to delete the selected beneficiary <strong>{{ $beneficiary->last_name . ', ' . $beneficiary->first_name .' '. $beneficiary->middle_name}}
                                            </strong> permanently. This action cannot be undone and will notify all other users in your Charitable Organization. Continue?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light waves-effect w-sm" data-bs-dismiss="modal">No</button>
                                        <form method="GET" action="{{ route('charity.beneficiaries.delete', $beneficiary->code) }}">
                                            @csrf
                                            <button type="submit" class="btn btn-danger waves-effect waves-light w-sm">Yes</button>
                                        </form>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div>


                    </div><!-- end cardbody -->
                </div><!-- end card -->
            </div><!-- end col -->
        </div>
        <!-- end row -->
    </div>
</div>
@endsection
