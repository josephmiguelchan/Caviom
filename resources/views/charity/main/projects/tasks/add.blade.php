<!-- Modal for Add Family -->
<div class="modal fade" id="addTaskModal" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="addTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTaskModalLabel">Add New Task</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('charity.projects.tasks.store',$project->code)}}" method="POST">
                    @csrf

                    <!-- Task -->
                    <div class="form-group mb-3 row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="title" class="form-label">*Task:</label>
                                <textarea class="form-control" name="title" id="title" rows="4" maxlength="100"
                                    placeholder="Max. of 100 Characters only..." required>{{ old('title') }}</textarea>
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
                                <textarea class="form-control" name="note" id="note" rows="4" maxlength="280"
                                    placeholder="Max. of 280 Characters only...">{{ old('note') }}</textarea>
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
                                <select class="form-select" name="assigned_to" id="assigned_to" required>
                                    <option disabled selected hidden>Select User</option>
                                    @foreach ($users as $item)
                                    <option value="{{$item->id}}" {{ old('assigned_to') == $item->id ? 'selected' : '' }}>
                                        {{$item->info->first_name .' '. $item->info->last_name}}
                                        {{$item->id == Auth::id() ? '(You)' : ''}}
                                    </option>
                                    @endforeach
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
                                <input class="form-control" name="deadline" id="deadline" type="datetime-local"
                                    min="{{ Carbon\Carbon::now()->startOfDay() }}" value="{{ old('deadline') }}">
                                @error('deadline')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light btn-rounded w-md waves-effect" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success btn-rounded w-md waves-effect waves-light">Add</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
