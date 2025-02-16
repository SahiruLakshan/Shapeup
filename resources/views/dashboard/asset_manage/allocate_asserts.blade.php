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
        height: 400px;
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

    .label-color {
        color: #D5D5D5;
    }
</style>

<div style="margin-top: 50px">

    <h6 style="color:#007bff">Home <i class="bi bi-chevron-right"></i> Assets allocation  </h6>
    <h3 class="form-title" style="text-align: left;font-weight:bold">Assets allocation  </h3>
    <div class="rectangle-wrapper">
        <div class="rectangle-background"></div>
        <div class="form-container">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <h5 style="font-weight: bold">Assets allocation</h5>
            <form class="mt-3" method="POST" action="{{ route('asset-allocations.store') }}">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="location" class="form-label label-color">Select category</label>
                        <select class="form-select" id="Select_category" name="Select_category">
                            <option value="">Select category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
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
                            <option value="">Select sub category</option>
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
                        <label for="branch" class="form-label label-color">Branch </label>
                        <input type="text" class="form-control" id="branch" placeholder="Enter branch " name="branch" />
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
                            <option value="">Select Employee</option>
                            @foreach($employees as $employee)
                                <option value="{{ $employee->id }}">{{ $employee->emp_name_with_initial }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                    <label for="date" class="form-label label-color">Date</label>
                    <input type="date" class="form-control" id="date" name="date" value="{{ now()->toDateString() }}" />
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
    </div>
</div>

<!-- Add these scripts at the end of your form -->
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
</script>

@endsection