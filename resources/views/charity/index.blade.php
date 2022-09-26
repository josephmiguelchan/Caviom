@extends('charity.charity_master')
@section('title', 'Dashboard')
@section('charity')

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="">
                    <div class="p-2">
                        <h1 class="mb-0" style="color: #62896d"><strong>{{ Str::of(Auth::user()->charity->name)->upper() }}</strong></h1>
                        <ol class="breadcrumb m-0 p-0 mb-3">
                            <li class="breadcrumb-item active">
                                My Charitable Organization
                            </li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">

            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-truncate font-size-14 mb-2"><strong>Charity Admins</strong>
                                </p>
                                <h4 class="mb-2 text-success">3</h4>
                                <p class="text-muted mb-0">
                                    Total no. of active Charity Administrators
                                </p>
                            </div>
                            <div class="avatar-sm">
                                <span class="avatar-title bg-light text-success rounded-3">
                                    <i class="ri-user-fill font-size-24" style="color: #92713e;"></i>
                                </span>
                            </div>
                        </div>
                    </div><!-- end cardbody -->
                </div><!-- end card -->
            </div><!-- end col -->

            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-truncate font-size-14 mb-2"><strong>Charity
                                        Associates</strong></p>
                                <h4 class="mb-2 text-success">20</h4>
                                <p class="text-muted mb-0">
                                    Total no. of active Charity Associates
                                </p>
                            </div>
                            <div class="avatar-sm">
                                <span class="avatar-title bg-light text-success rounded-3">
                                    <i class="ri-team-fill font-size-24" style="color: #92713e;"></i>
                                </span>
                            </div>
                        </div>
                    </div><!-- end cardbody -->
                </div><!-- end card -->
            </div><!-- end col -->
            <!-- end col -->

            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-truncate font-size-14 mb-2"><strong>Beneficiaries</strong>
                                </p>
                                <h4 class="mb-2 text-success">35</h4>
                                <p class="text-muted mb-0">
                                    Total no. of active Beneficiaries
                                </p>
                            </div>
                            <div class="avatar-sm">
                                <span class="avatar-title bg-light text-success rounded-3">
                                    <i class="ri-user-heart-fill font-size-24"
                                        style="color: #92713e;"></i>
                                </span>
                            </div>
                        </div>
                    </div><!-- end cardbody -->
                </div><!-- end card -->
            </div><!-- end col -->
            <!-- end col -->

            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-truncate font-size-14 mb-2"><strong>Gift Givings</strong>
                                </p>
                                <h4 class="mb-2 text-success">41</h4>
                                <p class="text-muted mb-0">
                                    Total no. of Gift Giving Projects
                                </p>
                            </div>
                            <div class="avatar-sm">
                                <span class="avatar-title bg-light text-success rounded-3">
                                    <i class="ri-gift-fill font-size-24" style="color: #92713e;"></i>
                                </span>
                            </div>
                        </div>
                    </div><!-- end cardbody -->
                </div><!-- end card -->
            </div><!-- end col -->
            <!-- end col -->
        </div>

        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-truncate font-size-14 mb-2"><strong>Verified Users</strong>
                                </p>
                                <h4 class="mb-2 text-success">5</h4>
                                <p class="text-muted mb-0">
                                    Organization's verified Caviom users
                                </p>
                            </div>
                            <div class="avatar-sm">
                                <span class="avatar-title bg-light text-success rounded-3">
                                    <i class="ri-bank-fill font-size-24" style="color: #92713e;"></i>
                                </span>
                            </div>
                        </div>
                    </div><!-- end cardbody -->
                </div><!-- end card -->
            </div><!-- end col -->
            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-truncate font-size-14  mb-2"><strong>Featured
                                        Projects</strong></p>
                                <h4 class="mb-2 text-success">6</h4>
                                <p class="text-muted mb-0">
                                    Posted projects on Public Profile
                                </p>
                            </div>
                            <div class="avatar-sm">
                                <span class="avatar-title bg-light text-success rounded-3">
                                    <i class="ri-heart-fill font-size-24" style="color: #92713e;"></i>
                                </span>
                            </div>
                        </div>
                    </div><!-- end cardbody -->
                </div><!-- end card -->
            </div><!-- end col -->
            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-truncate font-size-14 mb-2"><strong>Projects</strong></p>
                                <h4 class="mb-2 text-success">15</h4>
                                <p class="text-muted mb-0">
                                    Total no. of current Charity Projects
                                </p>
                            </div>
                            <div class="avatar-sm">
                                <span class="avatar-title bg-light text-success rounded-3">
                                    <i class="ri-landscape-fill font-size-24" style="color: #92713e;"></i>
                                </span>
                            </div>
                        </div>
                    </div><!-- end cardbody -->
                </div><!-- end card -->
            </div><!-- end col -->
            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="font-size-14 mb-2"><strong>Total Visits</strong></p>
                                <h4 class="mb-2 text-success">100</h4>
                                <p class="text-muted mb-0">
                                    Total no. of views since Registration
                                </p>
                            </div>
                            <div class="avatar-sm">
                                <span class="avatar-title bg-light text-success rounded-3">
                                    <i class="ri-eye-fill font-size-24" style="color: #92713e;"></i>
                                </span>
                            </div>
                        </div>
                    </div><!-- end cardbody -->
                </div><!-- end card -->
            </div><!-- end col -->
        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-xl-6">

                <div class="card">
                    <div class="card-body pb-0">
                        <h4 class="card-title mb-4">Donors and Donations</h4>

                        <div class="text-center pt-3">
                            <div class="row">
                                <div class="col-sm-4 mb-3 mb-sm-0">
                                    <div class="d-inline-flex">
                                        <h5 class="me-2">20</h5>
                                        <div class="text-success font-size-12">
                                            <i class="mdi mdi-menu-up font-size-14"> </i>2.2 %
                                        </div>
                                    </div>
                                    <p class="text-muted text-truncate mb-0">Leads</p>
                                </div><!-- end col -->
                                <div class="col-sm-4 mb-3 mb-sm-0">
                                    <div class="d-inline-flex">
                                        <h5 class="me-2">50</h5>
                                        <div class="text-success font-size-12">
                                            <i class="mdi mdi-menu-up font-size-14"> </i>1.2 %
                                        </div>
                                    </div>
                                    <p class="text-muted text-truncate mb-0">Prospects</p>
                                </div><!-- end col -->
                                <div class="col-sm-4">
                                    <div class="d-inline-flex">
                                        <h5 class="me-2">100</h5>
                                        <div class="text-success font-size-12">
                                            <i class="mdi mdi-menu-up font-size-14"> </i>1.7 %
                                        </div>
                                    </div>
                                    <p class="text-muted text-truncate mb-0">Opportunities</p>
                                </div><!-- end col -->
                            </div><!-- end row -->
                        </div>
                    </div>
                    <div class="card-body py-0 px-2">
                        <div id="column_chart_opportunities" class="apex-charts" dir="ltr"></div>
                    </div>
                </div><!-- end card -->
            </div><!-- end col -->

            <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <ul class="list-inline mb-2">
                            <li class="list-inline-item">
                                <h4 class="card-title">Progress Tracker</h4>
                            </li>
                            <li class="list-inline-item">
                                <p class="text-muted">
                                    (Overall count)
                                </p>
                            </li>
                        </ul>

                        <div class="row">
                            <div class="col-4">
                                <div class="text-center mt-4">
                                    <h5>50</h5>
                                    <p class="mb-2 text-truncate">Pending Tasks</p>
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-4">
                                <div class="text-center mt-4">
                                    <h5>30</h5>
                                    <p class="mb-2 text-truncate">In-Progress Tasks</p>
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-4">
                                <div class="text-center mt-4">
                                    <h5>20</h5>
                                    <p class="mb-2 text-truncate">Finished Tasks</p>
                                </div>
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->

                        <div class="mt-4">
                            <div id="donut-chart-1" class="apex-charts"></div>
                        </div>
                    </div>
                </div><!-- end card -->
            </div><!-- end col -->
        </div>
        <!-- end row -->

        <script type="text/javascript">
            $(document).ready(function() {
                var options = {
                    series: [50, 20, 30],
                    chart: {
                        height: 286,
                        type: "donut"
                    },
                    labels: ["Pending Tasks", "Finished Tasks", "In-Progress Tasks"],
                    plotOptions: {
                        pie: {
                            donut: {
                                size: "73%",
                                labels: {
                                    show: !0,
                                    name: {
                                        show: !0,
                                        fontSize: "18px",
                                        offsetY: 5
                                    },
                                    value: {
                                        show: !1,
                                        fontSize: "20px",
                                        color: "#343a40",
                                        offsetY: 8
                                    },
                                    total: {
                                        show: !0,
                                        fontSize: "17px",
                                        label: "Tasks",
                                        color: "#6c757d",
                                        fontWeight: 600
                                    },
                                },
                            },
                        },
                    },
                    dataLabels: {
                        enabled: !1
                    },
                    legend: {
                        show: !1
                    },
                    colors: ["#0f9cf3", "#6fd088", "#ffbb44"],
                };
                (chart = new ApexCharts(document.querySelector("#donut-chart-1"), options)).render();
            })
        </script>

        <div class="row">
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body">
                        <div class="dropdown float-end">
                            <a href="#" class="dropdown-toggle arrow-none card-drop"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Sales Report</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Profit</a>
                                <!-- item-->
                                <a href="javascript:void(0);" class="dropdown-item">Action</a>
                            </div>
                        </div>

                        <h4 class="card-title mb-4">Latest Transactions</h4>

                        <div class="table-responsive">
                            <table class="table table-centered mb-0 align-middle table-hover table-nowrap">
                                <thead class="table-light">
                                    <tr>
                                        <th>Name</th>
                                        <th>Position</th>
                                        <th>Status</th>
                                        <th>Age</th>
                                        <th>Start date</th>
                                        <th style="width: 120px;">Salary</th>
                                    </tr>
                                </thead><!-- end thead -->
                                <tbody>
                                    <tr>
                                        <td>
                                            <h6 class="mb-0">Charles Casey</h6>
                                        </td>
                                        <td>Web Developer</td>
                                        <td>
                                            <div class="font-size-13"><i
                                                    class="ri-checkbox-blank-circle-fill font-size-10 text-success align-middle me-2"></i>Active
                                            </div>
                                        </td>
                                        <td>
                                            23
                                        </td>
                                        <td>
                                            04 Apr, 2021
                                        </td>
                                        <td>$42,450</td>
                                    </tr>
                                    <!-- end -->
                                    <tr>
                                        <td>
                                            <h6 class="mb-0">Alex Adams</h6>
                                        </td>
                                        <td>Python Developer</td>
                                        <td>
                                            <div class="font-size-13"><i
                                                    class="ri-checkbox-blank-circle-fill font-size-10 text-warning align-middle me-2"></i>Deactive
                                            </div>
                                        </td>
                                        <td>
                                            28
                                        </td>
                                        <td>
                                            01 Aug, 2021
                                        </td>
                                        <td>$25,060</td>
                                    </tr>
                                    <!-- end -->
                                    <tr>
                                        <td>
                                            <h6 class="mb-0">Prezy Kelsey</h6>
                                        </td>
                                        <td>Senior Javascript Developer</td>
                                        <td>
                                            <div class="font-size-13"><i
                                                    class="ri-checkbox-blank-circle-fill font-size-10 text-success align-middle me-2"></i>Active
                                            </div>
                                        </td>
                                        <td>
                                            35
                                        </td>
                                        <td>
                                            15 Jun, 2021
                                        </td>
                                        <td>$59,350</td>
                                    </tr>
                                    <!-- end -->
                                    <tr>
                                        <td>
                                            <h6 class="mb-0">Ruhi Fancher</h6>
                                        </td>
                                        <td>React Developer</td>
                                        <td>
                                            <div class="font-size-13"><i
                                                    class="ri-checkbox-blank-circle-fill font-size-10 text-success align-middle me-2"></i>Active
                                            </div>
                                        </td>
                                        <td>
                                            25
                                        </td>
                                        <td>
                                            01 March, 2021
                                        </td>
                                        <td>$23,700</td>
                                    </tr>
                                    <!-- end -->
                                    <tr>
                                        <td>
                                            <h6 class="mb-0">Juliet Pineda</h6>
                                        </td>
                                        <td>Senior Web Designer</td>
                                        <td>
                                            <div class="font-size-13"><i
                                                    class="ri-checkbox-blank-circle-fill font-size-10 text-success align-middle me-2"></i>Active
                                            </div>
                                        </td>
                                        <td>
                                            38
                                        </td>
                                        <td>
                                            01 Jan, 2021
                                        </td>
                                        <td>$69,185</td>
                                    </tr>
                                    <!-- end -->
                                    <tr>
                                        <td>
                                            <h6 class="mb-0">Den Simpson</h6>
                                        </td>
                                        <td>Web Designer</td>
                                        <td>
                                            <div class="font-size-13"><i
                                                    class="ri-checkbox-blank-circle-fill font-size-10 text-warning align-middle me-2"></i>Deactive
                                            </div>
                                        </td>
                                        <td>
                                            21
                                        </td>
                                        <td>
                                            01 Sep, 2021
                                        </td>
                                        <td>$37,845</td>
                                    </tr>
                                    <!-- end -->
                                    <tr>
                                        <td>
                                            <h6 class="mb-0">Mahek Torres</h6>
                                        </td>
                                        <td>Senior Laravel Developer</td>
                                        <td>
                                            <div class="font-size-13"><i
                                                    class="ri-checkbox-blank-circle-fill font-size-10 text-success align-middle me-2"></i>Active
                                            </div>
                                        </td>
                                        <td>
                                            32
                                        </td>
                                        <td>
                                            20 May, 2021
                                        </td>
                                        <td>$55,100</td>
                                    </tr>
                                    <!-- end -->
                                </tbody><!-- end tbody -->
                            </table> <!-- end table -->
                        </div>
                    </div><!-- end card -->
                </div><!-- end card -->
            </div>
            <!-- end col -->
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <div class="float-end">
                            <select class="form-select shadow-none form-select-sm">
                                <option selected>Apr</option>
                                <option value="1">Mar</option>
                                <option value="2">Feb</option>
                                <option value="3">Jan</option>
                            </select>
                        </div>
                        <h4 class="card-title mb-4">Monthly Earnings</h4>

                        <div class="row">
                            <div class="col-4">
                                <div class="text-center mt-4">
                                    <h5>3475</h5>
                                    <p class="mb-2 text-truncate">Market Place</p>
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-4">
                                <div class="text-center mt-4">
                                    <h5>458</h5>
                                    <p class="mb-2 text-truncate">Last Week</p>
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-4">
                                <div class="text-center mt-4">
                                    <h5>9062</h5>
                                    <p class="mb-2 text-truncate">Last Month</p>
                                </div>
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->

                        <div class="mt-4">
                            <div id="donut-chart" class="apex-charts"></div>
                        </div>
                    </div>
                </div><!-- end card -->
            </div><!-- end col -->
        </div>
        <!-- end row -->
    </div>

</div>

@endsection