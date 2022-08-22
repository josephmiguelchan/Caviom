<h4 class="my-3 mt-5" style="color: #62896d">Other Information</h4>

    <!-- Education Form Group -->
    <div class="form-group mb-3 row">
        <!-- Educational Attainment -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="educational_attainment" class="form-label">*Educational Attainment</label>
                <input class="form-control" name="educational_attainment" id="educational_attainment" type="text" required
                    value="">
                @error('educational_attainment')
                    <div class="text-danger"><small>
                        {{ $message }}
                    </small></div>
                @enderror
            </div>
        </div>

        <!-- Last school year attended -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="last_school_year_attended" class="form-label">Last School Year Attended</label>
                <input class="form-control" name="last_school_year_attended" id="last_school_year_attended" type="text"
                    value="">
                @error('last_school_year_attended')
                    <div class="text-danger"><small>
                        {{ $message }}
                    </small></div>
                @enderror
            </div>
        </div>
    </div><!-- End Education Form Group -->

    <!-- Contact and Interview Datetime Form Group -->
    <div class="form-group mb-3 row">
        <!-- Contact No -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="contact_no" class="form-label">Contact No.</label>
                <input class="form-control" name="contact_no" id="contact_no" type="text" required
                    value="">
                @error('contact_no')
                    <div class="text-danger"><small>
                        {{ $message }}
                    </small></div>
                @enderror
            </div>
        </div>

        <!-- Date and time of Interview -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="interviewed_at" class="form-label">*Date and time of Interview</label>
                <input class="form-control" name="interviewed_at" id="interviewed_at" type="datetime-local"
                    value="">
                @error('interviewed_at')
                    <div class="text-danger"><small>
                        {{ $message }}
                    </small></div>
                @enderror
            </div>
        </div>
    </div><!-- End Contact and Interview Datetime Form Group -->
<!--End Education, Contact, and Interview -->