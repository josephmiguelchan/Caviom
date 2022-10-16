<!--  Modal content for Cover Photos Modal -->
<div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="uploadPhotosModal">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myLargeModalLabel">Cover Photos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="dZUpload">
                <h4 class="card-title">Upload Cover Photos of your Charitable Organization</h4>
                <p class="card-title-desc">Please upload at least one (1) cover photo, up to 5 cover photos. Maximum of 2MB in file size only.</p>

                <form action="{{route('charity.profile.cover_photos.save')}}" method="POST" class="dropzone" enctype="multipart/form-data"
                    id="myGreatDropzone">
                    @csrf
                    <div class="fallback">
                        <input name="file" type="file" multiple="multiple">
                    </div>
                    <div class="dz-message needsclick">
                        <div class="mb-3">
                            <i class="display-4 text-muted ri-upload-cloud-2-line"></i>
                        </div>

                        <h4>Drop files here or click to upload.</h4>
                    </div>
                </form>

                {{-- <div class="float-end mt-4 p-1">
                    <button type="button" class="btn btn-primary waves-effect waves-light w-lg" id="uploadFile">
                        <i class="mdi mdi-upload"></i> Upload image(s)
                    </button>
                </div> --}}

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<form method="POST" action="{{route('charity.profile.store_primary')}}" class="form-horizontal" id="primary_info_save" enctype="multipart/form-data">
    @csrf
    <div id="accordion" class="custom-accordion">
        <div class="card mb-1 shadow-none">
            <a href="#collapseOne" class="text-dark" data-bs-toggle="collapse"
                            aria-expanded="true"
                            aria-controls="collapseOne">
                <div class="card-header" id="headingOne">
                    <h6 class="m-0">
                        Photos <small>(Click to Expand)</small>
                        <i class="mdi mdi-minus float-end accor-plus-icon"></i>
                    </h6>
                </div>
            </a>

            <div id="collapseOne" class="collapse show"
                    aria-labelledby="headingOne" data-bs-parent="#accordion">
                <div class="card-body">

                    <!-- Cover Photos -->
                    <div>
                        <div class="form-group mb-3 row">
                            <div class="col-6">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label class="form-label" for="profile_photo">*Profile Picture</label>
                                        <span data-bs-toggle="tooltip" data-bs-placement="bottom" title="Must not exceed 2mb." data-bs-original-title="yes">
                                            <i class="mdi mdi-information-outline"></i>
                                        </span>
                                        <input type="file" class="form-control" id="profile_photo" name="profile_photo">
                                        @error('profile_photo')
                                            <div class="text-danger small">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-10">
                                    @php
                                        $avatar = 'upload/charitable_org/profile_photo/'.Auth::user()->charity->profile_photo;
                                        $defaultAvatar = 'upload/charitable_org/profile_photo/no_avatar.png';
                                    @endphp

                                    <img class="img-fluid rounded" alt="Charitable Organization Profile Photo Preview" src="{{ Auth::user()->charity->profile_photo? url($avatar):url($defaultAvatar) }}" id="showImage">
                                </div>
                            </div>

                            @php
                                $cover_photos = App\Models\Charity\Profile\ProfileCoverPhoto::where('charitable_organization_id', Auth::user()->charitable_organization_id)->take(5)->get();
                            @endphp

                            <div class="col-6">
                                <h5>Cover Photos</h5>
                                <p class="mt-0 mb-3">(Cover photos will be updated after uploading and refreshing this page)</p>
                                <div class="row text-center">
                                    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                                        <ol class="carousel-indicators">
                                            @foreach ($cover_photos as $key => $photo)
                                                <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{$key}}" {!! $key == 0?'class="active"':'' !!}></li>
                                            @endforeach
                                        </ol>
                                        <div class="carousel-inner" role="listbox">
                                            @foreach ($cover_photos as $key => $photo)
                                                <div class="carousel-item {{ $key == 0?'active':'' }}">
                                                    <img class="d-block img-fluid" src="{{ url('upload/charitable_org/cover_photos/'. $photo->file_name) }}" alt="Slide {{$key+1}}">
                                                </div>
                                            @endforeach
                                        </div>
                                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-light btn-rounded waves-effect waves-light w-xl float-end mt-2"
                                    data-bs-toggle="modal" data-bs-target="#uploadPhotosModal">
                                    <i class="ri-image-add-line"></i> Manage
                                </button>
                                @if (Session::has('error_msg'))
                                    <div class="text-danger my-2">
                                        {{ Session::get('error_msg') }}
                                    </div>
                                @endif
                            </div>
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
                        Primary Information & Address <small>(Click to Expand)</small>
                        <i class="mdi mdi-minus float-end accor-plus-icon"></i>
                    </h6>
                </div>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                    data-bs-parent="#accordion">
                <div class="card-body">
                        <!-- Label -->
                        <h4 class="mt-4" style="color: #62896d">Label</h4>

                        <div class="form-group mb-3 row">
                            <!-- Category -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="category" class="form-label">
                                        *Category
                                        <span data-bs-toggle="tooltip" data-bs-placement="bottom"
                                            title="Category to which your Charitable Organization falls under."
                                            data-bs-original-title="yes">
                                            <i class="mdi mdi-information-outline"></i>
                                        </span>
                                    </label>
                                    <select class="form-control select2" name="category" >
                                        <option disabled hidden selected>Select a category</option>

                                        <option value="Community Development" {{$primaryInfo?($primaryInfo->category=='Community Development'?'selected':''):(old('category')=='Community Development'?'selected':'')}}>Community Development</option>
                                        <option value="Education" {{$primaryInfo?($primaryInfo->category=='Education'?'selected':''):(old('category')=='Education'?'selected':'')}}>Education</option>
                                        <option value="Humanities" {{$primaryInfo?($primaryInfo->category=='Humanities'?'selected':''):(old('category')=='Humanities'?'selected':'')}}>Humanities</option>
                                        <option value="Health" {{$primaryInfo?($primaryInfo->category=='Health'?'selected':''):(old('category')=='Health'?'selected':'')}}>Health</option>
                                        <option value="Environment" {{$primaryInfo?($primaryInfo->category=='Environment'?'selected':''):(old('category')=='Environment'?'selected':'')}}>Environmental</option>
                                        <option value="Social Welfare" {{$primaryInfo?($primaryInfo->category=='Social Welfare'?'selected':''):(old('category')=='Social Welfare'?'selected':'')}}>Social Welfare</option>
                                        <option value="Corporate" {{$primaryInfo?($primaryInfo->category=='Corporate'?'selected':''):(old('category')=='Corporate'?'selected':'')}}>Corporate</option>
                                        <option value="Church" {{$primaryInfo?($primaryInfo->category=='Church'?'selected':''):(old('category')=='Church'?'selected':'')}}>Church</option>
                                        <option value="Livelihood" {{$primaryInfo?($primaryInfo->category=='Livelihood'?'selected':''):(old('category')=='Livelihood'?'selected':'')}}>Livelihood</option>
                                        <option value="Sports Volunteerism" {{$primaryInfo?($primaryInfo->category=='Sports Volunteerism'?'selected':''):(old('category')=='Sports Volunteerism'?'selected':'')}}>Sports Volunteerism</option>

                                    </select>
                                    @error('category')
                                        <div class="text-danger small">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Tagline -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tagline" class="form-label">Tagline (Optional)</label>
                                    <input class="form-control" name="tagline" id="thresholdconfig" type="text" placeholder="Enter tagline"
                                        maxlength="200" value="{{ $primaryInfo->tagline ?? old('tagline') }}">
                                    @error('tagline')
                                        <div class="text-danger small">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Primary Info & Address -->
                        <h4 class="mt-4" style="color: #62896d">Primary Information & Address</h4>

                        <!-- Dev note: Might delete this checkbox below -->
                        {{-- <div class="form-check form-switch mb-4" dir="ltr">
                            <input type="checkbox" name="use_own_info" class="form-check-input" id="use_own_info">
                            <label class="form-check-label" for="use_own_info">Use my own information</label>
                        </div> --}}

                        <!-- Email Address -->
                        <div class="form-group mb-3 row">
                            <div class="col-12">
                                <label for="email" class="form-label">
                                    *Email Adress
                                    <span data-bs-toggle="tooltip" data-bs-placement="bottom"
                                        title="Using the corporate email address of your Charitable Organization (if any) is highly suggested."
                                        data-bs-original-title="yes"><i class="mdi mdi-information-outline"></i>
                                    </span>
                                </label>
                                <input class="form-control" name="email" id="email" type="email"
                                    placeholder="@unless($errors->any())Ex. info@mycharity.org @endunless"
                                    value="{{ $primaryInfo->email_address ?? old('email') }}" >
                                @error('email')
                                    <div class="text-danger">
                                        <small>
                                            {{ $message }}
                                        </small>
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <!-- Cellphone -->
                            <div class="col-md-6">
                                <div class="form-group mb-3 row">
                                    <div class="col-12">
                                        <label for="cel_no" class="form-label">*Cellphone No.</label>
                                        <input class="form-control" name="cel_no" id="cel_no" type="tel"
                                            placeholder="@unless($errors->any())Ex. 09981234567 @endunless"
                                            value="{{ $primaryInfo->cel_no ?? old('cel_no') }}">
                                        @error('cel_no')
                                            <div class="text-danger">
                                                <small>
                                                    {{ $message }}
                                                </small>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Telephone -->
                            <div class="col-md-6">
                                <div class="form-group mb-3 row">
                                    <div class="col-12">
                                        <label for="tel_no" class="form-label">Telephone No.</label>
                                        <input class="form-control" name="tel_no" id="tel_no" type="tel"
                                            placeholder="@unless($errors->any())Ex. 82531234 @endunless" value="{{ $primaryInfo->tel_no ?? old('tel_no') }}">
                                        @error('tel_no')
                                            <div class="text-danger">
                                                <small>
                                                    {{ $message }}
                                                </small>
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Address Line 1 -->
                        <div class="form-group mb-3 row">
                            <div class="col-12">
                                <label for="address_line_one" class="form-label">*Address Line 1</label>
                                <input class="form-control" name="address_line_one" id="address_line_one" type="text"
                                    placeholder="@unless($errors->any())Ex. 1123 Kahoy St. @endunless"
                                    value="{{ $primaryInfo->address->address_line_one ?? old('address_line_one') }}">
                                @error('address_line_one')
                                    <div class="text-danger">
                                        <small>
                                            {{ $message }}
                                        </small>
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <!-- Address Line 2 -->
                        <div class="form-group mb-3 row">
                            <div class="col-12">
                                <label for="address_line_two" class="form-label">Address Line 2 (Optional)</label>
                                <input class="form-control" name="address_line_two" id="address_line_two" type="text"
                                    placeholder="@unless($errors->any())Ex. Unit 34B 4th Floor @endunless"
                                    value="{{ $primaryInfo->address->address_line_two ?? old('address_line_two') }}">
                                @error('address_line_two')
                                    <div class="text-danger">
                                        <small>
                                            {{ $message }}
                                        </small>
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group mb-3 row">
                            <!-- Region -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="region" class="form-label">*Region</label>
                                    <input class="form-control" name="region" id="region" type="text"
                                        placeholder="@unless($errors->any())Ex. NCR @endunless"
                                        value="{{ $primaryInfo->address->region ?? old('region') }}">
                                    @error('region')
                                        <div class="text-danger">
                                            <small>
                                                {{ $message }}
                                            </small>
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Province -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="province" class="form-label">*Province</label>
                                    <input class="form-control" name="province" id="province" type="text"
                                        placeholder="@unless($errors->any())Ex. Metro Manila @endunless"
                                        value="{{ $primaryInfo->address->province ?? old('province') }}">
                                    @error('province')
                                        <div class="text-danger">
                                            <small>
                                                {{ $message }}
                                            </small>
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- City -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="city" class="form-label">*City / Municipality</label>
                                    <input class="form-control" name="city" id="city" type="text"
                                        placeholder="@unless($errors->any())Ex. Manila City @endunless"
                                        value="{{ $primaryInfo->address->city ?? old('city') }}">
                                    @error('city')
                                        <div class="text-danger">
                                            <small>
                                                {{ $message }}
                                            </small>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3 row">
                            <!-- Barangay -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="barangay" class="form-label">*Barangay</label>
                                    <input class="form-control" name="barangay" id="barangay" type="text"
                                        placeholder="@unless($errors->any())Ex. Brgy. 204 @endunless"
                                        value="{{ $primaryInfo->address->barangay ?? old('barangay') }}">
                                    @error('barangay')
                                        <div class="text-danger">
                                            <small>
                                                {{ $message }}
                                            </small>
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Postal Code -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="postal_code" class="form-label">*Postal Code</label>
                                    <input class="form-control" name="postal_code" id="postal_code" type="text"
                                        placeholder="@unless($errors->any())Ex. 1013 @endunless"
                                        value="{{ $primaryInfo->address->postal_code ?? old('postal_code') }}">
                                    @error('postal_code')
                                        <div class="text-danger">
                                            <small>
                                                {{ $message }}
                                            </small>
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                </div>
            </div>
        </div>
    </div>

    <div class="row px-3">
        <ul class="list-inline mb-0 mt-4 text-center">
            <button type="submit" form="primary_info_save" class="btn btn-dark btn-rounded w-xl waves-effect waves-light w-100"
                style="background-color: #62896d;">Save Primary Information</button>
        </ul>
    </div>

    <p class="text-muted text-center font-size-12 mt-2">
        <em>
            Please click on <strong>Save</strong> first before proceeding to the next.
        </em>
    </p>
</form>


<script type="text/javascript">
    $(document).ready(function() {
        $('#profile_photo').change(function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>

