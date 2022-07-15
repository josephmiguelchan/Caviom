@extends('auth_master')
@section('title', 'Login')
@section('auth')

<div class="container-fluid p-0" style="max-width: 490px">
    <div class="card">
        <div class="card-body">

            <h1 style="color: #62896d" class="text-center py-3"><strong>PASSWORD RESET</strong></h1>

            <div class="p-3">
                <form method="POST" action="{{ route('password.email') }}" class="form-horizontal">
                    @csrf

                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                        <strong><i class="mdi mdi-alert-circle-outline me-2"></i> Forgot your password?</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <hr />
                        <span>Enter your registered email address and the password reset link will be sent there.</span>
                    </div>

                    <div class="form-group mb-3">
                        <div class="col-xs-12">
                            <label for="email" class="form-label">Registered Email Address</label>
                            <input class="form-control" type="email" required="" id="email" name="email"
                                value="{{ old('email') }}" placeholder="Enter email address" autofocus>
                        </div>
                    </div>

                    <div class="form-group pb-2 text-center row mt-3">
                        <div class="col-12">
                            <button class="btn btn-dark w-100 waves-effect waves-light" type="submit">
                                Send Password Reset Link
                            </button>
                        </div>
                    </div>

                    <div class="@unless($errors->has('email') || Session::has('status'))mt-5 @endunless">
                        @if ($errors->any())
                            <!-- Password Reset Link Failed message -->
                            <div class="text-danger text-center mb-4">
                                {{$errors->first()}}
                            </div>
                        @endif
                        @if(Session::has('status'))
                            <div class="text-info text-center mb-4">
                                {{ Session::get('status') }}
                            </div>
                        @endif
                    </div>
                </form>
            </div>
        </div>
        <!-- end cardbody -->
    </div>
    <!-- end card -->
    <div class="row">
        <div class="col-md-12 mb-5">
            <a href="{{route('login')}}" class="text-link float-end">
                <i class="ri-arrow-left-line"></i> Go Back
            </a>
        </div>
    </div>
</div>

@endsection