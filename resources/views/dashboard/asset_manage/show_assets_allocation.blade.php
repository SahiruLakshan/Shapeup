@extends('root')
@section('content')

<div style="margin-top: 50px">
    <h6 style="color:#007bff">Home <i class="bi bi-chevron-right"></i> Budget Comparison</h6>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 style="font-weight: bold">Budget Comparison</h3>
        <div class="position-relative w-25 search-box">
            <input type="text" class="form-control search-box" placeholder="Search..." />
            <i class="fas fa-search position-absolute" style="top: 50%; right: 10px; transform: translateY(-50%)"></i>
        </div>
    </div>
    <div class="flex mb-3">
        <button class="btn btn-primary" data-toggle="modal" data-target="#addAssetModal">New Asset Allocation</button>

    </div>
    <table class="table table-bordered mt-5 table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Category</th>
                <th>Sub Category</th>
                <th>Company</th>
                <th>Location</th>
                <th>Branch</th>
                <th>Employee</th>
                <th>Asset Value</th>
                <th>Date</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($assetAllocations as $key => $allocation)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $allocation->category->category_name }}</td>
                    <td>{{ $allocation->subCategory->sub_category }}</td>
                    <td>{{ $allocation->company }}</td>
                    <td>{{ $allocation->location }}</td>
                    <td>{{ $allocation->branch }}</td>
                    <td>{{ $allocation->employee->emp_name_with_initial }}</td>
                    <td>{{ $allocation->value }}</td>
                    <td>{{ $allocation->date }}</td>
                    <td>{{ $allocation->description }}</td>
                    <td>
                        <a href="{{ route('asset-allocations.edit', $allocation->id) }}"
                            class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('asset-allocations.destroy', $allocation->id) }}" method="POST"
                            style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>





<!-- Modal HTML -->
<div class="modal fade" id="addAssetModal" tabindex="-1" role="dialog" aria-labelledby="addAssetModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered custom-modal-width" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addAssetModalLabel" style="font-weight:600">Add New Asset</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form content goes here -->
                <form class="mt-3" method="POST" action="{{ route('asset-allocations.store') }}">
                    @csrf

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="location" class="form-label label-color">Select category</label>
                            <!-- Category Dropdown -->
                            <select class="form-select" id="Select_category" name="Select_category">
                                <option selected disabled>Select category</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="Company" class="form-label label-color">Company</label>
                            <input type="text" class="form-control" id="Company" placeholder="Enter Company "
                                name="company" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="location" class="form-label label-color">Select sub category</label>
                            <select class="form-select" id="sub_category" name="sub_category">
                                <option selected disabled>Select sub category</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="location" class="form-label label-color">Location</label>
                            <input type="text" class="form-control" id="location" placeholder="Enter Location "
                                name="location" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="serial number" class="form-label label-color">Serial Number</label>
                            <select class="form-select" id="serial_number" name="serial_number">
                                <option value="">Select Serial Number</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="branch" class="form-label label-color">Branch</label>
                            <input type="text" class="form-control" id="branch" placeholder="Enter branch "
                                name="branch" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="asset_value" class="form-label label-color">Assets value</label>
                            <input type="text" class="form-control" id="asset_value" placeholder="Enter assets value"
                                name="value" />
                        </div>
                        <div class="col-md-6">
                            <label for="employee" class="form-label label-color">Employee name</label>
                            <select class="form-select" id="employee" name="employee_id">
                                <option selected disabled>Select Employee</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="date" class="form-label label-color">Date</label>
                            <input type="date" class="form-control" id="date" name="date"
                                value="{{ now()->toDateString() }}" />
                        </div>
                        <div class="col-md-6">
                            <label for="description" class="form-label label-color">Description</label>
                            <textarea class="form-control" id="description" rows="1" placeholder="Enter description"
                                name="description"></textarea>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-submit">Add Now</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>












