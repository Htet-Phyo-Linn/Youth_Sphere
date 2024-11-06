@extends('admin.master')
@section('content')
    <!-- Button to trigger the modal -->

    <div class="row  mb-3">
        <div class="col-md-9">
            @if (session('createSuccess'))
                <div class="row">
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <strong><i class="fa-solid fa-circle-check me-2"></i>{{ session('createSuccess') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif

            @if (session('updateSuccess'))
                <div class="row">
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <strong><i class="fa-solid fa-circle-check me-2"></i>{{ session('updateSuccess') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif

            @if (session('deleteSuccess'))
                <div class="row">
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <strong><i class="fa-solid fa-circle-check me-2"></i>{{ session('deleteSuccess') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif

            @if (session('instructor_id_error'))
                <div class="row">
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <strong>
                            <i class="fa-solid fa-circle-check me-2"></i>
                            {{ session('instructor_id_error') }}
                        </strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>
            @endif

        </div>
        <div class="col-md-3">
            <button type="button" class="btn btn-primary" id="openModal" data-bs-toggle="modal"
                data-bs-target="#courseModal">
                Add New course
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">

            <div class="card">
                <div class="card-body">
                    <p class="card-title mb-3">Course List</p>

                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-border display">
                            <thead>
                                <tr>
                                    <th>Course ID</th>
                                    <th>Instructor Name</th>
                                    <th>Category Name</th>
                                    <th>Course Title</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $index => $course)
                                    <tr>
                                        <td>{{ $course->id }}
                                            <img src="{{ asset('storage/' . $course->image) }}" alt="Course Image"
                                                style="float: right;">
                                        </td>
                                        <td>{{ $course->instructor_name }}</td>
                                        <td>{{ $course->category_name }}</td>
                                        <td>{{ $course->course_title }}</td>
                                        {{-- <td>{{ $course->description }}</td> --}}
                                        <td>
                                            <span class="tooltip-description"
                                                data-full-description="{{ $course->description }}">
                                                {{ Str::limit($course->description, 10, '...') }}
                                            </span>
                                        </td>
                                        <td>{{ $course->price }}</td>
                                        {{-- <td>{{ $course->created_at }}</td> --}}
                                        <td>
                                            <!-- Edit Button -->
                                            <a href="{{ route('course.editPage', $course->id) }}"
                                                style="display: inline-block; margin-block-end: 0em; margin:0.8em 0.2em;"
                                                class="btn btn-dark btn-md">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <!-- List Button -->
                                            <a href="{{ route('lesson.list', $course->id) }}"
                                                style="display: inline-block; margin-block-end: 0em; margin:0.8em 0.2em;"
                                                class="btn btn-dark btn-md">
                                                <i class="fas fa-list"></i>
                                            </a>

                                            <form action="{{ route('course.delete', $course->id) }}" method="POST"
                                                style="display: inline-block; margin-block-end: 0em; margin:0.8em 0.2em;"
                                                onsubmit="return confirm('Are you sure you want to delete this user?');">
                                                @csrf
                                                @method('GET')
                                                <button type="submit" class="btn btn-danger btn-md">
                                                    <i class="fas fa-trash"></i> <!-- Font Awesome delete icon -->
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


<!-- Bootstrap Modal -->
<div class="modal fade" id="courseModal" tabindex="-1" aria-labelledby="courseModalLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="courseModalLabel">Course Form</h5>
            </div>
            <div class="modal-body">
                <form id="courseForm" action="{{ route('course.create') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="instructor_id" class="form-label">Instructor Id</label>
                        <input type="text" class="form-control" id="instructor_id" name="instructor_id" required>
                    </div>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select class="form-control" id="category" name="category">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>


                    <div class="mb-3">
                        <label for="course_title" class="form-label">Course Title</label>
                        <input type="course_title" class="form-control" id="course_title" name="course_title"
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="price" class="form-control" id="price" name="price" required>
                    </div>
                    <div class="mb-3">
                        <div class="form-group">
                            <label for="image" class="form-label">Image File Upload</label>
                            <input id="image" type="file" name="image" class="file-upload-default"
                                style="display: none;">
                            <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" disabled
                                    placeholder="Upload Image">
                                <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">Select
                                        Image</button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>
