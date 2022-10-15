<form method="POST" action="{{route('charity.profile.store_donations')}}" enctype="multipart/form-data">
    @csrf
    <div id="accordion" class="custom-accordion">
        <div class="card mb-1 shadow-none">
            <a href="#collapseSeven" class="text-dark" data-bs-toggle="collapse"
                            aria-expanded="true"
                            aria-controls="collapseSeven">
                <div class="card-header" id="headingSeven">
                    <h6 class="m-0">
                        Donation Modes <small>(Click to Expand)</small>
                        <i class="mdi mdi-minus float-end accor-plus-icon"></i>
                    </h6>
                </div>
            </a>

            <div id="collapseSeven" class="collapse show"
                    aria-labelledby="headingSeven" data-bs-parent="#accordion">
                <div class="card-body">
                    <div class="table-responsive mb-4">
                        <table class="table table-bordered mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th scope="1">No.</th>
                                    <th>Mode of Donation</th>
                                    <th>Account Name</th>
                                    <th>Account Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if ($donationModes->count() == 0)
                            <tr>
                                <td colspan="5" class="text-center text-black-50 fst-italic">
                                    <i class="mdi mdi-information-outline"></i> Your Charitable Organization currently has no mode of donations.
                                </td>
                            </tr>
                            @endif
                            @foreach($donationModes as $key => $donation)
                                <tr>
                                    <th scope="row">{{ $key+1 }}</th>
                                    <td>{{ $donation->mode }}</td>
                                    <td>{{ $donation->account_name }}</td>
                                    <td>{{ $donation->account_no }}</td>
                                    <td>
                                        <a href="{{route('charity.profile.destroy_donation_mode',$donation->id)}}" class="btn btn-rounded btn-sm btn-outline-danger waves-effect waves-light">
                                            <i class="mdi mdi-trash-can-outline"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label class="form-label" for="mode">*Mode of Donation</label>
                                <input type="text" class="form-control" id="mode" name="mode" placeholder="Enter mode of donation"
                                    value="{{ old('mode') }}" >
                                @error('mode')
                                    <div class="text-danger">
                                        <small>
                                            {{ $message }}
                                        </small>
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label class="form-label" for="account_name">*Account Name</label>
                                <input type="text" class="form-control" id="account_name" name="account_name" placeholder="Enter account name"
                                    value="{{ old('account_name') }}" >
                                @error('account_name')
                                    <div class="text-danger">
                                        <small>
                                            {{ $message }}
                                        </small>
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label class="form-label" for="account_no">*Account No.</label>
                                <input type="text" class="form-control" id="account_no" name="account_no" placeholder="Enter account no."
                                    value="{{ old('account_no') }}" >
                                @error('account_no')
                                    <div class="text-danger">
                                        <small>
                                            {{ $message }}
                                        </small>
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="float-end">
                            <span class="text-muted font-size-12 mt-2">
                                <em>
                                    Mininum of 1, maximum of 5 modes of donation only. Donation modes will only be displayed publicly once your organization
                                    has been verified.
                                </em>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row px-3">
        <ul class="list-inline mb-0 mt-4 text-center">
            <button type="submit" class="btn btn-dark btn-rounded w-xl waves-effect waves-light w-100" {{$donationModes->count()>=5 ? 'disabled':''}}
                style="background-color: #62896d;" value="Save Donation Modes"><i class="mdi mdi-plus"></i> Add Donation Mode
            </button>
        </ul>
    </div>

    <p class="text-muted text-center font-size-12 mt-2">
        <em>
            {!! $donationModes->count()>=5 ? 'Sorry, a max of 5 donation modes have already been reached.' : 'Please click on <strong>Add</strong> first before proceeding to the next.' !!}
        </em>
    </p>
</form>