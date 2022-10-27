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
                        <div class="row no-gutters align-items-center my-4">
                            <div class="col-6 text-center">
                                <h1 class="display-1 fw-bold"><i class="mdi mdi-star-circle-outline"></i> {{ number_format(Auth::user()->charity->star_tokens, 0) }}</h1>
                                <h3>Star Tokens Balance</h1>
                            </div>
                            <div class="col-6">
                                <div class="card-body">
                                    <!-- If subscribed to Caviom pro, add check decagram icon beside this text -->
                                    <h4 class="fw-bold mt-2">{{ Str::upper(Auth::user()->charity->subscription) }}
                                        {!!
                                            (Auth::user()->charity->subscription == 'Caviom Pro' or Auth::user()->charity->subscription == 'Caviom Premium') ?
                                            '<i class="mdi mdi-check-decagram mdi-24px" style="color: #62896d"></i>' : ''
                                        !!}
                                    </h4>
                                    <div class="card-text">
                                        <ul>
                                            <li>{{ Auth::user()->charity->featured_project_credits }} Featured Project Credits</li>
                                            <li>{{ $numberOfProjectCollaborations }} Project Collaborations</li>
                                            <li>{{ $numberOfGiftGivings }} Gift Givings</li>
                                            @if (Auth::user()->charity->subscription_expires_at)
                                            <li>
                                                Subscription ends on {{Carbon\Carbon::parse(Auth::user()->charity->subscription_expires_at)->isoFormat('LL')}}
                                            </li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row px-5 pb-5">
                            <div class="col-6">
                                @if ($orders->count() != 0)
                                <button type="button" disabled class="btn w-100 btn-dark waves-effect waves-light" style="background-color: #62896d">
                                    <i class="mdi mdi-cart-outline"></i> Pending Order Received
                                </button>
                                @else
                                <a href="{{ route('star.tokens.order') }}" class="btn w-100 btn-dark waves-effect waves-light"
                                    style="background-color: #62896d"> <i class="mdi mdi-cart-outline"></i> Click here to Order
                                </a>
                                @endif
                            </div>
                            <div class="col-6">
                                <a href="{{ route('star.tokens.history') }}" class="btn w-100 btn-outline-dark waves-effect waves-light">
                                    <i class="mdi mdi-open-in-new"></i> View Orders
                                </a>
                            </div>
                        </div>
                    </div><!-- end cardbody -->
                </div><!-- end card -->
            </div><!-- end col -->
        </div>
        <!-- end row -->
    </div>
</div>
@endsection
