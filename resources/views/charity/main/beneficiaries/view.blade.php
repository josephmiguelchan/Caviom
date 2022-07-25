@extends('charity.charity_master')
@section('title', 'View Beneficiary')
@section('charity')

@php
    $avatar = 'upload/avatar_img/'.Auth::user()->profile_image;
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
                            <a href="{{ route('charity.beneficiaries') }}">Beneficiaries</a>
                        </li>
                        <li class="breadcrumb-item active">View</li>
                    </ol>
                    <button type="button" data-bs-target=".bs-example-modal-center" title="Learn more" class="btn btn-link waves-effect p-0 mb-3" data-bs-toggle="modal">
                        <small>
                            <i class="mdi mdi-information"></i> Learn more about Beneficiaries
                        </small>
                    </button>

                    <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">What are Beneficiaries?</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Beneficiaries are eme eme</p>
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
                                    <a  data-bs-toggle="modal" data-bs-target="#exportBlankModal" href="javascript:void(0);" class="dropdown-item"><i class="mdi mdi-file-download-outline"></i> Export Blank Copy to PDF</a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <a href="{{route('charity.beneficiaries')}}" class="text-link">
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
                                        <p>You are about to attempt to back up the data of the selected beneficiary [<strong> Olarte, Clark Louise </strong>].
                                            This action will notify all other users in your Charitable Organization. Continue?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light waves-effect w-sm" data-bs-dismiss="modal">No</button>
                                        <button type="button" class="btn btn-dark waves-effect waves-light w-sm">Yes</button>
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
                                        <p>You are about to attempt to export a blank copy of the selected beneficiary [<strong> Olarte, Clark Louise </strong>] for
                                            manual assessment. This action will notify all other users in your Charitable Organization. Continue?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light waves-effect w-sm" data-bs-dismiss="modal">No</button>
                                        <button type="button" class="btn btn-dark waves-effect waves-light w-sm">Yes</button>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div>

                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <div class="user-profile text-center mt-3">
                                <div>
                                    <img src="{{ url('upload/avatar_img/no_avatar.png') }}"
                                        alt="Profile Picture" class="avatar-xl rounded-circle">
                                </div>
                                <div class="mt-3">
                                    <p class="text-muted mb-1">ID No. 1</p>
                                    <h1 class="py-3" style="color: #62896d">
                                        <strong>
                                            {{-- {{ Auth::user()->info->last_name . ', ' . Auth::user()->info->first_name }}
                                            @if (Auth::user()->info->middle_name)
                                            {{
                                                ' ' . Auth::user()->info->middle_name
                                            }}
                                            @endif --}}
                                            Olarte, Clark Louse Sinko
                                        </strong>
                                    </h1>
                                </div>
                            </div>
                        </div>
                        <div class="row px-4">
                            <!-- Dates -->
                            <dl class="row mb-0 col-lg-6">
                                <dt class="col-md-6"><h4 class="font-size-15"><strong>Date Added:</strong></h4></dt>
                                <dt class="col-md-6">{{ Carbon\Carbon::parse(Auth::user()->created_at)->toFormattedDateString() }}</dt>
                            </dl>
                            <dl class="row mb-0 col-lg-6">
                                <dt class="col-md-6"><h4 class="font-size-15"><strong>Last Updated at:</strong></h4></dt>
                                <dt class="col-md-6">{{ Carbon\Carbon::parse(Auth::user()->info->updated_at)->diffForHumans() }}</dt>
                                <dt class="col-md-6"><h4 class="font-size-15"><strong>Last Modified by:</strong></h4></dt>
                                <dt class="col-md-6">Martin Agpalza</dt>
                            </dl>
                            <!--End Dates -->

                            <!--Basic Info -->
                            <hr class="my-3">
                            <h4 class="my-3" style="color: #62896d">Personal Information</h4>
                            <dl class="row mb-0 col-lg-6">
                                <dt class="col-md-6"><h4 class="font-size-15"><strong>Nickname:</strong></h4></dt>
                                <dt class="col-md-6">Clark</dt>
                                <dt class="col-md-6"><h4 class="font-size-15"><strong>Religion:</strong></h4></dt>
                                <dt class="col-md-6">Roman Catholic</dt>
                            </dl>
                            <dl class="row mb-0 col-lg-6">
                                <dt class="col-md-6"><h4 class="font-size-15"><strong>Birth Date:</strong></h4></dt>
                                <dt class="col-md-6">Aug. 8, 2018</dt>
                                <dt class="col-md-6"><h4 class="font-size-15"><strong>Birth Place:</strong></h4></dt>
                                <dt class="col-md-6">Manila</dt>
                                <dt class="col-md-6"><h4 class="font-size-15"><strong>Age on Interview:</strong></h4></dt>
                                <dt class="col-md-6">4 years old</dt>
                            </dl>
                            <!--End Basic Info -->

                            <!--Address -->
                            <dl class="row my-4">
                                <dt class="col-md-3"><h4 class="font-size-15"><strong>Present Address:</strong></h4></dt>
                                <dt class="col-md-9 px-1">
                                    {{
                                        Auth::user()->info->address->address_line_two . ' ' . Auth::user()->info->address->address_line_one . ', ' .
                                        Auth::user()->info->address->barangay . ', ' . Auth::user()->info->address->city . ', ' . Auth::user()->info->address->province
                                    }}
                                </dt>
                                <dt class="col-md-3"><h4 class="font-size-15"><strong>Permanent Address:</strong></h4></dt>
                                <dt class="col-md-9 px-1">
                                    {{
                                        Auth::user()->info->address->address_line_two . ' ' . Auth::user()->info->address->address_line_one . ', ' .
                                        Auth::user()->info->address->barangay . ', ' . Auth::user()->info->address->city . ', ' . Auth::user()->info->address->province
                                    }}
                                </dt>
                                <dt class="col-md-3"><h4 class="font-size-15"><strong>Provincial Address:</strong></h4></dt>
                                <dt class="col-md-9 px-1">
                                    {{-- {{
                                        Auth::user()->info->address->address_line_two . ' ' . Auth::user()->info->address->address_line_one . ', ' .
                                        Auth::user()->info->address->barangay . ', ' . Auth::user()->info->address->city . ', ' . Auth::user()->info->address->province
                                    }} --}}
                                    None
                                </dt>
                            </dl>
                            <!--End Address -->

                            <!--Education, Contact, and Interview -->
                            <dl class="row mb-0 col-lg-6">
                                <dt class="col-md-6"><h4 class="font-size-15"><strong>Educational Attainment:</strong></h4></dt>
                                <dt class="col-md-6">Pre-school</dt>
                                <dt class="col-md-6"><h4 class="font-size-15"><strong>Last School Year Attended:</strong></h4></dt>
                                <dt class="col-md-6">2021 - 2022</dt>
                            </dl>
                            <dl class="row mb-0 col-lg-6">
                                <dt class="col-md-6"><h4 class="font-size-15"><strong>Contact No:</strong></h4></dt>
                                <dt class="col-md-6">None</dt>
                                <dt class="col-md-6"><h4 class="font-size-15"><strong>Interview Date Time:</strong></h4></dt>
                                <dt class="col-md-6">{{ Carbon\Carbon::parse(Auth::user()->created_at)->toDayDateTimeString() }}</dt>
                            </dl>
                            <!--End Education, Contact, and Interview -->

                            <h4 class="my-3 mt-5" style="color: #62896d">Family Economic Information</h4>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
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
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>Clarice Olarte</td>
                                            <td>47 years old</td>
                                            <td>Mother</td>
                                            <td>Widowed</td>
                                            <td>Elementary Graduate</td>
                                            <td>Vendor</td>
                                            <td>P300 / day</td>
                                            <td>---</td>
                                        </tr>
                                        <tr>
                                            <th scope="row">2</th>
                                            <td>Victoria Sanches</td>
                                            <td>78 years old</td>
                                            <td>Grandmother</td>
                                            <td>Widowed</td>
                                            <td>Illiterate</td>
                                            <td>None</td>
                                            <td>0</td>
                                            <td>---</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!--Problem -->
                            <h4 class="my-3 mt-5" style="color: #62896d">Problem Presented</h4>
                            <p>
                                Clark is incoming kinder student but their family cannot afford to send her to school due to lack of money.
                                The money that mother earns in selling for 8 hours a day which is only 300 pesos is not enough to buy their
                                daily meals and medication for their grandmother.
                            </p>
                            <!--End Problem-->


                            <h4 class="my-3" style="color: #62896d">Background Information</h4>

                            <h6>A. About the Client</h6>
                            <p>
                                The family lives in the slum area of Barangay 133. Every morning, her mother goes to wet market to sell
                                salt. While her mother is away, Clark is under the care of her grandmother. When the grandmother is feeling okay,
                                she and Althea creates basket crafts and sells them for P50.
                            </p>

                            <h6>B. About the Family</h6>
                            <p>
                                A typical low-income family in the United States is a mother and one or two children. An average day for such a
                                family starts early, with the mother feeding the children before they start school. The children usually do their
                                homework, sometimes even while going on a field trip to see another school. After school they play sports and engage
                                in hobbies before enjoying a meal with their families. Following this meal comes a long day of relaxation or watching
                                TV as everyone enjoys downtime together.
                            </p>

                            <h6>C. About the Community</h6>
                            <p>
                                This project is based on real experiences of the poor Filipino community living in a community where poverty is rampant.
                                We have been conducting more than 30 interviews and observation with local families who are struggling to make ends meet.
                            </p>


                            <!--Assessment / Recommendation -->
                            <h4 class="my-3" style="color: #62896d">Assessment / Recommendation</h4>
                            <p>
                                Charity work is a joint mission for us. We have demonstrated our tacit commitment and pride during our as well as the
                                beneficiary’s regular assessment visits and discussions at the field level. We had also recommended a series of strategies
                                to help the child combat malnourishment and poverty.
                            </p>
                            <!--End Assessment / Recommendation-->

                            <!--Prepared and Noted by -->
                            <dl class="row mb-0 col-lg-6 my-5">
                                <dt class="col-md-6"><h4 class="font-size-15 float-end"><strong>Prepared by:</strong></h4></dt>
                                <dt class="col-md-6">Shiella Kay</dt>
                            </dl>
                            <dl class="row mb-0 col-lg-6 mt-5">
                                <dt class="col-md-6"><h4 class="font-size-15 float-end"><strong>Noted by:</strong></h4></dt>
                                <dt class="col-md-6">Justin Coa</dt>
                            </dl>
                            <!--End Prepared and Noted by -->

                        </div>

                        <div class="row p-3">
                            <div class="">
                                <a href="{{ route('user.profile.edit') }}" class="btn btn-dark btn-rounded w-md waves-effect waves-light float-end">
                                    <i class="ri-edit-line"></i> Edit
                                </a>
                                <button type="button" class="btn btn-outline-danger btn-rounded w-md waves-effect waves-light float-end mx-2"
                                    data-bs-toggle="modal" data-bs-target="#deleteModal">
                                    <i class="ri-delete-bin-line"></i> Delete
                                </button>
                            </div>
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
                                        <p>You are about to delete the selected beneficiary [<strong> Olarte, Clark Louise </strong>] permanently . This action
                                            cannot be undone and will notify all other users in your Charitable Organization. Continue?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light waves-effect w-sm" data-bs-dismiss="modal">No</button>
                                        <button type="button" class="btn btn-danger waves-effect waves-light w-sm">Yes</button>
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