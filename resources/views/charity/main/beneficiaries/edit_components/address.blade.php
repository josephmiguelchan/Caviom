<!-- Permanent Address -->
<h4 class="my-3 mt-5" style="color: #62896d">Permanent Address</h4>

<div class="form-group mb-3 row">
    <!-- Address Line 1 -->
    <div class="col-md-6">
        <div class="form-group">
            <label for="permanent_address_line_one" class="form-label">*Address Line 1</label>
            <input class="form-control" name="permanent_address_line_one" id="permanent_address_line_one" type="text" required
                value="{{ old('permanent_address_line_one', $permanentAddressEdit->address_line_one) }}">
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
                value="{{ old('permanent_address_line_two', $permanentAddressEdit->address_line_two) }}">
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
{{--            <select class="form-control" id="permanent_region" value="{{ old('permanent_region', $permanentAddressEdit->region) }}"></select>--}}
            <input class="form-control" name="permanent_region" id="permanent_region" type="text" required
                   value="{{ old('permanent_region', $permanentAddressEdit->region) }}">
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
            {{--            <select class="form-control" id="permanent_province" value="{{ old('permanent_province', $permanentAddressEdit->province) }}"></select>--}}
            <input class="form-control" name="permanent_province" id="permanent_province" type="text" required
                   value="{{ old('permanent_province', $permanentAddressEdit->province) }}">
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
{{--            <select class="form-control" id="permanent_city" value="{{ old('permanent_city') }}"></select>--}}
            <input class="form-control" name="permanent_city" id="permanent_city" type="text"
                   value="{{ old('permanent_city', $permanentAddressEdit->city) }}">
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
            {{--            <select class="form-control" id="permanent_barangay" value="{{ old('permanent_barangay') }}"></select>--}}
            <input class="form-control" name="permanent_barangay" id="permanent_barangay" type="text"
                   value="{{ old('permanent_barangay', $permanentAddressEdit->barangay) }}">
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
                   value="{{ old('permanent_postal_code', $permanentAddressEdit->postal_code) }}" placeholder="Must be 4 digits" required>
            @error('permanent_postal_code')
            <div class="text-danger">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>

</div>

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
                   value="{{ old('present_address_line_one', $presentAddressEdit->address_line_one) }}" required>
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
                   value="{{ old('present_address_line_two', $presentAddressEdit->address_line_two) }}">
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
            {{--            <select class="form-control" id="present_region" value="{{ old('present_region') }}"></select>--}}
            <input class="form-control" name="present_region" id="present_region" type="text" required
                   value="{{ old('present_region', $presentAddressEdit->region) }}">
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
{{--            <select class="form-control" id="present_province" value="{{ old('present_province') }}"></select>--}}
            <input class="form-control" name="present_province" id="present_province" type="text" required
                   value="{{ old('present_province', $presentAddressEdit->province) }}">
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
            {{--            <select class="form-control" id="present_city" value="{{ old('present_city') }}"></select>--}}
            <input class="form-control" name="present_city" id="present_city" type="text"
                   value="{{ old('present_city', $presentAddressEdit->city) }}">
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
{{--            <select class="form-control" id="present_barangay" value="{{ old('present_barangay') }}"></select>--}}
            <input class="form-control" name="present_barangay" id="present_barangay" type="text"
                   value="{{ old('present_barangay', $presentAddressEdit->barangay) }}">
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
            <input class="form-control" name="present_postal_code" id="present_postal_code" type="number" required
                   value="{{ old('present_postal_code', $presentAddressEdit->postal_code) }}" placeholder="Must be 4 digits">
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
                   value="{{ old('provincial_address_line_one', $provincialAddressEdit->address_line_one) }}" required>
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
                   value="{{ old('provincial_address_line_two', $provincialAddressEdit->address_line_two) }}">
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
            {{--            <select class="form-control" id="provincial_region" value="{{ old('provincial_region') }}"></select>--}}
            <input class="form-control" name="provincial_region" id="provincial_region" type="text"
                   value="{{ old('provincial_region', $provincialAddressEdit->region) }}" required>
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
{{--            <select class="form-control" id="provincial_province" value="{{ old('provincial_province') }}"></select>--}}
            <input class="form-control" name="provincial_province" id="provincial_province" type="text" required
                   value="{{ old('provincial_province', $provincialAddressEdit->province) }}">
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
            {{--            <select class="form-control" id="provincial_city" value="{{ old('provincial_city') }}"></select>--}}
            <input class="form-control" name="provincial_city" id="provincial_city" type="text"
                   value="{{ old('provincial_city', $provincialAddressEdit->city) }}">
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
{{--            <select class="form-control" id="provincial_barangay" value="{{ old('provincial_barangay') }}"></select>--}}
            <input class="form-control" name="provincial_barangay" id="provincial_barangay" type="text"
                   value="{{ old('provincial_barangay', $provincialAddressEdit->barangay) }}">
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
            <input class="form-control" name="provincial_postal_code" id="provincial_postal_code" type="number" required
                   value="{{ old('provincial_postal_code', $provincialAddressEdit->postal_code) }}" placeholder="Must be 4 digits">
            @error('provincial_postal_code')
            <div class="text-danger">
                {{ $message }}
            </div>
            @enderror
        </div>
    </div>

