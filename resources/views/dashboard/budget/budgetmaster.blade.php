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
    </style>

    <div style="margin-top: 50px">
        <h6 style="color:#007bff">Home <i class="bi bi-chevron-right"></i> Budget Plan</h6>
        <h3 class="form-title" style="text-align: left;font-weight:bold">Budget Plan</h3>
        <div class="rectangle-wrapper">
            <div class="rectangle-background"></div>
            <div class="form-container">
                <h5 style="font-weight: bold">Date Range</h5>
                <form id="budget-form" class="mt-3">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="start-date" class="form-label">Start Date</label>
                            <input type="date" class="form-control" id="start-date" name="start_date"
                                placeholder="Enter Start Date" />
                        </div>
                        <div class="col-md-6">
                            <label for="end-date" class="form-label">End Date</label>
                            <input type="date" class="form-control" id="end-date" name="end_date"
                                placeholder="Enter End Date" />
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-submit">Proceed</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#budget-form').on('submit', function(e) {
                e.preventDefault();

                let startDate = $('#start-date').val();
                let endDate = $('#end-date').val();
                let token = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url: "{{ route('budget.store') }}",
                    type: "POST",
                    data: {
                        _token: token,
                        start_date: startDate,
                        end_date: endDate,
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Date Saved Successfully',
                            text: response.message,
                            showConfirmButton: false,
                            timer: 2000
                        })
                    },
                    error: function(xhr) {
                        let errorMessage = xhr.responseJSON?.message ||
                            'An unknown error occurred.';
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: errorMessage,
                            showConfirmButton: true,
                        });
                    }
                });
            });
        });
    </script>
@endsection
