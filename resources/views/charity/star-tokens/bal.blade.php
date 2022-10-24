@extends('charity.charity_master')
@section('title', 'View Star Tokens Balance')
@section('charity')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="p-2">
                    <h1 class="mb-0" style="color: #62896d"><strong>STAR TOKENS</strong></h1>
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('star.tokens.balance') }}">Star Tokens</a>
                        </li>
                        <li class="breadcrumb-item active">View Balance</li>
                    </ol>

                    @include('charity.modals.star-tokens')
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row my-5">
                            <div class="col-6 text-center">
                                <h1 class="display-1"><strong><i class="ri-coin-line"></i> {{ Auth::user()->charity->star_tokens }}</strong></h1>
                                <h1 class="display-6">Star Tokens Available</h1>
                            </div>
                            <div class="col-6">
                                <h2 class="mt-5">
                                    <a href="{{ route('star.tokens.history') }}" class="btn btn-outline-dark waves-effect waves-light"><i class="mdi mdi-open-in-new"></i>View ({{ $orders->count() }}) Pending Order</a>
                                </h2>
                                <h2 class="mt-4" style="color: #62896d">{{ $subscription }}</h2>

                                <p>{{ Auth::user()->charity->featured_project_credits }} Featured Project Credits</p>
                                <p>{{ $numberOfProjectCollaborations }} / 5 Project Collaborations</p>
                                <p>{{ $numberOfGiftGivings }} Gift Givings</p>
                                <h4 class="mt-1">
                                    <p>Subscription will end on: {{(Auth::user()->charity->subscription_expires_at)?Carbon\Carbon::parse(Auth::user()->charity->subscription_expires_at)->isoFormat('LL'):'---' }}</p>
                                </h4>

                            </div>
                        </div>
                        <div class="row px-5 pb-5">
                            <a href="{{ route('star.tokens.order') }}" class="btn btn-rounded btn-dark waves-effect waves-light" style="background-color: #62896d">Click here to Order</a>
                        </div>
                    </div><!-- end cardbody -->
                </div><!-- end card -->
            </div><!-- end col -->
        </div>
        <!-- end row -->
    </div>
</div>
@endsection