</div>
<!-- End Provincial Address -->

<!-- Address Dropdown -->
@push('scripts')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.js"></script>
    <script type="text/javascript" src="https://f001.backblazeb2.com/file/buonzz-assets/jquery.ph-locations.js"></script>

    <script type="text/javascript">
        function EnableDisableTextBox(use_permanent_address){
            var present_address_line_one = document.getElementById("present_address_line_one");
            var present_address_line_two = document.getElementById("present_address_line_two");
            var present_region = document.getElementById("present_region");
            var present_province = document.getElementById("present_province");
            var present_city = document.getElementById("present_city");
            var present_barangay = document.getElementById("present_barangay");
            var present_postal_code = document.getElementById("present_postal_code");

            present_address_line_one.disabled = use_permanent_address.checked ? true : false;
            present_address_line_two.disabled = use_permanent_address.checked ? true : false;
            present_region.disabled = use_permanent_address.checked ? true : false;
            present_province.disabled = use_permanent_address.checked ? true : false;
            present_city.disabled = use_permanent_address.checked ? true : false;
            present_barangay.disabled = use_permanent_address.checked ? true : false;
            present_postal_code.disabled = use_permanent_address.checked ? true : false;
        }
        function EnableDisableTextBox2(no_provincial_address){
            var provincial_address_line_one = document.getElementById("provincial_address_line_one");
            var provincial_address_line_two = document.getElementById("provincial_address_line_two");
            var provincial_region = document.getElementById("provincial_region");
            var provincial_province = document.getElementById("provincial_province");
            var provincial_city = document.getElementById("provincial_city");
            var provincial_barangay = document.getElementById("provincial_barangay");
            var provincial_postal_code = document.getElementById("provincial_postal_code");

            provincial_address_line_one.disabled = no_provincial_address.checked ? true : false;
            provincial_address_line_two.disabled = no_provincial_address.checked ? true : false;
            provincial_region.disabled = no_provincial_address.checked ? true : false;
            provincial_province.disabled = no_provincial_address.checked ? true : false;
            provincial_city.disabled = no_provincial_address.checked ? true : false;
            provincial_barangay.disabled = no_provincial_address.checked ? true : false;
            provincial_postal_code.disabled = no_provincial_address.checked ? true : false;
        }
        //
        // var permanent_address_handlers = {
        //     fill_provinces:  function(){
        //         var selected_permanent_region = $("#permanent_region option:selected").text();
        //         $('input[name=permanent_region]').val(selected_permanent_region);
        //
        //         var region_code = $(this).val();
        //         $('#permanent_province').ph_locations('fetch_list', [{"region_code": region_code}]);
        //     },
        //
        //     fill_cities: function(){
        //         var selected_permanent_province = $("#permanent_province option:selected").text();
        //         $('input[name=permanent_province]').val(selected_permanent_province);
        //
        //         var province_code = $(this).val();
        //         $('#permanent_city').ph_locations( 'fetch_list', [{"province_code": province_code}]);
        //     },
        //
        //     fill_barangays: function(){
        //         var selected_permanent_city = $("#permanent_city option:selected").text();
        //         $('input[name=permanent_city]').val(selected_permanent_city);
        //
        //         var city_code = $(this).val();
        //         $('#permanent_barangay').ph_locations('fetch_list', [{"city_code": city_code}]);
        //     },
        //
        //     get_barangay: function(){
        //         var selected_permanent_barangay = $("#permanent_barangay option:selected").text();
        //         $('input[name=permanent_barangay]').val(selected_permanent_barangay);
        //     }
        // };
        // var present_address_handlers = {
        //     fill_provinces:  function(){
        //         var selected_present_region = $("#present_region option:selected").text();
        //         $('input[name=present_region]').val(selected_present_region);
        //         var region_code = $(this).val();
        //         $('#present_province').ph_locations('fetch_list', [{"region_code": region_code}]);
        //     },
        //
        //     fill_cities: function(){
        //         var selected_present_province = $("#present_province option:selected").text();
        //         $('input[name=present_province]').val(selected_present_province);
        //         var province_code = $(this).val();
        //         $('#present_city').ph_locations( 'fetch_list', [{"province_code": province_code}]);
        //     },
        //
        //     fill_barangays: function(){
        //         var selected_present_barangay = $("#present_city option:selected").text();
        //         $('input[name=present_city]').val(selected_present_barangay);
        //         var city_code = $(this).val();
        //         $('#present_barangay').ph_locations('fetch_list', [{"city_code": city_code}]);
        //     },
        //
        //     get_barangay: function(){
        //         var selected_caption = $("#present_barangay option:selected").text();
        //         $('input[name=present_barangay]').val(selected_caption);
        //     }
        // };
        // var provincial_address_handlers = {
        //     fill_provinces:  function(){
        //         var selected_provincial_region = $("#provincial_region option:selected").text();
        //         $('input[name=provincial_region]').val(selected_provincial_region);
        //         var region_code = $(this).val();
        //         $('#provincial_province').ph_locations('fetch_list', [{"region_code": region_code}]);
        //     },
        //
        //     fill_cities: function(){
        //         var selected_provincial_province = $("#provincial_province option:selected").text();
        //         $('input[name=provincial_province]').val(selected_provincial_province);
        //         var province_code = $(this).val();
        //         $('#provincial_city').ph_locations( 'fetch_list', [{"province_code": province_code}]);
        //     },
        //
        //     fill_barangays: function(){
        //         var selected_provincial_barangay = $("#provincial_city option:selected").text();
        //         $('input[name=provincial_city]').val(selected_provincial_barangay);
        //         var city_code = $(this).val();
        //         $('#provincial_barangay').ph_locations('fetch_list', [{"city_code": city_code}]);
        //     },
        //
        //     get_barangay: function(){
        //         var selected_caption = $("#provincial_barangay option:selected").text();
        //         $('input[name=provincial_barangay]').val(selected_caption);
        //     }
        // };
        //
        // $(function(){
        //     //Permanent Address
        //     $('#permanent_region').on('change', permanent_address_handlers.fill_provinces);
        //     $('#permanent_province').on('change', permanent_address_handlers.fill_cities);
        //     $('#permanent_city').on('change', permanent_address_handlers.fill_barangays);
        //     $('#permanent_barangay').on('change',permanent_address_handlers.get_barangay);
        //
        //     $('#permanent_region').ph_locations({'location_type': 'regions'});
        //     $('#permanent_province').ph_locations({'location_type': 'provinces'});
        //     $('#permanent_city').ph_locations({'location_type': 'cities'});
        //     $('#permanent_barangay').ph_locations({'location_type': 'barangays'});
        //
        //     $('#permanent_region').ph_locations('fetch_list');
        //
        //     //Present Address
        //     $('#present_region').on('change', present_address_handlers.fill_provinces);
        //     $('#present_province').on('change', present_address_handlers.fill_cities);
        //     $('#present_city').on('change', present_address_handlers.fill_barangays);
        //     $('#present_barangay').on('change',present_address_handlers.get_barangay);
        //
        //     $('#present_region').ph_locations({'location_type': 'regions'});
        //     $('#present_province').ph_locations({'location_type': 'provinces'});
        //     $('#present_city').ph_locations({'location_type': 'cities'});
        //     $('#present_barangay').ph_locations({'location_type': 'barangays'});
        //
        //     $('#present_region').ph_locations('fetch_list');
        //
        //     //Provincial Address
        //     $('#provincial_region').on('change', provincial_address_handlers.fill_provinces);
        //     $('#provincial_province').on('change', provincial_address_handlers.fill_cities);
        //     $('#provincial_city').on('change', provincial_address_handlers.fill_barangays);
        //     $('#provincial_barangay').on('change',provincial_address_handlers.get_barangay);
        //
        //     $('#provincial_region').ph_locations({'location_type': 'regions'});
        //     $('#provincial_province').ph_locations({'location_type': 'provinces'});
        //     $('#provincial_city').ph_locations({'location_type': 'cities'});
        //     $('#provincial_barangay').ph_locations({'location_type': 'barangays'});
        //
        //     $('#provincial_region').ph_locations('fetch_list');
        // });
    </script>
@endpush
