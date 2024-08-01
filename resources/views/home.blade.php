<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.all.min.js"></script>

</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">

        <div class="container-fluid">

            <a class="navbar-brand mt-2 mt-lg-0" href="#">
                <h5 class="pt-1">Robust Teacher</h5>
            </a>

            <button data-mdb-button-init class="navbar-toggler" type="button" data-mdb-collapse-init
                data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>


            <div class="d-flex">

                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                    </li>
                </ul>



                <div class="d-flex align-items-center justify-content-start">

                    <a class="text-reset me-3" href="#">
                        <i class="fas fa-shopping-cart text-white"></i>
                    </a>


                </div>
            </div>
        </div>

    </nav>
    <!-- Navbar -->

    <div class="container mb-4">
        <table class="table align-middle mb-0 bg-white">
            <thead class="bg-light">
                <tr style="text-align: center">
                    <th>Name</th>
                    <th>Subject</th>
                    <th>Mark</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @if ($student->isEmpty())
                    <tr>
                        <td colspan="4" style="text-align: center">No Data Found</td>
                    </tr>
                @else
                    @foreach ($student as $item)
                        <tr style="text-align: center">
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="ms-3">
                                        <p class="fw-bold mb-1">{{ $item->studentName }}</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p class="fw-normal mb-1">{{ $item->subject }}</p>
                            </td>
                            <td>{{ $item->mark }}</td>
                            <td>
                                <button type="button" class="btn btn-info btn-sm btn-rounded" data-bs-toggle="modal"
                                    data-bs-target="#editModal{{ $item->id }}">
                                    Edit
                                </button>
                                <button type="button" class="btn btn-danger btn-sm btn-rounded"
                                    data-id="{{ $item->id }}" id="deleteButton">
                                    Delete
                                </button>
                            </td>
                        </tr>

                        <!-- Modal Structure -->
                        <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1"
                            aria-labelledby="editModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel">Edit Student</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="subjectForm{{ $item->id }}">
                                            @csrf
                                            <div class="row mb-3">
                                                <label for="name" class="col-sm-3 col-form-label">Name *</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="name"
                                                        name="name" value="{{ $item->studentName }}">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="subject" class="col-sm-3 col-form-label">Subject *</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="subject"
                                                        name="subject" value="{{ $item->subject }}">
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="mark" class="col-sm-3 col-form-label">Mark *</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="mark"
                                                        name="mark" value="{{ $item->mark }}">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="button" id="updatebutton"
                                            onclick="updateform({{ $item->id }})" data-id="{{ $item->id }}"
                                            class="btn btn-info">Update</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

            </tbody>
        </table>
    </div>
    <div class="container button">
        <button class="btn btn-info" id="addbutton" data-bs-toggle="modal"
            data-bs-target="#studentModal">Add</button>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="studentModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Student</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="message" id="message'"></div>
                    <form id="subjectForm">
                        @csrf
                        <div class="row mb-3">
                            <label for="name" class="col-sm-3 col-form-label">Name *</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="name" name="name">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="subject" class="col-sm-3 col-form-label">Subject *</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="subject" name="subject">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="mark" class="col-sm-3 col-form-label">Mark *</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="mark" name="mark">
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>
<script>
    function updateform(ids) {
        var toastMixin = Swal.mixin({
            toast: true,
            position: 'top-right',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });
        // e.preventDefault();
        console.log("vimal", ids);
        var id = ids;
        $.ajax({
            url: `/studentupdate/${id}`,
            type: 'POST',
            data: $("#subjectForm" + id).serialize(),
            success: function(response) {
                console.log(response);
                $('#editModal' + id).modal('hide');
                toastMixin.fire({
                    title: response.message,
                    icon: 'success'
                });
                window.location.reload();
            },
            error: function(xhr) {
                let errors = xhr.responseJSON.errors;
                let errorMessages = '';
                $.each(errors, function(key, value) {
                    errorMessages += value[0] + '<br>';
                    toastMixin.fire({
                        title: errorMessages,
                        icon: 'error'
                    });
                });

            }
        });
    };

    $(document).ready(function() {
        var toastMixin = Swal.mixin({
            toast: true,
            position: 'top-right',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        $('#subjectForm').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: "{{ route('addstudent') }}", // URL to send the request to
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    console.log(response);
                    $('#studentModal').modal('hide');
                    toastMixin.fire({
                        title: response.message,
                        icon: 'success'
                    });
                    $('#subjectForm')[0].reset();
                    window.location.reload();
                },
                error: function(xhr) {
                    let errors = xhr.responseJSON.errors;
                    let errorMessages = '';
                    $.each(errors, function(key, value) {
                        errorMessages += value[0] + '<br>';
                        toastMixin.fire({
                            title: errorMessages,
                            icon: 'error'
                        });
                    });

                }
            });
        });


        // delete
        $('body').on('click', '#deleteButton', function() {
            const button = $(this);
            const recordId = button.data('id'); // Get the ID of the record to delete

            Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete this record!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Perform the AJAX request to delete the record
                    $.ajax({
                        url: `/student/${recordId}`, // Update this URL with your route
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content')
                        },
                        success: function(response) {
                            toastMixin.fire({
                                title: response.message,
                                icon: 'success'
                            });


                            button.closest('tr').remove();
                        },
                        error: function(xhr) {
                            toastMixin.fire({
                                title: 'Error in deleting record',
                                icon: 'error'
                            });
                        }
                    });
                }
            });
        });
    });
</script>
