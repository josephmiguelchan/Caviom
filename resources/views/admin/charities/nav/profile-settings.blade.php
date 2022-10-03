<div class="row">
    <div class="col-lg-6 border-end px-4">

        <!-- Confirm Edit Modal -->
        <div id="confirmEditModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel"><i class="mdi mdi-alert-outline me-2"></i> Warning</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>
                            You are about to make changes to this Charitable Organization's public profile settings.
                            This action will notify users from this Charitable Organization. Continue?
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light waves-effect w-sm" data-bs-dismiss="modal">No</button>
                        <button type="submit" form="profile_settings_form" class="btn btn-dark waves-effect waves-light w-sm">Yes</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>

        <div class="card-body mt-3">
            <div class="row">
                <div class="col-lg-11">
                    <h2><strong>Profile Settings</strong></h2>
                    <p class="mb-2">Our Lady of Sorrows Foundation, Inc.</p>
                </div>
            </div>
        </div>
        <div class="card-body p-3">

            <form action="#" method="POST" id="profile_settings_form">
                @csrf

                <div class="form-group my-3 row">
                    <div class="col-md-6">
                        <label for="visibility_status" class="form-label">*Public Profile Visibility Status <i class="mdi mdi-eye"></i></label>
                        <select class="form-select" name="visibility_status" id="visibility_status" aria-label="Select status">
                            <option value="Hidden" selected>Hidden</option>
                            <option value="Visible">Visible</option>
                            <option value="Locked">Locked</option>
                        </select>
                        @error('visibility_status')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="verification_status" class="form-label">*Verification Status <i class="mdi mdi-check-decagram"></i></label>
                        <select class="form-select" name="verification_status" id="verification_status" aria-label="Select status">
                            <option selected hidden disabled>Pending</option>
                            <option value="Verified">Verified</option>
                            <option value="Declined">Declined</option>
                            <option value="Unverified">Unverified</option>
                        </select>
                        @error('verification_status')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group my-3">
                    <label for="remarks" class="form-label">*Remarks <i class="mdi mdi-exclamation-thick"></i></label>
                        <select class="form-select" name="remarks" id="remarks" aria-label="Select status">
                            <option selected>None</option>
                            <option value="1">Violated Community Guidelines</option>
                            <option value="2">[Re-Apply] Invalid Requirements</option>
                            <option value="3">[Re-Apply] Incomplete Requirements</option>
                            <option value="4">[Re-Apply] Expired Documents</option>
                        </select>
                        @error('remarks')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                </div>

                <button type="button" data-bs-target="#confirmEditModal" data-bs-toggle="modal" class="btn btn-dark w-lg waves-light waves-effect float-end">
                    <i class="mdi mdi-arrow-right-thick"></i> Save
                </button>

            </form>
        </div>
    </div>
    <div class="col-lg-6 text-center">
        <label class="my-3">Requirements Submitted <i class="mdi mdi-file-document"></i></label>
        <div class="row">
            <div class="col-sm-3">
                <a class="image-popup-vertical-fit" href="{{ asset('upload/test_files/dswd.jpg') }}" title="DSWD Certificate">
                    <img class="img-fluid rounded" alt="DSWD Certificate" src="{{ asset('upload/test_files/dswd.jpg') }}"  width="145">
                </a>
            </div>
            <div class="col-sm-3">
                <a class="image-popup-vertical-fit" href="{{ asset('upload/test_files/valid_id.jpg') }}" title="Valid ID">
                    <img class="img-fluid rounded" alt="Valid ID" src="{{ asset('upload/test_files/valid_id.jpg') }}"  width="145">
                </a>
            </div>
            <div class="col-sm-3">
                <a class="image-popup-vertical-fit" href="{{ asset('upload/test_files/sec.jpg') }}" title="SEC Registration">
                    <img class="img-fluid rounded" alt="SEC Registration" src="{{ asset('upload/test_files/sec.jpg') }}"  width="145">
                </a>
            </div>
            <div class="col-sm-3">
                <a class="image-popup-vertical-fit" href="{{ asset('upload/test_files/photo-id.jpg') }}" title="Photo Holding Valid ID">
                    <img class="img-fluid rounded" alt="Photo Holding Valid ID" src="{{ asset('upload/test_files/photo-id.jpg') }}"  width="145">
                </a>
            </div>
        </div>
        <p class="text-muted small mt-3">
            <strong>Note:</strong> No Photo will be shown here if the Charitable Organization have not applied for verification.
        </p>

        <div class="row">
            <dl class="row mb-0 col-lg-6 my-5">
                <dt class="col-md-6"><h4 class="font-size-15 fw-bold float-end">Date Added:</h4></dt>
                <dt class="col-md-6">Mar 20, 2022</dt>
            </dl>
            <dl class="row mb-0 col-lg-6 mt-5">
                <dt class="col-md-6"><h4 class="font-size-15 fw-bold float-end">Last Modified:</h4></dt>
                <dt class="col-md-6">6 days ago</dt>
            </dl>
        </div>
    </div>
</div>