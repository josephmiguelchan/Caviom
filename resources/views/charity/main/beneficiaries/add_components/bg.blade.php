<!-- Problem -->
<h4 class="my-3 mt-5" style="color: #62896d">Problem Presented</h4>
<textarea class="form-control" rows="5" name="problem_presented"></textarea>
@error('problem_presented')
    <div class="text-danger"><small>
        {{ $message }}
    </small></div>
@enderror
<!--End Problem-->

<h4 class="my-3 mt-4" style="color: #62896d">Background Information</h4>

<h6>A. About the Client</h6>
<textarea class="form-control" rows="5" name="about_client"></textarea>
@error('about_client')
    <div class="text-danger"><small>
        {{ $message }}
    </small></div>
@enderror

<h6 class="mt-3">B. About the Family</h6>
<textarea class="form-control" rows="5" name="about_family"></textarea>
@error('about_family')
    <div class="text-danger"><small>
        {{ $message }}
    </small></div>
@enderror

<h6 class="mt-3">C. About the Community</h6>
<textarea class="form-control" rows="5" name="about_community"></textarea>
@error('about_community')
    <div class="text-danger"><small>
        {{ $message }}
    </small></div>
@enderror


<!--Assessment / Recommendation -->
<h4 class="my-3 mt-4" style="color: #62896d">Assessment / Recommendation</h4>
<textarea class="form-control" rows="5" name="assessment"></textarea>
@error('assessment')
    <div class="text-danger"><small>
        {{ $message }}
    </small></div>
@enderror
<!--End Assessment / Recommendation-->