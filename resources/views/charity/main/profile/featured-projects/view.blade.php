@extends('charity.charity_master')
@section('title', 'View Featured Projects')
@section('charity')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="p-2">
                    <h1 class="mb-0" style="color: #62896d"><strong>FEATURED PROJECTS</strong></h1>
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item">Our Charitable Organization</li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('charity.profile') }}">Public Profile</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('charity.profile.feat-project.all') }}">Featured Projects</a>
                        </li>
                        <li class="breadcrumb-item active">View</li>
                    </ol>

                    @include('charity.modals.featured-projects')
                </div>
            </div>
        </div>
        <!-- end page title -->


        <div class="col-12">
            <div class="card p-4">
                <div class="card-body">
                    <div class="row px-2">
                        <div class="col-lg-8">
                            <h2 class="fw-bold">{{$fp->name}}</h2>
                        </div>
                        <div class="col-lg-4 mt-4">
                            <a href="{{ route('charity.profile.feat-project.all') }}" class="text-link float-end">
                                <i class="ri-arrow-left-line"></i> Go Back
                            </a>
                        </div>
                    </div>

                    <hr>

                    <div class="row mt-5 px-2">
                        <div class="col-lg-6">
                            <div class="row">
                                <dt class="col-md-4 mb-2"><h4 class="font-size-15"><strong>Venue:</strong></h4></dt>
                                <dt class="col-md-8 mb-2">{{$fp->venue}}</dt>
                                <dt class="col-md-4 mb-2"><h4 class="font-size-15"><strong>No. of Beneficiaries:</strong></h4></dt>
                                <dt class="col-md-8 mb-2">{{$fp->total_beneficiaries}}</dt>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <dt class="col-md-4 mb-2"><h4 class="font-size-15"><strong>Date:</strong></h4></dt>
                                <dt class="col-md-8 mb-2">{{$fp->started_on}}</dt>
                                <dt class="col-md-4 mb-2"><h4 class="font-size-15"><strong>Sponsors:</strong></h4></dt>
                                <dt class="col-md-8 mb-2">{{ ($fp->Sponsors)?$item->Sponsors:'---' }}</dt>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-12">
                                <div class="row">
                                    <dl class="col-md-12">
                                        <h4 class="font-size-15"><strong>Objective:</strong></h4>
                                        <p>
                                            {!!$fp->objectives!!}

                                        </p>

                                        <h4 class="font-size-15 mt-4"><strong>Thanksgiving Message:</strong></h4>
                                        <p>
                                            {!! $fp->message ?? '---' !!}
                                        </p>

                                        <div class="col-6">
                                            <h4 class="font-size-15 mt-4"><strong>Photos:</strong></h4>
                                            {{-- <p class="mt-0 mb-3">(Up to a max of 8 pictures only)</p> --}}
                                            <div class="row text-center">
                                                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                                                    <div class="carousel-inner" role="listbox">
                                                        <div class="carousel-item active">
                                                            <img class="d-block img-fluid" src="{{ url('upload/featured_project/'.$fp->cover_photo) }}" alt="Cover Photo"
                                                                style="max-height: 100%; width: 100%;">
                                                        </div>
                                                        @isset($fp->photos->featured_photo_1)
                                                        <div class="carousel-item">
                                                            <img class="d-block img-fluid" src="{{ url('upload/featured_project/'.$fp->photos->featured_photo_1) }}" alt="First Photo"
                                                                style="max-height: 100%; width: 100%;">
                                                        </div>
                                                        @endisset
                                                        @isset($fp->photos->featured_photo_2)
                                                        <div class="carousel-item">
                                                            <img class="d-block img-fluid" src="{{ url('upload/featured_project/'.$fp->photos->featured_photo_2) }}" alt="Second Photo"
                                                                style="max-height: 100%; width: 100%;">
                                                        </div>
                                                        @endisset

                                                        @isset($fp->photos->featured_photo_3)
                                                        <div class="carousel-item">
                                                            <img class="d-block img-fluid" src="{{ url('upload/featured_project/'.$fp->photos->featured_photo_3) }}" alt="Third Photo"
                                                                style="max-height: 100%; width: 100%;">
                                                        </div>
                                                        @endisset

                                                        @isset($fp->photos->featured_photo_4)
                                                        <div class="carousel-item">
                                                            <img class="d-block img-fluid" src="{{ url('upload/featured_project/'.$fp->photos->featured_photo_4) }}" alt="Fourth Photo"
                                                                style="max-height: 100%; width: 100%;">
                                                        </div>
                                                        @endisset

                                                        @isset($fp->photos->featured_photo_5)
                                                        <div class="carousel-item">
                                                            <img class="d-block img-fluid" src="{{ url('upload/featured_project/'.$fp->photos->featured_photo_5) }}" alt="Fifth Photo"
                                                                style="max-height: 100%; width: 100%;">
                                                        </div>
                                                        @endisset
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
                                        </div>

                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <div class="row mt-5 px-2">
                        <div class="col-lg-6">
                            <div class="row">
                                <dt class="col-md-4 mb-2"><h4 class="font-size-15"><strong>Visibility Status:</strong></h4></dt>
                                @if ($fp->visibility_status == "Hidden")
                                <dt class="col-md-8 mb-2"><i class="ri-eye-off-line"></i> {{$fp->visibility_status}}</dt>
                                @elseif($fp->visibility_status == "Visible")
                                <dt class="col-md-8 mb-2"><i class="ri-eye-line"></i> {{$fp->visibility_status}}</dt>
                                @endif

                                <dt class="col-md-4 mb-2"><h4 class="font-size-15"><strong>Approval Status:</strong></h4></dt>
                                @if ($fp->approval_status == 'Pending')
                                <dt class="col-md-8 mb-2"><span class="badge bg-warning">{{$fp->approval_status}}</span></dt>
                                @elseif($fp->approval_status == 'Approved')
                                <dt class="col-md-8 mb-2"><span class="badge bg-success">{{$fp->approval_status}}</span></dt>
                                @elseif($fp->approval_status == 'Rejected')
                                <dt class="col-md-8 mb-2"><span class="badge bg-danger">Rejected</span></dt>
                                @endif

                                <dt class="col-md-4 mb-2"><h4 class="font-size-15"><strong>Remarks:</strong></h4></dt>
                                 <dt class="col-md-8 mb-2"><h6 class="fw-bold">{{ ($fp->remarks_subject)?$fp->remarks_subject:'---' }}</h6></dt>
                                <dd class="col-md-8 offset-md-4">{{ ($fp->remarks_message)?$fp->remarks_message:'' }}</dt>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <dt class="col-md-4 mb-2"><h4 class="font-size-15"><strong>Date Added:</strong></h4></dt>
                                <dt class="col-md-8 mb-2">{{ ($fp->created_at)?Carbon\Carbon::parse($fp->created_at)->isoFormat('MMMM d, YYYY'):'---' }}</dt>
                                <dt class="col-md-4 mb-2"><h4 class="font-size-15"><strong>Last Updated:</strong></h4></dt>
                                <dt class="col-md-8 mb-2">{{ ($fp->updated_at)?Carbon\Carbon::parse($fp->status_updated_at)->diffForHumans():'---' }}</dt>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div> <!-- end col -->


    </div>

</div>

@endsection