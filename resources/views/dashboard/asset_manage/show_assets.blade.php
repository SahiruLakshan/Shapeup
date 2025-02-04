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
        <button class="btn btn-primary" data-toggle="modal" data-target="#addAssetModal">Add New Asset</button>

    </div>
    <table class="table table-bordered mt-2 table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Category</th>
                <th>Sub Category</th>
                <th>Brand</th>
                <th>Model</th>
                <th>Serial Number</th>
                <th>Asset Code</th>
                <th>Asset Value</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($assets as $key => $asset)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $asset->category->category_name }}</td>
                    <td>{{ $asset->subCategory->sub_category }}</td>
                    <td>{{ $asset->brand }}</td>
                    <td>{{ $asset->model }}</td>
                    <td>{{ $asset->serial_number }}</td>
                    <td>{{ $asset->code }}</td>
                    <td>{{ $asset->asset_value }}</td>
                    <td>
                        <a href="javascript:void(0)" class="btn btn-warning btn-sm" data-toggle="modal"
                            data-target="#editAssetModal" data-id="{{ $asset->id }}">
                            Edit
                        </a>
                        <form action="{{ route('assets.destroy', $asset->id) }}" method="POST"
                            style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-sm btn-danger" onclick="deleteAsset(event)">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>


<!-- Add New Asset Modal -->
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
                <form id="addAssetForm" method="POST" action="{{ route('assets.store') }}">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="category" class="form-label label-color">Select category</label>
                            <select class="form-select" id="category" name="category_id" required>
                                <option selected disabled>Loading categories...</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="sub_category" class="form-label label-color">Select sub category</label>
                            <select class="form-select" id="sub_category" name="sub_category_id" required>
                                <option selected disabled>Select sub category</option>
                                <!-- Subcategories will be populated dynamically -->
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="brand" class="form-label label-color">Brand</label>
                            <input type="text" class="form-control" id="brand" name="brand" required />
                        </div>
                        <div class="col-md-6">
                            <label for="model" class="form-label label-color">Model</label>
                            <input type="text" class="form-control" id="model" name="model" required />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="serial_number" class="form-label label-color">Serial Number</label>
                            <input type="text" class="form-control" id="serial_number" name="serial_number" required />
                        </div>
                        <div class="col-md-6">
                            <label for="code" class="form-label label-color">Asset Code</label>
                            <input type="text" class="form-control" id="code" name="code" required />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="asset_value" class="form-label label-color">Asset Value</label>
                            <input type="text" class="form-control" id="asset_value" name="asset_value" required />
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary">Add Now</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<!-- Edit Asset Modal -->
<!-- Edit Asset Modal -->
<div class="modal fade" id="editAssetModal" tabindex="-1" role="dialog" aria-labelledby="editAssetModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered custom-modal-width" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editAssetModalLabel">Update Asset</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="updateAssetForm" method="POST" action="" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="category" class="form-label">Category</label>
                            <select class="form-select" id="category" name="category_id" required>
                                <!-- Categories will be populated dynamically -->
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="sub_category" class="form-label">Sub Category</label>
                            <select class="form-select" id="sub_category" name="sub_category_id" required>
                                <!-- Subcategories will be populated dynamically -->
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="brand" class="form-label">Brand</label>
                            <input type="text" class="form-control" id="brand" name="brand" required />
                        </div>
                        <div class="col-md-6">
                            <label for="model" class="form-label">Model</label>
                            <input type="text" class="form-control" id="model" name="model" required />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="serial_number" class="form-label">Serial Number</label>
                            <input type="text" class="form-control" id="serial_number" name="serial_number" required />
                        </div>
                        <div class="col-md-6">
                            <label for="code" class="form-label">Asset Code</label>
                            <input type="text" class="form-control" id="code" name="code" required />
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="asset_value" class="form-label">Asset Value</label>
                            <input type="text" class="form-control" id="asset_value" name="asset_value" required />
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary">Update Now</button>
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
    $(document).ready(function () {
        // Trigger category load when the modal opens
        $('#addAssetModal').on('shown.bs.modal', function () {
            loadCategories();
        });

        // Function to load categories
        function loadCategories() {
            $.ajax({
                url: '/get-categories',
                method: 'GET',
                success: function (response) {
                    $('#category').empty().append('<option selected disabled>Select category</option>');
                    $.each(response, function (key, category) {
                        $('#category').append('<option value="' + category.id + '">' + category.category_name + '</option>');
                    });
                },
                error: function () {
                    alert('Error loading categories.');
                }
            });
        }

        // Load subcategories when a category is selected
        $('#category').on('change', function () {
            var categoryId = $(this).val();

            if (categoryId) {
                $.ajax({
                    url: '/get-subcategories',
                    method: 'GET',
                    data: { category_id: categoryId },
                    success: function (response) {
                        $('#sub_category').empty().append('<option selected disabled>Select sub category</option>');
                        $.each(response, function (key, subcategory) {
                            $('#sub_category').append('<option value="' + subcategory.id + '">' + subcategory.sub_category + '</option>');
                        });
                    },
                    error: function () {
                        alert('Error fetching subcategories.');
                    }
                });
            }
        });
    });
    function deleteAsset(event) {
        event.preventDefault(); // Prevent the form from submitting immediately

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // If confirmed, submit the form
                event.target.closest('form').submit();
            }
        });
    }
    // JavaScript to handle "check all" functionality
    document.getElementById('check-all').addEventListener('change', function () {
        const checkboxes = document.querySelectorAll('.check-item');
        checkboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });


    //update
    $(document).ready(function() {
    // Triggered when the modal is shown
    $('#editAssetModal').on('show.bs.modal', function(e) {
        var assetId = $(e.relatedTarget).data('id');  // Get asset ID from button data-id
        var modal = $(this);
        console.log('Modal triggered, assetId:', assetId);  // Log assetId to console

        // Make AJAX request to get asset data, categories, and subcategories
        $.ajax({
            url: '/assets/edit/' + assetId,  // Controller route to fetch data
            method: 'GET',
            success: function(data) {
                console.log('Data received:', data);
                var categories = data.categories;
                var subCategories = data.subCategories;
                var asset = data.asset;

                // Clear and populate the categories dropdown
                $('#category').empty().append('<option selected disabled>Select Category</option>');
                categories.forEach(function(category) {
                    $('#category').append('<option value="' + category.id + '" ' + (category.id == asset.category_id ? 'selected' : '') + '>' + category.name + '</option>');
                });

                // Clear and populate the subcategories dropdown
                $('#sub_category').empty().append('<option selected disabled>Select Sub Category</option>');
                subCategories.forEach(function(subCategory) {
                    $('#sub_category').append('<option value="' + subCategory.id + '" ' + (subCategory.id == asset.sub_category_id ? 'selected' : '') + '>' + subCategory.name + '</option>');
                });

                // Populate other form fields with the asset's current data
                modal.find('#brand').val(asset.brand);
                modal.find('#model').val(asset.model);
                modal.find('#serial_number').val(asset.serial_number);
                modal.find('#code').val(asset.code);
                modal.find('#asset_value').val(asset.asset_value);

                // Update the form's action URL to include the asset ID
                modal.find('form').attr('action', '/assets/update/' + assetId);
            },
            error: function(xhr) {
                alert('Error fetching asset data!');
            }
        });
    });

    // Handle form submission using AJAX
    $('#updateAssetForm').on('submit', function(e) {
        e.preventDefault();
        var form = $(this);
        var formData = form.serialize();

        $.ajax({
            url: form.attr('action'),
            method: 'PUT',
            data: formData,
            success: function(response) {
                $('#editAssetModal').modal('hide'); // Close the modal
                alert(response.success); // Show success message
                location.reload(); // Reload the page
            },
            error: function(xhr) {
                alert('Error updating asset!');
            }
        });
    });
});


</script>
@endsection