@extends('root')
@section('content')
    <div class="mt-4">
        <h6 style="color: #007bff">Hello <b>User</b>, Welcome Back!</h6>
    </div>
    <div class="mt-4">
        <div class="d-flex align-items-center justify-content-between">
            <h3 style="margin-right: 18rem">Dashboard</h3>
            <div class="w-100">
                <input type="text" class="form-control search-bar" placeholder="Search" aria-label="Search"
                    style="margin-left: 2rem" />
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-lg-7 border-end pe-4" style="border-right: 1px solid #ccc; height: 100%">
                <div class="card mb-5 graph">
                    <div class="card-body">
                        <div class="container mt-5">
                            <h4 class="text-center">Attendance of the Employees</h4>
                            <div class="chart-container">
                                <canvas id="attendanceChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card graph">
                    <div class="card-body">
                        <div class="container mt-5">
                            <h4 class="text-center">Attendance of the Employees</h4>
                            <div class="chart-container">
                                <canvas id="lineChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5 ps-4">
                <div class="card mb-4 employee">
                    <div class="card-body">
                        <h3 class="mt-2">Total Employees</h3>
                        <p class="display-6 float-end mb-2">22</p>
                    </div>
                </div>
                <div class="row mb-3">
                    <h5 style="font-weight: bold">Today</h5>
                    <div class="col-4">
                        <div class="stats-card green">
                            <p
                                style="
                  font-size: small;
                  margin-bottom: 10px;
                  font-weight: bold;
                ">
                                Attendance
                            </p>
                            <div class="stats">
                                <div class="progress-circle-container">
                                    <div class="progress-circle green" data-progress="25" data-color="#28a745">
                                        <span>25%</span>
                                    </div>
                                </div>
                                <h3 style="font-size: large; margin: 0">12</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="stats-card yellow">
                            <p style="font-size: small; font-weight: bold">
                                Late Attendance
                            </p>
                            <div class="stats">
                                <div class="progress-circle-container">
                                    <div class="progress-circle yellow" data-progress="75" data-color="#ffc107">
                                        <span>75%</span>
                                    </div>
                                </div>
                                <h3 style="font-size: large; margin: 0">05</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="stats-card orange">
                            <p style="font-size: small; font-weight: bold">Absent</p>
                            <div class="stats">
                                <div class="progress-circle-container">
                                    <div class="progress-circle orange" data-progress="75" data-color="#fd7e14">
                                        <span>75%</span>
                                    </div>
                                </div>
                                <h3 style="font-size: large; margin: 0">05</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <h5 style="font-weight: bold">Yesterday</h5>
                    <div class="col-4">
                        <div class="stats-card green">
                            <p
                                style="
                  font-size: small;
                  margin-bottom: 10px;
                  font-weight: bold;
                ">
                                Attendance
                            </p>
                            <div class="stats">
                                <div class="progress-circle-container">
                                    <div class="progress-circle green" data-progress="25" data-color="#28a745">
                                        <span>25%</span>
                                    </div>
                                </div>
                                <h3 style="font-size: large; margin: 0">12</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="stats-card yellow">
                            <p style="font-size: small; font-weight: bold">
                                Late Attendance
                            </p>
                            <div class="stats">
                                <div class="progress-circle-container">
                                    <div class="progress-circle yellow" data-progress="75" data-color="#ffc107">
                                        <span>75%</span>
                                    </div>
                                </div>
                                <h3 style="font-size: large; margin: 0">05</h3>
                            </div>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="stats-card orange">
                            <p style="font-size: small; font-weight: bold">Absent</p>
                            <div class="stats">
                                <div class="progress-circle-container">
                                    <div class="progress-circle orange" data-progress="75" data-color="#fd7e14">
                                        <span>75%</span>
                                    </div>
                                </div>
                                <h3 style="font-size: large; margin: 0">05</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <h5 style="font-weight: bold">Date</h5>
                <div class="calendar">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <button class="btn btn-outline-primary btn-sm" id="prevMonth">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <div>
                            <span id="monthLabel" class="fw-bold">April</span>
                            <span id="yearLabel" class="fw-bold">2024</span>
                        </div>
                        <button class="btn btn-outline-primary btn-sm" id="nextMonth">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>Mo</th>
                                <th>Tu</th>
                                <th>We</th>
                                <th>Th</th>
                                <th>Fr</th>
                                <th>Sa</th>
                                <th>Su</th>
                            </tr>
                        </thead>
                        <tbody id="calendarBody"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
