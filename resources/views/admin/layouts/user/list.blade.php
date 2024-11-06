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

        </div>
        <div class="col-md-3">
            <button type="button" class="btn btn-primary" id="openModal" data-bs-toggle="modal"
                data-bs-target="#userModal">
                Add New user
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">

            <div class="card">
                <div class="card-body">
                    <p class="card-title mb-3">User List</p>

                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-border">
                            <thead>
                                <tr>
                                    <th>User ID</th>
                                    {{-- <th>user ID</th> --}}
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Role</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $index => $user)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        {{-- <td>{{ $user->user_id }}</td> --}}
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>{{ $user->role }}</td>
                                        <td>{{ $user->created_at }}</td>
                                        <td>
                                            <!-- Edit Button -->
                                            <a href="{{ route('user.editPage', $user->id) }}"
                                                style="display: inline-block; margin-block-end: 0em; margin:0.8em 1em;"
                                                class="btn btn-dark btn-md">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <form action="{{ route('user.delete', $user->id) }}" method="POST"
                                                style="display: inline-block; margin-block-end: 0em; margin:0.8em 1em;"
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
<div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel">User Form</h5>
            </div>
            <div class="modal-body">
                <form id="userForm" action="{{ route('user.create') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="phone" class="form-control" id="phone" name="phone"
                            placeholder="+959XXXXXXXXX">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>
