<h4 class="my-3 mt-5" style="color: #62896d">Other Information</h4>

    <!-- Education Form Group -->
    <div class="form-group mb-3 row">
        <!-- Educational Attainment -->
        <div class="col-md-6">
            <div class="form-group">
                <label for="educational_attainment" class="form-label">Educational Attainment</label>
                <select class="form-control" name="educational_attainment" id="educational_attainment" type="dropdown">
                    <option value="{{ old('educational_attainment') }}">{{ old('educational_attainment') }}</option>
                    <option value="n/a">n/a</option>
                    <option value="Out-of-school Youth/Adult">Out-of-school Youth/Adult</option>
                    <option value="Alternative Learning System (ALS)">Alternative Learning System (ALS)</option>
                    <option value="Preschool">Preschool</option>
                    <option value="Kinder">Kinder</option>
                    <option value="Primary Education - Grade 1">Primary Education - Grade 1</option>
                    <option value="Primary Education - Grade 2">Primary Education - Grade 2</option>
                    <option value="Primary Education - Grade 3">Primary Education - Grade 3</option>
                    <option value="Primary Education - Grade 4">Primary Education - Grade 4</option>
                    <option value="Primary Education - Grade 5">Primary Education - Grade 5</option>
                    <option value="Primary Education - Grade 6">Primary Education - Grade 6</option>
                    <option value="Lower Secondary Education (JHS) - Grade 7">Lower Secondary Education (JHS) - Grade 7</option>
                    <option value="Lower Secondary Education (JHS) - Grade 8">Lower Secondary Education (JHS) - Grade 8</option>
                    <option value="Lower Secondary Education (JHS) - Grade 9">Lower Secondary Education (JHS) - Grade 9</option>
                    <option value="Lower Secondary Education (JHS) - Grade 10">Lower Secondary Education (JHS) - Grade 10</option>
                    <option value="Upper Secondary Education (SHS) - Grade 11">Upper Secondary Education (SHS) - Grade 11</option>
                    <option value="Upper Secondary Education (SHS) - Grade 12">Upper Secondary Education (SHS) - Grade 12</option>
                    <option value="Undergraduate (Bachelor’s Degree)">Undergraduate (Bachelor’s Degree)</option>
                    <option value="Postgraduate (Master’s Degree)">Postgraduate (Master’s Degree)</option>
                    <option value="Doctoral (PhD)">Doctoral (PhD)</option>
                </select>
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
                <input class="form-control" name="last_school_year_attended" id="last_school_year_attended" type=""
                       value="{{ old('last_school_year_attended') }}">
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
                <span data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-original-title="yes" title="Ex. +63 998 123 4567">
                    <i class="mdi mdi-information-outline"></i>
                </span>
                <input class="form-control input-mask" name="contact_no" id="contact_no" type="tel"
                    placeholder="Ex. +63 998 123 4567" value="{{ old('contact_no') }}" data-inputmask="'mask': '+63 \\999 999 9999'">
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
                <label for="interviewed_at" class="form-label">Date and time of Interview</label>
                <input class="form-control" name="interviewed_at" id="interviewed_at" type="datetime-local"
                    value="{{ old('interviewed_at') }}">
                @error('interviewed_at')
                    <div class="text-danger"><small>
                        {{ $message }}
                    </small></div>
                @enderror
            </div>
        </div>
    </div><!-- End Contact and Interview Datetime Form Group -->
<!--End Education, Contact, and Interview -->
