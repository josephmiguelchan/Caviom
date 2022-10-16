@extends('public.v2.public_master')

@section('title', 'Charitable Organizations')
@section('content')

<!-- ======= Breadcrumbs ======= -->
<section id="breadcrumbs" class="breadcrumbs">
    <div class="container">

        <div class="d-flex justify-content-between align-items-center">
        <h2>All Charitable Organizations</h2>
        <ol>
            <li><a href="{{route('home')}}">Home</a></li>
            <li>Charitable Organizations</li>
        </ol>
        </div>

    </div>
</section><!-- End Breadcrumbs -->

<section id="portfolio" class="portfolio">
    <div class="container">

    <div class="section-title" data-aos="fade-up">
        <h2>Charitable Organizations</h2>
    </div>

    <div class="row" data-aos="fade-up">
        <div class="col-lg-12 d-flex justify-content-center">
        <ul id="portfolio-flters">
            <li data-filter="*" class="filter-active">All</li>
            <li data-filter=".filter-Community-Development">Community</li>
            <li data-filter=".filter-Education">Education</li>
            <li data-filter=".filter-Humanities">Human</li>
            <li data-filter=".filter-Health">Health</li>
            <li data-filter=".filter-Environment">Environment</li>
            <li data-filter=".filter-Social-Welfare">Social Welfare</li>
            <li data-filter=".filter-Corporate">Corporate</li>
            <li data-filter=".filter-Church">Church</li>
            <li data-filter=".filter-Livelihood">Livelihood</li>
            <li data-filter=".filter-Sports-Volunteerism">Sports Volunteerism</li>
        </ul>
        </div>
    </div>

    <div class="row portfolio-container" data-aos="fade-up">
        @php
            $defaultPhoto = asset('upload/charitable_org/profile_photo/no_avatar.png');
        @endphp

        @foreach ($charities as $charity)
        <div class="col-lg-4 col-md-6 portfolio-item filter-{{str_replace(' ', '-', $charity->primaryInfo->category)}}">
            <img src="{{ $charity->profile_photo ? asset('upload/charitable_org/profile_photo/'.$charity->profile_photo) : $defaultPhoto }}" class="img-fluid" alt="{{$charity->name}} Profile Photo">
            <div class="portfolio-info">
                <h4>{{$charity->name}}</h4>
                <p>{{$charity->primaryInfo->category}} Organization</p>
                {{-- <a href="{{asset('upload/charitable_org/profile_photo/SaRU.jpg') }}" data-gall="portfolioGallery" class="venobox preview-link" title="App 1"><i class="bx bx-zoom-in"></i></a> --}}
                <a href="{{route('charities.view', $charity->code)}}" class="details-link" title="View Details"><i class="bx bx-window-open"></i></a>
            </div>
        </div>
        @endforeach



    </div>

    </div>
</section>
@endsection