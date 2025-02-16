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

    <h6 style="color:#007bff">Home <i class="bi bi-chevron-right"></i> Update Assets Sub Category</h6>
    <h3 class="form-title" style="text-align: left; font-weight: bold">Update Assets Sub Category</h3>
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

            <h5 style="font-weight: bold">Edit Assets Sub Category</h5>
            <form class="mt-3" method="POST" action="{{ route('subcategories.update', $subcategory->id) }}">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label label-color">Select Category </label>
                            <select class="form-select" name="category_id">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $subcategory->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->category_name }}
                                    </option>
                                @endforeach
                            </select>

                        </div>
                        <div class="col-md-6">
                            <label for="sub_category" class="form-label label-color">Enter Sub Category </label>
                            <input type="text" class="form-control" id="sub_category" name="sub_category"
                                value="{{ $subcategory->sub_category }}" placeholder="Enter sub category" />
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-submit">Update Now</button>
                    </div>
            </form>
        </div>
    </div>
</div>
@endsection