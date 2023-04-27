@php
    $users=\App\Models\User::all();
    $employees=\App\Models\User::where('usertype','Employee')->get();
    $students=\App\Models\AssignStudent::all();
    $admin=\App\Models\User::where('role','Admin')->get();
    $revenue=\App\Models\AccountStudentFee::all();
    $totalRevenue = $revenue->sum('amount');
    $totalRevenueDecimal = number_format($totalRevenue, 2);

    $salaries=\App\Models\AccountSalary::all();
    $totalSalary = $salaries->sum('amount');
    $totalSalaryDecimal = number_format($totalSalary, 2);

    $cost=\App\Models\OtherCostAccount::all();
    $totalCost = $cost->sum('amount');
    $totalCostDecimal = number_format($totalCost, 2);

    $earn=$totalRevenue-($totalSalary-$totalCost);
    $earnDeciaml=number_format($earn,2);
@endphp

@extends('admin.admin_master')
@section('admin')
    <!-- Include Chart.js from CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div class="page-content-wrapper">

        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <div class="btn-group float-right">
                            <ol class="breadcrumb hide-phone p-0 m-0">
                                <li class="breadcrumb-item"><a href="/">Main</a></li>
                                <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                            </ol>
                        </div>
                        <h4 class="page-title">Dashboard</h4>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="row grid-col">
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-row">
                                <div class="col-3 align-self-center">
                                    <div class="round">
                                        <i class="fas fa-user-alt"></i>
                                    </div>
                                </div>
                                <div class="col-9 align-self-center text-right">
                                    <div class="m-l-10">
                                        <h5 class="mt-0">{{count($users)}}</h5>
                                        <p class="mb-0 text-muted">Total Users</p>
                                    </div>
                                </div>
                            </div>
                            <div class="progress mt-3" style="height:3px;">
                                <div class="progress-bar  bg-success" role="progressbar" style="width: 35%;"
                                     aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div><!--end card-body-->
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-row">
                                <div class="col-3 align-self-center">
                                    <div class="round">
                                        <i class="fas fa-user-friends"></i>
                                    </div>
                                </div>
                                <div class="col-9 align-self-center text-right">
                                    <div class="m-l-10">
                                        <h5 class="mt-0">{{count($employees)}}</h5>
                                        <p class="mb-0 text-muted">Total Employees</p>
                                    </div>
                                </div>
                            </div>
                            <div class="progress mt-3" style="height:3px;">
                                <div class="progress-bar  bg-success" role="progressbar" style="width: 35%;"
                                     aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div><!--end card-body-->
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-row">
                                <div class="col-3 align-self-center">
                                    <div class="round">
                                        <i class="fas fa-user-graduate"></i>
                                    </div>
                                </div>
                                <div class="col-9 align-self-center text-right">
                                    <div class="m-l-10">
                                        <h5 class="mt-0">{{count($students)}}</h5>
                                        <p class="mb-0 text-muted">Total Students</p>
                                    </div>
                                </div>
                            </div>
                            <div class="progress mt-3" style="height:3px;">
                                <div class="progress-bar  bg-success" role="progressbar" style="width: 35%;"
                                     aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div><!--end card-body-->
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-row">
                                <div class="col-3 align-self-center">
                                    <div class="round">
                                        <i class="fas fa-user-cog"></i>
                                    </div>
                                </div>
                                <div class="col-9 align-self-center text-right">
                                    <div class="m-l-10">
                                        <h5 class="mt-0">{{count($admin)}}</h5>
                                        <p class="mb-0 text-muted">Total Admin</p>
                                    </div>
                                </div>
                            </div>
                            <div class="progress mt-3" style="height:3px;">
                                <div class="progress-bar  bg-success" role="progressbar" style="width: 35%;"
                                     aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div><!--end card-body-->
                    </div>
                </div>
            </div>
            <div class="row grid-col">
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-row">
                                <div class="col-3 align-self-center">
                                    <div class="round">
                                        <i class="fas fa-chart-pie"></i>
                                    </div>
                                </div>
                                <div class="col-9 align-self-center text-right">
                                    <div class="m-l-10">
                                        <h5 class="mt-0">{{$totalRevenueDecimal}}</h5>
                                        <p class="mb-0 text-muted">Student Fees</p>
                                    </div>
                                </div>
                            </div>
                            <div class="progress mt-3" style="height:3px;">
                                <div class="progress-bar  bg-success" role="progressbar" style="width: 35%;"
                                     aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div><!--end card-body-->
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-row">
                                <div class="col-3 align-self-center">
                                    <div class="round">
                                        <i class="fas fa-chart-line"></i>
                                    </div>
                                </div>
                                <div class="col-9 align-self-center text-right">
                                    <div class="m-l-10">
                                        <h5 class="mt-0">{{$totalSalaryDecimal}}</h5>
                                        <p class="mb-0 text-muted">Total Salary</p>
                                    </div>
                                </div>
                            </div>
                            <div class="progress mt-3" style="height:3px;">
                                <div class="progress-bar  bg-success" role="progressbar" style="width: 35%;"
                                     aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div><!--end card-body-->
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-row">
                                <div class="col-3 align-self-center">
                                    <div class="round">
                                        <i class="far fa-chart-bar"></i>
                                    </div>
                                </div>
                                <div class="col-9 align-self-center text-right">
                                    <div class="m-l-10">
                                        <h5 class="mt-0">{{$totalCostDecimal}}</h5>
                                        <p class="mb-0 text-muted">Others Cost</p>
                                    </div>
                                </div>
                            </div>
                            <div class="progress mt-3" style="height:3px;">
                                <div class="progress-bar  bg-success" role="progressbar" style="width: 35%;"
                                     aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div><!--end card-body-->
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex flex-row">
                                <div class="col-3 align-self-center">
                                    <div class="round">
                                        <i class="fab fa-cc-stripe"></i>
                                    </div>
                                </div>
                                <div class="col-9 align-self-center text-right">
                                    <div class="m-l-10">
                                        <h5 class="mt-0">{{$earnDeciaml}}</h5>
                                        <p class="mb-0 text-muted">Total Earn</p>
                                    </div>
                                </div>
                            </div>
                            <div class="progress mt-3" style="height:3px;">
                                <div class="progress-bar  bg-success" role="progressbar" style="width: 35%;"
                                     aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div><!--end card-body-->
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <canvas id="bar-chart"></canvas>
                </div>


            </div>

        </div>

    </div>
    <script>
        // Get the canvas element
        var canvas = document.getElementById("bar-chart");

        // Create a new chart object
        var chart = new Chart(canvas, {
            type: "bar",
            data: {
                labels: ["Total Revenue", "Total Salary", "Total Cost", "Net Earnings"],
                datasets: [{
                    label: "Amount",
                    data: [<?= $totalRevenue ?>, <?= $totalSalary ?>, <?= $totalCost ?>, <?= $earn ?>],
                    backgroundColor: ["#07203b", "#8c1d29", "#b98507", "#18722c"],
                    borderWidth: 1
                }]
            },
            options: {
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            callback: function (value, index, values) {
                                return "$" + value;
                            }
                        }
                    }]
                }
            }
        });
    </script>
@endsection
