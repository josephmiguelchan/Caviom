@extends('public.v2.public_master')

@section('title', 'Terms of Services')
@section('content')

<!-- ======= Breadcrumbs ======= -->
<section id="breadcrumbs" class="breadcrumbs">
    <div class="container">

        <div class="d-flex justify-content-between align-items-center">
        <h2>Terms of Services</h2>
        <ol>
            <li><a href="{{route('home')}}">Home</a></li>
            <li>Terms of Services</li>
        </ol>
        </div>

    </div>
</section><!-- End Breadcrumbs -->

<section id="pricing" class="pricing">
    <div class="container" data-aos="fade-up">
        <div class="row">
            @include('terms-and-privacy.tos')
        </div>
    </div>
</section>

@endsection