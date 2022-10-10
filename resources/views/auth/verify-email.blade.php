@extends('auth_master')
@section('title', 'Verify your Email Address')
@section('auth')

<div class="container-fluid p-0" style="max-width: 490px">
    <div class="card">
        <div class="card-body">


            <div class="p-3">
                <form method="POST" action="{{ route('verification.send') }}" class="form-horizontal">
                    @csrf

                    <h1 style="color: #62896d" class="text-center mt-3"><strong>EMAIL VERIFICATION</strong></h1>

                    @if (Auth::user()->status == 'Pending Unlock' and Auth::user()->role != 'Root Admin')
                    <div class="alert alert-primary alert-dismissible fade show mt-3" role="alert">
                        <strong><i class="mdi mdi-alert-circle-outline me-2"></i> Confirm Your Email Address</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <hr />
                        <span>
                            You have been invited to join <strong>{{ Auth::user()->charity->name }}</strong>. Kindly confirm your email address by
                            clicking on Send Verification Link button.
                        </span>
                    </div>
                    @endif

                    <p class="p-3">
                        Before getting started, please verify your email address by clicking on the link sent to your email.
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
                            <input type="submit" class="btn btn-dark btn-rounded w-50 waves-effect list-inline-item float-start"
                                value="{{Auth::user()->status=='Pending Unlock'?'Send':'Resend'}} Verification Link"></li>
                        <li>
                            <a class="btn btn-link list-inline-item float-end" href="{{ url('/logout') }}"><i class="mdi mdi-logout"></i> Logout</a>
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
