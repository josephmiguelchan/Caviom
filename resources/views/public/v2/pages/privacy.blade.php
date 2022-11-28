@extends('public.v2.public_master')

@section('title', 'Privacy Policy')
@section('content')

<!-- ======= Breadcrumbs ======= -->
<section id="breadcrumbs" class="breadcrumbs">
    <div class="container">

        <div class="d-flex justify-content-between align-items-center">
        <h2>Privacy Policy</h2>
        <ol>
            <li><a href="{{route('home')}}">Home</a></li>
            <li>Privacy Policy</li>
        </ol>
        </div>

    </div>
</section><!-- End Breadcrumbs -->

<section id="pricing" class="pricing">
    <div class="container" data-aos="fade-up">
        <div class="row">
            @include('terms-and-privacy.privacy')
        </div>
    </div>
</section>

@endsection