<script>
    // Get Subcategories when category changes
    document.getElementById('Select_category').addEventListener('change', function () {
        fetch(`/get-subcategories/${this.value}`)
            .then(response => response.json())
            .then(data => {
                let options = '<option value="">Select sub category</option>';
                data.forEach(sub => options += `<option value="${sub.id}">${sub.sub_category}</option>`);
                document.getElementById('sub_category').innerHTML = options;
            });
    });

    // Get Assets when both category and subcategory are selected
    document.getElementById('sub_category').addEventListener('change', function () {
        const category = document.getElementById('Select_category').value;
        fetch(`/get-assets/${category}/${this.value}`)
            .then(response => response.json())
            .then(data => {
                let options = '<option value="">Select Serial Number</option>';
                data.forEach(asset => options += `<option value="${asset.serial_number}">${asset.serial_number}</option>`);
                document.getElementById('serial_number').innerHTML = options;
            });
    });

    // Get Asset Value when serial number is selected
    document.getElementById('serial_number').addEventListener('change', function () {
        fetch(`/get-asset-value/${this.value}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Asset not found');
                }
                return response.json();
            })
            .then(data => {
                document.getElementById('asset_value').value = data.value;
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('asset_value').value = ''; // Clear the value on error
            });
    });

    $(document).ready(function () {
        // When the "New Asset Allocation" button is clicked
        $('#newAssetBtn').on('click', function () {
            // Show the modal
            $('#addAssetModal').modal('show');
        });
    });


    // JavaScript to handle "check all" functionality
    document.getElementById('check-all').addEventListener('change', function () {
        const checkboxes = document.querySelectorAll('.check-item');
        checkboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });


    $(document).ready(function () {
    // Load categories and employees when the modal is shown
    $('#addAssetModal').on('show.bs.modal', function () {
        loadCategories();  // Load categories when modal opens
        loadEmployees();   // Load employees when modal opens
    });

    // Load subcategories when category changes
    $('#Select_category').on('change', function () {
        let categoryId = $(this).val();
        if (categoryId) {
            $.ajax({
                url: `/get-subcategories/${categoryId}`,
                method: 'GET',
                dataType: 'json',
                success: function (data) {
                    let options = '<option value="">Select sub category</option>';
                    $.each(data, function (index, sub) {
                        options += `<option value="${sub.id}">${sub.sub_category}</option>`;
                    });
                    $('#sub_category').html(options);
                    $('#serial_number').html('<option value="">Select Serial Number</option>');
                    $('#asset_value').val('');
                }
            });
        } else {
            $('#sub_category').html('<option value="">Select sub category</option>');
            $('#serial_number').html('<option value="">Select Serial Number</option>');
            $('#asset_value').val('');
        }
    });

    // Load serial numbers when both category and subcategory are selected
    $('#sub_category').on('change', function () {
        let categoryId = $('#Select_category').val();
        let subCategoryId = $(this).val();
        if (categoryId && subCategoryId) {
            $.ajax({
                url: `/get-assets/${categoryId}/${subCategoryId}`,
                method: 'GET',
                dataType: 'json',
                success: function (data) {
                    let options = '<option value="">Select Serial Number</option>';
                    $.each(data, function (index, asset) {
                        options += `<option value="${asset.serial_number}">${asset.serial_number}</option>`;
                    });
                    $('#serial_number').html(options);
                    $('#asset_value').val('');
                }
            });
        }
    });

    // Load asset value when serial number is selected
    $('#serial_number').on('change', function () {
        let serialNumber = $(this).val();
        if (serialNumber) {
            $.ajax({
                url: `/get-asset-value/${serialNumber}`,
                method: 'GET',
                dataType: 'json',
                success: function (data) {
                    $('#asset_value').val(data.value);
                },
                error: function () {
                    $('#asset_value').val('');
                }
            });
        }
    });
});

// Function to load categories
function loadCategories() {
    $.ajax({
        url: '/get-categories', // Adjust if needed for correct route
        method: 'GET',
        success: function (response) {
            $('#Select_category').empty().append('<option selected disabled>Select category</option>');
            $.each(response, function (key, category) {
                $('#Select_category').append('<option value="' + category.id + '">' + category.category_name + '</option>');
            });
        },
        error: function () {
            alert('Error loading categories.');
        }
    });
}

// Function to load employees
function loadEmployees() {
    $.ajax({
        url: '/get-employees', // Adjust if needed for correct route
        method: 'GET',
        success: function (response) {
            $('#employee').empty().append('<option selected disabled>Select Employee</option>');
            $.each(response, function (key, employee) {
                $('#employee').append('<option value="' + employee.id + '">' + employee.emp_name_with_initial + '</option>');
            });
        },
        error: function () {
            alert('Error loading employees.');
        }
    });
}

</script>
@endsection