<!-- Problem -->
<h4 class="my-3 mt-5" style="color: #62896d"><strong>III. Problem Presented</strong></h4>
<textarea class="form-control" rows="5" id="problem_presented" name="problem_presented">{{ old('problem_presented', $bi->problem_presented) }}</textarea>
@error('problem_presented')
    <div class="text-danger"><small>
        {{ $message }}
    </small></div>
@enderror
<!--End Problem-->

<h4 class="my-3 mt-4" style="color: #62896d"><strong>IV. Background Information</strong></h4>

<h6>A. About the Client</h6>
<textarea class="form-control" rows="5" id="about_client" name="about_client">{{ old('about_client', $bi->about_client) }}</textarea>
@error('about_client')
    <div class="text-danger"><small>
        {{ $message }}
    </small></div>
@enderror

<h6 class="mt-3">B. About the Family</h6>
<textarea class="form-control" rows="5" id="about_family" name="about_family">{{ old('about_family', $bi->about_family) }}</textarea>
@error('about_family')
    <div class="text-danger"><small>
        {{ $message }}
    </small></div>
@enderror

<h6 class="mt-3">C. About the Community</h6>
<textarea class="form-control" rows="5" id="about_community" name="about_community">{{ old('about_community', $bi->about_community) }}</textarea>
@error('about_community')
    <div class="text-danger"><small>
        {{ $message }}
    </small></div>
@enderror


<!--Assessment / Recommendation -->
<h4 class="my-3 mt-4" style="color: #62896d"><strong>V. Assessment / Recommendation</strong></h4>
<textarea class="form-control" rows="5" id="assessment" name="assessment">{{ old('assessment', $bi->assessment) }}</textarea>
@error('assessment')
    <div class="text-danger"><small>
        {{ $message }}
    </small></div>
@enderror
<!--End Assessment / Recommendation-->
