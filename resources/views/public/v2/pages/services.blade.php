@extends('public.v2.public_master')

@section('title', 'Our Services')
@section('content')

<!-- ======= Breadcrumbs ======= -->
<section id="breadcrumbs" class="breadcrumbs">
    <div class="container">

        <div class="d-flex justify-content-between align-items-center">
        <h2>Services, Pricing and FAQ</h2>
        <ol>
            <li><a href="{{route('home')}}">Home</a></li>
            <li>Services</li>
        </ol>
        </div>

    </div>
</section><!-- End Breadcrumbs -->

@include('public.v2.body.services')

<!-- ======= Pricing Section ======= -->
<section id="pricing" class="pricing">
    <div class="container" data-aos="fade-up">

        <div class="row">

            <div class="col-lg-3 col-md-6">
            <div class="box">
                <h3>Free</h3>
                <h4><sup>₱</sup>0</h4>
                <ul>
                    <li>4,500 Free Star Tokens</li>
                    <li>5 Project Collaborations</li>
                    <li class="na">Unli Gift Givings</li>
                </ul>
                <div class="btn-wrap">
                    <a href="{{route('register')}}" class="btn-buy">Try Now</a>
                </div>
            </div>
            </div>

            <div class="col-lg-3 col-md-6 mt-4 mt-md-0">
            <div class="box">
                <h3>Caviom Pro</h3>
                <h4><sup>₱</sup>249<span> / month</span></h4>
                <ul>
                    <li>1 Month</li>
                    <li>5 Featured Project Credits</li>
                    <li>Unli Project Collaborations</li>
                    <li>Unli Gift Givings</li>
                </ul>
                <div class="btn-wrap">
                    <a href="{{route('star.tokens.order')}}" class="btn-buy">Get</a>
                </div>
            </div>
            </div>

            <div class="col-lg-3 col-md-6 mt-4 mt-lg-0">
            <div class="box">
                <span class="advanced">20% OFF</span>
                <h3>Caviom Premium</h3>
                <h4><sup>₱</sup>2,399<span> / year</span></h4>
                <ul>
                    <li>12 Months</li>
                    <li>50 Featured Project Credits</li>
                    <li>Unli Project Collaborations</li>
                    <li>Unli Gift Givings</li>
                </ul>
                <div class="btn-wrap">
                    <a href="{{route('star.tokens.order')}}" class="btn-buy">Get</a>
                </div>
            </div>
            </div>

            <div class="col-lg-3 col-md-6 mt-4 mt-lg-0">
                <div class="box featured">
                    <h3>Star Tokens Bundle</h3>
                    <h4><sup>Prepaid</sup></h4>
                    <ul>
                        <li>₱29 — 600 Star Tokens</li>
                        <li>₱59 — 1,500 Star Tokens</li>
                        <li>₱109 — 3,000 Star Tokens</li>
                    </ul>
                    <div class="btn-wrap">
                        <a href="{{route('star.tokens.order')}}" class="btn-buy">Get</a>
                    </div>
                </div>
            </div>

        </div>

    </div>
</section><!-- End Pricing Section -->

<!-- ======= Frequently Asked Questions Section ======= -->
<section id="faq" class="faq section-bg">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
            <h2>Frequently Asked Questions</h2>
        </div>

        <div class="faq-list">
            <ul>
            <li data-aos="fade-up">
                <i class="bx bx-help-circle icon-help"></i> <a data-toggle="collapse" class="collapse" href="#faq-list-1">Do I need to subscribe to any of Caviom's subscription plan to use its services?<i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                <div id="faq-list-1" class="collapse show" data-parent=".faq-list">
                <p>
                    No need to subscribe to any paid subscription in order to use Caviom. Your (unique) organization will
                    be credited 4,500 Free Star Tokens upon registration and creation of your account as a Charity Admin.
                    You can then use these free currency to use some features that require Star Tokens.
                </p>
                </div>
            </li>

            <li data-aos="fade-up" data-aos-delay="100">
                <i class="bx bx-help-circle icon-help"></i> <a data-toggle="collapse" href="#faq-list-2" class="collapsed">How do I avail of any of Subscription / Star Tokens? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                <div id="faq-list-2" class="collapse" data-parent=".faq-list">
                <p>
                    Upon registering your Charitable Organization and creating an account as a Charity Admin, navigate to your
                    Star Tokens Balance and click on Purchase Star Tokens. Follow the step-by-step instructions provided in this page.
                </p>
                </div>
            </li>

            <li data-aos="fade-up" data-aos-delay="200">
                <i class="bx bx-help-circle icon-help"></i> <a data-toggle="collapse" href="#faq-list-3" class="collapsed">Can I change my mind after I ordered? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                <div id="faq-list-3" class="collapse" data-parent=".faq-list">
                <p>
                    Each order request undergo through verification by Caviom Administrators. Once the order has been reviewed and
                    deemed final (e.g. Order has been processed successfully), it is no longer refundable as per our Terms of Service.
                    If you believe that there has been a mistake in your order, please email us at support@caviom.org
                </p>
                </div>
            </li>

            <li data-aos="fade-up" data-aos-delay="300">
                <i class="bx bx-help-circle icon-help"></i> <a data-toggle="collapse" href="#faq-list-4" class="collapsed">Are my Charitable Organization's records safe? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                <div id="faq-list-4" class="collapse" data-parent=".faq-list">
                <p>
                    Caviom uses Laravel's encryption services providing a simple yet protected layer against data leaks.
                    It uses AES-256 and AES-128 encryption technologies to encrypt and decrypt Personally Identifiable Information (or PII)
                    compliant data from Charitable Organizations.
                </p>
                </div>
            </li>

            <li data-aos="fade-up" data-aos-delay="400">
                <i class="bx bx-help-circle icon-help"></i> <a data-toggle="collapse" href="#faq-list-5" class="collapsed">Where can I ask my questions? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                <div id="faq-list-5" class="collapse" data-parent=".faq-list">
                <p>
                    If you have more questions, feel free to contact us at support@caviom.org
                </p>
                </div>
            </li>

            </ul>
        </div>

    </div>
</section><!-- End Frequently Asked Questions Section -->
@endsection