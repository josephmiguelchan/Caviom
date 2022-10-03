@extends('admin.admin_master')
@section('title', 'Our Lady of Sorrows Outreach Foundation, Inc.')
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
                        <li class="breadcrumb-item">Charitable Organizations</li>
                        <li class="breadcrumb-item active">Our Lady of Sorrows Outreach Foundation, Inc.</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <!-- Send Notification to Charity Modal -->
        <div id="sendNotificationModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel"><i class="mdi mdi-alert-outline me-2"></i> Send Notification</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="#" method="POST">
                            @csrf

                            <div class="m-2">
                                <form action="" method="POST" id="submit_notification_form">
                                    @csrf

                                    <label for="content_message">Message</label>
                                    <textarea name="content_message" class="form-control" maxlength="500" id="content_message" cols="30" rows="5"></textarea>
                                    @error('content_message')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </form>

                                <p class="mt-3">Are you sure you want to send this notification to active users of this Charitable Organization?</p>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light waves-effect w-sm" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" form="submit_notification_form" class="btn btn-dark waves-effect waves-light w-sm">Send</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>

        <div class="col-12">
            <div class="card p-3">
                <div class="card-body">
                    <div class="row px-2">
                        <div class="col-lg-8">

                        </div>
                        <div class="col-lg-4 mt-4">
                            <a href="{{ route('admin.charities') }}" class="text-link float-end">
                                <i class="ri-arrow-left-line"></i> Go Back to List
                            </a>
                        </div>
                    </div>

                    <div class="bg-secondary rounded mt-3">
                        <a class="image-popup-vertical-fit" title="Our Lady of Sorrows Outreach Foundation, Inc." href="{{ asset('upload/charitable_org/profile_photo/OLSOFI.jpg') }}">
                            <div id="carouselExampleCaption" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner" role="listbox">
                                    <div class="carousel-item active">
                                        <img src="{{ asset('upload/charitable_org/profile_photo/OLSOFI.jpg') }}" class="rounded"
                                            style="width: 100%; height: 30vh; object-fit: cover; opacity:.4;"
                                            alt="Profile Photo of Our Lady of Sorrows Outreach Foundation, Inc.">
                                        <div class="carousel-caption d-none d-md-block text-white-50 my-4">
                                            <h1 class="text-white fw-bold">Our Lady of Sorrows Outreach Foundation, Inc.</h1>
                                            <p>May 20, 2022</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="card-group">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-truncate font-size-14 fw-bold mb-2">Charity Admins</p>
                                        <h4 class="mb-2 text-success">1</h4>
                                        <p class="text-muted mb-0">
                                            Active Charity Admin Accounts
                                        </p>
                                    </div>
                                    <div class="avatar-sm">
                                        <span class="avatar-title bg-light text-success rounded-3">
                                            <i class="ri-user-fill font-size-24" style="color: #92713e;"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-truncate font-size-14 fw-bold mb-2">Charity Associates</p>
                                        <h4 class="mb-2 text-success">1</h4>
                                        <p class="text-muted mb-0">
                                            Active Charity Associates
                                        </p>
                                    </div>
                                    <div class="avatar-sm">
                                        <span class="avatar-title bg-light text-success rounded-3">
                                            <i class="ri-team-fill font-size-24" style="color: #92713e;"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-truncate font-size-14 fw-bold mb-2">Featured Projects</p>
                                        <h4 class="mb-2 text-success">6</h4>
                                        <p class="text-muted mb-0">
                                            Posted Projects on Public Profile
                                        </p>
                                    </div>
                                    <div class="avatar-sm">
                                        <span class="avatar-title bg-light text-success rounded-3">
                                            <i class="ri-heart-fill font-size-24" style="color: #92713e;"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <p class="text-truncate font-size-14 fw-bold mb-2">Star Tokens</p>
                                        <h4 class="mb-2 text-success">4,500</h4>
                                        <p class="text-muted mb-0">
                                            Organization's Current Balance
                                        </p>
                                    </div>
                                    <div class="avatar-sm">
                                        <span class="avatar-title bg-light text-success rounded-3">
                                            <i class="ri-star-fill font-size-24" style="color: #92713e;"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-5 mt-3 justify-content-center">
                        <button type="button" class="btn btn-lg w-50 btn-rounded btn-dark waves-effect waves-light"
                            data-bs-toggle="modal" data-bs-target="#sendNotificationModal"
                            style="background-color: #62896d">Send Notification</button>
                    </div>

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#profilesettings1" role="tab">
                                <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                <span class="d-none d-sm-block">Profile Settings</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#charityusers1" role="tab">
                                <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                <span class="d-none d-sm-block">Charity Users</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#featprojects1" role="tab">
                                <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                <span class="d-none d-sm-block">Featured Projects</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#startokens1" role="tab">
                                <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                                <span class="d-none d-sm-block">Star Tokens</span>
                            </a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content text-muted">
                        <div class="tab-pane active" id="profilesettings1" role="tabpanel">
                            @include('admin.charities.nav.profile-settings')
                        </div>
                        <div class="tab-pane" id="charityusers1" role="tabpanel">
                            @include('admin.charities.nav.users')
                        </div>
                        <div class="tab-pane" id="featprojects1" role="tabpanel">
                            @include('admin.charities.nav.feat-projects')
                        </div>
                        <div class="tab-pane" id="startokens1" role="tabpanel">
                            @include('admin.charities.nav.star-tokens')
                        </div>
                    </div>

                </div>
            </div>
        </div> <!-- end col -->


    </div>

</div>

@endsection