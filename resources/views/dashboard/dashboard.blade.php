@extends('root')
@section('content')
    <style>
        .card {
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #fff;
            border-bottom: none;
            font-weight: bold;
        }

        .card-body {
            padding: 10px;
        }

        .calendar .bg-today {
            background-color: #007bff;
            color: #fff;
            border-radius: 50%;
        }

        .calendar td {
            height: 50px;
            vertical-align: middle;
        }

        .employee {
            background: linear-gradient(135deg, #007bff 70%, #4da7ff 100%);
            border-radius: 20px;
            color: #fff;
            position: relative;
            overflow: hidden;
        }

        /* Optional: Add subtle corner effects */
        .employee::before {
            content: "";
            position: absolute;
            width: 100px;
            height: 100px;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            top: -20px;
            left: -20px;
        }

        .employee::after {
            content: "";
            position: absolute;
            width: 150px;
            height: 150px;
            background-color: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
            bottom: -40px;
            right: -40px;
        }

        .search-bar {
            background-color: #f0f8ff;
            /* Light blue background */
            border-radius: 20px;
            /* Rounded corners */
            border: 1px solid transparent;
            /* Removes visible border */
            padding: 10px 15px;
            /* Adjust padding for a clean look */
            font-size: 16px;
            /* Adjust text size */
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
            /* Optional subtle shadow */
            width: 250px;
        }

        .search-bar:focus {
            outline: none;
            /* Remove default outline */
            border: 1px solid #007bff;
            /* Highlight border on focus */
            box-shadow: 0px 2px 6px rgba(0, 123, 255, 0.3);
            /* Add shadow on focus */
        }

        .graph {
            height: 400px;
        }

        .stats-card {
            width: 150px;
            /* Adjust card width */
            height: 150px;
            /* Adjust card height */
            border-radius: 20px;
            padding: 15px;
            /* Reduce padding */
            color: #fff;
            text-align: center;
            display: flex;
            flex-direction: column;
            /* Stack content vertically */
            justify-content: center;
            /* Center vertically */
            align-items: center;
            /* Center horizontally */
            gap: 10px;
            /* Space between elements */
        }

        /* Specific Colors for Cards */
        .stats-card.green {
            background-color: #28a745;
        }

        .stats-card.yellow {
            background-color: #ffc107;
        }

        .stats-card.orange {
            background-color: #fd7e14;
        }

        /* Flexbox for Circle and Number */
        .stats {
            display: flex;
            align-items: center;
            /* Align items vertically */
            justify-content: center;
            /* Align items horizontally */
            gap: 10px;
            /* Space between circle and number */
        }

        /* Progress Circle Container */
        .progress-circle-container {
            width: 50px;
            /* Adjust circle size */
            height: 50px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Progress Circle Styles */
        .progress-circle {
            position: relative;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: conic-gradient(#fff 0%,
                    #fff 25%,
                    /* Dynamic progress color (25%) */
                    transparent 25%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: Arial, sans-serif;
            font-weight: bold;
            color: #fff;
        }

        /* Inner Circle Background */
        .progress-circle:after {
            content: "";
            position: absolute;
            width: 32px;
            /* Inner circle size */
            height: 32px;
            background-color: var(--circle-color, #28a745);
            border-radius: 50%;
        }

        /* Percentage Text Inside Circle */
        .progress-circle span {
            position: absolute;
            font-size: 12px;
            color: #fff;
            /* Text color */
            z-index: 10;
        }

        .calendar td {
            height: 50px;
            vertical-align: middle;
        }

        .bg-today {
            background-color: #007bff;
            color: white;
            border-radius: 50%;
        }

        .calendar {
            padding: 20px;
            border-radius: 10px;
            background-color: #e3f2fd;
        }

        .calendar .btn {
            background-color: #fff;
            border: none;
            color: #007bff;
        }

        .calendar .btn:hover {
            background-color: #007bff;
            color: #fff;
        }

        .chart-container {
            width: 80%;
            height: 400px;
            margin: 0 auto;
        }

        @media (max-width: 992px) {
            .header .search-bar {
                width: 200px;
            }

            .sidebar {
                height: auto;
                border-right: none;
            }

            .content {
                padding: 10px;
            }
        }

        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                align-items: flex-start;
            }

            .header .search-bar {
                width: 100%;
                margin-top: 10px;
            }

            .header .user-info {
                margin-top: 10px;
            }

            .sidebar {
                display: none;
            }

            .content {
                padding: 10px;
            }
        }
    </style>

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
