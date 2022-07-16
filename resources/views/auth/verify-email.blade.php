@extends('auth_master')
@section('title', 'Verify your email address')
@section('auth')

<div class="container-fluid p-0" style="max-width: 490px">
    <div class="card">
        <div class="card-body">


            <div class="p-3">
                <form method="POST" action="{{ route('verification.send') }}" class="form-horizontal">
                    @csrf

                    <h1 style="color: #62896d" class="text-center mt-3"><strong>EMAIL VERIFICATION</strong></h1>
                    <p class="py-3">
                        Before getting started, a verification link has been sent to your registered email address.
                        Please verify your email address by clicking on the link we just emailed to you.
                    </p>

                    <div class="@unless($errors->any() || Session::has('status'))mt-5 @endunless">
                        @if ($errors->any())
                            <!-- Send Verification Link Failed message -->
                            <div class="text-danger text-center mb-3">
                                {{$errors->first()}}
                            </div>
                        @endif
                        @if(Session::has('status'))
                            <div class="text-info text-center mb-3">
                                {{ Session::get('status') }}
                            </div>
                        @endif
                    </div>

                    <hr />
                    <ul class="list-inline mt-3">
                        <li>
                            <input type="submit" class="btn btn-dark waves-effect list-inline-item float-start" value="Resend Verification Link"></li>
                        <li>
                            <a class="btn btn-link list-inline-item float-end" href="{{ route('user.logout') }}">Logout</a>
                        </li>
                    </ul>
                </form>
            </div>
        </div>
        <!-- end cardbody -->
    </div>
    <!-- end card -->
</div>

@endsection
