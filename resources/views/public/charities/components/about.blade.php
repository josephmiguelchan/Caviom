<!-- Title -->
{{-- <div class="text-center my-5">
    <h1 class="display-1 fw-bold">About Us</h1>
    <p class="text-muted">San Roque United, Inc.</p>
</div> --}}

<!-- Our Story -->
<div class="row align-items-center">
    <div class="col-md-6 p-5">
        <h1 class="display-3 my-3">Our Story</h1>
        {!! $charity->secondaryInfo->our_story !!}
    </div>
    <div class="col-md-6 text-center">
        @isset($charity->secondaryInfo->our_story_photo)
        <img src="{{ asset('upload/charitable_org/our_story/'.$charity->secondaryInfo->our_story_photo) }}" class="img-fluid rounded" alt="Our Story">
        @else
        <img src="{{ asset('upload/charitable_org/placeholder-3.png') }}" class="img-fluid rounded" alt="Our Story">
        @endisset
    </div>
</div>

<!-- Our Goal -->
<div class="row align-items-center my-4">
    <div class="col-md-6 text-center">
        @isset($charity->secondaryInfo->our_story_photo)
        <img src="{{ asset('upload/charitable_org/our_goal/'.$charity->secondaryInfo->our_goal_photo) }}" class="img-fluid rounded" alt="Our Goal">
        @else
        <img src="{{ asset('upload/charitable_org/placeholder-3.png') }}" class="img-fluid rounded" alt="Our Goal">
        @endisset
    </div>
    <div class="col-md-6 p-5">
        <h1 class="display-3 my-3">Our Goal</h1>
        {!! $charity->secondaryInfo->our_goal !!}
    </div>
</div>

<!-- Our Team -->
<h1 class="display-3 mt-5 text-center">The Team</h1>
<div class="row justify-content-center my-4 mb-5">
    @foreach ($charity->users as $user)
    <div class="col-lg-3 col-sm-6">
        <div class="card m-b-30">
            <div class="card-body">

                @php
                    $defaultAvatar = asset('upload/avatar_img/no_avatar.png');
                @endphp

                <div class="d-flex align-items-center">
                    <img class="d-flex me-3 rounded-circle img-thumbnail avatar-lg" src="{{ $user->profile_image ? asset('upload/avatar_img/'.$user->profile_image) : $defaultAvatar }}" alt="User Profile image">
                    <div class="flex-grow-1">
                        <h5 class="mt-0 font-size-18 mb-1">{{ $user->info->first_name . ' ' . Str::limit($user->info->last_name, 1, '.') }}</h5>
                        <p class="text-muted font-size-14">{{ $user->info->work_position }}</p>
                    </div>
                </div>

            </div>
        </div>
    </div> <!-- end col -->
    @endforeach

</div>

<!-- Awards -->
@unless ($charity->awards->count() == 0)
<h1 class="display-3 mt-5 mb-4 text-center">Certificates & Recognition</h1>
<div class="row text-center">
    <div id="carouselExampleIndicators3" class="carousel slide" data-bs-ride="carousel">
        <ol class="carousel-indicators">
            @foreach ($charity->awards as $key => $award)
            <li data-bs-target="#carouselExampleIndicators3" data-bs-slide-to="{{$key}}" {!! $key==0 ? 'class="active"' : '' !!}></li>
            @endforeach
        </ol>
        <div class="carousel-inner" style="max-height: 20vh" role="listbox">
            @foreach ($charity->awards as $key => $award)
            <div class="carousel-item {{ $key==0 ? 'active' : '' }}">
                <img class="align-items-center w-100" style="height: 20vh; object-fit: cover;"
                    src="{{ asset('backend/assets/images/bg.jpg') }}" alt="Award #{{$key+1}}">
                <div class="align-top carousel-caption d-none d-md-block text-white-50">
                    <h5 class="text-white">{{$award->name}}</h5>
                    <p class="text-white-50">
                        <a href="{{$award->file_link}}" target="_blank" class="text-white-50">View Award <i class="mdi mdi-open-in-new"></i></a>
                    </p>
                </div>
            </div>
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators3" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators3" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>
@endif