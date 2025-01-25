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

    <h6 style="color:#007bff">Home <i class="bi bi-chevron-right"></i> Add New Asset  </h6>
    <h3 class="form-title" style="text-align: left;font-weight:bold">Add New Asset  </h3>
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


            <h5 style="font-weight: bold"> Add New Asset</h5>
            <form class="mt-3" method="POST" action="{{ route('assets.store') }}">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="location" class="form-label label-color">Select category</label>
                        <select class="form-select" aria-label="Default select example" id="category" name="category">
                            <option selected disabled>Select category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                        
                    </div>
                    <div class="col-md-6">
                        <label for="location" class="form-label label-color">Select sub category</label>
                        <select class="form-select" id="sub_category" name="sub_category">
                            <option selected disabled>Select sub category</option>
                            <!-- Subcategories will be populated via AJAX -->
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="brand" class="form-label label-color">Brand</label>
                        <input type="text" class="form-control" id="brand" placeholder="Enter Brand" name="brand" />
                    </div>
                    <div class="col-md-6">
                        <label for="model" class="form-label label-color">Model</label>
                        <input type="text" class="form-control" id="model" placeholder="Enter model " name="model" />
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="serial number" class="form-label label-color">Assets serial number</label>
                        <input type="text" class="form-control" id="serial number" placeholder="Enter serial number"
                            name="serial_number" />
                    </div>
                    <div class="col-md-6">
                        <label for="asset code" class="form-label label-color">Assets code </label>
                        <input type="text" class="form-control" id="code" placeholder="Enter assets code "
                            name="code" />
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="asset value" class="form-label label-color">Assets value</label>
                        <input type="text" class="form-control" id="asset value" placeholder="Enter assets value"
                            name="asset_value" />
                    </div>

                </div>
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-submit">Add Now</button>
                </div>

            </form>
        </div>
    </div>
</div>
<!-- jQuery Script for AJAX -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        $('#category').on('change', function () {
            let categoryId = $(this).val();

            if (categoryId) {
                $.ajax({
                    url: "{{ route('get.subcategories') }}",  // Ensure this route exists in web.php
                    type: "GET",
                    data: { category_id: categoryId },
                    dataType: "json",
                    success: function (data) {
                        console.log('Subcategories:', data);  // Debugging output
                        $('#sub_category').empty().append('<option selected disabled>Select sub category</option>');
                        if (data.length > 0) {
                            $.each(data, function (key, value) {
                                $('#sub_category').append('<option value="' + value.id + '">' + value.sub_category + '</option>');
                            });
                        } else {
                            $('#sub_category').append('<option selected disabled>No subcategories found</option>');
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error('AJAX Error:', error);
                        alert('Something went wrong. Please try again.');
                    }
                });
            } else {
                $('#sub_category').empty().append('<option selected disabled>Select sub category</option>');
            }
        });
    });
</script>



@endsection