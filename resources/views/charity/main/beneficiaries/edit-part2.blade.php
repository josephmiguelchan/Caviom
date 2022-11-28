@extends('charity.charity_master')
@section('title', 'Edit Beneficiary')
@section('charity')

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
                        <li class="breadcrumb-item active">Edit</li>
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
                        <div class="row">
                            <div class="col-lg-8">
                                <h1><strong>Edit Beneficiary</strong></h1>
                                <p>{{$beneficiary->first_name . ' ' . $beneficiary->last_name}}</p>
                            </div>
                            <div class="col-lg-4 mt-4">
                                <a href="{{route('charity.beneficiaries.all')}}" class="text-link float-end">
                                    <i class="ri-arrow-left-line"></i> Go Back
                                </a>
                            </div>
                        </div>
                        <hr class="my-3">
                        <h2 class="my-3 mt-5" style="color: #62896d" ><strong>II. Family Economic Information</strong></h2>

                        <!-- Family Information -->
                        <div class="table-responsive">

                            <!-- View All -->
                            <table class="table table-bordered table-hover mb-0">
                                <thead class="table-light">
                                <tr>
                                    <th scope="1">No.</th>
                                    <th>Name</th>
                                    <th>Birthday</th>
                                    <th>Age on Interview</th>
                                    <th>Relationship</th>
                                    <th>Civil Status</th>
                                    <th>Education</th>
                                    <th>Occupation</th>
                                    <th>Income</th>
                                    <th>Whereabouts</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($familyInfo as $key => $fi)
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
                                        <td>
                                            <button type="button" class="btn btn-sm btn-dark btn-rounded waves-effect waves-light"
                                                    data-bs-toggle="modal" data-bs-target="#editFamilyModal_{{ $key+1 }}">
                                                <i class="ri-edit-line"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-outline-danger btn-rounded waves-effect waves-light"
                                                    data-bs-toggle="modal" data-bs-target="#deleteFamilyModal_{{ $key+1 }}">
                                                <i class="ri-delete-bin-line"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            @if($beneficiary->families->count() >= 20)
                                <p class="text-danger text-center small mt-2">You have already reached a maximum of 20 family members for this Beneficiary.</p>
                            @endif
                            <button type="button" class="my-2 btn w-xl btn-success waves-effect waves-light float-end" data-bs-toggle="modal" data-bs-target="#addFamilyModal"
                                {{$beneficiary->families->count() >= 20 ? 'disabled' : ''}}>
                                <i class="ri-user-add-line"></i> Add New
                            </button>

                            <!-- Modal for Add Family -->
                            <form method="POST" action="{{ route('charity.beneficiaries2.storePart2', $beneficiary->code) }}" enctype="multipart/form-data">
                                <div class="modal fade" id="addFamilyModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="addFamilyModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="addFamilyModalLabel">Add Family Member</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                @csrf
                                                <!-- Full Name Form Group -->
                                                    <div class="form-group mb-3 row">

                                                        <!-- Form type -->
                                                        <input type="hidden" name="form_type" id="form_type"  value="redirectToViewAfterEdit" />

                                                        <!-- First Name -->
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="fam_first_name" class="form-label">*First Name</label>
                                                                <input type="text" class="form-control" name="fam_first_name" id="fam_first_name" required
                                                                       value="{{ old('fam_first_name') }}">
                                                                @error('fam_first_name')
                                                                <div class="text-danger">
                                                                    {{ $message }}
                                                                </div>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <!-- Middle Name -->
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="fam_middle_name" class="form-label">Middle Name</label>
                                                                <input type="text" class="form-control" name="fam_middle_name" id="fam_middle_name" value="{{ old('fam_middle_name') }}">
                                                                @error('fam_middle_name')
                                                                <div class="text-danger">
                                                                    {{ $message }}
                                                                </div>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <!-- Last Name -->
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="fam_last_name" class="form-label">*Last Name</label>
                                                                <input type="text" class="form-control" name="fam_last_name" id="fam_last_name" required
                                                                       value="{{ old('fam_last_name') }}">
                                                                @error('fam_last_name')
                                                                <div class="text-danger">
                                                                    {{ $message }}
                                                                </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div><!-- End Full Name Form Group -->

                                                    <div class="form-group mb-3 row">
                                                        <!-- Date of Birth -->
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="fam_birth_date" class="form-label">Date of Birth</label>
                                                                <input class="form-control" name="fam_birth_date" id="fam_birth_date" type="date" value="{{ old('fam_birth_date') }}">
                                                                @error('fam_birth_date')
                                                                <div class="text-danger">
                                                                    {{ $message }}
                                                                </div>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <!-- Relationship -->
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="fam_relationship" class="form-label">*Relationship</label>
                                                                <input class="form-control" name="fam_relationship" id="fam_relationship" type="text" required
                                                                       value="{{ old('fam_relationship') }}">
                                                                @error('fam_relationship')
                                                                <div class="text-danger">
                                                                    {{ $message }}
                                                                </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group mb-3 row">
                                                        <!-- Civil Status -->
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="fam_civil_status" class="form-label">Civil Status</label>
                                                                <select class="form-control" name="fam_civil_status" id="fam_civil_status">
                                                                    <option value="{{ old('fam_civil_status') }}">{{ old('fam_civil_status') }}</option>
                                                                    <option value="n/a">n/a</option>
                                                                    <option value="Single">Single</option>
                                                                    <option value="Married">Married</option>
                                                                    <option value="Widowed">Widowed</option>
                                                                    <option value="Separated">Separated</option>
                                                                    <option value="Divorced">Divorced</option>
                                                                </select>
                                                                @error('fam_civil_status')
                                                                <div class="text-danger">
                                                                    {{ $message }}
                                                                </div>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <!-- Education -->
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="fam_education" class="form-label">Education</label>
                                                                <select class="form-control" name="fam_education" id="fam_education" type="dropdown">
                                                                    <option value="{{ old('fam_education') }}">{{ old('fam_education') }}</option>
                                                                    <option value="n/a">n/a</option>
                                                                    <option value="Out-of-school Youth/Adult">Out-of-school Youth/Adult</option>
                                                                    <option value="Alternative Learning System (ALS)">Alternative Learning System (ALS)</option>
                                                                    <option value="Preschool">Preschool</option>
                                                                    <option value="Kinder">Kinder</option>
                                                                    <option value="Primary Education - Grade 1">Primary Education - Grade 1</option>
                                                                    <option value="Primary Education - Grade 2">Primary Education - Grade 2</option>
                                                                    <option value="Primary Education - Grade 3">Primary Education - Grade 3</option>
                                                                    <option value="Primary Education - Grade 4">Primary Education - Grade 4</option>
                                                                    <option value="Primary Education - Grade 5">Primary Education - Grade 5</option>
                                                                    <option value="Primary Education - Grade 6">Primary Education - Grade 6</option>
                                                                    <option value="Lower Secondary Education (JHS) - Grade 7">Lower Secondary Education (JHS) - Grade 7</option>
                                                                    <option value="Lower Secondary Education (JHS) - Grade 8">Lower Secondary Education (JHS) - Grade 8</option>
                                                                    <option value="Lower Secondary Education (JHS) - Grade 9">Lower Secondary Education (JHS) - Grade 9</option>
                                                                    <option value="Lower Secondary Education (JHS) - Grade 10">Lower Secondary Education (JHS) - Grade 10</option>
                                                                    <option value="Upper Secondary Education (SHS) - Grade 11">Upper Secondary Education (SHS) - Grade 11</option>
                                                                    <option value="Upper Secondary Education (SHS) - Grade 12">Upper Secondary Education (SHS) - Grade 12</option>
                                                                    <option value="Undergraduate (Bachelor’s Degree)">Undergraduate (Bachelor’s Degree)</option>
                                                                    <option value="Postgraduate (Master’s Degree)">Postgraduate (Master’s Degree)</option>
                                                                    <option value="Doctoral (PhD)">Doctoral (PhD)</option>
                                                                </select>
                                                                @error('fam_education')
                                                                <div class="text-danger">
                                                                    {{ $message }}
                                                                </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group mb-3 row">
                                                        <!-- Occupation -->
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="fam_occupation" class="form-label">Occupation</label>
                                                                <input class="form-control" name="fam_occupation" id="fam_occupation" type="text" value="{{ old('fam_occupation') }}">
                                                                @error('fam_occupation')
                                                                <div class="text-danger">
                                                                    {{ $message }}
                                                                </div>
                                                                @enderror
                                                            </div>
                                                        </div>

                                                        <!-- Income -->
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="fam_income" class="form-label">Income</label>
                                                                <input class="form-control" name="fam_income" id="fam_income" type="text" value="{{ old('fam_income') }}">
                                                                @error('fam_income')
                                                                <div class="text-danger">
                                                                    {{ $message }}
                                                                </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- Whereabouts -->
                                                    <div class="row form-group mb-3">
                                                        <div class="col-md-12">
                                                            <label for="fam_where_abouts" class="form-label">Whereabouts</label>
                                                            <input type="text" class="form-control" name="fam_where_abouts" id="fam_where_abouts" value="{{ old('fam_where_abouts') }}">
                                                            @error('fam_where_abouts')
                                                            <div class="text-danger">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light btn-rounded w-md waves-effect" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-dark btn-rounded w-md waves-effect waves-light">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <!-- Modal for Edit Family -->
                            @foreach($familyInfo as $key => $fi)
                            <div class="modal fade" id="editFamilyModal_{{ $key+1 }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="editFamilyModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editFamilyModalLabel">Edit Family Member</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="{{ route('charity.beneficiaries2.updatePart2', ['id' => $fi->id, 'beneficiary_code' => $beneficiary->code]) }}">
                                            @csrf

                                            <!-- Form type -->
                                                <input type="hidden" name="form_type" id="form_type" value="redirectToViewAfterEdit" />

                                            <!-- Full Name Form Group -->
                                                <div class="form-group mb-3 row">
                                                    <!-- First Name -->
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="edit_fam_first_name" class="form-label">*First Name</label>
                                                            <input type="text" class="form-control" name="edit_fam_first_name" id="edit_fam_first_name" required
                                                                   value="{{ old('edit_fam_first_name', $fi->first_name) }}">
                                                            @error('edit_fam_first_name')
                                                            <div class="text-danger">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <!-- Middle Name -->
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="edit_fam_middle_name" class="form-label">Middle Name</label>
                                                            <input type="text" class="form-control" name="edit_fam_middle_name" id="edit_fam_middle_name"
                                                                   value="{{ old('edit_fam_middle_name', $fi->middle_name) }}">
                                                            @error('edit_fam_middle_name')
                                                            <div class="text-danger">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <!-- Last Name -->
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label for="edit_fam_last_name" class="form-label">*Last Name</label>
                                                            <input type="text" class="form-control" name="edit_fam_last_name" id="edit_fam_last_name" required
                                                                   value="{{ old('edit_fam_last_name', $fi->last_name) }}">
                                                            @error('edit_fam_last_name')
                                                            <div class="text-danger">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div><!-- End Full Name Form Group -->

                                                <div class="form-group mb-3 row">
                                                    <!-- Date of Birth -->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="edit_fam_birth_date" class="form-label">*Date of Birth</label>
                                                            <input class="form-control" name="edit_fam_birth_date" id="edit_fam_birth_date" type="date" required
                                                                   value="{{ old('edit_fam_birth_date', $fi->birth_date) }}">
                                                            @error('edit_fam_birth_date')
                                                            <div class="text-danger">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <!-- Relationship -->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="edit_fam_relationship" class="form-label">*Relationship</label>
                                                            <input class="form-control" name="edit_fam_relationship" id="edit_fam_relationship" type="text" required
                                                                   value="{{ old('edit_fam_relationship', $fi->relationship) }}">
                                                            @error('edit_fam_relationship')
                                                            <div class="text-danger">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group mb-3 row">
                                                    <!-- Civil Status -->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="edit_fam_civil_status" class="form-label">Civil Status</label>
                                                            <select class="form-control" name="edit_fam_civil_status" id="edit_fam_civil_status">
                                                                <option value="{{ old('edit_fam_civil_status',$fi->civil_status) }}">{{ old('edit_fam_civil_status',$fi->civil_status) }}</option>
                                                                <option value="n/a">n/a</option>
                                                                <option value="Single">Single</option>
                                                                <option value="Married">Married</option>
                                                                <option value="Widowed">Widowed</option>
                                                                <option value="Separated">Separated</option>
                                                                <option value="Divorced">Divorced</option>
                                                            </select>
                                                            @error('edit_fam_civil_status')
                                                            <div class="text-danger">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <!-- Education -->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="edit_fam_education" class="form-label">Education</label>
                                                            <select class="form-control" name="edit_fam_education" id="edit_fam_education" type="dropdown">
                                                                <option value="{{ old('edit_fam_education', $fi->education) }}">{{ old('edit_fam_education', $fi->education) }}</option>
                                                                <option value="n/a">n/a</option>
                                                                <option value="Out-of-school Youth/Adult">Out-of-school Youth/Adult</option>
                                                                <option value="Alternative Learning System (ALS)">Alternative Learning System (ALS)</option>
                                                                <option value="Preschool">Preschool</option>
                                                                <option value="Kinder">Kinder</option>
                                                                <option value="Primary Education - Grade 1">Primary Education - Grade 1</option>
                                                                <option value="Primary Education - Grade 2">Primary Education - Grade 2</option>
                                                                <option value="Primary Education - Grade 3">Primary Education - Grade 3</option>
                                                                <option value="Primary Education - Grade 4">Primary Education - Grade 4</option>
                                                                <option value="Primary Education - Grade 5">Primary Education - Grade 5</option>
                                                                <option value="Primary Education - Grade 6">Primary Education - Grade 6</option>
                                                                <option value="Lower Secondary Education (JHS) - Grade 7">Lower Secondary Education (JHS) - Grade 7</option>
                                                                <option value="Lower Secondary Education (JHS) - Grade 8">Lower Secondary Education (JHS) - Grade 8</option>
                                                                <option value="Lower Secondary Education (JHS) - Grade 9">Lower Secondary Education (JHS) - Grade 9</option>
                                                                <option value="Lower Secondary Education (JHS) - Grade 10">Lower Secondary Education (JHS) - Grade 10</option>
                                                                <option value="Upper Secondary Education (SHS) - Grade 11">Upper Secondary Education (SHS) - Grade 11</option>
                                                                <option value="Upper Secondary Education (SHS) - Grade 12">Upper Secondary Education (SHS) - Grade 12</option>
                                                                <option value="Undergraduate (Bachelor’s Degree)">Undergraduate (Bachelor’s Degree)</option>
                                                                <option value="Postgraduate (Master’s Degree)">Postgraduate (Master’s Degree)</option>
                                                                <option value="Doctoral (PhD)">Doctoral (PhD)</option>
                                                            </select>
                                                            @error('edit_fam_education')
                                                            <div class="text-danger">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group mb-3 row">
                                                    <!-- Occupation -->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="edit_fam_occupation" class="form-label">Occupation</label>
                                                            <input class="form-control" name="edit_fam_occupation" id="edit_fam_occupation" type="text"
                                                                   value="{{ old('edit_fam_occupation', $fi->occupation) }}">
                                                            @error('edit_fam_occupation')
                                                            <div class="text-danger">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <!-- Income -->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="edit_fam_income" class="form-label">Income</label>
                                                            <input class="form-control" name="edit_fam_income" id="edit_fam_income" type="text"
                                                                   value="{{ old('edit_fam_income', $fi->income) }}">
                                                            @error('edit_fam_income')
                                                            <div class="text-danger">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Whereabouts -->
                                                <div class="row form-group mb-3">
                                                    <div class="col-md-12">
                                                        <label for="edit_fam_where_abouts" class="form-label">Whereabouts</label>
                                                        <input type="text" class="form-control" name="edit_fam_where_abouts" id="edit_fam_where_abouts"
                                                               value="{{ old('edit_fam_where_abouts', $fi->where_abouts) }}">
                                                        @error('edit_fam_where_abouts')
                                                        <div class="text-danger">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-light btn-rounded w-md waves-effect" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-dark btn-rounded w-md waves-effect waves-light">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Delete modal for Family member -->
                                <div id="deleteFamilyModal_{{ $key+1 }}" class="modal fade" tabindex="-1" aria-labelledby="deleteFamilyModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="myModalLabel"><i class="mdi mdi-alert-outline me-2"></i> Are you sure?</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>You are about to delete the selected family member <strong> {{ $fi->last_name . ', ' . $fi->first_name .' '. $fi->middle_name}} </strong> permanently. Continue?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light waves-effect w-sm" data-bs-dismiss="modal">No</button>
                                                <form method="POST" action="{{ route('charity.beneficiaries2.destroyPart2', ['id' => $fi->id, 'beneficiary_code' => $beneficiary->code]) }}">
                                                    @csrf

                                                    <!-- Form type -->
                                                        <input type="hidden" name="form_type" id="form_type" value="redirectToViewAfterEdit" />

                                                    <button type="submit" class="btn btn-danger waves-effect waves-light w-sm">
                                                        Yes
                                                    </button>
                                                </form>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div>
                            @endforeach

                        </div><!-- End Family Information -->

                        <div class="row p-3">
                            <div class="row">
                                <div class="col-md-8">
                                    <p class="text-center mb-0 small col-2">Part 2/3</p>
                                    <div class="progress col-2">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100" style="width: 66%"></div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <a href="{{ route('charity.beneficiaries.show', $beneficiary->code) }}" class="btn btn-dark btn-rounded w-md waves-effect waves-light float-end">
                                        Go Back
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div><!-- end cardbody -->
                </div><!-- end card -->
            </div><!-- end col -->
        </div>
        <!-- end row -->
    </div>
</div>
@endsection
