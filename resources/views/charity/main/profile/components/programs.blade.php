<form method="POST" action="" enctype="multipart/form-data">
    @csrf
    <div id="accordion" class="custom-accordion">
        <div class="card mb-1 shadow-none">
            <a href="#collapseSix" class="text-dark" data-bs-toggle="collapse"
                            aria-expanded="true"
                            aria-controls="collapseSix">
                <div class="card-header" id="headingOne">
                    <h6 class="m-0">
                        Programs & Activities <small>(Click to Expand)</small>
                        <i class="mdi mdi-minus float-end accor-plus-icon"></i>
                    </h6>
                </div>
            </a>

            <div id="collapseSix" class="collapse show"
                    aria-labelledby="headingOne" data-bs-parent="#accordion">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label" for="program_name">*Program / Activity Name</label>
                                <input type="text" class="form-control" id="program_name" name="program_name" placeholder="Enter name" required
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

                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label" for="program_photo">Photo of the Program / Activity</label>
                                <input class="form-control" name="program_photo" id="program_photo" type="file">
                                @error('program_photo')
                                    <div class="text-danger">
                                        <small>
                                            {{ $message }}
                                        </small>
                                    </div>
                                @enderror
                            </div>
                            <a class="image-popup-no-margins" title="Photo Story" href="{{ asset('backend/assets/images/placeholder-image.jpg') }}">
                                <img class="img-fluid rounded" alt="Our Story's Photo Preview" src="{{ asset('backend/assets/images/placeholder-image.jpg') }}" width="230">
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label class="form-label" for="program_description">*Description</label>
                                <textarea id="elm3" name="program_description" required>{{ old('program_description') }}</textarea>
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
                        <div class="float-end">
                            <span class="text-muted font-size-12 mt-2">
                                <em>
                                    Max of 5 programs / activities only.
                                </em>
                            </span>
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
                style="background-color: #62896d;" value="Save Programs & Activities">
        </ul>
    </div>

    <p class="text-muted text-center font-size-12 mt-2">
        <em>
            Please click on <strong>Save</strong> first before proceeding to the next.
        </em>
    </p>
</form>