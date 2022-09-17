@extends('auth_master')
@section('title', 'Login')
@section('auth')

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6">
            <div class="card" style="height: 80vh">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">

                            <div class="p-5">
                                <h1 style="color: #62896d"><strong>WELCOME</strong></h1>

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
        <div class="col-sm-6 text-center">
            <h1 style="color: #92713e" class="my-5"><strong>Admin's Portal</strong></h1>
            <img src="{{ asset('backend/assets/images/auth/admin.svg') }}" style="height: 30vh" class="mb-5">
            <br>
            <a href="{{ route('login') }}" class="btn btn-sm btn-secondary w-xl waves-effect waves-light">Go Back</a>
        </div>
    </div>
    <!-- end card -->
</div>

@endsection