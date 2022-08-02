<!-- Permanent Address -->
<h4 class="my-3 mt-5" style="color: #62896d">Permanent Address</h4>

<div class="form-group mb-3 row">
    <!-- Address Line 1 -->
    <div class="col-md-6">
        <div class="form-group">
            <label for="permanent_address_line_one" class="form-label">*Address Line 1</label>
            <input class="form-control" name="permanent_address_line_one" id="permanent_address_line_one" type="text" required
                value="">
            @error('permanent_address_line_one')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    <!-- Address Line 2 -->
    <div class="col-md-6">
        <div class="form-group">
            <label for="permanent_address_line_two" class="form-label">Address Line 2 (Optional)</label>
            <input class="form-control" name="permanent_address_line_two" id="permanent_address_line_two" type="text"
                value="">
            @error('permanent_address_line_two')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
</div>

<div class="form-group mb-3 row">
    <!-- Province -->
    <div class="col-md-6">
        <div class="form-group">
            <label for="permanent_province" class="form-label">*Province</label>
            <input class="form-control" name="permanent_province" id="permanent_province" type="text" required
                value="">
            @error('permanent_province')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    <!-- City -->
    <div class="col-md-6">
        <div class="form-group">
            <label for="permanent_city" class="form-label">*City / Municipality</label>
            <input class="form-control" name="permanent_city" id="permanent_city" type="text" required
                value="">
            @error('permanent_city')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
</div>

<div class="form-group mb-3 row">
    <!-- Barangay -->
    <div class="col-md-6">
        <div class="form-group">
            <label for="permanent_barangay" class="form-label">*Barangay</label>
            <input class="form-control" name="permanent_barangay" id="permanent_barangay" type="text" required
                value="">
            @error('permanent_barangay')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror
            </div>
    </div>

    <!-- Postal Code -->
    <div class="col-md-6">
        <div class="form-group">
            <label for="permanent_postal_code" class="form-label">*Postal Code</label>
            <input class="form-control" name="permanent_postal_code" id="permanent_postal_code" type="text" required
                value="">
            @error('permanent_postal_code')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
</div>
<!-- End Permanent Address -->



<!-- Present Address -->
<h4 class="mt-5" style="color: #62896d">Present Address</h4>

<!-- Dev note: Might delete this checkbox below -->
<div class="form-check form-switch mb-4" dir="ltr">
    <input type="checkbox" name="use_present_address" class="form-check-input" id="use_present_address" checked>
    <label class="form-check-label" for="use_present_address">Same as permanent address</label>
</div>

<div class="form-group mb-3 row">
    <!-- Address Line 1 -->
    <div class="col-md-6">
        <div class="form-group">
            <label for="present_address_line_one" class="form-label">*Address Line 1</label>
            <input class="form-control" name="present_address_line_one" id="present_address_line_one" type="text" required
                value="" disabled>
            @error('present_address_line_one')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    <!-- Address Line 2 -->
    <div class="col-md-6">
        <div class="form-group">
            <label for="present_address_line_two" class="form-label">Address Line 2 (Optional)</label>
            <input class="form-control" name="present_address_line_two" id="present_address_line_two" type="text"
                value="" disabled>
            @error('present_address_line_two')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
</div>

<div class="form-group mb-3 row">
    <!-- Province -->
    <div class="col-md-6">
        <div class="form-group">
            <label for="present_province" class="form-label">*Province</label>
            <input class="form-control" name="present_province" id="present_province" type="text" required
                value="" disabled>
            @error('present_province')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    <!-- City -->
    <div class="col-md-6">
        <div class="form-group">
            <label for="present_city" class="form-label">*City / Municipality</label>
            <input class="form-control" name="present_city" id="present_city" type="text" required
                value="" disabled>
            @error('present_city')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
</div>

<div class="form-group mb-3 row">
    <!-- Barangay -->
    <div class="col-md-6">
        <div class="form-group">
            <label for="present_barangay" class="form-label">*Barangay</label>
            <input class="form-control" name="present_barangay" id="present_barangay" type="text" required
                value="" disabled>
            @error('present_barangay')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror
            </div>
    </div>

    <!-- Postal Code -->
    <div class="col-md-6">
        <div class="form-group">
            <label for="present_postal_code" class="form-label">*Postal Code</label>
            <input class="form-control" name="present_postal_code" id="present_postal_code" type="text" required
                value="" disabled>
            @error('present_postal_code')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
</div>
<!-- End Present Address -->


<!-- Provincial Address -->
<h4 class="mt-5" style="color: #62896d">Provincial Address (Optional)</h4>

<!-- Dev note: Might delete this checkbox below -->
<div class="form-check form-switch mb-4" dir="ltr">
    <input type="checkbox" name="no_provincial_address" class="form-check-input" id="no_provincial_address" checked>
    <label class="form-check-label" for="no_provincial_address">No Provincial Address</label>
</div>

<div class="form-group mb-3 row">
    <!-- Address Line 1 -->
    <div class="col-md-6">
        <div class="form-group">
            <label for="provincial_address_line_one" class="form-label">*Address Line 1</label>
            <input class="form-control" name="provincial_address_line_one" id="provincial_address_line_one" type="text" required
                value="" disabled>
            @error('provincial_address_line_one')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    <!-- Address Line 2 -->
    <div class="col-md-6">
        <div class="form-group">
            <label for="provincial_address_line_two" class="form-label">Address Line 2 (Optional)</label>
            <input class="form-control" name="provincial_address_line_two" id="provincial_address_line_two" type="text"
                value="" disabled>
            @error('provincial_address_line_two')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
</div>

<div class="form-group mb-3 row">
    <!-- Province -->
    <div class="col-md-6">
        <div class="form-group">
            <label for="provincial_province" class="form-label">*Province</label>
            <input class="form-control" name="provincial_province" id="provincial_province" type="text" required
                value="" disabled>
            @error('provincial_province')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    <!-- City -->
    <div class="col-md-6">
        <div class="form-group">
            <label for="provincial_city" class="form-label">*City / Municipality</label>
            <input class="form-control" name="provincial_city" id="provincial_city" type="text" required
                value="" disabled>
            @error('provincial_city')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
</div>

<div class="form-group mb-3 row">
    <!-- Barangay -->
    <div class="col-md-6">
        <div class="form-group">
            <label for="provincial_barangay" class="form-label">*Barangay</label>
            <input class="form-control" name="provincial_barangay" id="provincial_barangay" type="text" required
                value="" disabled>
            @error('provincial_barangay')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror
            </div>
    </div>

    <!-- Postal Code -->
    <div class="col-md-6">
        <div class="form-group">
            <label for="provincial_postal_code" class="form-label">*Postal Code</label>
            <input class="form-control" name="provincial_postal_code" id="provincial_postal_code" type="text" required
                value="" disabled>
            @error('provincial_postal_code')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
</div>
<!-- End Provincial Address -->