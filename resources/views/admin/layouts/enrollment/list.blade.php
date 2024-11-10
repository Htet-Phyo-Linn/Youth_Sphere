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
            @if ($errors->any())
                <div class="row">
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <strong><i class="fa-solid fa-circle-check me-2"></i>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </li>
                            @endforeach
                        </strong>

                    </div>
                </div>
            @endif



        </div>
        <div class="col-md-3">
            <button type="button" class="btn btn-primary" id="openModal" data-bs-toggle="modal"
                data-bs-target="#enrollmentModal">
                Add New enrollment
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">

            <div class="card">
                <div class="card-body">
                    <p class="card-title mb-3">Enrollment List</p>

                    <div class="table-responsive">
                        <table id="example" class="table table-striped table-border display">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Enrollement ID</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>enrollment Name</th>
                                    <th>Enrolled At</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $index => $enrollment)
                                    <tr>
                                        {{-- <td>{{ sprintf('ENR-%05d', $enrollment->id) }}</td> --}}
                                        <!-- This will show 1 for the first item, 2 for the second, and so on -->
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $enrollment->enrollment_id }}</td>
                                        <td>{{ $enrollment->username }}</td>
                                        <td>{{ $enrollment->user_email }}</td>
                                        <td>{{ $enrollment->course_name }}</td>
                                        <td>{{ $enrollment->enrolled_at }}</td>
                                        <td>
                                            @if ($enrollment->status === 'active')
                                                <label class="badge badge-success">Active</label>
                                            @elseif($enrollment->status === 'pending')
                                                <label class="badge badge-warning">Pending</label>
                                            @elseif($enrollment->status === 'cancelled')
                                                <label class="badge badge-danger">Cancelled</label>
                                            @elseif($enrollment->status === 'complete')
                                                <label class="badge badge-primary">Complete</label>
                                            @else
                                                <label
                                                    class="badge badge-secondary">{{ ucfirst($enrollment->status) }}</label>
                                            @endif
                                        </td>

                                        <td>
                                            {{-- <!-- Edit Button -->
                                            <a href="{{ route('enrollment.list', $enrollment->id) }}"

                                                class="btn btn-dark btn-md">
                                                <i class="fas fa-edit"></i>
                                            </a> --}}

                                            <!-- Open Modal Button -->
                                            <a href="#" class="btn btn-dark btn-md" data-bs-toggle="modal"
                                                data-bs-target="#enrollmentStatusModal"
                                                style="display: inline-block; margin-block-end: 0em; margin:0.8em 0.2em;"
                                                data-enrollment-id="{{ $enrollment->enrollment_id }}"
                                                data-enrollment-status="{{ $enrollment->status }}">
                                                <i class="fas fa-edit"></i>
                                            </a>

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
<div class="modal fade" id="enrollmentModal" tabindex="-1" aria-labelledby="enrollmentModalLabel" aria-hidden="true"
    data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="enrollmentModalLabel">Enrollment Form</h5>
            </div>
            <div class="modal-body">
                <form id="enrollmentForm" action="{{ route('enrollment.create') }}" method="POST">
                    @csrf
                    <!-- User ID Field -->
                    <div class="mb-3">
                        <label for="user_id" class="form-label">User ID</label>
                        <input type="text" class="form-control" id="user_id" name="user_id" required>
                    </div>

                    <!-- Course ID Field -->
                    <div class="mb-3">
                        <label for="course_id" class="form-label">Course ID</label>
                        <input type="text" class="form-control" id="course_id" name="course_id" required>
                    </div>

                    <!-- Enrollment Date Field -->
                    <div class="mb-3">
                        <label for="enrolled_at" class="form-label">Enrolled At</label>
                        <input type="datetime-local" class="form-control" id="enrolled_at" name="enrolled_at">
                    </div>

                    <!-- Status Field -->
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="active">Active</option>
                            <option value="pending">Pending</option>
                            <option value="cancelled">Cancelled</option>
                            <option value="complete">Complete</option>
                        </select>
                    </div>

                    <!-- Submit and Close Buttons -->
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Modal -->
<div class="modal fade" id="enrollmentStatusModal" tabindex="-1" aria-labelledby="enrollmentModalLabel"
    aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="enrollmentModalLabel">Update Enrollment Status</h5>
            </div>
            <div class="modal-body">
                <form id="enrollmentForm" action="{{ route('enrollment.edit') }}" method="POST">
                    @csrf

                    <input type="hidden" name="enrollment_id" id="enrollment_id"
                        value="{{ $enrollment->enrollment_id }}">

                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="active" {{ $enrollment->status == 'active' ? 'selected' : '' }}>Active
                            </option>
                            <option value="pending" {{ $enrollment->status == 'pending' ? 'selected' : '' }}>Pending
                            </option>
                            <option value="cancelled" {{ $enrollment->status == 'cancelled' ? 'selected' : '' }}>
                                Cancelled</option>
                            <option value="complete" {{ $enrollment->status == 'complete' ? 'selected' : '' }}>
                                Complete</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Status</button>
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>
