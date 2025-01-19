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
            <form class="mt-3" method="POST" action="">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="location" class="form-label label-color">Select category</label>
                        <select class="form-select" id="Select_category">
                            <option selected>Select category</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="location" class="form-label label-color">Select sub category</label>
                        <select class="form-select" id="sub_category">
                            <option selected>Select sub category</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="brand" class="form-label label-color">Brand</label>
                        <input type="text" class="form-control" id="brand" placeholder="Enter Brand" />
                    </div>
                    <div class="col-md-6">
                        <label for="model" class="form-label label-color">Model</label>
                        <input type="text" class="form-control" id="model" placeholder="Enter model " />
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="serial number" class="form-label label-color">Assets serial number</label>
                        <input type="text" class="form-control" id="serial number" placeholder="Enter serial number" />
                    </div>
                    <div class="col-md-6">
                        <label for="asset code" class="form-label label-color">Assets code </label>
                        <input type="text" class="form-control" id="code" placeholder="Enter assets code " />
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="asset value" class="form-label label-color">Assets value</label>
                        <input type="text" class="form-control" id="asset value" placeholder="Enter assets value" />
                    </div>

                </div>
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-submit">Add Now</button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection