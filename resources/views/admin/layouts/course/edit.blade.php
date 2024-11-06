@extends('admin.master')

@section('content')
    <div class="row">
        <div class="col-md-2 grid-margin stretch-card">
        </div>
        <div class="col-md-8 grid-margin stretch-card">

            @if (session('instructor_id_error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('instructor_id_error') }}
                </div>
            @endif



            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Course</h4>
                    <p class="card-description">
                        Be Careful

                    </p>
                    <form class="forms-sample" action="{{ route('course.edit') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="instructor_id" class="form-label">Instructor ID</label>
                            <input type="text" class="form-control" id="instructor_id" name="instructor_id"
                                value="{{ old('instructor_id', $data->instructor_id) }}" placeholder="Enter Instructor ID"
                                required>
                            <input type="hidden" name="id" value="{{ $data->id }}">
                        </div>
                        <div class="form-group">
                            <label for="category" class="form-label">Category</label>
                            <select class="form-control" id="category" name="category" required>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="title" class="form-label">Course Title</label>
                            <input type="text" class="form-control" id="title" name="title"
                                value="{{ old('title', $data->title) }}" placeholder="Course Title" required>
                        </div>
                        <div class="form-group">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter Description">{{ old('description', $data->description) }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" step="0.01" class="form-control" id="price" name="price"
                                value="{{ old('price', $data->price) }}" placeholder="Enter Price" required>
                        </div>
                        <div class="form-group">
                            <label for="image" class="form-label">Image File Upload</label>

                            <!-- Display the current image -->
                            @if ($data->image)
                                <div class="mb-12">
                                    <img src="{{ asset('storage/' . $data->image) }}" alt="Current Image"
                                        style="width: 100%; height: auto; display: block; margin-bottom: 10px;">
                                    <p><b>Current Image</b></p>
                                </div>
                            @endif

                            <input id="image" type="file" name="image" class="file-upload-default"
                                style="display: none;">
                            <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" disabled
                                    placeholder="Upload Image">
                                <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="button">Select Image</button>
                                </span>
                            </div>
                        </div>


                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        <button type="button" class="btn btn-light" onclick="window.history.back();">Cancel</button>
                    </form>


                </div>
            </div>
        </div>
        <div class="col-md-2 grid-margin stretch-card">
        </div>
    </div>
@endsection
