@extends('root')
@section('content')
    <style>
        /* Set blue background color for even rows */
        .table-striped tbody tr:nth-child(even) {
            background-color: blue; 
            color: white; /* Optional: Make text white for readability */
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
    </style>

    <div style="margin-top: 50px">
        <h6 style="color:#007bff">Home <i class="bi bi-chevron-right"></i> Budget Comparison</h6>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h3 style="font-weight: bold">Budget Comparison</h3>
            <div class="position-relative w-25 search-box">
              <input
                type="text"
                class="form-control search-box"
                placeholder="Search..."
              />
              <i
                class="fas fa-search position-absolute"
                style="top: 50%; right: 10px; transform: translateY(-50%)"
              ></i>
            </div>
          </div>
        <button class="btn btn-warning">Generate Report</button>
        <table class="table table-striped" style="margin-top: 30px">
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

    <script>
        // JavaScript to handle "check all" functionality
        document.getElementById('check-all').addEventListener('change', function() {
            const checkboxes = document.querySelectorAll('.check-item');
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });
    </script>
@endsection