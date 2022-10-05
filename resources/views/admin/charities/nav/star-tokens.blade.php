<div class="card-body mt-3">
    <div class="row">
        <div class="col-lg-11">
            <h2><strong>Star Tokens</strong></h2>
            <p class="mb-2">{{$organizationdetail->name}}</p>
        </div>
    </div>
</div>
<div class="card-body">
    <div class="row">
        <div class="card col-lg-4">
            <div class="card-body">
                <div class="text-center">
                    <h2 class="display-2 fw-bold">{{$organizationdetail->star_tokens}}</h2>
                    <p class="card-text">Available Star Tokens</p>
                </div>
                <hr>
                <div class="row col-12">
                    <dt class="col-md-6 text-end"><h4 class="font-size-15 fw-bold" style="color: #62896d">Subscription:</h4></dt>
                    <dt class="col-md-6">{{$organizationdetail->subscription}}</dt>
                </div>
                <div class="row col-12">
                    <dt class="col-md-6 text-end"><h4 class="font-size-15 fw-bold" style="color: #62896d">Ends on:</h4></dt>

                    @switch($organizationdetail->subscription)
                        @case('Free')                            
                            <dt class="col-md-6">---</dt>
                            @break

                        @case('Caviom Pro')
                            <dt class="col-md-6">{{$organizationdetail->subscribed_at->addMonth()->isoFormat('MMMM D, YYYY')}}</dt>
                            @break

                        @case('Caviom Premium')
                            <dt class="col-md-6">{{$organizationdetail->subscribed_at->addYear()->isoFormat('MMMM D, YYYY')}}</dt>
                            @break

                        @default
                            <span>Something went wrong, please try again</span>
                    @endswitch
                </div>
                <div class="row col-12">
                    <dt class="col-md-6 text-end"><h4 class="font-size-15 fw-bold" style="color: #62896d">Featured Projects Left:</h4></dt>
                    <dt class="col-md-6">{{$organizationdetail->featured_project_credits}}</dt>
                </div>
            </div>
        </div>
        <div class="card col-lg-4 p-5 {{($organizationdetail->subscription == 'Caviom Pro')?'border border-success':'bg-light'}}"> <!-- If subscribed to Caviom pro, add 'border border-success' to this card -->
            <div class="row no-gutters align-items-center">
                <div class="col-md-4">
                    <img class="card-img img-fluid" src="{{ asset('backend/assets/images/star-tokens/pro.svg') }}" alt="Caviom Pro">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <!-- If subscribed to Caviom pro, add check decagram icon beside this text -->
                        <h4 class="fw-bold">CAVIOM PRO {!!($organizationdetail->subscription == 'Caviom Pro')?'<i class="mdi mdi-check-decagram mdi-24px" style="color: #62896d"></i>':''!!}</h4>
                        <div class="card-text">
                            <ul>
                                <li>1 Month</li>
                                <li>5 Featured Project Credits</li>
                                <li>Unli Projects</li>
                                <li>Unli Gift Givings</li>
                            </ul>
                            <h4 class="card-title">Php 249.00</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card col-lg-4 p-5 {{($organizationdetail->subscription == 'Caviom Premium')?'border border-success':'bg-light'}}"> <!-- If NOT subscribed to Caviom Premium, add 'bg-light' to this div -->
            <div class="row no-gutters text-muted align-items-center">
                <div class="col-md-4">
                    <img class="card-img img-fluid" src="{{ asset('backend/assets/images/star-tokens/premium.svg') }}" alt="Caviom Premium">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <!-- If subscribed to Caviom Premium, add check decagram icon beside this text -->
                        <h4 class="fw-bold">CAVIOM PREMIUM {!!($organizationdetail->subscription == 'Caviom Premium')?'<i class="mdi mdi-check-decagram mdi-24px" style="color: #62896d"></i>':''!!}</h4>
                        <div class="card-text">
                            <ul>
                                <li>12 Months</li>
                                <li>50 Featured Project Credits</li>
                                <li>Unli Projects</li>
                                <li>Unli Gift Givings</li>
                            </ul>
                            <h4 class="card-title">Php 2399.00</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>         
    </div>
</div>