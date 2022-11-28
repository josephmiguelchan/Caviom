<div id="accordion" class="custom-accordion">
    <form method="POST" action="{{route('charity.profile.store_awards')}}" class="form-horizontal" enctype="multipart/form-data">
        @csrf
        <div class="card mb-2 shadow-none">
            <a href="#collapseThree" class="text-dark" data-bs-toggle="collapse"
                            aria-expanded="true"
                            aria-controls="collapseThree">
                <div class="card-header" id="headingThree">
                    <h6 class="m-0">
                        Awards — OPTIONAL <small>(Click to Expand)</small>
                        <i class="mdi mdi-minus float-end accor-plus-icon"></i>
                    </h6>
                </div>
            </a>
            <div id="collapseThree" class="collapse show"
                    aria-labelledby="headingThree" data-bs-parent="#accordion">
                <div class="card-body">
                    <div class="table-responsive mb-4">
                        <table class="table table-bordered mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th scope="1">No.</th>
                                    <th>Award Name</th>
                                    <th>File Link of the Award</th>
                                    <th>Date Created</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if ($awards->count() == 0)
                            <tr>
                                <td colspan="5" class="text-center text-black-50 fst-italic">
                                    <i class="mdi mdi-information-outline"></i> Your Charitable Organization currently has no awards.
                                </td>
                            </tr>
                            @endif
                            @foreach($awards as $key => $award)
                                <tr>
                                    <th scope="row">{{ $key+1 }}</th>
                                    <td>{{ $award->name }}</td>
                                    <td>{!! $award->file_link?'<a target="_blank" href="' . $award->file_link .'"> ' . $award->file_link . '</a>':'---'!!}</td>
                                    <td>{{ Carbon\Carbon::parse($award->created_at)->isoFormat('LL (LT)') }}</a></td>
                                    <td>
                                        <a href="{{route('charity.profile.destroy_awards',$award->id)}}" class="btn btn-rounded btn-sm btn-outline-danger waves-effect waves-light">
                                            <i class="mdi mdi-trash-can-outline"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label" for="award_name">*Name of Certificate</label>
                                <input type="text" class="form-control" id="award_name" name="award_name"
                                    placeholder="Enter name of the certificate or award" value="{{ old('award_name') }}">
                                @error('award_name')
                                    <div class="text-danger">
                                        <small>
                                            {{ $message }}
                                        </small>
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div>
                                <label class="form-label" for="file_link">
                                    File Link (Optional)
                                    <span data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        title="Upload the file on your drive cloud and put the public link to the file here."
                                        data-bs-original-title="yes">
                                        <i class="mdi mdi-information-outline"></i>
                                    </span>
                                </label>
                                <input type="text" class="form-control" id="file_link" name="file_link"
                                    placeholder="Enter file link of the certificate or award" value="{{ old('file_link') }}">
                            </div>
                            @error('file_link')
                                <div class="text-danger">
                                    <small>
                                        {{ $message }}
                                    </small>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="row px-3">
                        <ul class="list-inline mb-0 mt-4 text-center">
                            <button type="submit" class="btn btn-outline-dark btn-rounded w-xl waves-effect waves-light w-50" {{ $awards->count()>=5?'disabled':'' }}>
                                <i class="mdi mdi-plus"></i> Add Award
                            </button>
                        </ul>
                        @if ($awards->count() >= 5)
                        <span class="text-muted text-center font-size-12 mt-2">
                            <em>
                                Max of 5 awards only.
                            </em>
                        </span>
                        @endif
                    </div>


                </div>
            </div>
        </div>
    </form>
    <form method="POST" action="{{route('charity.profile.store_secondary')}}" enctype="multipart/form-data" id="saveSecondaryInfo">
        @csrf
        <div class="card mb-1 shadow-none">
            <a href="#collapseFour" class="text-dark collapsed" data-bs-toggle="collapse"
                            aria-expanded="false"
                            aria-controls="collapseFour">
                <div class="card-header" id="headingFour">
                    <h6 class="m-0">
                        Story <small>(Click to Expand)</small>
                        <i class="mdi mdi-minus float-end accor-plus-icon"></i>
                    </h6>
                </div>
            </a>

            <div id="collapseFour" class="collapse"
                    aria-labelledby="headingFour" data-bs-parent="#accordion">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="mb-3">
                                <label class="form-label" for="our_story">*Our Story</label>
                                <textarea id="elm1" name="our_story">{{ $secondaryInfo->our_story ?? old('our_story') }}</textarea>
                                @error('our_story')
                                    <div class="text-danger">
                                        <small>
                                            {{ $message }}
                                        </small>
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-2">
                                <label class="form-label" for="our_story_photo">Story Photo</label>
                                <input class="form-control" name="our_story_photo" id="our_story_photo" type="file">
                                @error('our_story_photo')
                                    <div class="text-danger">
                                        <small>
                                            {{ $message }}
                                        </small>
                                    </div>
                                @enderror
                            </div>
                            @isset($secondaryInfo)
                            <img id="showImageStory" class="img-fluid rounded" alt="Our Story's Photo Preview" src="{{ $secondaryInfo->our_story_photo ? asset('upload/charitable_org/our_story/'.$secondaryInfo->our_story_photo) : asset('backend/assets/images/placeholder-image.jpg') }}" height="300">
                            @else
                            <img id="showImageStory" class="img-fluid rounded" alt="Our Story's Photo Preview" src="{{ asset('backend/assets/images/placeholder-image.jpg') }}" height="300">
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-1 shadow-none">
            <a href="#collapseFive" class="text-dark collapsed" data-bs-toggle="collapse"
                            aria-expanded="false"
                            aria-controls="collapseFive">
                <div class="card-header" id="headingFive">
                    <h6 class="m-0">
                        Goal <small>(Click to Expand)</small>
                        <i class="mdi mdi-minus float-end accor-plus-icon"></i>
                    </h6>
                </div>
            </a>
            <div id="collapseFive" class="collapse" aria-labelledby="headingFive"
                    data-bs-parent="#accordion">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="mb-3">
                                <label class="form-label" for="our_goal">*Our Goal</label>
                                <textarea id="elm2" name="our_goal">{{ $secondaryInfo->our_goal ?? old('our_goal') }}</textarea>
                                @error('our_goal')
                                    <div class="text-danger">
                                        <small>
                                            {{ $message }}
                                        </small>
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label class="form-label" for="our_goal_photo">Goal Photo</label>
                                <input class="form-control" name="our_goal_photo" id="our_goal_photo" type="file">
                                @error('our_goal_photo')
                                    <div class="text-danger">
                                        <small>
                                            {{ $message }}
                                        </small>
                                    </div>
                                @enderror
                            </div>
                            @isset($secondaryInfo)
                            <img id="showImageGoal" class="img-fluid rounded" alt="Our Goal's Photo Preview" src="{{ $secondaryInfo->our_goal_photo ? asset('upload/charitable_org/our_goal/'.$secondaryInfo->our_goal_photo) : asset('backend/assets/images/placeholder-image.jpg') }}">
                            @else
                            <img id="showImageGoal" class="img-fluid rounded" alt="Our Goal's Photo Preview" src="{{ asset('backend/assets/images/placeholder-image.jpg') }}">
                            @endisset
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="row px-3">
    <ul class="list-inline mb-0 mt-4 text-center">
        <button type="submit" form="saveSecondaryInfo" class="btn btn-dark btn-rounded w-xl waves-effect waves-light w-100"
            style="background-color: #62896d;">Save Secondary Information
        </button>
    </ul>
</div>

<p class="text-muted text-center font-size-12 mt-2">
    <em>
        Please click on <strong>Save</strong> first before proceeding to the next.
    </em>
</p>

<script type="text/javascript">
    $(document).ready(function() {
        $('#our_story_photo').change(function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#showImageStory').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
        $('#our_goal_photo').change(function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#showImageGoal').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>