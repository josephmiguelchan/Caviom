<h1 class="text-center display-3 my-5">Programs & Activities</h1>

@foreach ($charity->programs as $program)
<div class="row align-items-center my-4">
    <div class="col-md-6 p-5">
        <h1 class="display-5 fw-bold my-3">{{$program->name}}</h1>
        {!!$program->description!!}
    </div>
    <div class="col-md-6 text-center">
        @isset($program->program_photo)
        <img src="{{ asset('upload/charitable_org/programs/'.$program->program_photo) }}" class="img-fluid rounded" alt="Responsive image">
        @else
        <img src="{{ asset('upload/charitable_org/placeholder-3.png') }}" class="img-fluid rounded" alt="Responsive image">
        @endisset
    </div>
</div>
@endforeach
