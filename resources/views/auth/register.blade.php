<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Register | Miguellumbao - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('backend/assets/images/Caviom Logo.png') }}">
    <!-- Bootstrap Css -->
    <link href="{{ asset('backend/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet"
        type="text/css" />
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
                    <div class="text-center mt-4">
                        <div class="mb-2">
                            <a href="{{ url('/') }}" class="auth-logo">
                                <img src="{{ asset('backend/assets/images/caviom-logo-2.png') }}" height="100"
                                    class="logo-dark mx-auto" alt="">
                                <img src="{{ asset('backend/assets/images/caviom-logo-2.png') }}" height="100"
                                    class="logo-light mx-auto" alt="">
                            </a>
                        </div>
                    </div>

                    <h4 class="text-muted text-center font-size-15">Register</h4>

                    <div class="p-3">
                        <form class="form-horizontal needs-validation @if ($errors->all()) was-validated @endif mt-3"
                            action="{{ route('register') }}" method="POST" novalidate>
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3 row">
                                        <div class="col-12">
                                            <label for="validationCustom04" class="form-label">Name</label>
                                            <input class="form-control" name="name" id="name" type="text"
                                                placeholder="Name"
                                                value="{{ old('name') }}"
                                                required>
                                            @error('name')
                                                <div class="invalid-tooltip">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3 position-relative">
                                        <label for="username" class="form-label">Username</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="username">@</span>
                                            </div>
                                            <input type="text" class="form-control" name="username" id="username"
                                                placeholder="Username"
                                                aria-describedby="validationTooltipUsernamePrepend"
                                                value="{{ old('username') }}"
                                                required="">
                                            @error('username')
                                                <div class="invalid-tooltip">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-3 row">
                                <div class="col-12">
                                    <label for="validationCustom04" class="form-label">Email</label>
                                    <input class="form-control" name="email" id="email" type="email" required=""
                                        placeholder="Email"
                                        value="{{ old('email') }}" required>
                                    @error('email')
                                        <div class="invalid-tooltip">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group mb-3 row">
                                <div class="col-12">
                                    <label for="validationCustom04" class="form-label">
                                        Password
                                        <span data-bs-toggle="tooltip" data-bs-placement="right"
                                            title="Minimum of 8 characters with a letter and a number."
                                            data-bs-original-title="yes">
                                            <i class="mdi mdi-information-outline"></i>
                                        </span>
                                    </label>
                                    <input class="form-control" name="password" id="email" type="password" required=""
                                        placeholder="Password" value="" required>

                                    @error('password')
                                        <div class="invalid-tooltip">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group mb-3 row">
                                <div class="col-12">
                                    <label for="validationCustom04" class="form-label">Confirm Password</label>
                                    <input class="form-control" name="password_confirmation"
                                        id="password_confirmation" type="password" required="" value=""
                                        placeholder="Confirm Password" required>
                                    @error('password_confirmation')
                                        <div class="invalid-tooltip">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group mb-3 row">
                                <div class="col-12">
                                    <div class="custom-control custom-checkbox">
                                        <!-- Term & Conditions -->
                                        <!-- <input type="checkbox" class="custom-control-input" id="customCheck1">
                                        <label class="form-label ms-1 fw-normal" for="customCheck1">I accept <a href="#" class="text-muted">Terms and Conditions</a></label> -->
                                    </div>
                                </div>
                            </div>

                            <div class="form-group text-center row mt-3 pt-1">
                                <div class="col-12">
                                    <button class="btn btn-dark w-100 waves-effect waves-light"
                                        type="submit">Register</button>
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
