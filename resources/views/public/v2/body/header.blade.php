<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

        <h1 class="logo mr-auto"><a href="{{url('/')}}">
            <img src="{{ asset('backend/assets/images/Caviom-dark.png') }}" alt="logo-sm" height="52">
        </h1>

        <nav class="nav-menu d-none d-lg-block">
            <ul>
                <li {!! Request::routeIs('home*')?'class="active"':'' !!}><a href="{{route('home')}}">Home</a></li>
                <li {!! Request::routeIs('about*')?'class="active"':'' !!}><a href="{{route('about')}}">About</a></li>
                <li {!! Request::routeIs('contact*')?'class="active"':'' !!}><a href="{{route('contact')}}">Contact</a></li>
                <li {!! Request::routeIs('services*')?'class="active"':'' !!}><a href="{{route('services')}}">Services</a></li>
                <li {!! Request::routeIs('charities*')?'class="active"':'' !!}><a href="{{route('charities.all')}}">Charitable Organizations</a></li>
            </ul>
        </nav><!-- .nav-menu -->

        <div class="header-social-links">
            <a href="{{route('login')}}" class="twitter"><i class="bx bx-log-in"></i></a>
            <a href="{{route('register')}}" class="twitter"><i class="bx bx-solid bx-user-plus"></i></a>
        </div>

    </div>
</header><!-- End Header -->