<!-- Cover Photos -->
<div>
    <div class="form-group mb-3 row">
        <div class="col-12">
            <label class="form-label">*Cover Photos</label>
            <div class="row">
                <div class="popup-gallery">
                    <a class="float-start" href="{{ asset('backend/assets/images/small/img-1.jpg') }}" title="Cover Photo 1">
                        <div class="img-fluid">
                            <img src="{{ asset('backend/assets/images/small/img-1.jpg') }}" alt="img-1" width="120">
                        </div>
                    </a>
                    <a class="float-start" href="{{ asset('backend/assets/images/small/img-2.jpg') }}" title="Cover Photo 2">
                        <div class="img-fluid">
                            <img src="{{ asset('backend/assets/images/small/img-2.jpg') }}" alt="img-2" width="120">
                        </div>
                    </a>
                    <a class="float-start" href="{{ asset('backend/assets/images/small/img-3.jpg') }}" title="Cover Photo 3">
                        <div class="img-fluid">
                            <img src="{{ asset('backend/assets/images/small/img-3.jpg') }}" alt="img-3" width="120">
                        </div>
                    </a>
                    <a class="float-start" href="{{ asset('backend/assets/images/small/img-4.jpg') }}" title="Cover Photo 4">
                        <div class="img-fluid">
                            <img src="{{ asset('backend/assets/images/small/img-4.jpg') }}" alt="img-4" width="120">
                        </div>
                    </a>
                    <a class="float-start" href="{{ asset('backend/assets/images/small/img-5.jpg') }}" title="Cover Photo 5">
                        <div class="img-fluid">
                            <img src="{{ asset('backend/assets/images/small/img-5.jpg') }}" alt="img-5" width="120">
                        </div>
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

    <!--  Modal content for Cover Photos Modal -->
    <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="uploadPhotosModal">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myLargeModalLabel">Cover Photos</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4 class="card-title">Upload Cover Photos of your Charitable Organization</h4>
                    <p class="card-title-desc">At least one photo is required up to a maximum of 5 cover photos.</p>

                    <form action="#" method="POST" class="dropzone" enctype="multipart/form-data">
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

                    <div class="float-end mt-4 p-1">
                        <button type="button" class="btn btn-primary waves-effect waves-light w-lg">
                            <i class="mdi mdi-upload"></i> Upload image(s)
                        </button>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
</div>

<!-- Primary Info & Address -->
<form method="POST" action="" class="form-horizontal">
    @csrf

    <h4 class="mt-4" style="color: #62896d">Primary Information</h4>

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
                <select class="form-control select2" name="category" required>
                    <option disabled hidden selected>Select a category</option>
                    <optgroup label="International Charity Groups">
                        <option value="AK">Community Development Charities</option>
                        <option value="HI">Education Charities</option>
                    </optgroup>
                    <optgroup label="Local Charity Groups">
                        <option value="CA">Health Charities</option>
                        <option value="NV">Human Services</option>
                        <option value="OR">Environmental Charities</option>
                        <option value="WA">Human Service Charities</option>
                    </optgroup>
                </select>
                @error('category')
                    <div class="text-danger my-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <!-- Tagline -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="tagline" class="form-label">Tagline (Optional)</label>
                <input class="form-control" name="tagline" id="tagline" type="password"
                    placeholder="Enter tagline" value="{{ old('tagline') }}">
                @error('tagline')
                    <div class="text-danger my-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
    </div>

    <!-- Email Address -->
    <div class="form-group mb-3 row">
        <div class="col-12">
            <label for="email" class="form-label">
                *Email Adress
                <span data-bs-toggle="tooltip" data-bs-placement="bottom"
                    title="Using the corporate email address of your Charitable Organization (if any) is highly suggested."
                    data-bs-original-title="yes">
                    <i class="mdi mdi-information-outline"></i>
                </span>
            </label>
            <input class="form-control" name="email" id="email" type="email"
                placeholder="@unless($errors->any())Ex. info@mycharity.org @endunless"
                value="{{ old('email') }}" required>
            <!-- Dev note: Might delete this checkbox below -->
            <div class="form-check form-switch mt-1" dir="ltr">
                <input type="checkbox" class="form-check-input" id="customSwitch1">
                <label class="form-check-label" for="customSwitch1">Use my own email address</label>
            </div>
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
                        placeholder="@unless($errors->any())Ex. 09981234567 @endunless" required
                        value="{{ old('cel_no') }}">
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
                    <input class="form-control" name="tel_no" id="tel_no" type="tel" required
                        placeholder="@unless($errors->any())Ex. 82531234 @endunless" value="{{ old('tel_no') }}">
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

    <h4 class="mt-4" style="color: #62896d">Physical Address</h4>

    <!-- Dev note: Might delete this checkbox below -->
    <div class="form-check form-switch mb-4" dir="ltr">
        <input type="checkbox" class="form-check-input" id="customSwitch1">
        <label class="form-check-label" for="customSwitch1">Use my own current address</label>
    </div>

    <!-- Address Line 1 -->
    <div class="form-group mb-3 row">
        <div class="col-12">
            <label for="address_line_one" class="form-label">*Address Line 1</label>
            <input class="form-control" name="address_line_one" id="address_line_one" type="text" required
                placeholder="@unless($errors->any())Ex. 1123 Kahoy St. @endunless"
                value="{{ old('address_line_one') }}">
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
                value="{{ old('address_line_two') }}">
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
        <!-- Province -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="province" class="form-label">*Province</label>
                <input class="form-control" name="province" id="province" type="text" required
                    placeholder="@unless($errors->any())Ex. Metro Manila @endunless"
                    value="{{ old('province') }}">
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
        <div class="col-md-6">
            <div class="form-group">
                <label for="city" class="form-label">*City / Municipality</label>
                <input class="form-control" name="city" id="city" type="text" required
                    placeholder="@unless($errors->any())Ex. Manila City @endunless"
                    value="{{ old('city') }}">
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
                <input class="form-control" name="barangay" id="barangay" type="text" required
                    placeholder="@unless($errors->any())Ex. Brgy. 204 @endunless"
                    value="{{ old('barangay') }}">
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
                <input class="form-control" name="postal_code" id="postal_code" type="text" required
                    placeholder="@unless($errors->any())Ex. 1013 @endunless"
                    value="{{ old('postal_code') }}">
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

    <div class="row px-3">
        <ul class="list-inline mb-0 mt-4 text-center">
            <input type="submit" class="btn btn-dark btn-rounded w-xl waves-effect waves-light w-100"
                style="background-color: #62896d;" value="Save">
        </ul>
    </div>
</form>