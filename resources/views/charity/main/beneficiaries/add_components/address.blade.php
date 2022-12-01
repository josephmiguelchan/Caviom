<!-- Permanent Address -->
<h4 class="my-3 mt-5" style="color: #62896d">Permanent Address</h4>

<div class="form-group mb-3 row">
    <!-- Address Line 1 -->
    <div class="col-md-6">
        <div class="form-group">
            <label for="permanent_address_line_one" class="form-label">*Address Line 1</label>
            <input class="form-control" name="permanent_address_line_one" id="permanent_address_line_one" type="text"
                value="{{ old('permanent_address_line_one') }}">
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
                value="{{ old('permanent_address_line_two') }}">
            @error('permanent_address_line_two')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

</div>

<div class="form-group mb-3 row">

    <!-- Region -->
    <div class="col-md-6">
        <div class="form-group">
            <label for="permanent_region" class="form-label">*Region</label>
            <input type="hidden" name="permanent_region"/>
            <select class="form-control select2" id="permanent_region" value="{{ old('permanent_region') }}">
                <option value="" disabled selected>Select Region</option>
            </select>
            @error('permanent_region')
            <div class="text-danger">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>

    <!-- Province -->
    <div class="col-md-6">
        <div class="form-group">
            <label for="permanent_province" class="form-label">*Province</label>
            <input type="hidden" name="permanent_province"/>
            <select class="form-control select2" id="permanent_province">
                <option value="" disabled selected>Select Province</option>
            </select>
            @error('permanent_province')
            <div class="text-danger">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>

</div>

<div class="form-group mb-3 row">

    <!-- City -->
    <div class="col-md-5">
        <div class="form-group">
            <label for="permanent_city" class="form-label">City</label>
            <input type="hidden" name="permanent_city"/>
            <select class="form-control select2" id="permanent_city">
                <option value="" disabled selected>Select City</option>
            </select>
            @error('permanent_city')
            <div class="text-danger">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>

    <!-- Barangay -->
    <div class="col-md-5">
        <div class="form-group">
            <label for="permanent_barangay" class="form-label">Barangay</label>
            <input type="hidden" name="permanent_barangay"/>
            <select class="form-control select2" id="permanent_barangay">
                <option value="" disabled selected>Select Barangay</option>
            </select>
            @error('permanent_barangay')
                <div class="text-danger">
                    {{ $message }}
                </div>
            @enderror
            </div>
    </div>

    <!-- Postal Code -->
    <div class="col-md-2">
        <div class="form-group">
            <label for="permanent_postal_code" class="form-label">*Postal Code</label>
            <input class="form-control" name="permanent_postal_code" id="permanent_postal_code" type="number"
                value="{{ old('permanent_postal_code') }}" placeholder="Must be 4 digits" min="0" max="9999">
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
    <input type="checkbox" name="use_permanent_address" class="form-check-input" id="use_permanent_address" onclick="EnableDisableTextBox(this)"
           value="{{ old('use_permanent_address') }}">
    <label class="form-check-label" for="use_permanent_address">Same as permanent address</label>
</div>

<div class="form-group mb-3 row">
    <!-- Address Line 1 -->
    <div class="col-md-6">
        <div class="form-group">
            <label for="present_address_line_one" class="form-label">*Address Line 1</label>
            <input class="form-control" name="present_address_line_one" id="present_address_line_one" type="text"
                   value="{{ old('present_address_line_one') }}">
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
                   value="{{ old('present_address_line_two') }}">
            @error('present_address_line_two')
            <div class="text-danger">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>

</div>

<div class="form-group mb-3 row">
    <!-- Region -->
    <div class="col-md-6">
        <div class="form-group">
            <label for="present_region" class="form-label">*Region</label>
            <input type="hidden" name="present_region"/>
            <select class="form-control select2" id="present_region">
                <option value="" disabled selected>Select Region</option>
            </select>
            @error('present_region')
            <div class="text-danger">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>

    <!-- Province -->
    <div class="col-md-6">
        <div class="form-group">
            <label for="present_province" class="form-label">*Province</label>
            <input type="hidden" name="present_province"/>
            <select class="form-control select2" id="present_province">
                <option value="" disabled selected>Select Province</option>
            </select>
            @error('present_province')
            <div class="text-danger">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>

