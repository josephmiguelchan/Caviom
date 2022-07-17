@extends('auth_master')
@section('title', 'Reset Password')
@section('auth')

<div class="container-fluid p-0" style="max-width: 490px">
    <div class="card">
        <div class="card-body">


            <div class="p-3">
                <form method="post" action="{{ route('password.update') }}">
                    @csrf

                    <h1 style="color: #62896d" class="mt-3"><strong>PASSWORD RESET</strong></h1>

                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <!-- Email Address -->
                    <div class="mb-4">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email"
                            value="{{ old('email', $request->email) }}" readonly>
                        @error('confirm_password')
                            <div class="text-danger">
                                <i class="mdi mdi-alert-outline me-2"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-4">
                        <label for="password" class="form-label">
                            New Password
                            <span data-bs-toggle="tooltip" data-bs-placement="right"
                                title="Password must be 8-20 characters with a letter and a number."
                                data-bs-original-title="yes">
                                <i class="mdi mdi-information-outline"></i>
                            </span>
                        </label>
                        <input type="password" class="form-control" name="password" id="password"
                            placeholder="New Password">
                        @error('password')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" name="password_confirmation"
                            id="password_confirmation" placeholder="Confirm Password">
                        @error('password_confirmation')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="@unless($errors->has('email') || Session::has('status'))mt-5 @endunless">
                        @error ('email')
                            <!-- Send Verification Link Failed message -->
                            <div class="text-danger text-center my-3">
                                {{$message}}
                            </div>
                        @enderror
                        @if(Session::has('status'))
                            <div class="text-info text-center my-3">
                                {{ Session::get('status') }}
                            </div>
                        @endif
                    </div>

                    <input type="submit" class="btn btn-dark btn-rounded w-100 waves-effect list-inline-item"
                        value="Save Password">
                </form>
            </div>
        </div>
        <!-- end cardbody -->
    </div>
    <!-- end card -->
</div>

@endsection
