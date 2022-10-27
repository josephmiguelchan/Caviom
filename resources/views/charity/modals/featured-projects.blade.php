<button type="button" data-bs-target=".bs-example-modal-center" title="Learn more" class="btn btn-link waves-effect p-0 mb-3" data-bs-toggle="modal">
    <small>
        <i class="mdi mdi-information"></i> Learn more about Featured Projects
    </small>
</button>

<div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">What are Featured Projects?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>
                    Featured Projects is a feature added to Caviom platform to keep the public profile updated
                    based on the recent projects conducted by the Charitable Organization. Here are some benefits
                    of having an updated public profile:
                </p>
                <ul>
                    <li>
                        Public donors or sponsors are kept posted and informed about how their donations are
                        being used.
                    </li>
                    <li>
                        The charitable organization that updates their public profile by posting featured projects
                        inspires and gives ideas to other charitable organization of what project they may
                        conduct next.
                    </li>
                </ul>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Modal for Add button Confirmation -->
<div class="modal fade" id="bs-add-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel"><i class="mdi mdi-alert-outline me-2"></i> Warning</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>
                    You can no longer edit this Featured Project once submitted for approval review. This action will notify
                    and deduct your Charitable Organization <strong>450 Star Tokens / 1 Free Credit</strong>. Continue?
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light waves-effect w-sm" data-bs-dismiss="modal">No</button>
                <button type="submit" form="add_form" class="btn btn-dark waves-effect waves-light w-sm">Yes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->