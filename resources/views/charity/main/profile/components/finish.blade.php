<form method="POST" action="" enctype="multipart/form-data">
    @csrf
    <div class="row justify-content-center mb-5">
        <div class="col-lg-6">
            <div class="text-center">
                <div class="mb-4">
                    <i class="ri-check-line text-dark display-4"></i>
                </div>
                <div>
                    <h5>Confirm Details</h5>
                    <!-- Term & Conditions -->
                    <div class="col-12 text-center px-3">
                        <div class="form-check mb-0">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="is_agreed" class="form-check-input" id="is_agreed" required>
                                <label class="form-label ms-1 fw-normal" for="is_agreed">
                                    I have carefully completed and reviewed that my Organization's Public Profile is in accordance with Caviom's Terms of Services and Privacy Policy.
                                    I consent to allow my Charitable Organization’s profile be viewable to the public.
                                </label>
                                @error('is_agreed')
                                    <div class="text-danger">
                                        <small>
                                            {{ $message }}
                                        </small>
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="px-3 col-4">
            <ul class="list-inline mb-0 mt-4">
                <button type="submit" class="btn btn-dark btn-rounded w-100 waves-effect waves-light"
                    style="background-color: #62896d;"><i class="mdi mdi-pencil"></i> Publish
                </button>
            </ul>
        </div>
    </div>

</form>