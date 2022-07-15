@extends('auth_master')
@section('title', 'Login')
@section('auth')

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6 text-center">
            <img src="{{ asset('backend/assets/images/auth/login-1.svg') }}" class="mt-5">
            <h6 class="mt-3">
                <ul class="list-inline text-center">
                    <li class="list-inline-item">Hope for the Better</li>
                    <li class="list-inline-item">|</li>
                    <li class="list-inline-item">Take action</li>
                    <li class="list-inline-item">|</li>
                    <li class="list-inline-item">Make a difference</li>
                </ul>
            </h6>
            <h1 style="color: #62896d"><strong>START WITH US!</strong></h1>
            <a style="background-color: #92713e; color: #ffffff;" href="{{ route('register') }}"
                class="btn w-50 waves-effect waves-light">REGISTER AS CHARITY ADMIN
            </a>
            <p class="my-4 px-5 lead">
                CAVIOM is a platform for Charitable Organizations to collaborate with their
                fellow volunteers or co-worker at the comfort of their own space.
            </p>
        </div>
        <div class="col-sm-6">
            <div class="card" style="height: 600px">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 p-5">

                            <div class="p-3">
                                <h1 style="color: #62896d"><strong>LOG IN</strong></h1>

                                <form method="POST" action="{{ route('login') }}" class="form-horizontal custom-validation mt-4">
                                    @csrf

                                    <div class="form-group mb-2 row">
                                        <div class="col-12">
                                            <label for="username" class="form-label">Username</label>
                                            <input class="form-control parsley-success" id="username" type="text" required
                                                name="username" placeholder="Enter your username">
                                        </div>
                                    </div>

                                    <div class="form-group mb-3 row">
                                        <div class="col-12">
                                            <label for="password" class="form-label">Password</label>
                                            <input class="form-control" id="password" type="password" required
                                                name="password" placeholder="Enter your password">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-12">
                                            <div class="custom-control custom-checkbox">
                                                <input name="remember" type="checkbox" class="custom-control-input"
                                                    id="remember_me">
                                                <label class="form-label ms-1" for="remember_me">Remember me</label>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Login failed message -->
                                    <div class="@unless($errors->has('username'))mt-5 @endunless">
                                        @if ($errors->has('username'))
                                            <div class="text-danger text-center my-2">
                                                    {{$errors->first()}}
                                            </div>
                                        @endif
                                    </div>

                                    <div class="form-group mb-3 text-center row mt-3 pt-1">
                                        <div class="col-12">
                                            <button class="btn btn-dark btn-rounded w-100 waves-effect waves-light" type="submit" style="background-color: #62896d">
                                                Log In
                                            </button>
                                        </div>
                                    </div>

                                    <div class="form-group mb-0 row">
                                        <ul class="list-inline">
                                            @if (Route::has('password.request'))
                                                <div class="text-center">
                                                    <a href="{{ route('password.request') }}" class="text-link">
                                                        Forgot Password?
                                                    </a>
                                                </div>
                                            @endif
                                            {{-- <div class="float-end list-inline-item">
                                                <a href="{{ route('register') }}" class="text-muted">
                                                    <i class="mdi mdi-account-circle"></i>
                                                    Register New Charity
                                                </a>
                                            </div> --}}
                                        </ul>
                                    </div>
                                </form>
                            </div>
                            <!-- end -->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end card -->
</div>

@endsection