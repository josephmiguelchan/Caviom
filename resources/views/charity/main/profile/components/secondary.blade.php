<form method="POST" action="" enctype="multipart/form-data">
    @csrf

    <div id="accordion" class="custom-accordion">
        <div class="card mb-1 shadow-none">
            <a href="#collapseOne" class="text-dark" data-bs-toggle="collapse"
                            aria-expanded="true"
                            aria-controls="collapseOne">
                <div class="card-header" id="headingOne">
                    <h6 class="m-0">
                        Story
                        <i class="mdi mdi-minus float-end accor-plus-icon"></i>
                    </h6>
                </div>
            </a>

            <div id="collapseOne" class="collapse show"
                    aria-labelledby="headingOne" data-bs-parent="#accordion">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="mb-3">
                                <label class="form-label" for="our_story">*Our Story</label>
                                <textarea id="elm1" name="our_story">{{ old('our_story') }}</textarea>
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
                                @error('our_story')
                                    <div class="text-danger">
                                        <small>
                                            {{ $message }}
                                        </small>
                                    </div>
                                @enderror
                            </div>
                            <a class="image-popup-no-margins" title="Photo Story" href="{{ asset('backend/assets/images/placeholder-image.jpg') }}">
                                <img class="img-fluid rounded" alt="Our Story's Photo Preview" src="{{ asset('backend/assets/images/placeholder-image.jpg') }}" height="300">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-1 shadow-none">
            <a href="#collapseTwo" class="text-dark collapsed" data-bs-toggle="collapse"
                            aria-expanded="false"
                            aria-controls="collapseTwo">
                <div class="card-header" id="headingTwo">
                    <h6 class="m-0">
                        Goal
                        <i class="mdi mdi-minus float-end accor-plus-icon"></i>
                    </h6>
                </div>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                    data-bs-parent="#accordion">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="mb-3">
                                <label class="form-label" for="our_goal">*Our Goal</label>
                                <textarea id="elm2" name="our_goal">
                                    {{ old('our_goal') }}
                                </textarea>
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
                                @error('our_goal')
                                    <div class="text-danger">
                                        <small>
                                            {{ $message }}
                                        </small>
                                    </div>
                                @enderror
                            </div>
                            <a class="image-popup-no-margins" title="Photo Story" href="{{ asset('backend/assets/images/placeholder-image.jpg') }}">
                                <img class="img-fluid rounded" alt="Our Story's Photo Preview" src="{{ asset('backend/assets/images/placeholder-image.jpg') }}">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-0 shadow-none">
            <a href="#collapseThree" class="text-dark collapsed" data-bs-toggle="collapse"
                            aria-expanded="false"
                            aria-controls="collapseThree">
                <div class="card-header" id="headingThree">
                    <h6 class="m-0">
                        Awards
                        <i class="mdi mdi-minus float-end accor-plus-icon"></i>
                    </h6>
                </div>
            </a>
            <div id="collapseThree" class="collapse"
                    aria-labelledby="headingThree" data-bs-parent="#accordion">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label" for="award_name">*Name of Certificate</label>
                                <input type="text" class="form-control" id="award_name" name="award_name"
                                    placeholder="Enter name of the certificate or award" value="{{ old('award_name') }}" required>
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
                            <div class="mb-3">
                                <label class="form-label" for="file_link">
                                    File Link of the Award (Optional)
                                    <span data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        title="Upload the file on your drive cloud and put the link to the file here."
                                        data-bs-original-title="yes">
                                        <i class="mdi mdi-information-outline"></i>
                                    </span>
                                </label>
                                <input type="text" class="form-control" id="file_link" name="file_link"
                                    placeholder="Enter file link of the certificate or award" value="{{ old('file_link') }}" required>
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

                    <div class="row">
                        <div class="float-end">
                            <button type="button" class="btn btn-light btn-rounded waves-effect waves-light w-xl float-end mt-2">
                                <i class="mdi mdi-plus"></i> Add more
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row px-3">
        <ul class="list-inline mb-0 mt-4 text-center">
            <input type="submit" class="btn btn-dark btn-rounded w-xl waves-effect waves-light w-100"
                style="background-color: #62896d;" value="Save Secondary Information">
        </ul>
    </div>
</form>