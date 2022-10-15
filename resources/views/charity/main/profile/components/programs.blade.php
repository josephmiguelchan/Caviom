<form method="POST" action="{{ route('charity.profile.store_programs') }}" enctype="multipart/form-data">
    @csrf
    <div id="accordion" class="custom-accordion">
        <div class="card mb-1 shadow-none">
            <a href="#collapseSix" class="text-dark" data-bs-toggle="collapse"
                            aria-expanded="true"
                            aria-controls="collapseSix">
                <div class="card-header" id="headingSix">
                    <h6 class="m-0">
                        Programs & Activities <small>(Click to Expand)</small>
                        <i class="mdi mdi-minus float-end accor-plus-icon"></i>
                    </h6>
                </div>
            </a>

            <div id="collapseSix" class="collapse show"
                    aria-labelledby="headingSix" data-bs-parent="#accordion">
                <div class="card-body">
                    <div class="table-responsive mb-4">
                        <table class="table table-bordered mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th scope="1">No.</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Photo</th>
                                    <th>Date Created</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if ($programs->count() == 0)
                            <tr>
                                <td colspan="6" class="text-center text-black-50 fst-italic">
                                    <i class="mdi mdi-information-outline"></i> Your Charitable Organization currently has no programs / activities.
                                </td>
                            </tr>
                            @endif
                            @foreach($programs as $key => $program)
                                <tr>
                                    <th scope="row">{{ $key+1 }}</th>
                                    <td>{{ $program->name }}</td>
                                    <td>{!! Str::limit($program->description, 1000) !!}</td>
                                    <td>
                                        @isset($program->program_photo)
                                        <a class="image-popup-no-margins" title="Program #{{$key+1}} Photo" href="{{ asset('upload/charitable_org/programs/'.$program->program_photo) }}">
                                            <img class="rounded" alt="Program #{{$key+1}} Photo" src="{{ asset('upload/charitable_org/programs/'.$program->program_photo) }}" style="max-height: 10vh">
                                        </a>
                                        @else
                                        ---
                                        @endisset
                                    </td>
                                    <td>{{ Carbon\Carbon::parse($program->created_at)->isoFormat('LL (LT)') }}</a></td>
                                    <td>
                                        <a href="{{route('charity.profile.destroy_programs',$program->id)}}" class="btn btn-rounded btn-sm btn-outline-danger waves-effect waves-light">
                                            <i class="mdi mdi-trash-can-outline"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-9">
                            <div class="mb-3">
                                <label class="form-label" for="program_name">*Program / Activity Name</label>
                                <input type="text" class="form-control" id="program_name" name="program_name" placeholder="Enter name"
                                    value="{{ old('program_name') }}" >
                                @error('program_name')
                                    <div class="text-danger">
                                        <small>
                                            {{ $message }}
                                        </small>
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="mb-3">
                                <label class="form-label" for="program_photo">Photo</label>
                                <input class="form-control" name="program_photo" id="program_photo" type="file">
                                @error('program_photo')
                                    <div class="text-danger">
                                        <small>
                                            {{ $message }}
                                        </small>
                                    </div>
                                @enderror
                            </div>
                            <img id="showImageProgram" class="img-fluid rounded" alt="Program's Photo Preview" src="{{ asset('backend/assets/images/placeholder-image.jpg') }}" width="230">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label" for="program_description">*Description</label>
                                <textarea id="elm3" name="program_description">{{ old('program_description') }}</textarea>
                                @error('program_description')
                                    <div class="text-danger">
                                        <small>
                                            {{ $message }}
                                        </small>
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <span class="text-muted font-size-12 mt-2">
                                <em>
                                    Mininum of 1, maximum of 5 programs / activities only.
                                </em>
                            </span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-dark btn-rounded waves-effect waves-light w-100 mt-5" {{$programs->count()>=5 ? 'disabled':''}}
                                style="background-color: #62896d">
                                <i class="mdi mdi-plus"></i> Add Program / Activity
                            </button>
                        </div>
                    </div>
                    <p class="text-muted text-center font-size-12 mt-1">
                        <em>
                            {!! $donationModes->count()>=5 ? 'Sorry, a max of 5 programs / activities have already been reached.' : 'Please click on <strong>Add</strong> first before proceeding to the next.' !!}
                        </em>
                    </p>

                </div>
            </div>
        </div>
    </div>

</form>

<script type="text/javascript">
    $(document).ready(function() {
        $('#program_photo').change(function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#showImageProgram').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>