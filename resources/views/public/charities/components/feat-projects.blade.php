<h1 class="text-center display-3 my-5">Featured Projects</h1>

<div class="row justify-content-center mb-5"> <!-- data-masonry='{"percentPosition": true }' -->
    @if ($featuredProjects->count() == 0)
        <h6 class="text-muted text-center fst-italic my-5">Sorry, this Charitable Organization currently has no featured projects <strong>yet</strong>.</h6>
    @endif

    @foreach ($featuredProjects as $key => $fp)
    <div class="col-sm-6 col-lg-4 px-3">
        <div class="card">
            <img class="card-img-top img-fluid" src="{{ asset('upload/featured_project/'. $fp->cover_photo) }}" alt="Project #{{$key+1}}">
            <div class="card-body">
                <h4 class="card-title">{{$fp->name}}</h4>
                <p class="card-text">
                    <small class="text-muted">{{Carbon\Carbon::parse($fp->started_on)->isoFormat('LL')}}</small>
                </p>
                <a href="{{route('charities.feat-proj.view', $fp->code)}}" class="btn btn-dark waves-effect waves-light w-100">
                    <i class="mdi mdi-open-in-new"></i> View Project
                </a>
            </div>
        </div>
    </div>
    @endforeach
</div>