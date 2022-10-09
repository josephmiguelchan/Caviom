<section id="hero">
    <div id="heroCarousel" class="carousel slide carousel-fade" data-ride="carousel">

    <div class="carousel-inner" role="listbox">

        <!-- Slide 1 -->
        <div class="carousel-item active" style="background-image: url({{asset('frontend/assets/img/slide/slide-1.jpg')}});">
        <div class="carousel-container">
            <div class="carousel-content animate__animated animate__fadeInUp">
            <h2>Welcome to <span>Caviom</span></h2>
            <p>
                Caviom is a platform for Charitable Organizations to collaborate with their fellow volunteers or co-workers at the comfort of their own space.
                The platform helps them easen the digitalization of their records and processes without breaking the bank.
            </p>
            <div class="text-center"><a href="{{route('register')}}" class="btn-get-started">Get Started</a></div>
            </div>
        </div>
        </div>

        <!-- Slide 2 -->
        <div class="carousel-item" style="background-image: url({{asset('frontend/assets/img/slide/slide-2.jpg')}});">
        <div class="carousel-container">
            <div class="carousel-content animate__animated animate__fadeInUp">
            <h2>Is Caviom Free to Use?</h2>
            <p>
                Absolutely! Anyone can register their own Charitable Organization without spending a coin. Some features within Caviom requires
                <span>Star Tokens</span> — the digital currency of Caviom. Buying Star Tokens is available via GCash, Metrobank and Bank Transfer.
            </p>
            <div class="text-center"><a href="{{route('services')}}" class="btn-get-started">Read More</a></div>
            </div>
        </div>
        </div>

        <!-- Slide 3 -->
        <div class="carousel-item" style="background-image: url({{asset('frontend/assets/img/slide/slide-3.jpg')}});">
        <div class="carousel-container">
            <div class="carousel-content animate__animated animate__fadeInUp">
            <h2>Is Caviom Safe to Use?</h2>
            <p>
                Caviom uses encryption to store confidential records and other PII-compliant data of Charitable Organizations. Records are only accessible
                to authenticated Charity Users within the same organization.
            </p>
            <div class="text-center"><a href="{{route('services')}}" class="btn-get-started">Read More</a></div>
            </div>
        </div>
        </div>

    </div>

    <a class="carousel-control-prev" href="#heroCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon icofont-simple-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>

    <a class="carousel-control-next" href="#heroCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon icofont-simple-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>

    <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

    </div>
</section>