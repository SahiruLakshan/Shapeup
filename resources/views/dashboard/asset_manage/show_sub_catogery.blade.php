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
        <button class="btn btn-primary" data-toggle="modal" data-target="#addSubCategoryModal"><i
                class="bi bi-plus"></i>
            Add New Subcategory
        </button>
    </div>
    <table class="table table-bordered mt-2 table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Catogery Name</th>
                <th>Sub catogery Name</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
                @foreach($category->subcategories as $subcategory)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $category->category_name }}</td>
                        <td>{{ $subcategory->sub_category }}</td>
                        <td>{{ $subcategory->created_at->format('Y-m-d') }}</td>
                        <td>
                            <a href="#" data-id="{{ $subcategory->id }}" class="btn btn-warning btn-sm edit-btn">Edit</a>

                            <form action="{{ route('subcategories.destroy', $subcategory->id) }}" method="POST"
                                style="display: inline-block;" id="deleteForm-{{ $subcategory->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger btn-sm delete-btn"
                                    data-id="{{ $subcategory->id }}">Delete</button>
                            </form>

                        </td>

                    </tr>
                @endforeach
            @empty
                <tr>
                    <td colspan="5" class="text-center">No subcategories found</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>

<!-- Add Subcategory Modal -->
<div class="modal fade" id="addSubCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addSubCategoryModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered custom-modal-width" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSubCategoryModalLabel" style="font-weight:600">Add Subcategory</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addSubCategoryForm">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="category_id" class="form-label label-color">Select Category</label>
                            <select class="form-select" id="category_id" name="category_id" required>
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="sub_category" class="form-label label-color">Subcategory Name</label>
                            <input type="text" class="form-control" id="sub_category" name="sub_category" required
                                placeholder="Enter subcategory name">
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


<!-- Update Subcategory Modal -->
<div class="modal fade" id="updateSubCategoryModal" tabindex="-1" role="dialog"
    aria-labelledby="updateSubCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered custom-modal-width" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateSubCategoryModalLabel" style="font-weight:600">Update Subcategory</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="updateSubCategoryForm" method="POST" action="">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="subcategory_id" name="subcategory_id"> 
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="edit_category_id" class="form-label label-color">Select Category</label>
                            <select class="form-select" id="edit_category_id" name="category_id" required>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                            
                        </div>
                        <div class="col-md-6">
                            <label for="edit_sub_category" class="form-label label-color">Subcategory Name</label>
                            <input type="text" class="form-control" id="edit_sub_category" name="sub_category" required
                                placeholder="Enter subcategory name">
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-submit">Update Now</button>
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
    // Handle form submission using AJAX
    $('#addSubCategoryForm').submit(function (e) {
        e.preventDefault(); // Prevent default form submission

        const formData = new FormData(this);

        $.ajax({
            url: "{{ route('subcategories.store') }}",
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            },
            success: function (data) {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: data.message,
                    }).then(() => {
                        location.reload(); // Reload the page to show the new subcategory
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: data.message,
                    });
                }
            },
            error: function (xhr, status, error) {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'An error occurred while processing your request.',
                });
            }
        });
    });

    // Load categories function
    function loadCategories() {
        $.ajax({
            url: "{{ route('subcategories.index') }}",
            method: 'GET',
            dataType: 'json',
            success: function (data) {
                let categoriesSelect = $('#category_id');
                categoriesSelect.empty().append('<option value="">Select Category</option>');

                $.each(data.categories, function (index, category) {
                    categoriesSelect.append(`<option value="${category.id}">${category.category_name}</option>`);
                });
            },
            error: function (xhr, status, error) {
                console.error('Error:', error);
            }
        });
    }

    // Load categories when the page is ready
    loadCategories();
});


    document.addEventListener('DOMContentLoaded', function () {
        // Your delete functionality here
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();

                const subcategoryId = this.getAttribute('data-id');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('deleteForm-' + subcategoryId).submit();
                    }
                });
            });
        });
    });


// JavaScript
$(document).ready(function () {
        // Handle edit button click
        $(document).on('click', '.edit-btn', function (e) {
            e.preventDefault();
            const subcategoryId = $(this).data('id');

            // Fetch subcategory details via AJAX
            $.ajax({
                url: `/subcategories/${subcategoryId}/edit`,
                method: 'GET',
                success: function (response) {
                    if (response.success) {
                        const subcategory = response.subcategory;

                        // Populate the update modal fields
                        $('#subcategory_id').val(subcategory.id);
                        $('#edit_category_id').val(subcategory.category_id);
                        $('#edit_sub_category').val(subcategory.sub_category);

                        // Update the form action URL
                        $('#updateSubCategoryForm').attr('action', `/subcategories/${subcategoryId}`);

                        // Show the update modal
                        $('#updateSubCategoryModal').modal('show');
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: response.message,
                        });
                    }
                },
                error: function (error) {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'An error occurred while fetching data.',
                    });
                }
            });
        });

        // Handle update form submission
        $('#updateSubCategoryForm').on('submit', function (e) {
            e.preventDefault();
            const form = $(this);
            const actionUrl = form.attr('action');
            const formData = form.serialize();

            $.ajax({
                url: actionUrl,
                method: 'POST',
                data: formData,
                success: function (response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: response.message,
                        }).then(() => {
                            $('#updateSubCategoryModal').modal('hide'); 
                            window.location.reload(); // Reload the page to reflect changes
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: response.message,
                        });
                    }
                },
                error: function (error) {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'An error occurred while updating data.',
                    });
                }
            });
        });
    });
    $('#updateSubCategoryModal').on('hidden.bs.modal', function () {  
    $(this).find('form')[0].reset();  
});


</script>
@endsection