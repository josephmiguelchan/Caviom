<!-- Family Information -->
<h4 class="mt-5" style="color: #62896d">Family Economic Information</h4>
<div class="table-responsive">
    <table class="table table-bordered table-hover mb-0">
        <thead class="table-light">
            <tr>
                <th scope="1">ID</th>
                <th>Name</th>
                <th>Date of Birth</th>
                <th>Relationship</th>
                <th>Civil Status</th>
                <th>Education</th>
                <th>Occupation</th>
                <th>Income</th>
                <th>Whereabouts</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td>Clarice Olarte</td>
                <td>January 27, 1990</td>
                <td>Mother</td>
                <td>Widowed</td>
                <td>Elementary Graduate</td>
                <td>Vendor</td>
                <td>P300 / day</td>
                <td>---</td>
                <td>
                    <button type="button" class="btn btn-sm btn-dark btn-rounded waves-effect waves-light"
                        data-bs-toggle="modal" data-bs-target="#editFamilyModal">
                        <i class="ri-edit-line"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-danger btn-rounded waves-effect waves-light"
                        data-bs-toggle="modal" data-bs-target="#deleteFamilyModal">
                        <i class="ri-delete-bin-line"></i>
                    </button>
                </td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>Victoria Sanches</td>
                <td>September 13, 1965</td>
                <td>Grandmother</td>
                <td>Widowed</td>
                <td>Illiterate</td>
                <td>None</td>
                <td>0</td>
                <td>---</td>
                <td>
                    <button type="button" class="btn btn-sm btn-dark btn-rounded waves-effect waves-light">
                        <i class="ri-edit-line"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-danger btn-rounded waves-effect waves-light">
                        <i class="ri-delete-bin-line"></i>
                    </button>
                </td>
            </tr>
        </tbody>
    </table>


    <button type="button" class="my-2 btn w-xl btn-success waves-effect waves-light float-end" data-bs-toggle="modal" data-bs-target="#addFamilyModal">
        <i class="ri-user-add-line"></i> Add New
    </button>

    <!-- Modal for Add Family -->
    <div class="modal fade" id="addFamilyModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="addFamilyModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addFamilyModalLabel">Add Family Member</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        @csrf
                        <!-- Full Name Form Group -->
                        <div class="form-group mb-3 row">
                            <!-- First Name -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="first_name" class="form-label">*First Name</label>
                                    <input type="text" class="form-control" name="first_name" id="first_name" required>
                                    @error('first_name')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Middle Name -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="middle_name" class="form-label">Middle Name</label>
                                    <input type="text" class="form-control" name="middle_name" id="middle_name">
                                    @error('middle_name')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Last Name -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="last_name" class="form-label">*Last Name</label>
                                    <input type="text" class="form-control" name="last_name" id="last_name" required>
                                    @error('last_name')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div><!-- End Full Name Form Group -->

                        <div class="form-group mb-3 row">
                            <!-- Date of Birth -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="birth_date" class="form-label">Date of Birth</label>
                                    <input class="form-control" name="birth_date" id="birth_date" type="date">
                                    @error('birth_date')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Relationship -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="relationship" class="form-label">*Relationship</label>
                                    <input class="form-control" name="relationship" id="relationship" type="text">
                                    @error('relationship')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3 row">
                            <!-- Civil Status -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="civil_status" class="form-label">Civil Status</label>
                                    <input class="form-control" name="civil_status" id="civil_status" type="text">
                                    @error('civil_status')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Education -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="education" class="form-label">Education</label>
                                    <input class="form-control" name="education" id="education" type="text">
                                    @error('education')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3 row">
                            <!-- Occupation -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="occupation" class="form-label">Occupation</label>
                                    <input class="form-control" name="occupation" id="occupation" type="text">
                                    @error('occupation')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Income -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="income" class="form-label">Income</label>
                                    <input class="form-control" name="income" id="income" type="text">
                                    @error('income')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Whereabouts -->
                        <div class="row form-group mb-3">
                            <div class="col-md-12">
                                <label for="where_abouts" class="form-label">Whereabouts</label>
                                <input type="text" class="form-control" name="where_abouts" id="where_abouts">
                                @error('where_abouts')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light btn-rounded w-md waves-effect" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-dark btn-rounded w-md waves-effect waves-light">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Edit Family -->
    <div class="modal fade" id="editFamilyModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="editFamilyModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editFamilyModalLabel">Edit Family Member #1</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        @csrf
                        <!-- Full Name Form Group -->
                        <div class="form-group mb-3 row">
                            <!-- First Name -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="first_name" class="form-label">*First Name</label>
                                    <input type="text" class="form-control" name="first_name" id="first_name"
                                        value="Clarice" required>
                                    @error('first_name')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Middle Name -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="middle_name" class="form-label">Middle Name</label>
                                    <input type="text" class="form-control" name="middle_name" id="middle_name"
                                        value="">
                                    @error('middle_name')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Last Name -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="last_name" class="form-label">*Last Name</label>
                                    <input type="text" class="form-control" name="last_name" id="last_name"
                                    value="Olarte" required>
                                    @error('last_name')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div><!-- End Full Name Form Group -->

                        <div class="form-group mb-3 row">
                            <!-- Date of Birth -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="birth_date" class="form-label">Date of Birth</label>
                                    <input class="form-control" name="birth_date" id="birth_date" type="date"
                                        value="1990-01-27">
                                    @error('birth_date')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Relationship -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="relationship" class="form-label">*Relationship</label>
                                    <input class="form-control" name="relationship" id="relationship" type="text"
                                        value="Mother">
                                    @error('relationship')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3 row">
                            <!-- Civil Status -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="civil_status" class="form-label">Civil Status</label>
                                    <input class="form-control" name="civil_status" id="civil_status" type="text"
                                        value="Widowed">
                                    @error('civil_status')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Education -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="education" class="form-label">Education</label>
                                    <input class="form-control" name="education" id="education" type="text"
                                        value="Elementary Graduate">
                                    @error('education')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3 row">
                            <!-- Occupation -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="occupation" class="form-label">Occupation</label>
                                    <input class="form-control" name="occupation" id="occupation" type="text"
                                        value="Vendor">
                                    @error('occupation')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Income -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="income" class="form-label">Income</label>
                                    <input class="form-control" name="income" id="income" type="text"
                                        value="P300 / day">
                                    @error('income')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Whereabouts -->
                        <div class="row form-group mb-3">
                            <div class="col-md-12">
                                <label for="where_abouts" class="form-label">Whereabouts</label>
                                <input type="text" class="form-control" name="where_abouts" id="where_abouts"
                                value="---">
                                @error('where_abouts')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light btn-rounded w-md waves-effect" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-dark btn-rounded w-md waves-effect waves-light">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete modal for Family member -->
    <div id="deleteFamilyModal" class="modal fade" tabindex="-1" aria-labelledby="deleteFamilyModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel"><i class="mdi mdi-alert-outline me-2"></i> Are you sure?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>You are about to delete the selected family member [<strong> Clarice Olarte </strong>] permanently. Continue?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light waves-effect w-sm" data-bs-dismiss="modal">No</button>
                    <button type="button" class="btn btn-danger waves-effect waves-light w-sm">Yes</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

</div><!-- End Family Information -->