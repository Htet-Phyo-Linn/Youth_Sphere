@extends('user.master')

@section('styles')
    <style>
        .br-1 {
            border-radius: 1.2rem;
        }

        .card {
            display: flex;
            flex-direction: column;
            height: 100%;
            transition: box-shadow 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .card-body {
            display: flex;
            flex-direction: column;
            flex-grow: 1;
            padding: 1rem;
        }

        .card-title {
            height: 3rem;
        }

        .card-text.price {
            font-size: 1.1rem;
            margin-bottom: 10px;
        }

        .card-body .mt-auto {
            margin-top: auto;
        }

        .card-text.description {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            display: block;
        }

        /* Categories styling */
        .category-buttons {
            margin-bottom: 20px;
        }

        .category-button {
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .category-button.active {
            background-color: #007bff;
            color: white;
        }
    </style>
@endsection



@section('content')
    <div class="container" style="padding-top: 120px;">

        <div class="row">
            <!-- Search Bar -->
            {{-- <div class="col-md-12 mb-4">
                <input type="text" id="courseSearch" class="form-control" placeholder="Search for courses...">
            </div> --}}

            <div class="category-buttons" style="">
                <span>
                    <button class="btn btn-sm btn-outline-primary category-button active br-1"
                        data-category="all">All</button>
                </span>
                @foreach ($categories as $category)
                    <span>
                        <button class="btn btn-sm btn-outline-primary category-button br-1"
                            data-category="{{ $category->id }}">
                            {{ $category->name }}
                        </button>
                    </span>
                @endforeach
            </div>
        </div>



        <!-- Courses Row -->
        <div class="row" id="courseContainer">
            @foreach ($courses as $course)
                <div class="col-lg-3 col-md-4 col-12 mb-4 course-item" data-category="{{ $course->category_id }}">
                    <div class="card h-100 br-1">
                        @if ($course->image)
                            <img src="{{ asset('storage/' . $course->image) }}" class="card-img-top br-1"
                                alt="{{ $course->title }}">
                        @else
                            <img src="https://via.placeholder.com/350x200" class="card-img-top br-1" alt="Course Image">
                        @endif
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $course->title }}</h5>
                            <p class="card-text description">{{ Str::limit($course->description, 100) }}</p>
                            <p class="card-text price"><strong>Price:</strong> ${{ $course->price }}</p>
                            <div class="mt-auto">
                                <button type="button" class="btn btn-outline-primary" data-toggle="modal"
                                    data-target="#courseModal{{ $course->id }}">
                                    View Details
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination Controls -->
        <div class="d-flex justify-content-center">
            {{ $courses->links('pagination::bootstrap-4') }}
        </div>
    </div>
@endsection


@section('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script> <!-- jQuery first -->

    <script>
        $(document).ready(function() {
            $(document).on('click', '.category-button', function() {
                var categoryId = $(this).data('category'); // Get the category ID from the clicked button

                // If 'all' is clicked, send null to the server
                if (categoryId === "all") {
                    categoryId = null;
                }

                console.log('Category ID:', categoryId); // Log the category ID for debugging

                $.ajax({
                    url: '{{ route('courses.filter') }}', // Your route name here
                    type: 'GET',
                    data: {
                        category_id: categoryId // Pass the selected category ID (or null for all)
                    },
                    success: function(data) {
                        // Replace the course items with filtered results
                        $('#courseContainer').html(data);
                    },
                    error: function(xhr, status, error) {
                        console.log('AJAX request failed: ' + status + ', ' + error);
                    }
                });
            });

            // Add active class to the clicked button and remove it from others
            $(document).on('click', '.category-button', function() {
                $('.category-button').removeClass('active');
                $(this).addClass('active');
            });



        });
    </script>
@endsection
