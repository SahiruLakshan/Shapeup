@extends('root')
@section('content')

<div style="margin-top: 50px">
    <h6 style="color:#007bff">Home <i class="bi bi-chevron-right"></i> New Asset Allocation</h6>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 style="font-weight: bold">Asset Allocation</h3>
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
                        <a href="#" class="btn btn-warning btn-sm edit-btn" data-id="{{ $allocation->id }}"
                            data-toggle="modal" data-target="#updateAssetModal">Edit</a>

                        <form id="deleteAssetForm-{{ $allocation->id }}"
                            action="{{ route('asset-allocations.destroy', $allocation->id) }}" method="POST"
                            style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-sm btn-danger"
                                onclick="confirmDelete({{ $allocation->id }})">
                                Delete
                            </button>
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






<!-- Update Asset Modal -->
<div class="modal fade" id="updateAssetModal" tabindex="-1" role="dialog" aria-labelledby="updateAssetModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered custom-modal-width" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateAssetModalLabel" style="font-weight:600">Update Asset allocation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="mt-3" id="updateAssetForm" method="POST">
                    @csrf
                    @method('PUT')

                    <input type="hidden" id="asset_idUpdate" name="asset_id" />

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="Select_category" class="form-label label-color">Select category</label>
                            <select class="form-select" id="Select_categoryUpdate" name="Select_category"></select>
                        </div>
                        <div class="col-md-6">
                            <label for="Company" class="form-label label-color">Company</label>
                            <input type="text" class="form-control" id="CompanyUpdate" name="company" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="sub_category" class="form-label label-color">Select sub category</label>
                            <select class="form-select" id="sub_categoryUpdate" name="sub_category"></select>
                        </div>
                        <div class="col-md-6">
                            <label for="location" class="form-label label-color">Location</label>
                            <input type="text" class="form-control" id="locationUpdate" name="location" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="serial_number" class="form-label label-color">Serial Number</label>
                            <select class="form-select" id="serial_numberUpdate" name="serial_number"></select>
                        </div>
                        <div class="col-md-6">
                            <label for="branch" class="form-label label-color">Branch</label>
                            <input type="text" class="form-control" id="branchUpdate" name="branch" />
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="asset_value" class="form-label label-color">Asset Value</label>
                            <input type="text" class="form-control" id="asset_valueUpdate" name="value" />
                        </div>
                        <div class="col-md-6">
                            <label for="employee" class="form-label label-color">Employee Name</label>
                            <select class="form-select" id="employeeUpdate" name="employee_id"></select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="date" class="form-label label-color">Date</label>
                            <input type="date" class="form-control" id="dateUpdate" name="date" />
                        </div>
                        <div class="col-md-6">
                            <label for="description" class="form-label label-color">Description</label>
                            <textarea class="form-control" id="descriptionUpdate" name="description"
                                rows="1"></textarea>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-submit">Update</button>
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
    // document.getElementById('check-all').addEventListener('change', function () {
    //     const checkboxes = document.querySelectorAll('.check-item');
    //     checkboxes.forEach(checkbox => {
    //         checkbox.checked = this.checked;
    //     });
    // });


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
            url: '/get-employees',
            method: 'GET',
            success: function (response) {
                $('#employee').empty().append('<option selected disabled>Select Employee</option>');
                $.each(response, function (id, name) {
                    $('#employee').append('<option value="' + id + '">' + name + '</option>');
                });
            },
            error: function () {
                alert('Error loading employees.');
            }
        });
    }


    //update

    $(document).on('click', '.edit-btn', function (event) {
        const assetId = $(this).data('id'); // Extract the asset ID from the data-id attribute

        $.ajax({
            url: `/asset-allocations/${assetId}/edit`,
            method: 'GET',
            success: function (data) {
                console.log(data);

                // Fill the form fields with existing data
                $('#asset_idUpdate').val(data.assetAllocation.id);
                $('#Select_categoryUpdate').val(data.assetAllocation.category_id);
                $('#CompanyUpdate').val(data.assetAllocation.company);
                $('#locationUpdate').val(data.assetAllocation.location);
                $('#branchUpdate').val(data.assetAllocation.branch);
                $('#asset_valueUpdate').val(data.assetAllocation.value);
                $('#descriptionUpdate').val(data.assetAllocation.description);
                $('#dateUpdate').val(data.assetAllocation.date);

                // Populate employees dropdown
                $('#employeeUpdate').empty().append('<option selected disabled>Select Employee</option>');
                $.each(data.employees, function (id, name) {
                    $('#employeeUpdate').append('<option value="' + id + '"' + (id == data.assetAllocation.employee_id ? ' selected' : '') + '>' + name + '</option>');
                });

                // Populate categories dropdown
                $('#Select_categoryUpdate').empty().append('<option selected disabled>Select Category</option>');
                $(data.categories).each(function (index, category) {
                    $('#Select_categoryUpdate').append(`<option value="${category.id}" ${category.id == data.assetAllocation.category_id ? 'selected' : ''}>${category.category_name}</option>`);
                });

                // Populate subcategories dropdown
                $('#sub_categoryUpdate').empty().append('<option selected disabled>Select Subcategory</option>');
                data.subcategories.forEach(function (category) {
                    $('#sub_categoryUpdate').append('<option value="' + category.id + '"' + (category.id == data.assetAllocation.sub_category_id ? ' selected' : '') + '>' + category.sub_category + '</option>');
                });

                // Populate serial numbers dropdown
                $('#serial_numberUpdate').empty().append('<option selected disabled>Select Serial Number</option>');
                data.assets.forEach(function (asset) {
                    $('#serial_numberUpdate').append('<option value="' + asset.serial_number + '"' + (asset.serial_number == data.assetAllocation.serial_number ? ' selected' : '') + '>' + asset.serial_number + '</option>');
                });

                // Show the modal
                $('#updateAssetModal').modal('show');
            },
            error: function (xhr, status, error) {
                console.error("Error fetching asset data: ", error);
            }
        });
    });

    $(document).ready(function () {
        // Get Subcategories when category changes
        $('#Select_categoryUpdate').on('change', function () {
            const categoryId = $(this).val();
            $.ajax({
                url: `/get-subcategories/${categoryId}`,
                method: 'GET',
                success: function (data) {
                    let options = '<option value="">Select sub category</option>';
                    data.forEach(sub => options += `<option value="${sub.id}">${sub.sub_category}</option>`);
                    $('#sub_categoryUpdate').html(options);
                }
            });
        });

        // Get Assets when both category and subcategory are selected
        $('#sub_categoryUpdate').on('change', function () {
            const category = $('#Select_categoryUpdate').val();
            const subCategory = $(this).val();
            $.ajax({
                url: `/get-assets/${category}/${subCategory}`,
                method: 'GET',
                success: function (data) {
                    let options = '<option value="">Select Serial Number</option>';
                    data.forEach(asset => options += `<option value="${asset.serial_number}">${asset.serial_number}</option>`);
                    $('#serial_numberUpdate').html(options);
                }
            });
        });

        // Get Asset Value when serial number is selected
        $('#serial_numberUpdate').on('change', function () {
            const serialNumber = $(this).val();
            $.ajax({
                url: `/get-asset-value/${serialNumber}`,
                method: 'GET',
                success: function (data) {
                    $('#asset_valueUpdate').val(data.value);
                }
            });
        });

        // Handle form submission
        $('#updateAssetForm').on('submit', function (e) {
            e.preventDefault();
            const assetId = $('#asset_idUpdate').val();
            $.ajax({
                url: `/asset-allocations/${assetId}`,
                method: 'PUT',
                data: $(this).serialize(),
                success: function (response) {
                    Swal.fire({
                        title: "Success!",
                        text: "Asset allocation updated successfully.",
                        icon: "success",
                        confirmButtonText: "OK"
                    }).then(() => {
                        $('#updateAssetModal').modal('hide');
                        location.reload(); // Reload the page to reflect changes
                    });
                },
                error: function (xhr, status, error) {
                    console.error("Error updating asset allocation: ", error);
                    Swal.fire({
                        title: "Error!",
                        text: "Failed to update asset allocation. Please try again.",
                        icon: "error",
                        confirmButtonText: "OK"
                    });
                }
            });
        });
    });
    function confirmDelete(assetId) {
        Swal.fire({
            title: "Are you sure?",
            text: "This action cannot be undone!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`deleteAssetForm-${assetId}`).submit();
            }
        });
    }
</script>
@endsection