</div>

<div class="form-group mb-3 row">

    <!-- City -->
    <div class="col-md-5">
        <div class="form-group">
            <label for="present_city" class="form-label">City</label>
            <input type="hidden" name="present_city"/>
            <select class="form-control select2" id="present_city">
                <option value="" disabled selected>Select City</option>
            </select>
            @error('present_city')
            <div class="text-danger">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>

    <!-- Barangay -->
    <div class="col-md-5">
        <div class="form-group">
            <label for="present_barangay" class="form-label">Barangay</label>
            <input type="hidden" name="present_barangay"/>
            <select class="form-control select2" id="present_barangay">
                <option value="" disabled selected>Select Barangay</option>
            </select>
            @error('present_barangay')
            <div class="text-danger">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>

    <!-- Postal Code -->
    <div class="col-md-2">
        <div class="form-group">
            <label for="present_postal_code" class="form-label">*Postal Code</label>
            <input class="form-control" name="present_postal_code" id="present_postal_code" type="number"
                value="{{ old('present_postal_code') }}" placeholder="Must be 4 digits" min="0" max="9999">
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
    <input type="checkbox" name="no_provincial_address" class="form-check-input" id="no_provincial_address" onclick="EnableDisableTextBox2(this)"
           value="{{ old('no_provincial_address') }}">
    <label class="form-check-label" for="no_provincial_address">No Provincial Address</label>
</div>

<div class="form-group mb-3 row">
    <!-- Address Line 1 -->
    <div class="col-md-6">
        <div class="form-group">
            <label for="provincial_address_line_one" class="form-label">*Address Line 1</label>
            <input class="form-control" name="provincial_address_line_one" id="provincial_address_line_one" type="text"
                   value="{{ old('provincial_address_line_one') }}">
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
                   value="{{ old('provincial_address_line_two') }}">
            @error('provincial_address_line_two')
            <div class="text-danger">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>


</div>

<div class="form-group mb-3 row">
    <!-- Region -->
    <div class="col-md-6">
        <div class="form-group">
            <label for="provincial_region" class="form-label">*Region</label>
            <input type="hidden" name="provincial_region"/>
            <select class="form-control select2" id="provincial_region">
                <option value="" disabled selected>Select Region</option>
            </select>
            @error('provincial_region')
            <div class="text-danger">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>

    <!-- Province -->
    <div class="col-md-6">
        <div class="form-group">
            <label for="provincial_province" class="form-label">*Province</label>
            <input type="hidden" name="provincial_province"/>
            <select class="form-control select2" id="provincial_province">
                <option value="" disabled selected>Select Province</option>
            </select>
            @error('provincial_province')
            <div class="text-danger">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>

</div>

<div class="form-group mb-3 row">
    <!-- City -->
    <div class="col-md-5">
        <div class="form-group">
            <label for="provincial_city" class="form-label">City</label>
            <input type="hidden" name="provincial_city"/>
            <select class="form-control select2" id="provincial_city">
                <option value="" disabled selected>Select City</option>
            </select>
            @error('provincial_city')
            <div class="text-danger">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>

    <!-- Barangay -->
    <div class="col-md-5">
        <div class="form-group">
            <label for="provincial_barangay" class="form-label">Barangay</label>
            <input type="hidden" name="provincial_barangay"/>
            <select class="form-control select2" id="provincial_barangay">
                <option value="" disabled selected>Select Barangay</option>
            </select>
            @error('provincial_barangay')
            <div class="text-danger">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>

    <!-- Postal Code -->
    <div class="col-md-2">
        <div class="form-group">
            <label for="provincial_postal_code" class="form-label">*Postal Code</label>
            <input class="form-control input-mask" name="provincial_postal_code" id="provincial_postal_code" type="number"
                value="{{ old('provincial_postal_code') }}" placeholder="Must be 4 digits" min="0" max="9999">
            @error('provincial_postal_code')
            <div class="text-danger">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>

</div>
<!-- End Provincial Address -->

@push('scripts')
<script src="{{ asset('backend/assets/js/pages/beneficiary-places-api.js')}}"></script>
@endpush
