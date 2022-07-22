<form method="POST" action="" enctype="multipart/form-data">
    @csrf
    <div id="accordion" class="custom-accordion">
        <div class="card mb-1 shadow-none">
            <a href="#collapseSeven" class="text-dark" data-bs-toggle="collapse"
                            aria-expanded="true"
                            aria-controls="collapseSeven">
                <div class="card-header" id="headingOne">
                    <h6 class="m-0">
                        Donation Modes
                        <i class="mdi mdi-minus float-end accor-plus-icon"></i>
                    </h6>
                </div>
            </a>

            <div id="collapseSeven" class="collapse show"
                    aria-labelledby="headingOne" data-bs-parent="#accordion">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label class="form-label" for="mode">*Mode of Donation</label>
                                <input type="text" class="form-control" id="mode" name="mode" placeholder="Enter mode of donation" required
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
                                <input type="text" class="form-control" id="account_name" name="account_name" placeholder="Enter account name" required
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
                                <input type="text" class="form-control" id="account_no" name="account_no" placeholder="Enter account no." required
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
                                    Max of 5 mode of donations only. Donation modes will only be displayed publicly once your organization
                                    has been verified.
                                </em>
                            </span>
                            <button type="button" class="btn btn-light btn-rounded waves-effect waves-light w-xl float-end mt-2">
                                <i class="mdi mdi-plus"></i> Add more
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row px-3">
        <ul class="list-inline mb-0 mt-4 text-center">
            <input type="submit" class="btn btn-dark btn-rounded w-xl waves-effect waves-light w-100"
                style="background-color: #62896d;" value="Save Donation Modes">
        </ul>
    </div>

    <p class="text-muted text-center font-size-12 mt-2">
        <em>
            Please click on <strong>Save</strong> first before proceeding to the next.
        </em>
    </p>
</form>