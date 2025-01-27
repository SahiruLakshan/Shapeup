@extends('root')
@section('content')
<style>
    .form-container {
        position: relative;
        z-index: 1;
        padding: 40px;
        width: 100%;
        max-width: 900px;
        background-color: #fff;
        border-radius: 15px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
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
        border-radius: 15px;
        z-index: 0;
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
    <h6 style="color:#007bff">Home <i class="bi bi-chevron-right"></i> Update Asset</h6>
    <h3 class="form-title" style="text-align: left;font-weight:bold">Update Asset</h3>
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

            <h5 style="font-weight: bold">Update Asset Details</h5>
            <form class="mt-3" method="POST" action="{{ route('assets.update', $asset->id) }}">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="category" class="form-label label-color">Select Category</label>
                        <select class="form-select" id="category" name="category">
                            <option selected disabled>Select category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $asset->category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->category_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="sub_category" class="form-label label-color">Select Subcategory</label>
                        <select class="form-select" id="sub_category" name="sub_category">
                            <option selected disabled>Select subcategory</option>
                            @foreach($subCategories as $subCategory)
                                <option value="{{ $subCategory->id }}" {{ $asset->sub_category_id == $subCategory->id ? 'selected' : '' }}>
                                    {{ $subCategory->sub_category }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="brand" class="form-label label-color">Brand</label>
                        <input type="text" class="form-control" id="brand" name="brand" value="{{ $asset->brand }}" placeholder="Enter Brand" />
                    </div>
                    <div class="col-md-6">
                        <label for="model" class="form-label label-color">Model</label>
                        <input type="text" class="form-control" id="model" name="model" value="{{ $asset->model }}" placeholder="Enter Model" />
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="serial_number" class="form-label label-color">Asset Serial Number</label>
                        <input type="text" class="form-control" id="serial_number" name="serial_number" value="{{ $asset->serial_number }}" placeholder="Enter Serial Number" />
                    </div>
                    <div class="col-md-6">
                        <label for="code" class="form-label label-color">Asset Code</label>
                        <input type="text" class="form-control" id="code" name="code" value="{{ $asset->code }}" placeholder="Enter Asset Code" />
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="asset_value" class="form-label label-color">Asset Value</label>
                        <input type="text" class="form-control" id="asset_value" name="asset_value" value="{{ $asset->asset_value }}" placeholder="Enter Asset Value" />
                    </div>
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-submit">Update Asset</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        $('#category').on('change', function () {
            let categoryId = $(this).val();
            if (categoryId) {
                $.ajax({
                    url: "{{ route('get.subcategories') }}",
                    type: "GET",
                    data: { category_id: categoryId },
                    dataType: "json",
                    success: function (data) {
                        $('#sub_category').empty().append('<option selected disabled>Select subcategory</option>');
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
                $('#sub_category').empty().append('<option selected disabled>Select subcategory</option>');
            }
        });
    });
</script>

@endsection
