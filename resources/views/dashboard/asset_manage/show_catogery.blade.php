@extends('root')
@section('content')

<div style="margin-top: 50px">
    <h6 style="color:#007bff">Home <i class="bi bi-chevron-right"></i>Category Table</h6>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 style="font-weight: bold">Category Table</h3>
        <div class="position-relative w-25 search-box">
            <input type="text" class="form-control search-box" placeholder="Search..." />
            <i class="fas fa-search position-absolute" style="top: 50%; right: 10px; transform: translateY(-50%)"></i>
        </div>
    </div>
    <div class="flex mb-3">
        <button class="btn btn-primary" data-toggle="modal" data-target="#addCategoryModal"><i class="bi bi-plus"></i>
            Add
            New Category</button>
    </div>
    <table class="display" id="myTable">
        <thead>
            <tr>
                <th>#</th>
                <th>Category Name</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $category->category_name }}</td>
                    <td>{{ $category->created_at->format('Y-m-d') }}</td>
                    <td>

                        <button class="btn btn-warning btn-sm edit-category-btn" data-id="{{ $category->id }}">Edit</button>

                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                            style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm delete-btn">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">No categories found</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>

<div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addCategoryModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered custom-modal-width" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCategoryModalLabel" style="font-weight:600">Catogery Modal</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body d-flex justify-content-center align-items-center">
                <div class="form-container">
                    <h5 style="font-weight: bold">Add assets Catogery</h5>
                    <form id="addCategoryForm" class="mt-3" method="POST" action="{{ route('categories.store') }}">
                        @csrf

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label label-color">Enter category name</label>
                                <input type="text" class="form-control" name="category_name" id="category-name"
                                    placeholder="category name" />
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-submit"
                                    style="margin-top: 28px; margin-left: 150px;">Add
                                    Now</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>


    </div>
</div>



<!-- Edit Category Modal -->
<div class="modal fade" id="editCategoryModal" tabindex="-1" role="dialog" aria-labelledby="editCategoryModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered custom-modal-width" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCategoryModalLabel" style="font-weight:600">Update Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">&times;</span>
</button>
            </div>
            <div class="modal-body">
                <form id="updateCategoryForm" method="POST" action="">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="edit-category-id" name="id">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="edit-category-name" class="form-label label-color">Enter category name</label>
                            <input type="text" class="form-control" name="category_name" id="edit-category-name"
                                placeholder="Category name" required>
                        </div>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-submit"
                                style="margin-top: 28px; margin-left: 150px;">Update</button>
                        </div>
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

    // Handle form submission and show SweetAlert messages
    document.getElementById('addCategoryForm').addEventListener('submit', function (e) {
        e.preventDefault(); // Prevent default form submission

        const form = this;
        const formData = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            }
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success message
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: data.message,
                    }).then(() => {
                        // Close the modal

                        window.location.reload();

                        const modal = bootstrap.Modal.getInstance(document.getElementById('addCategoryModal'));

                    });
                } else {
                    // Show error message
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: data.message,
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'An error occurred while processing your request.',
                });
            });
    });

    // Handle delete button clicks
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault(); // Prevent default form submission

            const form = this.closest('form'); // Get the closest form

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the form if the user confirms
                    form.submit();
                }
            });
        });
    });


    // JavaScript to handle "check all" functionality
    // document.getElementById('check-all').addEventListener('change', function () {
    //     const checkboxes = document.querySelectorAll('.check-item');
    //     checkboxes.forEach(checkbox => {
    //         checkbox.checked = this.checked;
    //     });
    // });

   

    $(document).ready(function () {
        let table = new DataTable('#myTable', {
            responsive: true
        });
        console.log("🚀 ~ table:", table)
    // Open modal and load existing data
    $('.edit-category-btn').on('click', function () {
        var categoryId = $(this).data('id');
        $.ajax({
            url: '/categories/' + categoryId + '/edit',
            type: 'GET',
            success: function (response) {
                $('#edit-category-id').val(response.id);
                $('#edit-category-name').val(response.category_name);  // Corrected key
                $('#updateCategoryForm').attr('action', '/categories/' + categoryId);
                $('#editCategoryModal').modal('show');  // Ensure modal is triggered
            },
            error: function () {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Failed to fetch category data.',
                    confirmButtonColor: '#d33'
                });
            }
        });
    });

    // Handle form submission via AJAX
    $('#updateCategoryForm').on('submit', function (e) {
        e.preventDefault();

        var form = $(this);
        var categoryId = $('#edit-category-id').val();
        var formData = form.serialize();
        console.log(formData)
        $.ajax({
            url: '/categories/' + categoryId,
            type: 'PUT',
            data: formData,
            
            success: function (response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: 'Category updated successfully!',
                    confirmButtonColor: '#3085d6'
                }).then(() => {
                    $('#editCategoryModal').modal('hide');
                    location.reload();  
                });
            },
            error: function (xhr) {
                console.log(xhr.responseText);
                Swal.fire({
                    icon: 'error',
                    title: 'Update Failed!',
                    text: 'Failed to update category. Please try again.',
                    confirmButtonColor: '#d33'
                });
            }
        });
    });
});

$('.close, .btn-secondary').on('click', function () {
    $('#editCategoryModal').modal('hide');
});

</script>
@endsection