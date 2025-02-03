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


<!-- update Subcategory Modal -->
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
                <form id="updateSubCategoryForm" method="POST" action="{{ route('subcategories.update', ':id') }}">
                    @csrf
                    @method('PUT')

                    <input type="hidden" id="subcategory_id" name="subcategory_id">

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="category_id" class="form-label label-color">Select Category</label>
                            <select class="form-select" name="category_id" id="category_id">
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
    // Handle form submission using AJAX
    document.getElementById('addSubCategoryForm').addEventListener('submit', function (e) {
        e.preventDefault(); // Prevent default form submission

        const formData = new FormData(this);

        fetch("{{ route('subcategories.store') }}", {
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
                        window.location.reload(); // Reload the page to show the new subcategory
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

    function loadCategories() {
        fetch("{{ route('subcategories.index') }}")
            .then(response => response.json())
            .then(data => {
                let categoriesSelect = document.getElementById('category_id');
                categoriesSelect.innerHTML = '<option value="">Select Category</option>'; // Clear previous options

                data.categories.forEach(function (category) {
                    let option = document.createElement('option');
                    option.value = category.id;
                    option.textContent = category.category_name;
                    categoriesSelect.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    // Load categories when the page is ready
    document.addEventListener('DOMContentLoaded', function () {
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


    // Handle update form submission using AJAX
    document.getElementById('updateSubCategoryForm').addEventListener('submit', function (e) {
        e.preventDefault(); // Prevent default form submission

        const formData = new FormData(this);
        const subcategoryId = document.getElementById('subcategory_id').value; // Assuming you have a hidden input for subcategory ID

        fetch("{{ route('subcategories.update', ':id') }}".replace(':id', subcategoryId), {
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
                        window.location.reload(); // Reload the page to show the updated data
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



    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();

            const subcategoryId = this.getAttribute('data-id'); // Get subcategory ID

            // Use the correct URL for fetching the data
            fetch(`/subcategories/${subcategoryId}/edit`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const subcategory = data.subcategory; // Assuming data has subcategory and categories

                        // Populate the update form with the fetched subcategory details
                        document.getElementById('subcategory_id').value = subcategory.id;
                        document.getElementById('category_id').value = subcategory.category_id;
                        document.getElementById('sub_category').value = subcategory.sub_category;

                        // Show the update modal
                        $('#updateSubCategoryModal').modal('show');
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Failed to fetch subcategory details.',
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'An error occurred while fetching data.',
                    });
                });
        });
    });


</script>
@endsection