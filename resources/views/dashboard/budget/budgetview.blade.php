@extends('root')
@section('content')
    <div style="margin-top: 50px">
        <h6 style="color:#007bff">Home <i class="bi bi-chevron-right"></i> Budget Comparison</h6>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 style="font-weight: bold">Budget Comparison</h3>
        </div>
        <button class="btn btn-primary" data-toggle="modal" data-target="#budgetmodal"><i class="bi bi-plus"></i> Add
            the Budget</button>
        <button class="btn btn-warning">Generate Report</button>
        <table class="table table-striped" style="margin-top: 30px" id="myTable">
            <thead>
                <tr class="table-secondary">
                    <th><input type="checkbox" id="check-all" /></th>
                    <th>Job Title</th>
                    <th>Count</th>
                    <th>Overall Budget</th>
                    <th>Actual Budget</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="checkbox" class="check-item" /></td>
                    <td>Sales Manager</td>
                    <td>2</td>
                    <td>Rs 10,0000.00</td>
                    <td>Rs 12,0000.00</td>
                </tr>
                <tr>
                    <td><input type="checkbox" class="check-item" /></td>
                    <td>HR Manager</td>
                    <td>3</td>
                    <td>Rs 15,0000.00</td>
                    <td>Rs 14,0000.00</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="modal fade" id="budgetmodal" tabindex="-1" role="dialog" aria-labelledby="budgetmodalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered custom-modal-width" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="budgetmodalLongTitle" style="font-weight:600">Budget Modal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
    
                <!-- Tab Navigation -->
                <ul class="nav nav-tabs" id="budgetTabs">
                    <li class="nav-item">
                        <a class="nav-link" id="budgetMasterTab" data-toggle="tab" href="#budgetMaster">Date Range</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" id="budgetSubTab" data-toggle="tab" href="#budgetSub">Budget Process</a>
                    </li>
                </ul>
    
                <div class="tab-content">
                    <!-- Budget Master Tab Content -->
                    <div class="tab-pane fade" id="budgetMaster">
                        <div class="modal-body d-flex justify-content-center align-items-center">
                            <div class="form-container">
                                <h5 style="font-weight: bold">Date Range</h5>
                                <form id="budget-form" class="mt-3">
                                    @csrf
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="start-date" class="form-label">Start Date</label>
                                            <input type="date" class="form-control" id="master_start-date" name="start_date"
                                                placeholder="Enter Start Date" />
                                        </div>
                                        <div class="col-md-6">
                                            <label for="end-date" class="form-label">End Date</label>
                                            <input type="date" class="form-control" id="master_end-date" name="end_date"
                                                placeholder="Enter End Date" />
                                        </div>
                                    </div>
                                    <div class="text-center mt-4">
                                        <button type="submit" class="btn btn-submit"><i class="bi bi-floppy2-fill"></i> Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
    
                    <!-- Budget Sub Tab Content -->
                    <div class="tab-pane fade show active" id="budgetSub">
                        <div class="modal-body d-flex justify-content-center align-items-center">
                            <div class="form-container">
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
                                            <select class="form-select" name="department" id="department" aria-label="Default select example">
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
                                            <input type="number" class="form-control" id="no_of_employee" name="no_of_employee" placeholder="Employees Count" min="0" />
                                        </div>
                                        <div class="col-md-4">
                                            <label for="end-date" class="form-label">Basic Salary (Rs.)</label>
                                            <input type="number" class="form-control" id="basic_salary" name="basic_salary" placeholder="Basic Salary" min="0" />
                                        </div>
                                        <div class="col-md-1" style="display: flex; align-items: center; justify-content: center; margin-top: 30px;">
                                            <i class="bi bi-plus-lg"></i>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="end-date" class="form-label">Allowance (Rs.)</label>
                                            <input type="number" class="form-control" id="allowance" name="allowance" placeholder="Allowance" min="0" />
                                        </div>
                                    </div>
            
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-submit"><i class="bi bi-floppy2-fill"></i> Save</button>
                                    </div>
                                </form>
                            </div>
        
                        </div>
                    </div>
                </div>
    
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    
@endsection
@section('scripts')

    <script>
        //Budget Sub Form Submission
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
 
        // Budget Master Form Submission
        $(document).ready(function() {
            $('#budget-form').on('submit', function(e) {
                e.preventDefault();

                let startDate = $('#master_start-date').val();
                let endDate = $('#master_end-date').val();
                let token = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url: "{{ route('budget.store') }}",
                    type: "POST",
                    data: {
                        _token: token,
                        start_date: startDate,
                        end_date: endDate,
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Date Saved Successfully',
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
  
        // JavaScript to handle "check all" functionality of Table
        let table = new DataTable('#myTable');
    </script>
@endsection
