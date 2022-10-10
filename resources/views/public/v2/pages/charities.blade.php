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
            <li data-filter=".filter-community">Community</li>
            <li data-filter=".filter-education">Education</li>
            <li data-filter=".filter-human">Human</li>
            <li data-filter=".filter-health">Health</li>
            <li data-filter=".filter-environment">Environment</li>
            <li data-filter=".filter-social-welfare">Social Welfare</li>
            <li data-filter=".filter-corporate">Corporate</li>
            <li data-filter=".filter-church">Church</li>
            <li data-filter=".filter-livelihood">Livelihood</li>
            <li data-filter=".filter-sports">Sports Volunteerism</li>
        </ul>
        </div>
    </div>

    <div class="row portfolio-container" data-aos="fade-up">

        <div class="col-lg-4 col-md-6 portfolio-item filter-community">
            <img src="{{asset('upload/charitable_org/profile_photo/SaRU.jpg') }}" class="img-fluid" alt="San Roque United, Inc. Profile Photo">
            <div class="portfolio-info">
                <h4>San Roque United, Inc.</h4>
                <p>Community Based Organization</p>
                {{-- <a href="{{asset('upload/charitable_org/profile_photo/SaRU.jpg') }}" data-gall="portfolioGallery" class="venobox preview-link" title="App 1"><i class="bx bx-zoom-in"></i></a> --}}
                <a href="{{route('charities.view')}}" class="details-link" title="More Details"><i class="bx bx-window-open"></i></a>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 portfolio-item filter-church">
            <img src="{{asset('upload/charitable_org/profile_photo/OLSOFI.jpg') }}" class="img-fluid" alt="">
            <div class="portfolio-info">
                <h4>Our Lady of Sorrows Foundation, Inc.</h4>
                <p>Church Based Organization</p>
                {{-- <a href="{{asset('upload/charitable_org/profile_photo/OLSOFI.jpg') }}" data-gall="portfolioGallery" class="venobox preview-link" title="Web 3"><i class="bx bx-zoom-in"></i></a> --}}
                <a href="#" class="details-link" title="More Details"><i class="bx bx-window-open"></i></a>
            </div>
        </div>

        <div class="col-lg-4 col-md-6 portfolio-item filter-community">
        <img src="{{asset('frontend/assets/img/portfolio/portfolio-3.jpg') }}" class="img-fluid" alt="">
        <div class="portfolio-info">
            <h4>App 2</h4>
            <p>App</p>
            {{-- <a href="{{asset('frontend/assets/img/portfolio/portfolio-3.jpg') }}" data-gall="portfolioGallery" class="venobox preview-link" title="App 2"><i class="bx bx-zoom-in"></i></a> --}}
            <a href="#" class="details-link" title="More Details"><i class="bx bx-window-open"></i></a>
        </div>
        </div>

        <div class="col-lg-4 col-md-6 portfolio-item filter-education">
        <img src="{{asset('frontend/assets/img/portfolio/portfolio-4.jpg') }}" class="img-fluid" alt="">
        <div class="portfolio-info">
            <h4>Card 2</h4>
            <p>Card</p>
            {{-- <a href="{{asset('frontend/assets/img/portfolio/portfolio-4.jpg') }}" data-gall="portfolioGallery" class="venobox preview-link" title="Card 2"><i class="bx bx-zoom-in"></i></a> --}}
            <a href="#" class="details-link" title="More Details"><i class="bx bx-window-open"></i></a>
        </div>
        </div>

        <div class="col-lg-4 col-md-6 portfolio-item filter-human">
        <img src="{{asset('frontend/assets/img/portfolio/portfolio-5.jpg') }}" class="img-fluid" alt="">
        <div class="portfolio-info">
            <h4>Web 2</h4>
            <p>Web</p>
            <a href="{{asset('frontend/assets/img/portfolio/portfolio-5.jpg') }}" data-gall="portfolioGallery" class="venobox preview-link" title="Web 2"><i class="bx bx-zoom-in"></i></a>
            <a href="#" class="details-link" title="More Details"><i class="bx bx-window-open"></i></a>
        </div>
        </div>

        <div class="col-lg-4 col-md-6 portfolio-item filter-community">
        <img src="{{asset('frontend/assets/img/portfolio/portfolio-6.jpg') }}" class="img-fluid" alt="">
        <div class="portfolio-info">
            <h4>App 3</h4>
            <p>App</p>
            <a href="{{asset('frontend/assets/img/portfolio/portfolio-6.jpg') }}" data-gall="portfolioGallery" class="venobox preview-link" title="App 3"><i class="bx bx-zoom-in"></i></a>
            <a href="#" class="details-link" title="More Details"><i class="bx bx-window-open"></i></a>
        </div>
        </div>

        <div class="col-lg-4 col-md-6 portfolio-item filter-education">
        <img src="{{asset('frontend/assets/img/portfolio/portfolio-7.jpg') }}" class="img-fluid" alt="">
        <div class="portfolio-info">
            <h4>Card 1</h4>
            <p>Card</p>
            <a href="{{asset('frontend/assets/img/portfolio/portfolio-7.jpg') }}" data-gall="portfolioGallery" class="venobox preview-link" title="Card 1"><i class="bx bx-zoom-in"></i></a>
            <a href="#" class="details-link" title="More Details"><i class="bx bx-window-open"></i></a>
        </div>
        </div>

        <div class="col-lg-4 col-md-6 portfolio-item filter-education">
        <img src="{{asset('frontend/assets/img/portfolio/portfolio-8.jpg') }}" class="img-fluid" alt="">
        <div class="portfolio-info">
            <h4>Card 3</h4>
            <p>Card</p>
            <a href="{{asset('frontend/assets/img/portfolio/portfolio-8.jpg') }}" data-gall="portfolioGallery" class="venobox preview-link" title="Card 3"><i class="bx bx-zoom-in"></i></a>
            <a href="#" class="details-link" title="More Details"><i class="bx bx-window-open"></i></a>
        </div>
        </div>

        <div class="col-lg-4 col-md-6 portfolio-item filter-human">
        <img src="{{asset('frontend/assets/img/portfolio/portfolio-9.jpg') }}" class="img-fluid" alt="">
        <div class="portfolio-info">
            <h4>Web 3</h4>
            <p>Web</p>
            <a href="{{asset('frontend/assets/img/portfolio/portfolio-9.jpg') }}" data-gall="portfolioGallery" class="venobox preview-link" title="Web 3"><i class="bx bx-zoom-in"></i></a>
            <a href="#" class="details-link" title="More Details"><i class="bx bx-window-open"></i></a>
        </div>
        </div>

    </div>

    </div>
</section>
@endsection