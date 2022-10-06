<!--Category and Label -->
<div class="form-group mt-5 my-3 row">
    <!-- Category -->
    <div class="col-md-6">
        <div class="form-group">
            <label for="category" class="form-label">Category</label>
            <input class="form-control" name="category" id="category" type="text"
                   placeholder="You can leave this blank." value="{{ old('category', $beneficiary->category) }}">
            @error('category')
            <div class="text-danger"><small>
                    {{ $message }}
                </small></div>
            @enderror
        </div>
    </div>

    <!-- Label -->
    <div class="col-md-6">
        <div class="form-group">
            <label for="label" class="form-label">Label</label>
            <input class="form-control" name="label" id="label" type="text"
                   placeholder="You can leave this blank." value="{{ old('label', $beneficiary->label) }}">
            @error('label')
            <div class="text-danger"><small>
                    {{ $message }}
                </small></div>
            @enderror
        </div>
    </div>
</div>
<!--End Category and Label -->

<!--Prepared and Noted by -->
<div class="form-group my-3 row">
    <!-- Prepared by -->
    <div class="col-md-6">
        <div class="form-group">
            <label for="prepared_by" class="form-label">Prepared by</label>
            <input class="form-control" name="prepared_by" id="prepared_by" type="text" value="{{ old('prepared_by', $beneficiary->prepared_by) }}">
            @error('noted_by')
            <div class="text-danger"><small>
                    {{ $message }}
                </small></div>
            @enderror
        </div>
    </div>

    <!-- Noted by -->
    <div class="col-md-6">
        <div class="form-group">
            <label for="noted_by" class="form-label">Noted by</label>
            <input class="form-control" name="noted_by" id="noted_by" type="text" value="{{ old('noted_by', $beneficiary->noted_by) }}">
            @error('noted_by')
            <div class="text-danger"><small>
                    {{ $message }}
                </small></div>
            @enderror
        </div>
    </div>
</div>
<!--End Prepared and Noted by -->
