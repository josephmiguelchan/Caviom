<button type="button" data-bs-target=".bs-example-modal-center" title="Learn more" class="btn btn-link waves-effect p-0 mb-3" data-bs-toggle="modal">
    <small>
        <i class="mdi mdi-information"></i> Learn more about Users
    </small>
</button>

<!-- Learn more about Users -->
<div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">What are Charity Users?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>
                    Users is a feature added to Caviom to manage the user accounts that have access to the records
                    of the charitable organization.
                </p>
                <p>
                    <strong>Charity Admin:</strong>
                    <ul>
                        <li>Have all the access to the features</li>
                    </ul>
                    <strong>Charity Associates:</strong>
                    <ul>
                        <li>Can access records except from:</li>
                        <ul>
                            <li>Managing Public Profile</li>
                            <li>Creating Featured Projects</li>
                            <li>Editing, Deleting, and Adding a Project</li>
                            <li>Unlocking and Deleting Pending Users</li>
                            <li>Creating and Feature Gift Giving Projects</li>
                            <li>Accessing Charity Audit Logs</li>
                            <li>Star Tokens</li>
                        </ul>
                    </ul>
                </p>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<!-- Modal for Create Account Confirmation -->
<div class="modal fade" id="bs-register-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel"><i class="mdi mdi-alert-outline me-2"></i> Warning</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>
                    Email address can no longer be edited once submitted. Kindly review user account details carefully.
                    Are you sure you want to register this user to your Charitable Organization?
                    <strong>This action will notify and deduct your Charitable Organization's Star Tokens.</strong>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light waves-effect w-sm" data-bs-dismiss="modal">No</button>
                <button type="submit" form="add_form" class="btn btn-dark waves-effect waves-light w-sm">Yes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!-- Export to Excel Modal -->
<div id="exportModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel"><i class="mdi mdi-alert-outline me-2"></i> Warning</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>You are about to attempt to backup all your users. This action
                    will notify all other users in your Charitable Organization. Continue?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light waves-effect w-sm" data-bs-dismiss="modal">No</button>
                <a href="{{ route('charity.users.export') }}" type="button" class="btn btn-dark waves-effect waves-light w-sm">Yes</a>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>