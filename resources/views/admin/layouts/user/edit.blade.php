@extends('admin.master')

@section('content')
    <div class="row">
        <div class="col-md-2 grid-margin stretch-card">
        </div>
        <div class="col-md-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit User</h4>
                    <p class="card-description">
                        Be Careful
                    </p>
                    <form class="forms-sample" action="{{ route('user.edit') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name"
                                value="{{ old('name', $data->name) }}" required>
                            <input type="hidden" name="id" value="{{ $data->id }}">
                        </div>
                        <div class="form-group">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="XXXXXXXXXX@gmail.com" value="{{ old('email', $data->email) }}" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="phone" class="form-control" id="phone" name="phone"
                                placeholder="+959XXXXXXXXX" value="{{ old('phone', $data->phone) }}">
                        </div>
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select class="form-control" id="role" name="role">
                                <option value="user" {{ old('role', $data->role) == 'user' ? 'selected' : '' }}>User
                                </option>
                                <option value="instructor" {{ old('role', $data->role) == 'instructor' ? 'selected' : '' }}>
                                    Instructor</option>
                                <option value="admin" {{ old('role', $data->role) == 'admin' ? 'selected' : '' }}>
                                    Admin</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="password" class="form-label">Password (leave blank to keep current password)</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="New Password">
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
