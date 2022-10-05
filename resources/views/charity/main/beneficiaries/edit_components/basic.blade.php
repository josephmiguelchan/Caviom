<h4 class="my-3 mt-5" style="color: #62896d">Personal Information</h4>

<div class="form-group mb-3 row">
    <!-- Nick Name -->
    <div class="col-md-6">
        <div class="form-group">
            <label for="nick_name" class="form-label">*Nickname</label>
            <input type="text" class="form-control" name="nick_name" id="nick_name" value="{{ old('nick_name', $beneficiaryEdit->nick_name) }}" required>
            @error('nick_name')
                <div class="text-danger"><small>
                    <small>{{ $message }}</small>
                </small></div>
            @enderror
        </div>
    </div>

    <!-- Profile Picture -->
    <div class="col-md-6">
        <div class="form-group">
            <label for="profile_photo" class="form-label">
                Profile Photo (Optional)
                <span data-bs-toggle="tooltip" data-bs-placement="bottom" title="Recommended image resolution of 512x512. Must not
                    exceed 2mb." data-bs-original-title="yes">
                    <i class="mdi mdi-information-outline"></i>
                </span>
            </label>
            <input class="form-control" name="profile_photo" id="profile_photo" type="file" value="{{ old('profile_photo') }}">
            @error('profile_photo')
                <div class="text-danger"><small>
                    {{ $message }}
                </small></div>
            @enderror
        </div>
    </div>
</div>

<!-- Full Name Form Group -->
<div class="form-group mb-3 row">
    <!-- First Name -->
    <div class="col-md-4">
        <div class="form-group">
            <label for="first_name" class="form-label">*First Name</label>
            <input type="text" class="form-control" name="first_name" id="first_name" value="{{ old('first_name', $beneficiaryEdit->first_name) }}" required>
            @error('first_name')
                <div class="text-danger"><small>
                    {{ $message }}
                </small></div>
            @enderror
        </div>
    </div>

    <!-- Middle Name -->
    <div class="col-md-4">
        <div class="form-group">
            <label for="middle_name" class="form-label">Middle Name</label>
            <input type="text" class="form-control" name="middle_name" id="middle_name" value="{{ old('middle_name', $beneficiaryEdit->middle_name) }}">
            @error('middle_name')
                <div class="text-danger"><small>
                    {{ $message }}
                </small></div>
            @enderror
        </div>
    </div>

    <!-- Last Name -->
    <div class="col-md-4">
        <div class="form-group">
            <label for="last_name" class="form-label">*Last Name</label>
            <input type="text" class="form-control" name="last_name" id="last_name" value="{{ old('last_name', $beneficiaryEdit->last_name) }}" required>
            @error('last_name')
                <div class="text-danger"><small>
                    {{ $message }}
                </small></div>
            @enderror
        </div>
    </div>
</div><!-- End Full Name Form Group -->


<!-- Birth and Religion Form Group -->
<div class="form-group mb-3 row">
    <!-- Birth date -->
    <div class="col-md-4">
        <div class="form-group">
            <label for="birth_date" class="form-label">*Date of Birth</label>
            <input type="date" class="form-control" name="birth_date" id="birth_date" value="{{ old('birth_date', $beneficiaryEdit->birth_date) }}" min="1910-12-30" required>
            @error('birth_date')
                <div class="text-danger"><small>
                    {{ $message }}
                </small></div>
            @enderror
        </div>
    </div>

    <!-- Birth place -->
    <div class="col-md-4">
        <div class="form-group">
            <label for="birth_place" class="form-label">Place of Birth</label>
            <input type="text" class="form-control" name="birth_place" id="birth_place" value="{{ old('birth_place', $beneficiaryEdit->birth_place) }}">
            @error('birth_place')
                <div class="text-danger"><small>
                    {{ $message }}
                </small></div>
            @enderror
        </div>
    </div>

    <!-- Religion -->
    <div class="col-md-4">
        <div class="form-group">
            <label for="religion" class="form-label">Religion</label>
            <input type="text" class="form-control" name="religion" id="religion" value="{{ old('religion', $beneficiaryEdit->religion) }}">
            @error('religion')
                <div class="text-danger"><small>
                    {{ $message }}
                </small></div>
            @enderror
        </div>
    </div>
</div><!-- End Birth and Religion Form Group -->
