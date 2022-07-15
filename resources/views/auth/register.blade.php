<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Caviom — Register | Charity Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('backend/assets/images/Caviom Logo.png') }}">
    <!-- Bootstrap Css -->
    <link href="{{ asset('backend/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('backend/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('backend/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

</head>

<body class="auth-body-bg" style="background-image:url({{ asset('backend/assets/images/auth-bg.gif') }})">
    <div class="bg-overlay"></div>
    <div class="wrapper-page">
        <div class="container-fluid p-0">
            <div class="card">
                <div class="card-body">
                    {{-- <div class="text-center mt-4">
                        <div class="">
                            <a href="{{ url('/') }}" class="auth-logo">
                                <img src="{{ asset('backend/assets/images/caviom-logo-2.png') }}" height="100"
                                    class="logo-dark mx-auto" alt="">
                                <img src="{{ asset('backend/assets/images/caviom-logo-2.png') }}" height="100"
                                    class="logo-light mx-auto" alt="">
                            </a>
                        </div>
                    </div> --}}

                    <div class="p-3">
                        <form class="form-horizontal needs-validation @if ($errors->all()) was-validated @endif"
                            action="{{ route('register') }}" method="POST" novalidate enctype='multipart/form-data'>
                            @csrf

                            <h1 style="color: #62896d"><strong>REGISTER</strong></h1>

                            <h4 class="mt-4" style="color: #62896d">Personal Information</h4>

                            <div class="form-group mb-3 row">
                                <!-- First Name -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="first_name" class="form-label">*First Name</label>
                                        <input type="text" class="form-control" name="first_name" id="first_name" placeholder="Ex. Juan"
                                            value="@if(!$errors->has('first_name')){{ old('first_name') }}@endif" required>
                                        @error('first_name')
                                            <div class="invalid-tooltip">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Middle Name -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="middle_name" class="form-label">Middle Name</label>
                                        <input type="text" class="form-control" name="middle_name" id="middle_name" placeholder="Ex. De La"
                                            value="@if(!$errors->has('middle_name')){{ old('middle_name') }}@endif" required>
                                        @error('middle_name')
                                            <div class="invalid-tooltip">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Last Name -->
                            <div class="row form-group mb-3">
                                <div class="col-md-12">
                                    <label for="last_name" class="form-label">*Last Name</label>
                                    <input type="text" class="form-control" name="last_name" id="last_name" placeholder="Ex. Cruz"
                                    value="@if(!$errors->has('last_name')){{ old('last_name') }}@endif" required>
                                    @error('last_name')
                                        <div class="invalid-tooltip">
                                            {{ $message }}
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
                                                placeholder="Ex. 09981234567" required
                                                value="@if(!$errors->has('cel_no')){{ old('cel_no') }}@endif">
                                            @error('cel_no')
                                                <div class="invalid-tooltip">
                                                    {{ $message }}
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
                                                placeholder="Ex. 82531234" value="@if(!$errors->has('tel_no')){{ old('tel_no') }}@endif">
                                            @error('tel_no')
                                                <div class="invalid-tooltip">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Work Position -->
                            <div class="form-group mb-3 row">
                                <div class="col-12">
                                    <label for="work_position" class="form-label">*Position in the Organization</label>
                                    <input class="form-control" name="work_position" id="work_position" type="text" required
                                        placeholder="Ex. Head / President / Founder / Director"  required
                                        value="@if(!$errors->has('work_position')){{ old('work_position') }}@endif">
                                    @error('work_position')
                                        <div class="invalid-tooltip">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Organizational ID No. -->
                            <div class="form-group mb-3 row">
                                <div class="col-12">
                                    <label for="organizational_id_no" class="form-label">
                                        Your Organizational ID Number (Permanent)
                                        <span data-bs-toggle="tooltip" data-bs-placement="bottom" title="Leave blank if you wish to autogenerate a 10-digit ID No.
                                            It must consist of numbers only (No character / Special Symbols).
                                            Maximum length of ID must be up to 10 digits only. Each ID no. must be unique in the Charitable Organization." data-bs-original-title="yes">
                                            <i class="mdi mdi-information-outline"></i>
                                        </span>
                                    </label>
                                    <input class="form-control" name="organizational_id_no" id="organizational_id_no" type="text" placeholder="(Leave blank if you wish to auto-generate ID no.)"
                                        value="{{ old('organizational_id_no') }}" required>
                                    @error('organizational_id_no')
                                        <div class="invalid-tooltip">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <h4 class="mt-4" style="color: #62896d">Current Address</h4>

                            {{-- <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3 row">
                                        <div class="col-12">
                                            <label for="house_no" class="form-label">*House / Block No.</label>
                                            <input class="form-control" name="house_no" id="house_no" type="text"
                                                placeholder="Ex. 34B"
                                                value="{{ old('house_no') }}"
                                                required>
                                            @error('house_no')
                                                <div class="invalid-tooltip">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3 row">
                                        <div class="col-12">
                                            <label for="tel_no" class="form-label">Street / Subdivision</label>
                                            <input class="form-control" name="tel_no" id="tel_no" type="text"
                                                placeholder="Ex. Stratford Drive"
                                                value="{{ old('tel_no') }}"
                                                required>
                                            @error('tel_no')
                                                <div class="invalid-tooltip">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div> --}}

                            <!-- Address Line 1 -->
                            <div class="form-group mb-3 row">
                                <div class="col-12">
                                    <label for="address_line_one" class="form-label">*Address Line 1</label>
                                    <input class="form-control" name="address_line_one" id="address_line_one" type="text" required
                                        placeholder="Ex. 1123 Kahoy St."
                                        value="@if(!$errors->has('address_line_one')){{ old('address_line_one') }}@endif">
                                    @error('address_line_one')
                                        <div class="invalid-tooltip">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Address Line 2 -->
                            <div class="form-group mb-3 row">
                                <div class="col-12">
                                    <label for="address_line_two" class="form-label">Address Line 2 (Optional)</label>
                                    <input class="form-control" name="address_line_two" id="address_line_two" type="text"
                                        placeholder="Ex. Unit 34B 4th Floor"
                                        value="@if(!$errors->has('address_line_two')){{ old('address_line_two') }}@endif">
                                    @error('address_line_two')
                                        <div class="invalid-tooltip">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Province -->
                            <div class="form-group mb-3 row">
                                <div class="col-12">
                                    <label for="province" class="form-label">*Province</label>
                                    <input class="form-control" name="province" id="province" type="text" required
                                        placeholder="Ex. Metro Manila"
                                        value="@if(!$errors->has('province')){{ old('province') }}@endif">
                                    @error('province')
                                        <div class="invalid-tooltip">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- City -->
                            <div class="form-group mb-3 row">
                                <div class="col-12">
                                    <label for="city" class="form-label">*City / Municipality</label>
                                    <input class="form-control" name="city" id="city" type="text" required
                                        placeholder="Ex. Manila City"
                                        value="@if(!$errors->has('city')){{ old('city') }}@endif">
                                    @error('city')
                                        <div class="invalid-tooltip">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Barangay -->
                            <div class="form-group mb-3 row">
                                <div class="col-12">
                                    <label for="barangay" class="form-label">*Barangay</label>
                                    <input class="form-control" name="barangay" id="barangay" type="text" required
                                        placeholder="Ex. Brgy. 204"
                                        value="@if(!$errors->has('barangay')){{ old('barangay') }}@endif">
                                    @error('barangay')
                                        <div class="invalid-tooltip">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Postal Code -->
                            <div class="form-group mb-3 row">
                                <div class="col-12">
                                    <label for="postal_code" class="form-label">*Postal Code</label>
                                    <input class="form-control" name="postal_code" id="postal_code" type="text" required
                                        placeholder="Ex. 1013"
                                        value="@if(!$errors->has('postal_code')){{ old('postal_code') }}@endif">
                                    @error('postal_code')
                                        <div class="invalid-tooltip">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <h4 class="mt-4" style="color: #62896d">Login Details</h4>

                            <!-- Charitable Organization Name -->
                            <div class="form-group mb-3 row">
                                <div class="col-12">
                                    <label for="name" class="form-label">*Name of your Charitable Organization (Permanent)</label>
                                    <span data-bs-toggle="tooltip" data-bs-placement="bottom" title="Kindly double check as this will no longer be editable." data-bs-original-title="yes">
                                        <i class="mdi mdi-information-outline"></i>
                                    </span>
                                    <input class="form-control" name="name" id="name" type="text" required
                                        placeholder="Ex. My Charitable Organization, Inc."
                                        value="@if(!$errors->has('name')){{ old('name') }}@endif">
                                    @error('name')
                                        <div class="invalid-tooltip">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Username -->
                            <div class="form-group mb-3 row">
                                <div class="col-12">
                                    <label for="username" class="form-label">
                                        *Username
                                        <span data-bs-toggle="tooltip" data-bs-placement="bottom"
                                            title="You cannot change your username once you create one. Make sure it is appropriate."
                                            data-bs-original-title="yes">
                                            <i class="mdi mdi-information-outline"></i>
                                        </span>
                                    </label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="username">@</span>
                                        </div>
                                        <input type="text" class="form-control" name="username" id="username"
                                            placeholder="Ex. juan.delacruz"
                                            aria-describedby="validationTooltipUsernamePrepend"
                                            value="@if(!$errors->has('username')){{ old('username') }}@endif" required>
                                        @error('username')
                                            <div class="invalid-tooltip">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Profile Photo -->
                            <div class="form-group mb-3 row">
                                <div class="col-12">
                                    <label for="profile_photo" class="form-label">Profile Photo (Optional)</label>
                                    <input class="form-control" name="profile_image" id="profile_image" type="file">
                                    @error('profile_photo')
                                        <div class="invalid-tooltip">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Email Address -->
                            <div class="form-group mb-3 row">
                                <div class="col-12">
                                    <label for="email" class="form-label">*Email Adress</label>
                                    <input class="form-control" name="email" id="email" type="email"
                                        placeholder="Ex. juan.delacruz@mycharity.org"
                                        value="@if(!$errors->has('email')){{ old('email') }}@endif" required>
                                    @error('email')
                                        <div class="invalid-tooltip">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Password -->
                            <div class="form-group mb-3 row">
                                <div class="col-12">
                                    <label for="password" class="form-label">
                                        *Password
                                        <span data-bs-toggle="tooltip" data-bs-placement="bottom"
                                            title="8-20 characters with a letter and a number."
                                            data-bs-original-title="yes">
                                            <i class="mdi mdi-information-outline"></i>
                                        </span>
                                    </label>
                                    <input class="form-control" name="password" id="password" type="password" required
                                        placeholder="Password" value="">

                                    @error('password')
                                        <div class="invalid-tooltip">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Confirm Password -->
                            <div class="form-group mb-3 row">
                                <div class="col-12">
                                    <label for="password_confirmation" class="form-label">*Confirm Password</label>
                                    <input class="form-control" name="password_confirmation"
                                        id="password_confirmation" type="password"
                                        placeholder="Confirm Password" required>
                                    @error('password_confirmation')
                                        <div class="invalid-tooltip">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Term & Conditions -->
                            <div class="form-check mb-3 row">
                                <div class="col-12">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="is_agreed" class="form-check-input" id="is_agreed" required>
                                        <label class="form-label ms-1 fw-normal" for="is_agreed">I agree to Caviom's
                                            <a href="#" target="_blank" class="text-link"><strong>Terms of Service</strong></a> and
                                            <a href="#" target="_blank" class="text-link"><strong>Privacy Policy</strong></a>.
                                        </label>
                                        @error('is_agreed')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group text-center row mt-3 pt-1">
                                <div class="col-12">
                                    <button class="btn btn-dark w-100 waves-effect waves-light"
                                        type="submit">Create Account</button>
                                </div>
                            </div>

                            <div class="form-group mt-2 mb-0 row">
                                <div class="col-12 mt-2 text-center">
                                    <a href="{{ route('login') }}" class="text-muted">Already have account?</a>
                                </div>
                            </div>
                        </form>
                        <!-- end form -->
                    </div>
                </div>
                <!-- end cardbody -->
            </div>
            <!-- end container -->
        </div>
        <!-- end -->


        <!-- JAVASCRIPT -->
        <script src="{{ asset('backend/assets/libs/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('backend/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('backend/assets/libs/metismenu/metisMenu.min.js') }}"></script>
        <script src="{{ asset('backend/assets/libs/simplebar/simplebar.min.js') }}"></script>
        <script src="{{ asset('backend/assets/libs/node-waves/waves.min.js') }}"></script>

        <script src="{{ asset('backend/assets/js/app.js') }}"></script>

</body>

</html>
