@extends('public.v2.public_master')

@section('title', 'Featured Project')
@section('content')

<!-- ======= Breadcrumbs ======= -->
<section id="breadcrumbs" class="breadcrumbs">
    <div class="container">

        <div class="d-flex justify-content-between align-items-center">
        <h2>Featured Project</h2>
        <ol>
            <li><a href="{{route('home')}}">Home</a></li>
            <li><a href="{{route('charities.all')}}">Charitable Organizations</a></li>
            <li><a href="{{route('charities.view', $fp->charity->code)}}">{{$fp->charity->name}}</a></li>
            <li>Featured Project</li>
        </ol>
        </div>

    </div>
</section><!-- End Breadcrumbs -->

<!-- ======= Blog Section ======= -->
<section id="blog" class="blog">
    <div class="container">

        <div class="row">

            <div class="col-lg-8 entries">

            <article class="entry entry-single" data-aos="fade-up">

                <div class="entry-img">
                    <img src="{{asset('upload/featured_project/'.$fp->cover_photo)}}" alt="Cover Photo" class="img-fluid">
                </div>

                <h2 class="entry-title">
                    {{$fp->name}}
                </h2>

                <div class="entry-meta">
                    <ul>
                        <li class="d-flex align-items-center"><i class="icofont-user"></i> <a href="{{route('charities.view', $fp->charity->code)}}">{{$fp->charity->name}}</a></li>
                        <li class="d-flex align-items-center"><i class="icofont-wall-clock"></i> <a><time datetime="{{$fp->started_on}}">{{Carbon\Carbon::parse($fp->started_on)->isoFormat('LL')}}</time></a></li>
                    </ul>
                </div>

                <div class="entry-content">
                    {!! $fp->objectives !!}

                    @isset($fp->photos->featured_photo_1)
                    <img src="{{asset('upload/featured_project/'. $fp->photos->featured_photo_1)}}" class="img-fluid my-3" alt="Featured Photo no. 1">
                    @endisset
                    @isset($fp->photos->featured_photo_2)
                    <img src="{{asset('upload/featured_project/'. $fp->photos->featured_photo_2)}}" class="img-fluid my-3" alt="Featured Photo no. 2">
                    @endisset
                    @isset($fp->photos->featured_photo_3)
                    <img src="{{asset('upload/featured_project/'. $fp->photos->featured_photo_3)}}" class="img-fluid my-3" alt="Featured Photo no. 3">
                    @endisset
                    @isset($fp->photos->featured_photo_4)
                    <img src="{{asset('upload/featured_project/'. $fp->photos->featured_photo_4)}}" class="img-fluid my-3" alt="Featured Photo no. 4">
                    @endisset
                    @isset($fp->photos->featured_photo_5)
                    <img src="{{asset('upload/featured_project/'. $fp->photos->featured_photo_5)}}" class="img-fluid my-3" alt="Featured Photo no. 5">
                    @endisset

                    {!! $fp->message !!}

                </div>

            </article><!-- End blog entry -->

            <div class="blog-author clearfix" data-aos="fade-up">
                @php
                    $defaultPhoto = asset('upload/charitable_org/profile_photo/default.png');
                @endphp
                <img src="{{ $fp->charity->profile_photo ? asset('upload/charitable_org/profile_photo/'.$fp->charity->profile_photo) : $defaultPhoto }}"
                    class="rounded-circle float-left" alt="Charity Profile Photo">
                <h4>{{ $fp->charity->name }}</h4>
                {{-- <div class="social-links">
                    <a href="https://twitters.com/#"><i class="icofont-twitter"></i></a>
                    <a href="https://facebook.com/#"><i class="icofont-facebook"></i></a>
                    <a href="https://instagram.com/#"><i class="icofont-instagram"></i></a>
                </div> --}}
                <p class="mt-2">
                    {{ $fp->charity->primaryInfo->tagline }}
                </p>
            </div><!-- End blog author bio -->

        </div><!-- End blog entries list -->

        <div class="col-lg-4">

            <div class="sidebar" data-aos="fade-left">

                <h3 class="sidebar-title">See Also</h3>
                <div class="sidebar-item recent-posts">

                    @foreach ($fps as $other_fp)
                    <div class="post-item clearfix">
                        <img src="{{asset('upload/featured_project/'.$other_fp->cover_photo)}}" alt="{{$other_fp->name}} Cover Photo">
                        <h4><a href="{{route('charities.feat-proj.view', $other_fp->code)}}">{{ $other_fp->name }}</a></h4>
                        <time datetime="$other_fp->started_on">{{Carbon\Carbon::parse($other_fp->started_on)->isoFormat('LL')}}</time>
                    </div>
                    @endforeach

                </div><!-- End sidebar recent posts-->

            </div><!-- End blog sidebar -->

        </div>

    </div>
</section>
<!-- End Blog Section -->

@endsection