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
                <form class="mt-3" id="dataForm">
                    @csrf
                    <div class="row mb-3" style="padding-bottom: 20px;">
                        <div class="col-md-6">
                            <label for="start-date" class="form-label">Start Date</label>
                            <select class="form-select" name="start_date" id="start-date">
                                <option selected>Select Start Date</option>
                                @foreach ($groupedDates as $start_date => $end_dates)
                                    <option value="{{ $start_date }}">{{ $start_date }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="end-date" class="form-label">End Date</label>
                            <select class="form-select" name="end_date" id="end-date" disabled>
                                <option selected>Select End Date</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3" style="padding-bottom: 20px;">
                        <div class="col-md-6">
                            <label for="start-date" class="form-label">Department</label>
                            <select class="form-select" name="department" id="department"
                                aria-label="Default select example">
                                <option selected>Select Department</option>
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="end-date" class="form-label">Job Title</label>
                            <select class="form-select" name="job_title" id="job_title" aria-label="Default select example">
                                <option selected>Select Job Title</option>
                                @foreach ($titles as $title)
                                    <option value="{{ $title->id }}">{{ $title->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-12" style="padding-bottom: 20px;">
                        <div class="col-md-3">
                            <label for="start-date" class="form-label">Number of Employees</label>
                            <input type="number" class="form-control" id="no_of_employee" name="no_of_employee"
                                placeholder="Employees Count" min="0" />
                        </div>
                        <div class="col-md-4">
                            <label for="end-date" class="form-label">Basic Salary (Rs.)</label>
                            <input type="number" class="form-control" id="basic_salary" name="basic_salary"
                                placeholder="Basic Salary" min="0" />
                        </div>
                        <div class="col-md-1"
                            style="display: flex; align-items: center; justify-content: center; margin-top: 30px;">
                            <i class="bi bi-plus-lg"></i>
                        </div>
                        <div class="col-md-4">
                            <label for="end-date" class="form-label">Allowance (Rs.)</label>
                            <input type="number" class="form-control" id="allowance" name="allowance"
                                placeholder="Allowance" min="0" />
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

@section('scripts')
    <script>
        $(document).ready(function() {
            // Map of start_date to their corresponding end_dates
            const dateMapping = @json($groupedDates->map(fn($endDates) => $endDates->pluck('end_date')));

            // Event listener for start-date change
            $('#start-date').on('change', function() {
                const selectedStartDate = $(this).val();
                const relatedEndDates = dateMapping[selectedStartDate] || [];

                const endDateDropdown = $('#end-date');
                endDateDropdown.empty(); // Clear previous options
                // endDateDropdown.append('<option selected>Select End Date</option>'); // Default option

                if (relatedEndDates.length > 0) {
                    relatedEndDates.forEach(function(endDate) {
                        endDateDropdown.append(`<option value="${endDate}">${endDate}</option>`);
                    });
                    endDateDropdown.prop('disabled', false); // Enable dropdown
                } else {
                    endDateDropdown.prop('disabled', true); // Disable dropdown if no matches
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#dataForm').on('submit', function(e) {
                e.preventDefault();

                let startDate = $('#start-date').val();
                let endDate = $('#end-date').val();
                let department = $('#department').val();
                let job_title = $('#job_title').val();
                let no_of_employee = $('#no_of_employee').val();
                let basic_salary = $('#basic_salary').val();
                let allowance = $('#allowance').val();
                let token = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url: "{{ route('budgetplan.store') }}",
                    type: "POST",
                    data: {
                        _token: token,
                        start_date: startDate,
                        end_date: endDate,
                        department: department,
                        job_title: job_title,
                        no_of_employee: no_of_employee,
                        basic_salary: basic_salary,
                        allowance: allowance,
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Form Submit Successfully',
                            text: response.message,
                            showConfirmButton: false,
                            timer: 2000
                        })
                    },
                    error: function(xhr) {
                        let errorMessage = xhr.responseJSON?.message ||
                            'An unknown error occurred.';
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: errorMessage,
                            showConfirmButton: true,
                        });
                    }
                });
            });
        });
    </script>
@endsection
