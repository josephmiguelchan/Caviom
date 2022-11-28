@extends('admin.admin_master')
@section('title', 'Edit Profile')
@section('charity')

@php
    $avatar = 'upload/avatar_img/'.$User->profile_image;
    $defaultAvatar = 'upload/avatar_img/no_avatar.png';

    $userremarks = App\Models\Admin\Notifier::where('category', 'Charity User')->get();


@endphp

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="">
                    <div class="p-2">
                        <h1 class="mb-0" style="color: #62896d"><strong>EDIT USER</strong></h1>
                        <ol class="breadcrumb m-0 p-0 mb-3">
                            <li class="breadcrumb-item">Menu</li>
                            <li class="breadcrumb-item">
                                <a href="{{route('admin.charities.all')}}">Charitable Organizations</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{route('admin.charities.view', $User->charity->code)}}">{{ $User->charity->name }}</a></li>
                            <li class="breadcrumb-item active">Edit Charity User</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <!-- Submit Modal -->
        <div id="submitModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel"><i class="mdi mdi-alert-outline me-2"></i> Warning</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>
                            You are about to make changes to this user. Continue?
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light waves-effect w-sm" data-bs-dismiss="modal">No</button>
                        <button type="submit" form="edit_user" class="btn btn-dark waves-effect waves-light w-sm">Yes</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="p-4">
                            <a href="{{ route('admin.charities.users.view', $User->code) }}" class="text-link">
                                <i class="ri-arrow-left-line"></i> Go Back
                            </a>
                        </div>
                        <div class="text-center">
                            <div class="user-profile text-center mt-3">
                                <div class="">
                                    <img src="{{ (!empty($User->profile_image))? url($avatar):url($defaultAvatar) }}"
                                        alt="Profile Picture" class="avatar-xl rounded-circle" id="showImage">
                                </div>
                                <div class="mt-3">
                                    <p class="text-muted mb-1"><span class="badge bg-light">ID No. {{ $User->info->organizational_id_no }}</span></p>
                                    <h4 class="font-size-12 text-dark">{{ Str::of($User->role)->upper() }}</h4>
                                    <h1 class="py-3" style="color: #62896d">
                                        <strong>
                                            {{ $User->info->last_name . ', ' . $User->info->first_name }}
                                            @if ($User->info->middle_name)
                                            {{
                                                ' ' . Str::substr($User->info->middle_name, 0, 1) . '.'
                                            }}
                                            @endif
                                        </strong>
                                    </h1>
                                </div>
                            </div>
                        </div>
                        <div class="row px-5">
                            <div class="row px-5 mb-5">
                                <dl class="row mb-0 col-lg-6">
                                    <dt class="col-md-6"><h4 class="font-size-15"><strong>Username:</strong></h4></dt>
                                    <dt class="col-md-6">
                                        @isset($User->username)
                                            {{'@'.$User->username}}
                                        @endisset
                                    </dt>
                                </dl>
                                <dl class="row mb-0 col-lg-6">
                                    <dt class="col-md-6"><h4 class="font-size-15"><strong>Last Updated:</strong></h4></dt>
                                    <dt class="col-md-6">{{ Carbon\Carbon::parse($User->info->updated_at)->diffForHumans() }}</dt>
                                </dl>
                                <dl class="row mb-0 col-lg-6">
                                    <dt class="col-md-6"><h4 class="font-size-15"><strong>Email Address:</strong></h4></dt>
                                    <dt class="col-md-6"><a href="mailto:{{$User->email}}">{{$User->email}}</a></dt>
                                </dl>
                                <dl class="row mb-0 col-lg-6">
                                    <dt class="col-md-6"><h4 class="font-size-15"><strong>Date Registered:</strong></h4></dt>
                                    <dt class="col-md-6">{{ Carbon\Carbon::parse($User->created_at)->toFormattedDateString() }}</dt>
                                </dl>
                                <dl class="row mb-0 col-lg-6">
                                    <dt class="col-md-6"><h4 class="font-size-15"><strong>Account Status:</strong></h4></dt>
                                    <dt class="col-md-6">{{$User->status}}</dt>
                                </dl>
                                <dl class="row mb-0 col-lg-6">
                                    <dt class="col-md-6"><h4 class="font-size-15"><strong>Remarks:</strong></h4></dt>
                                    <dt class="col-md-6"><h6 class="fw-bold">{{ empty($User->remarks)? '---': $User->remarks }}</h6></dt>
                                    <dt class="col-md-6 offset-md-6">{{ empty($User->remarks)? '': $User->remarks_message }}</dt>
                                </dl>
                            <hr class="my-3">

                            <form method="POST" action="#" enctype="multipart/form-data" class="form-horizontal" id="edit_user">
                                @csrf

                                <h4 class="mt-4" style="color: #62896d">Account</h4>

                                <div class="form-group mb-3 row">
                                    <!-- Email Add -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email" class="form-label">*Email Address</label>
                                            <input type="email" class="form-control" name="email" id="email"
                                                value="{{ empty($errors->has('email'))?old('email',$User->email):$User->email}}" required>
                                            @error('email')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Username -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="text" class="form-label">*Username</label>
                                            <input type="username" class="form-control" name="username" id="username"
                                                value="{{ empty($errors->has('username'))?old('username',$User->username):$User->username}}">
                                            @error('username')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-3 row">
                                    <!-- Password -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password" class="form-label">New Password (Optional)</label>
                                            <input type="password" class="form-control" name="password" id="password"
                                                value="">
                                            @error('password')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Confirm Password -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="confirm_password" class="form-label">Confirm Password</label>
                                            <input type="password" class="form-control" name="confirm_password" id="confirm_password"
                                                value="">
                                            @error('confirm_password')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-3 row">
                                    <!-- Account Status -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="account_status" class="form-label">*Account Status</label>
                                            <select class="form-select" name="account_status" id="account_status" aria-label="Select status">
                                                <option value="Pending Unlock" {{ ($User->status == 'Pending Unlock')? 'selected' : ''}} hidden>Pending Unlock</option>
                                                <option value="Active" {{ ($User->status == 'Active')? 'selected' : ''}}>Active</option>
                                                <option value="Inactive" {{ ($User->status == 'Inactive')? 'selected' : ''}}>Inactive</option>
                                            </select>
                                            @error('account_status')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Remarks -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="remarks" class="form-label">*Remarks</label>
                                            <select class="form-select select2-search-disable" name="remarks" id="remarks" aria-label="Select status">
                                                <!-- Foreach notifiers remarks with category of Charity User -->
                                                <option value="" {{($User->remarks == null)?'selected':''}}>None</option>
                                                @foreach ($userremarks as $item)
                                                <option value="{{$item->subject}}" {{ ($User->remarks == $item->subject )?'selected':''}}>{{ $item->subject }}</option>
                                                @endforeach
                                            </select>
                                            @error('remarks')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <h4 class="mt-4" style="color: #62896d">Personal Information</h4>

                                <div class="form-group mb-3 row">
                                    <!-- First Name -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="first_name" class="form-label">*First Name</label>
                                            <input type="text" class="form-control" name="first_name" id="first_name"
                                                value="{{ (empty($errors->has('first_name')))?old('first_name',$User->info->first_name):$User->info->first_name}}" required>
                                            @error('first_name')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Middle Name -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="middle_name" class="form-label">Middle Name</label>
                                            <input type="text" class="form-control" name="middle_name" id="middle_name"
                                                value="{{ (empty($errors->has('middle_name')))?old('middle_name',$User->info->middle_name):$User->info->middle_name}}">
                                            @error('middle_name')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Last Name -->
                                <div class="row form-group mb-3">
                                    <div class="col-md-12">
                                        <label for="last_name" class="form-label">*Last Name</label>
                                        <input type="text" class="form-control" name="last_name" id="last_name"
                                        value="{{ (empty($errors->has('last_name')))?old('last_name',$User->info->last_name):$User->info->last_name}}" required>
                                        @error('last_name')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <!-- Cellphone -->
                                    <div class="col-md-6">
                                        <div class="form-group mb-3 row">
                                            <div class="col-12">
                                                <label for="cel_no" class="form-label">*Cellphone No.</label>
                                                <span data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="yes" title="Ex. +63 998 123 4567">
                                                    <i class="mdi mdi-information-outline"></i>
                                                </span>
                                                <input class="form-control input-mask" name="cel_no" id="cel_no" type="tel"
                                                    placeholder="Ex. +63 998 123 4567" required data-inputmask="'mask': '+63 \\999 999 9999'"
                                                    value="{{ (empty($errors->has('cel_no')))?old('cel_no',$User->info->cel_no):$User->info->cel_no}}">
                                                @error('cel_no')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Telephone -->
                                    <div class="col-md-6">
                                        <div class="form-group mb-3 row">
                                            <div class="col-12">
                                                <label for="tel_no" class="form-label">Telephone No.</label>
                                                <span data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="yes"
                                                    title="Ex. +632 8123 6789">
                                                    <i class="mdi mdi-information-outline"></i>
                                                </span>
                                                <input class="form-control input-mask" name="tel_no" id="tel_no" type="tel"
                                                    placeholder="Ex. +632 8123 6789" data-inputmask="'mask': '+632 8999 9999'"
                                                    value="{{ (empty($errors->has('tel_no')))?old('tel_no',$User->info->tel_no):$User->info->tel_no}}">
                                                @error('tel_no')
                                                    <div class="text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Work Position -->
                                <div class="form-group mb-3 row">
                                    <div class="col-12">
                                        <label for="work_position" class="form-label">*Position in the Organization</label>
                                        <input class="form-control" name="work_position" id="work_position" type="text" required
                                            value="{{ (empty($errors->has('work_position')))?old('work_position',$User->info->work_position):$User->info->work_position}}">
                                        @error('work_position')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <h4 class="mt-4" style="color: #62896d">Current Address</h4>

                                <!-- Address Line 1 -->
                                <div class="form-group mb-3 row">
                                    <div class="col-12">
                                        <label for="address_line_one" class="form-label">*Address Line 1</label>
                                        <input class="form-control" name="address_line_one" id="address_line_one" type="text" required
                                            value="{{ (empty($errors->has('address_line_one')))?old('address_line_one',$User->info->address->address_line_one):$User->info->address->address_line_one}}">
                                        @error('address_line_one')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Address Line 2 -->
                                <div class="form-group mb-3 row">
                                    <div class="col-12">
                                        <label for="address_line_two" class="form-label">Address Line 2 (Optional)</label>
                                        <input class="form-control" name="address_line_two" id="address_line_two" type="text"
                                            value="{{ (empty($errors->has('address_line_two')))?old('address_line_two',$User->info->address->address_line_two):$User->info->address->address_line_two}}">
                                        @error('address_line_two')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group mb-3 row">
                                    <!-- Region -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="region" class="form-label">*Region</label>
                                            <input class="form-control" name="region" id="region" type="text" required
                                                value="{{ (empty($errors->has('region')))?old('region',$User->info->address->region):$User->info->address->region}}">
                                            @error('region')
                                                <div class="text-danger">
                                                    <small>
                                                        {{ $message }}
                                                    </small>
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Province -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="province" class="form-label">*Province</label>
                                            <input class="form-control" name="province" id="province" type="text" required
                                                value="{{ (empty($errors->has('province')))?old('province',$User->info->address->province):$User->info->address->province}}">
                                            @error('province')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- City -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="city" class="form-label">*City / Municipality</label>
                                            <input class="form-control" name="city" id="city" type="text" required
                                                value="{{ (empty($errors->has('city')))?old('city',$User->info->address->city):$User->info->address->city}}">
                                            @error('city')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-3 row">
                                    <!-- Barangay -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="barangay" class="form-label">*Barangay</label>
                                            <input class="form-control" name="barangay" id="barangay" type="text" required
                                                value="{{ (empty($errors->has('barangay')))?old('barangay',$User->info->address->barangay):$User->info->address->barangay}}">
                                            @error('barangay')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            </div>
                                    </div>

                                    <!-- Postal Code -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="postal_code" class="form-label">*Postal Code</label>
                                            <span data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ex. 1013" data-bs-original-title="yes">
                                                <i class="mdi mdi-information-outline"></i>
                                            </span>
                                            <input class="form-control input-mask" name="postal_code" id="postal_code"
                                                data-inputmask="'mask': '9999'" type="tel" required
                                                value="{{ (empty($errors->has('postal_code')))?old('postal_code',$User->info->address->postal_code):$User->info->address->postal_code}}">
                                            @error('postal_code')
                                                <div class="text-danger">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row p-5">
                                    <ul class="list-inline mb-0 mt-4 float-end">
                                        <input type="submit" class="btn btn-dark btn-rounded w-lg waves-effect waves-light float-end" style="background-color: #62896d;" value="Save">
                                        <a class="btn list-inline-item float-end mx-4" href="{{ route('admin.charities.users.view', $User->code) }}">Cancel</a>
                                    </ul>
                                </div>
                            </form>
                        </div>
                    </div><!-- end cardbody -->
                </div><!-- end card -->
            </div><!-- end col -->
        </div>
        <!-- end row -->
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#profile_image').change(function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        })
    })
</script>
@endsection