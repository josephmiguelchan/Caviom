<!-- Modal for Add Family -->
<div class="modal fade" id="addTaskModal" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="addTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTaskModalLabel">Add New Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    @csrf

                    <!-- Task -->
                    <div class="form-group mb-3 row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="title" class="form-label">*Task:</label>
                                <textarea class="form-control" name="title" id="title" rows="4" maxlength="100"
                                    placeholder="Max. of 100 Characters only..." required></textarea>
                                @error('title')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Note -->
                    <div class="form-group mb-3 row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="note" class="form-label">Note (Optional):</label>
                                <textarea class="form-control" name="note" id="note" rows="4" maxlength="50"
                                    placeholder="Max. of 50 Characters only..."></textarea>
                                @error('note')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-3 row">
                        <!-- Assigned User -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="assigned_to" class="form-label">*Assigned To:</label>
                                <select class="form-select" aria-label="Default select example" name="assigned_to" id="assigned_to" required>
                                    <option disabled selected hidden>Select User</option>
                                    <option value="0">Mira Buenom</option>
                                    <option value="1">Suki Toka</option>
                                    <option value="2">Jans Pork</option>
                                </select>
                                @error('assigned_to')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <!-- Deadline -->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="deadline" class="form-label">*Deadline:</label>
                                <input class="form-control" name="deadline" id="deadline" type="datetime-local">
                                @error('deadline')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light btn-rounded w-md waves-effect" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success btn-rounded w-md waves-effect waves-light">Add</button>
            </div>
        </div>
    </div>
</div>