<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Caviom — @yield('title') | Charity Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('backend/assets/images/Caviom Logo.png') }}">
    <!-- Bootstrap Css -->
    <link href="{{ asset('backend/assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('backend/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Toastr Css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/libs/toastr/build/toastr.min.css') }}">
    <!-- Select Css-->
    <link href="{{ asset('backend/assets/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css">
    <!-- App Css-->
    <link href="{{ asset('backend/assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />


</head>

<body style="background-color: #f7f3ea">
    {{-- <div class="bg-overlay"></div> --}}

    <!-- Loader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner">
                <i class="ri-loader-line spin-icon"></i>
            </div>
        </div>
    </div>

    <!-- Header -->
    <header id="page-topbar" style="background-color: #62896d;">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO -->
                <div class="navbar-brand-box">
                    <a href="{{ url('/') }}" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="{{ asset('backend/assets/images/Caviom.png') }}" alt="logo-sm" height="52">
                        </span>
                        <span class="logo-lg">
                            <img src="{{ asset('backend/assets/images/Caviom.png') }}" alt="logo-dark" height="50">
                        </span>
                    </a>

                    <a href="{{ url('/') }}" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="{{ asset('backend/assets/images/Caviom Logo.png') }}" alt="logo-sm-light" height="20">
                        </span>
                        <span class="logo-lg">
                            <img src="{{ asset('backend/assets/images/Caviom.png') }}" alt="logo-light" height="50">
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </header>


    <!-- Main Content -->
    <div class="page-content" style="background-color: #f7f3ea">
        @yield('auth')


        <!-- Footer -->
        <footer class="footer" style="left: 0%">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        ©
                        <script>
                            document.write(new Date().getFullYear())
                        </script> Caviom. All rights reserved.
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-end d-none d-sm-block">
                            Crafted with <i class="mdi mdi-heart text-danger"></i> by Caviom
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->

    </div>
    <!-- end Main Content -->

    <!-- JAVASCRIPT -->
    <script src="{{ asset('backend/assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/node-waves/waves.min.js') }}"></script>

    <script src="{{ asset('backend/assets/js/app.js') }}"></script>

    <!-- toastr plugin -->
    <script src="{{ asset('backend/assets/libs/toastr/build/toastr.min.js') }}"></script>

    <!-- toastr init -->
    <script src="{{ asset('backend/assets/js/pages/toastr.init.js') }}"></script>

    <!-- form mask -->
    <script src="{{ asset('backend/assets/libs/inputmask/jquery.inputmask.min.js') }}"></script>

    <!-- form mask init -->
    <script src="{{ asset('backend/assets/js/pages/form-mask.init.js') }}"></script>

    <!-- Select form js -->
    <script src="{{ asset('backend/assets/libs/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/pages/form-advanced.init.js') }}"></script>

    <script>
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}"

            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": true,
                "progressBar": false,
                "positionClass": "toast-top-right",
                "preventDuplicates": true,
                "onclick": null,
                "showDuration": 500,
                "hideDuration": 1000,
                "timeOut": 5000,
                "extendedTimeOut": 1500,
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "slideDown",
                "hideMethod": "fadeOut"
            }

            switch (type) {
                case 'info':
                    toastr.info(" {{ Session::get('message') }} ");
                    break;

                case 'success':
                    toastr.success(" {{ Session::get('message') }} ");
                    break;

                case 'warning':
                    toastr.warning(" {{ Session::get('message') }} ");
                    break;

                case 'error':
                    toastr.error(" {{ Session::get('message') }} ");
                    break;
            }
        @endif
    </script>

</body>

</html>
