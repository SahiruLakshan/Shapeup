@extends('root')
@section('content')
    <style>
        .form-container {
            position: relative;
            z-index: 1;
            /* Above the rectangle background */
            padding: 40px;
            width: 100%;
            max-width: 900px;
            /* Limit max width */
            background-color: #fff;
            /* White background */
            border-radius: 15px;
            /* Rounded corners */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            /* Subtle shadow */
            top: 10px;
        }

        .btn-submit {
            background-color: #1bbddd;
            color: #fff;
            font-size: 16px;
            padding: 10px 40px;
            border: none;
            border-radius: 5px;
        }

        .btn-submit:hover {
            background-color: #17a2b8;
        }

        .rectangle-background {
            position: absolute;
            width: 1200px;
            height: 600px;
            background-color: #f0f8ff;
            /* Light blue background */
            border-radius: 15px;
            /* Rounded corners */
            z-index: 0;
            /* Behind the form */
        }

        .rectangle-wrapper {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            margin-top: 100px;
        }
    </style>

    <div style="margin-top: 50px">
    
    <h6 style="color:#007bff">Home <i class="bi bi-chevron-right"></i> Budget Plan</h6>
    <h3 class="form-title" style="text-align: left;font-weight:bold">Budget Plan</h3>
    <div class="rectangle-wrapper">
        <div class="rectangle-background"></div>
        <div class="form-container">
            <h5 style="font-weight: bold">Budget Process</h5>
            <form class="mt-3">
                <div class="row mb-3" style="padding-bottom: 20px;">
                    <div class="col-md-6">
                        <label for="start-date" class="form-label">Start Date</label>
                        <input type="date" class="form-control" id="start-date" name="start_date" placeholder="Enter Start Date" />
                    </div>
                    <div class="col-md-6">
                        <label for="end-date" class="form-label">End Date</label>
                        <input type="date" class="form-control" id="end-date" name="end_date" placeholder="Enter End Date" />
                    </div>
                </div>
                
                <div class="row mb-3" style="padding-bottom: 20px;">
                    <div class="col-md-6">
                        <label for="start-date" class="form-label">Department</label>
                        <select class="form-select" aria-label="Default select example">
                            <option selected>Select Department</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                          </select>
                    </div>
                    <div class="col-md-6">
                        <label for="end-date" class="form-label">Job Title</label>
                        <select class="form-select" aria-label="Default select example">
                            <option selected>Select Job Title</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                          </select>
                    </div>
                </div>
                
                <div class="row mb-12" style="padding-bottom: 20px;">
                    <div class="col-md-3">
                        <label for="start-date" class="form-label">Number of Employees</label>
                        <input type="number" class="form-control" id="noe" name="noe" placeholder="Employees Count" min="0" />
                    </div>
                    <div class="col-md-4">
                        <label for="end-date" class="form-label">Basic Salary</label>
                        <input type="number" class="form-control" id="b_salary" name="b_salary" placeholder="Basic Salary" min="0"/>
                    </div>
                    <div class="col-md-1" style="display: flex; align-items: center; justify-content: center; margin-top: 30px;">
                        <i class="bi bi-plus-lg"></i>
                    </div>
                    <div class="col-md-4">
                        <label for="end-date" class="form-label">Allowance</label>
                        <input type="number" class="form-control" id="allowance" name="allowance" placeholder="Allowance" min="0"/>
                    </div>
                </div>
                
                <div class="text-center">
                    <button type="submit" class="btn btn-submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
    </div>
@endsection
