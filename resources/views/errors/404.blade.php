@extends('auth_master')
@section('title', 'Not Found')
@section('auth')

<div class="my-5 pt-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body p-5">
                        <div class="ex-page-content text-center">
                            <h1>404!</h1>
                            <h5>Sorry, the page you are looking for is not found.</h5>

                            <a class="btn btn-info mb-5 waves-effect waves-light mt-4"
                                href="{{ url('/') }}" style="background-color: #62896d">
                                Back to Home
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection