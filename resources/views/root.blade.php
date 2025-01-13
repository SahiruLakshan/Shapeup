<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ShapeUP Dashboard</title>
    <link crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body {
            font-family: "Arial", sans-serif;
            background-color: #f8f9fa;
        }

        .sidebar {
            background-color: #fff;
            height: auto;
            padding: 20px;
            border-right: 1px solid #e0e0e0;
        }

        .sidebar .nav-link {
            color: #333;
            font-weight: 500;
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .sidebar .nav-link i {
            margin-right: 15px;
            font-size: 18px;
        }

        .sidebar .nav-link.active {
            color: #007bff;
        }

        .sidebar .nav-link:hover {
            color: #007bff;
        }

        .content {
            padding: 20px;
        }

        .header {
            background-color: #e3f2fd;
            padding: 0 20px;
            border-radius: 15px;
            height: 50px;
        }

        .right-section .right {
            display: inline-flex;
            align-items: center;
            font-size: 16px;
            height: 100%;
            margin-right: 60px;
        }

        .right-section .right:last-child {
            margin-right: 0;
        }

        .header a {
            font-size: 16px;
        }

        .header .fa-bell {
            font-size: 18px;
        }

        .header .user-info img {
            width: 40px;
            height: 40px;
        }

        .header .position-relative span {
            width: 10px;
            height: 10px;
        }

        .col-2 {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 50px;
        }

        .header-center {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="d-flex flex-column flex-lg-row">
        @include('components.sidebar')
        <div class="content flex-grow-1">
            @include('components.navbar')
            <div class="container">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="{{ asset('js/graph.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
    <script crossorigin="anonymous" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+3i4l0I4zV9K5Gk5t5f5v5f5f5f5f"
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @yield('scripts')

    <!--SweetAlerts-->
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 1500
            });
        </script>
    @endif

    @if ($errors->any())
        <script>
            let errorList = '';
            @foreach ($errors->all() as $error)
                errorList += "<li>{{ $error }}</li>";
            @endforeach
            console.log(errorList);
            $(document).ready(function() {
                Swal.fire({
                    icon: 'error',
                    title: 'FAILED!',
                    html: errorList,
                    confirmButtonText: 'OK',
                    customClass: {
                        confirmButton: 'btn btn-danger'
                    }
                });
            });
        </script>
    @endif

    @if (session('warning'))
        <script>
            Swal.fire({
                icon: 'warning',
                title: 'Warning',
                text: '{{ session('warning') }}',
                showConfirmButton: false,
                timer: 1500
            });
        </script>
    @endif
</body>

</html>
