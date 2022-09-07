@extends('charity.charity_master')
@section('title', 'Add Gift Giving')
@section('charity')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="p-2">
                    <h1 class="mb-0" style="color: #62896d"><strong>GIFT GIVING</strong></h1>
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('gifts.all') }}">Gift Givings</a>
                        </li>
                        <li class="breadcrumb-item active">Add</li>
                    </ol>

                    @include('charity.modals.gift-giving')
                </div>
            </div>
        </div>
        <!-- end page title -->

        <!-- Submit Modal -->
        <div id="submit_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel"><i class="mdi mdi-alert-outline me-2"></i> Warning</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>
                            You can no longer edit the information here once submitted (e.g. No. of packs, Amount per pack, etc.). This action
                            will notify and deduct your Charitable Organization 300 Star Tokens. Continue?
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light waves-effect w-sm" data-bs-dismiss="modal">No</button>
                        <button type="submit" form="submit_form" class="btn btn-dark waves-effect waves-light w-sm">Yes</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card p-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-8">
                                <h2><strong>Add Gift Giving</strong></h2>
                                <p class="text-muted font-size-12 mt-2"><em>
                                    {{-- Tip: Subscribe your Charitable Organization to Caviom PRO to create unlimited Gift Givings. --}}
                                    <strong>*</strong>Once created, Gift Givings cannot be edited anymore. Please review information carefully before submitting.
                                </em></p>
                            </div>
                            <div class="col-lg-4 mt-4">
                                <a href="{{route('gifts.all')}}" class="text-link float-end">
                                    <i class="ri-arrow-left-line"></i> Go Back
                                </a>
                            </div>
                        </div>
                        <hr class="my-3">
                        <form method="POST" action="#" id="submit_form">
                            @csrf
                            <div class="form-group mb-3 row">
                                <!-- Name -->
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="name" class="form-label">*Name of Gift Giving Event</label>
                                        <input class="form-control" name="name" id="name" type="text">
                                        @error('name')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Amount per Pack -->
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="amount_per_pack" class="form-label">*Amount per Pack</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="peso_currency">Php</span>
                                            </div>
                                            <input class="form-control input-mask" data-inputmask="'alias': 'numeric', 'groupSeparator': ',',
                                                'digits': 2, 'digitsOptional': false, 'placeholder': '0'" name="amount_per_pack"
                                                id="amount_per_pack" value="">
                                        </div>
                                        @error('amount_per_pack')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- No. of Packs -->
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="no_of_packs" class="form-label">
                                            *No. of Packs
                                            <span data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                title="This is the total number of beneficiaries for this Event."
                                                data-bs-original-title="yes">
                                                <i class="mdi mdi-information-outline"></i>
                                            </span>
                                        </label>
                                        <input type="number" class="form-control" name="no_of_packs" id="no_of_packs"
                                            value="">
                                        @error('no_of_packs')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-3 row">
                                <!-- Objective -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="objective" class="form-label">*Objective</label>
                                        <textarea id="elm1" rows="10" name="objective" maxlength="500">
                                        </textarea>
                                        @error('objective')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-3 row">
                                <!-- Venue -->
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="venue" class="form-label">*Address of Venue</label>
                                        <input class="form-control" name="venue" id="venue" type="text"
                                            value="">
                                        @error('venue')
                                            <div class="text-danger"><small>
                                                {{ $message }}
                                            </small></div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- *Date of Event -->
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="start_at" class="form-label">*Date & Time of Event</label>
                                        <input class="form-control" name="start_at" id="start_at" type="datetime-local"
                                            value="">
                                        @error('start_at')
                                            <div class="text-danger"><small>
                                                {{ $message }}
                                            </small></div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-3 row">
                                <!-- Sponsors -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="sponsors" class="form-label">Sponsor/s (Optional)</label>
                                        <input class="form-control" name="sponsors" id="sponsors" type="text"
                                            value="">
                                        @error('sponsors')
                                            <div class="text-danger"><small>
                                                {{ $message }}
                                            </small></div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row p-5">
                                <ul class="list-inline mb-0 mt-4 float-end">
                                    <button type="button" class="btn btn-dark btn-rounded w-lg waves-effect waves-light float-end"
                                        data-bs-toggle="modal" data-bs-target="#submit_modal">
                                        <i class="ri-edit-2-line"></i> Submit
                                    </button>
                                    <a class="btn list-inline-item float-end mx-4" href="{{ route('gifts.all') }}">Cancel</a>
                                </ul>

                            </div>
                        </form>
                    </div><!-- end cardbody -->
                </div><!-- end card -->
            </div><!-- end col -->
        </div>
        <!-- end row -->
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#profile_image').change(function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        })
    })
</script>
@endsection