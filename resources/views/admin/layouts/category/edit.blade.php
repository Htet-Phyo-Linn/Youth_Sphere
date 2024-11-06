@extends('admin.master')

@section('content')
    <div class="row">
        <div class="col-md-2 grid-margin stretch-card">
        </div>
        <div class="col-md-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Category</h4>
                    <p class="card-description">
                        Be Careful
                    </p>
                    <form class="forms-sample" action="{{ route('category.edit') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Title</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Title"
                                value="{{ old('name', $data->name) }}">
                            <input type="hidden" name="id" value="{{ $data->id }}">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea type="text" class="form-control" id="description" name="description" placeholder="Description"
                                rows="6">
                                {{ old('description', $data->description) }}
                            </textarea>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        <button class="btn btn-light" onclick="window.history.back();">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-2 grid-margin stretch-card">
        </div>
    </div>
@endsection
