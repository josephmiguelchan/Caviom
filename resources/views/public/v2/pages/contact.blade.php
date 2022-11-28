@extends('public.v2.public_master')

@section('title', 'Contact Us')
@section('content')

<!-- ======= Breadcrumbs ======= -->
<section id="breadcrumbs" class="breadcrumbs">
    <div class="container">

        <div class="d-flex justify-content-between align-items-center">
        <h2>Contact Us</h2>
        <ol>
            <li><a href="{{route('home')}}">Home</a></li>
            <li>Contact</li>
        </ol>
        </div>

    </div>
</section><!-- End Breadcrumbs -->

<!-- ======= Contact Section ======= -->
<section id="contact" class="contact">
    <div class="container">

        <div class="row justify-content-center" data-aos="fade-up">

            <div class="col-lg-10">

                <div class="info-wrap">
                    <div class="row">
                        <div class="col-lg-4 info">
                            <i class="icofont-google-map"></i>
                            <h4>Location:</h4>
                            <p>2544 Taft Ave.<br>Malate, Manila, NCR 1004</p>
                        </div>

                        <div class="col-lg-4 info mt-4 mt-lg-0">
                            <i class="icofont-envelope"></i>
                            <h4>Email:</h4>
                            <p>support@caviom.org</p>
                        </div>

                        <div class="col-lg-4 info mt-4 mt-lg-0">
                            <i class="icofont-phone"></i>
                            <h4>Call:</h4>
                            <p>+63 976 004 5112</p>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>
<!-- End Contact Section -->

@include('public.v2.body.team')

@endsection