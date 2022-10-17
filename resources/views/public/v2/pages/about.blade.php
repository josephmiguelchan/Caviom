@extends('public.v2.public_master')

@section('title', 'About Us')
@section('content')

<!-- ======= Breadcrumbs ======= -->
<section id="breadcrumbs" class="breadcrumbs">
    <div class="container">

        <div class="d-flex justify-content-between align-items-center">
        <h2>About Us</h2>
        <ol>
            <li><a href="{{route('home')}}">Home</a></li>
            <li>About</li>
        </ol>
        </div>

    </div>
</section><!-- End Breadcrumbs -->

@include('public.v2.body.about_us')

<!-- ======= Our Team Section ======= -->
@include('public.v2.body.team')
<!-- End Our Team Section -->

@endsection