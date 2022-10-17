@extends('public.public_master')
@section('title', 'View Charitable Organization')
@section('main')

<!-- Cover Photos -->
<div class="row text-center">
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <ol class="carousel-indicators">
            @if ($charity->coverPhotos->count() == 0)
                <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>
            @endif
            @foreach ($charity->coverPhotos as $key => $photo)
                <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{$key}}" {!! $key == 0?'class="active"':'' !!}></li>
            @endforeach
        </ol>
        <div class="carousel-inner" role="listbox">
            @if ($charity->coverPhotos->count() == 0)
                <div class="carousel-item active">
                    <img class="d-block img-fluid" src="{{ url('upload/charitable_org/cover_photos/caviom-header-2.png') }}"
                        alt="Slide 1" style="width: 100%; height: 40vh; object-fit: cover;">
                </div>
            @endif
            @foreach ($charity->coverPhotos as $key => $photo)
                <div class="carousel-item {{ $key == 0?'active':'' }}">
                    <img class="d-block img-fluid" src="{{ url('upload/charitable_org/cover_photos/'. $photo->file_name) }}"
                        alt="Slide {{$key+1}}" style="width: 100%; height: 40vh; object-fit: cover;">
                </div>
            @endforeach
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
                    @php
                        $defaultPhoto = asset('upload/charitable_org/profile_photo/default.png');
                    @endphp
                    <img class="card-img img-fluid" style="max-height: 30vh; max-width: 30vh;" alt="Profile Photo"
                        src="{{ $charity->profile_photo ? asset('upload/charitable_org/profile_photo/'.$charity->profile_photo) : $defaultPhoto }}">
                </div>

            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <p class="text-muted mb-0">{{$charity->primaryInfo->category}} Organization</p>
                    <!-- Put Verified Logo if status == verified -->
                    <h1 class="fw-bold mt-0">{{$charity->name}} {!! $charity->verification_status=='Verified' ? '<i class="mdi mdi-check-decagram"></i>' : '' !!}</h1>
                    <p class="small"><em>{{$charity->primaryInfo->tagline}}</em></p>

                    <h4 class="fw-bold mt-5">Contact Details</h4>
                    <dl class="row mb-0 ps-5">
                        <dt class="col-sm-2">Address</dt>
                        <dd class="col-sm-10">
                            {{ Str::upper($charity->primaryInfo->address->address_line_two . ' ' . $charity->primaryInfo->address->address_line_one .
                                ', ' . $charity->primaryInfo->address->city . ', ' . $charity->primaryInfo->address->province) }}
                        </dd>
                        <dt class="col-sm-2">Email Address</dt>
                        <dd class="col-sm-10"><a href="mailto:{{$charity->primaryInfo->email_address}}">{{$charity->primaryInfo->email_address}}</a></dd>
                        <dt class="col-sm-2">Cellphone No</dt>
                        <dd class="col-sm-10"><a href="tel:{{$charity->primaryInfo->cel_no}}">{{$charity->primaryInfo->cel_no}}</a></dd>
                        <dt class="col-sm-2">Telephone No</dt>
                        <dd class="col-sm-10">
                            @isset($charity->primaryInfo->tel_no)
                                <a href="tel:{{$charity->primaryInfo->tel_no}}">{{$charity->primaryInfo->tel_no}}</a>
                            @else
                                ---
                            @endisset
                        </dd>
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