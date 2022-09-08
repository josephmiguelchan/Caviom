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
                            <a href="{{ route('charity.profile.feat-projects') }}">Featured Projects</a>
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
                            <h2 class="fw-bold">Medical Mission 2022</h2>
                        </div>
                        <div class="col-lg-4 mt-4">
                            <a href="{{ route('charity.profile.feat-projects') }}" class="text-link float-end">
                                <i class="ri-arrow-left-line"></i> Go Back
                            </a>
                        </div>
                    </div>

                    <hr>

                    <div class="row mt-5 px-2">
                        <div class="col-lg-6">
                            <div class="row">
                                <dt class="col-md-4 mb-2"><h4 class="font-size-15"><strong>Venue:</strong></h4></dt>
                                <dt class="col-md-8 mb-2">OLSOFI</dt>
                                <dt class="col-md-4 mb-2"><h4 class="font-size-15"><strong>No. of Beneficiaries:</strong></h4></dt>
                                <dt class="col-md-8 mb-2">90</dt>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <dt class="col-md-4 mb-2"><h4 class="font-size-15"><strong>Date:</strong></h4></dt>
                                <dt class="col-md-8 mb-2">June 12, 2022</dt>
                                <dt class="col-md-4 mb-2"><h4 class="font-size-15"><strong>Sponsors:</strong></h4></dt>
                                <dt class="col-md-8 mb-2">JCo. Lmtd, Jollibee Philtranco, Ayala Holdings</dt>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-lg-12">
                                <div class="row">
                                    <dl class="col-md-12">
                                        <h4 class="font-size-15"><strong>Objective:</strong></h4>
                                        <p>
                                            It is a long established fact that a reader will be distracted by the readable content of
                                            a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less
                                            normal distribution of letters, as opposed to using 'Content here, content here', making it look
                                            like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum
                                            as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in
                                            their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on
                                            purpose (injected humour and the like).
                                        </p>

                                        <h4 class="font-size-15 mt-4"><strong>Thanksgiving Message:</strong></h4>
                                        <p>
                                            There are many variations of passages of Lorem Ipsum available, but the majority have suffered
                                            alteration in some form, by injected humour, or randomised words which don't look even slightly
                                            believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't
                                            anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet
                                            tend to repeat predefined chunks as necessary, making this the first true generator on the Internet.
                                            It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures,
                                            to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free
                                            from repetition, injected humour, or non-characteristic words etc.
                                        </p>

                                        <div class="col-6">
                                            <h4 class="font-size-15 mt-4"><strong>Photos:</strong></h4>
                                            {{-- <p class="mt-0 mb-3">(Up to a max of 8 pictures only)</p> --}}
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
                                                            <img class="d-block img-fluid" src="{{ asset('backend/assets/images/small/img-1.jpg') }}" alt="First slide">
                                                        </div>
                                                        <div class="carousel-item">
                                                            <img class="d-block img-fluid" src="{{ asset('backend/assets/images/small/img-2.jpg') }}" alt="Second slide">
                                                        </div>
                                                        <div class="carousel-item">
                                                            <img class="d-block img-fluid" src="{{ asset('backend/assets/images/small/img-3.jpg') }}" alt="Third slide">
                                                        </div>
                                                        <div class="carousel-item">
                                                            <img class="d-block img-fluid" src="{{ asset('backend/assets/images/small/img-4.jpg') }}" alt="Fourth slide">
                                                        </div>
                                                        <div class="carousel-item">
                                                            <img class="d-block img-fluid" src="{{ asset('backend/assets/images/small/img-5.jpg') }}" alt="Fifth slide">
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
                                <dt class="col-md-8 mb-2"><i class="ri-eye-off-line"></i> Hidden</dt>
                                <dt class="col-md-4 mb-2"><h4 class="font-size-15"><strong>Approval Status:</strong></h4></dt>
                                <dt class="col-md-8 mb-2"><span class="badge bg-warning">PENDING</span></dt>
                                <dt class="col-md-4 mb-2"><h4 class="font-size-15"><strong>Remarks:</strong></h4></dt>
                                <dt class="col-md-8 mb-2">---</dt>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <dt class="col-md-4 mb-2"><h4 class="font-size-15"><strong>Date Added:</strong></h4></dt>
                                <dt class="col-md-8 mb-2">July 14, 2022</dt>
                                <dt class="col-md-4 mb-2"><h4 class="font-size-15"><strong>Last Updated:</strong></h4></dt>
                                <dt class="col-md-8 mb-2">Just now</dt>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div> <!-- end col -->


    </div>

</div>

@endsection