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
            margin: auto;
        }

        .btn-submit {
            background-color: #1bbddd;
            color: #fff;
            font-size: 16px;
            padding: 10px 40px;
            border: none;
            border-radius: 5px;
            width: 20%;
        }

        .btn-submit:hover {
            background-color: #17a2b8;
        }

        .rectangle-background {
            position: absolute;
            width: 1300px;
            height: 700px;
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
            padding-bottom: 50px;
        }

        .form-label {
            font-weight: bold;
        }

        .form-control {
            border-radius: 8px;
            height: 45px;
        }
    </style>

    <div style="margin-top: 50px">
        <h6 style="color:#007bff">Home <i class="bi bi-chevron-right"></i> Employee Management <i class="bi bi-chevron-right"></i> Insurance</h6>
        <h3 class="form-title" style="text-align: left;font-weight:bold">Insurance</h3>
        <div class="rectangle-wrapper">
            <div class="rectangle-background"></div>
            <div class="form-container">
                <h5 style="font-weight: bold">Add Insurance Company</h5>
                <form id="insurance-form" class="mt-3">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="company-name" class="form-label">Company Name</label>
                            <input type="text" class="form-control" id="company-name" name="company_name"
                                   placeholder="Enter Company Name" />
                        </div>
                        <div class="col-md-6">
                            <label for="company-email" class="form-label">Company Email</label>
                            <input type="email" class="form-control" id="company-email" name="company_email"
                                   placeholder="Enter Company Email" />
                        </div>
                    </div>

                    <div id="contact-person-section">
                        <!-- Contact Person Fields -->
                        @for ($i = 0; $i < 3; $i++)
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="contact-person-{{ $i }}" class="form-label">Contact Person</label>
                                    <input type="text" class="form-control" name="contact_person[]" placeholder="Enter Name">
                                </div>
                                <div class="col-md-4">
                                    <label for="contact-person-email-{{ $i }}" class="form-label">Contact Person Email</label>
                                    <input type="email" class="form-control" name="contact_person_email[]" placeholder="Enter Email">
                                </div>
                                <div class="col-md-4">
                                    <label for="contact-person-mobile-{{ $i }}" class="form-label">Contact Person Mobile No.</label>
                                    <input type="text" class="form-control" name="contact_person_mobile[]" placeholder="Enter Mobile No.">
                                </div>
                            </div>
                        @endfor
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
            $('#insurance-form').on('submit', function(e) {
                e.preventDefault();

                let formData = $(this).serialize();
                let token = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    url: "{{ route('insurance.store') }}",
                    type: "POST",
                    data: formData,
                    headers: { 'X-CSRF-TOKEN': token },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Insurance Company Added Successfully',
                            text: response.message,
                            showConfirmButton: false,
                            timer: 2000
                        })
                    },
                    error: function(xhr) {
                        let errorMessage = xhr.responseJSON?.message || 'An unknown error occurred.';
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
