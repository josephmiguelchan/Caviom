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
                                <p class="text-truncate font-size-14 mb-2"><strong>Charity Admins</strong></p>
                                <h4 class="mb-2 text-success">{{$admin_count}}</h4>
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
                                <p class="text-truncate font-size-14 mb-2"><strong>Charity Associates</strong></p>
                                <h4 class="mb-2 text-success">{{$assoc_count}}</h4>
                                <p class="text-muted mb-0">Total no. of active Charity Associates</p>
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
                                <p class="text-truncate font-size-14 mb-2"><strong>Beneficiaries</strong></p>
                                <h4 class="mb-2 text-success">{{$benefic_count}}</h4>
                                <p class="text-muted mb-0">Total no. of added Beneficiaries</p>
                            </div>
                            <div class="avatar-sm">
                                <span class="avatar-title bg-light text-success rounded-3">
                                    <i class="ri-user-heart-fill font-size-24" style="color: #92713e;"></i>
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
                                <p class="text-truncate font-size-14 mb-2"><strong>Gift Givings</strong></p>
                                <h4 class="mb-2 text-success">{{ Auth::user()->charity->giftgiving->count() }}</h4>
                                <p class="text-muted mb-0">Total no. of Gift Giving Projects</p>
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
                                <p class="text-truncate font-size-14 mb-2"><strong>Verified Users</strong></p>
                                <h4 class="mb-2 text-success">{{$users_count}}</h4>
                                <p class="text-muted mb-0">Organization's verified Caviom users</p>
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
                                <p class="text-truncate font-size-14  mb-2"><strong>Featured Projects</strong></p>
                                <h4 class="mb-2 text-success">{{$feat_count}}</h4>
                                <p class="text-muted mb-0">Posted projects on Public Profile</p>
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
                                <h4 class="mb-2 text-success">{{ Auth::user()->charity->projects->count() }}</h4>
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
                                <h4 class="mb-2 text-success">{{ number_format(Auth::user()->charity->view_count) }}</h4>
                                <p class="text-muted mb-0">
                                    Total no. of Views since Registration
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
                                        <h5 class="me-2">{{Auth::user()->charity->leads->count()}}</h5>
                                    </div>
                                    <p class="text-muted text-truncate mb-0">Leads</p>
                                </div><!-- end col -->
                                <div class="col-sm-4 mb-3 mb-sm-0">
                                    <div class="d-inline-flex">
                                        <h5 class="me-2">{{Auth::user()->charity->prospects->count()}}</h5>
                                    </div>
                                    <p class="text-muted text-truncate mb-0">Prospects</p>
                                </div><!-- end col -->
                                <div class="col-sm-4">
                                    <div class="d-inline-flex">
                                        <h5 class="me-2">{{$opportunities}}</h5>
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
                                    <h5>{{$pending_tasks}}</h5>
                                    <p class="mb-2 text-truncate">Pending Tasks</p>
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-4">
                                <div class="text-center mt-4">
                                    <h5>{{$in_progress_tasks}}</h5>
                                    <p class="mb-2 text-truncate">In-Progress Tasks</p>
                                </div>
                            </div>
                            <!-- end col -->
                            <div class="col-4">
                                <div class="text-center mt-4">
                                    <h5>{{$completed_tasks}}</h5>
                                    <p class="mb-2 text-truncate">Finished Tasks</p>
                                </div>
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->

                        <div class="mt-4">
                            <div id="donut-chart-tasks" class="apex-charts"></div>
                        </div>
                    </div>
                </div><!-- end card -->
            </div><!-- end col -->
        </div>
        <!-- end row -->

        @push('scripts_v2')
        <script type="text/javascript">
            $(document).ready(function() {
                var options = {
                    series: [{{$pending_tasks}}, {{$completed_tasks}}, {{$in_progress_tasks}}],
                    chart: {
                        height: 309,
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
                (chart = new ApexCharts(document.querySelector("#donut-chart-tasks"), options)).render();

                var options = {
                    chart: { height: 350, type: "bar", toolbar: { show: !1 } },
                    plotOptions: { bar: { dataLabels: { position: "top" } } },
                    dataLabels: { enabled: !0, offsetY: -20, style: { fontSize: "12px", colors: ["#304758"] } },
                    series: [{ name: "Total Count", data: [{{Auth::user()->charity->leads->count()}}, {{Auth::user()->charity->prospects->count()}}, {{$opportunities}}] }],
                    colors: ["#6fd088"],
                    grid: { borderColor: "#f1f1f1", padding: { bottom: 10 } },
                    xaxis: {
                        categories: ["Leads", "Prospects", "Opportunities"],
                        position: "top",
                        labels: { offsetY: -18 },
                        axisBorder: { show: !1 },
                        axisTicks: { show: !1 },
                        crosshairs: { fill: { type: "gradient", gradient: { colorFrom: "#D8E3F0", colorTo: "#BED1E6", stops: [0, 100], opacityFrom: 0.4, opacityTo: 0.5 } } },
                        tooltip: { enabled: !0, offsetY: -35 },
                    },
                    fill: { gradient: { shade: "light", type: "horizontal", shadeIntensity: 0.25, gradientToColors: void 0, inverseColors: !0, opacityFrom: 1, opacityTo: 1, stops: [50, 0, 100, 100] } },
                    yaxis: { axisBorder: { show: !1 }, axisTicks: { show: !1 }, labels: { show: !1 } },
                    legend: { offsetY: 7 },
                };
                (chart = new ApexCharts(document.querySelector("#column_chart_opportunities"), options)).render();
            });
        </script>
        @endpush
    </div>
</div>

@endsection