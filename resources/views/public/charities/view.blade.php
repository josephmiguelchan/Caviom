@extends('public.public_master')
@section('title', 'View Charitable Organization')
@section('main')

<!-- Cover Photos -->
<div class="row text-center">
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <ol class="carousel-indicators">
            <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>
            <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></li>
            <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></li>
            <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3"></li>
            <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
                <img class="d-block img-fluid" style="width: 100%; height: 40vh; object-fit: cover;"
                    src="{{ asset('backend/assets/images/small/img-1.jpg') }}" alt="First cover photo">
            </div>
            <div class="carousel-item">
                <img class="d-block img-fluid" style="width: 100%; height: 40vh; object-fit: cover;"
                    src="{{ asset('backend/assets/images/small/img-2.jpg') }}" alt="Second cover photo">
            </div>
            <div class="carousel-item">
                <img class="d-block img-fluid" style="width: 100%; height: 40vh; object-fit: cover;"
                    src="{{ asset('backend/assets/images/small/img-3.jpg') }}" alt="Third cover photo">
            </div>
            <div class="carousel-item">
                <img class="d-block img-fluid" style="width: 100%; height: 40vh; object-fit: cover;"
                    src="{{ asset('backend/assets/images/small/img-4.jpg') }}" alt="Fourth cover photo">
            </div>
            <div class="carousel-item">
                <img class="d-block img-fluid" style="width: 100%; height: 40vh; object-fit: cover;"
                    src="{{ asset('backend/assets/images/small/img-5.jpg') }}" alt="Fifth cover photo">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>

<!-- Basic Info -->
<div class="col-12 m-0">
    <div class="card">
        <div class="row no-gutters align-items-center my-3">
            <div class="col-md-4 p-4">
                <div class="text-center">
                    <img class="card-img img-fluid" style="max-height: 30vh; max-width: 30vh;" src="{{asset('upload/charitable_org/profile_photo/SaRU.jpg')}}" alt="Card image">
                </div>

            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <p class="text-muted mb-0">Child Sponsorship Organizations</p>
                    <!-- Put Verified Logo if status == verified -->
                    <h1 class="fw-bold mt-0">San Roque United, Inc. <i class="mdi mdi-check-decagram"></i></h1>
                    <p class="small"><em>The quick brown fox boldly jumped over the lazy dog. - Alberto Epstein (Sinabi talaga niya yan)</em></p>

                    <h4 class="fw-bold mt-5">Contact Details</h4>
                    <dl class="row mb-0 ps-5">
                        <dt class="col-sm-2">Address</dt>
                        <dd class="col-sm-10">4312 Dungaw Road, Luntian St., Barangay 32, Pasay City 1300</dd>
                        <dt class="col-sm-2">Email Address</dt>
                        <dd class="col-sm-10"><a href="mailto:info@mycharitable.org">info@mycharitable.org</a></dd>
                        <dt class="col-sm-2">Cellphone No</dt>
                        <dd class="col-sm-10"><a href="tel:09982314657">09982314657</a></dd>
                        <dt class="col-sm-2">Telephone No</dt>
                        <dd class="col-sm-10">---</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card p-0">
    <div class="card-body">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#aboutUs" role="tab">
                    <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                    <span class="d-none d-sm-block">About Us</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#programsAndActivities" role="tab">
                    <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                    <span class="d-none d-sm-block">Programs & Activities</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#featuredProjects" role="tab">
                    <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                    <span class="d-none d-sm-block">Featured Projects</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#donate" role="tab">
                    <span class="d-block d-sm-none"><i class="fas fa-cog"></i></span>
                    <span class="d-none d-sm-block">Donate</span>
                </a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content p-3 text-muted">
            <div class="tab-pane active" id="aboutUs" role="tabpanel">
                @include('public.charities.components.about')
            </div>
            <div class="tab-pane" id="programsAndActivities" role="tabpanel">
                @include('public.charities.components.programs')
            </div>
            <div class="tab-pane" id="featuredProjects" role="tabpanel">
                @include('public.charities.components.feat-projects')
            </div>
            <div class="tab-pane" id="donate" role="tabpanel">
                @include('public.charities.components.donate')
            </div>
        </div>
    </div>
</div>

@endsection