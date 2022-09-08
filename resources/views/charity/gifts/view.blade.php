@extends('charity.charity_master')
@section('title', 'View Gift Giving')
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
                        <li class="breadcrumb-item active">View</li>
                    </ol>

                    @include('charity.modals.gift-giving')
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body p-5">
                        <div class="row">
                            <div class="col-lg-8">
                                <h2><strong>View Gift Giving</strong></h2>
                            </div>
                            <div class="col-lg-4 mt-4">
                                <a href="{{ route('gifts.all') }}" class="text-link float-end">
                                    <i class="ri-arrow-left-line"></i> Go Back
                                </a>
                            </div>
                        </div>

                        <hr>

                        <div class="row mt-5">
                            <div class="col-lg-12">
                                <div class="row">
                                    <dl class="row col-md-12">
                                        <dt class="col-md-2 py-2"><h4 class="font-size-15"><strong>Name:</strong></h4></dt>
                                        <dt class="col-md-10 py-2">
                                            Changing the World One Child at a Time
                                        </dt>
                                        <dt class="col-md-2 py-2"><h4 class="font-size-15"><strong>Objective:</strong></h4></dt>
                                        <dt class="col-md-10 py-2">
                                            <p>
                                                An annual tradition of gift giving by Tarcisian Adorers of Our Lady of Sorrows Parish.
                                                This year, the organization is aiming to set a Christmas Party for 200 elderly scavengers.
                                                Scavenger hunt will be in Pasay and other nearby cities.
                                            </p>
                                            <p>
                                                Tarcisian Adorers will organize several fund raising events for this project such as cake
                                                raffle, and kalakal drive. Proceeds from fund raising projects, donations, and solicitations
                                                will all go to the TNDP gift giving project.
                                            </p>
                                        </dt>

                                        <dt class="col-md-2 py-2"><h4 class="font-size-15"><strong>Datetime of Event:</strong></h4></dt>
                                        <dt class="col-md-10 py-2">
                                            Thu, July 26, 2022, 2:15 PM
                                        </dt>

                                        <!-- Edit status dropdown should only be visible to whom the task is assigned to; otherwise, read only. -->
                                        <dt class="col-md-2 py-2"><h4 class="font-size-15"><strong>Venue:</strong></h4></dt>
                                        <dt class="col-md-10 py-2">
                                            2130 F.B. Harrison St., Pasay, Metro Manila.
                                        </dt>

                                        <dt class="col-md-2 py-2"><h4 class="font-size-15"><strong>Sponsors:</strong></h4></dt>
                                        <dt class="col-md-10 py-2">
                                            ---
                                        </dt>

                                    </dl>
                                </div>
                            </div>
                        </div>

                        <!-- Date Created and Modified -->
                        <div class="row">
                            <dl class="row mb-0 col-lg-6 my-5">
                                <dt class="col-md-6"><h4 class="font-size-15 float-end"><strong>Last Downloaded by</strong></h4></dt>
                                <dt class="col-md-6">
                                    <a href="{{ route('charity.users.view') }}">Pangilinan, J.</a>
                                </dt>
                            </dl>
                            <dl class="row mb-0 col-lg-6 mt-5">
                                <dt class="col-md-6"><h4 class="font-size-15 text-info float-end"><strong>Batch No.</strong></h4></dt>
                                <dt class="col-md-6">---</dt>
                            </dl>
                        </div>

                        <div class="row mt-5">
                            <div class="col-lg-8">
                            </div>
                            <div class="col-lg-4">
                                @if(Auth::user()->role == "Charity Admin")
                                    <ul class="list-inline mb-0 float-end">
                                        <a href="{{ route('charity.profile.feat-projects.add') }}" class="btn btn-primary waves-effect w-xl waves-light mb-2">
                                            <i class="mdi mdi-star-outline"></i> Feature Project
                                        </a>
                                    </ul>
                                @endif
                            </div>
                        </div>

                        <hr>

                        <p><small>
                            <span class="text-primary"><strong>Note:</strong></span>
                            <em>The maximum total of Beneficiaries of this Gift Giving is limited to the No. of Packs initially set by your Charity Admin.</em>
                        </small></p>

                        <form action="" method="POST">
                            @csrf
                            <div class="mb-5">
                                <div class="row">
                                    <div class="col-md-5">
                                        <label for="name" class="form-label">Search from Beneficiaries List</label>
                                        <div class="input-group">
                                            <select class="form-control select2">
                                                <option selected hidden disabled>Select a Beneficiary...</option>
                                                <optgroup label="Beneficiaries of {{ Auth::user()->charity->name }}">
                                                    <option value="Gala, Samana Lyn O.">Gala, Samana Lyn O.</option>
                                                    <option value="Caparas, Nicanor Jr. L.">Caparas, Nicanor Jr. L.</option>
                                                    <option value="Miedes Jefferson K.">Miedes Jefferson K.</option>
                                                </optgroup>
                                            </select>
                                            <button type="button" class="btn btn-success waves-effect w-md btn-sm" title="Add Beneficiary">
                                                <i class="mdi mdi-plus"></i> Add
                                            </button>
                                        </div>
                                        @error('name')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="col-md-1 text-center mt-4">
                                        <p>OR</p>
                                    </div>
                                    <div class="col-md-5">
                                        <label for="custom_name" class="form-label">Enter a New Beneficiary</label>
                                        <div class="input-group col-md-8">
                                            <input type="text" name="custom_name" id="custom_name" placeholder="Ex: Lastname, Firstname M." class="form-control">
                                            <button type="button" class="btn btn-success waves-effect w-md btn-sm" title="Add New Beneficiary">
                                                <i class="mdi mdi-plus"></i> Add
                                            </button>
                                        </div>
                                        @error('name')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="table-responsive ">
                            <table class="table table-bordered table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th width="8%">Head Count</th>
                                        <th width="12%">Unique Ticket ID No.</th>
                                        <th width="70%">Full Name of Beneficiary</th>
                                        <th width="10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">1</th>
                                        <td>74288</th>
                                        <td>Castro, Junnie F.</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-outline-danger btn-rounded waves-effect waves-light">
                                                <i class="ri-delete-bin-line"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">2</th>
                                        <td>93857</th>
                                        <td>Gara, Samara Lyn O.</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-outline-danger btn-rounded waves-effect waves-light">
                                                <i class="ri-delete-bin-line"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
</div>
@endsection