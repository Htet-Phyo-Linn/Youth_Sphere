@extends('admin.master')

@section('content')
    <style>
        .form-control {
            height: 38px;
            /* Adjust the height of input fields */
            /* font-size: rem; */
            /* Adjust the font size */
            padding: 10px;
            /* Adjust padding for better spacing */
        }

        label {
            font-weight: bold;
            font-size: 1rem;
        }
    </style>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card" id="list_card">
                <div class="lesson_card">
                    <div class="card-body">
                        <h3 class="card-title">Edit Lesson: {{ $lesson->title }}</h3>
                        <div class="container">

                            <form action="{{ route('lesson.edit') }}" method="POST">
                                @csrf
                                <input type="hidden" name="lesson_id" value="{{ $lesson->id }}">

                                <div class="form-group">
                                    <label for="lesson_title">Lesson Title</label>
                                    <input type="text" class="form-control" name="lesson_title" id="lesson_title"
                                        value="{{ $lesson->title }}" required>
                                </div>

                                <div class="form-group">
                                    <label for="content">Content</label>
                                    <textarea class="form-control" name="content" id="content" required>{{ $lesson->content }}</textarea>
                                </div>
                                <hr>
                                <h4>Edit : Videos</h4>
                                <div class="video-list">
                                    @foreach ($videos as $video)
                                        <div class="form-group">
                                            <input type="hidden" name="video_ids[]" value="{{ $video->id }}">
                                            <label class="mt-2 mb-1" for="video_title_{{ $video->id }}">Video
                                                Title</label>
                                            <input type="text" class="form-control" name="video_titles[]"
                                                id="video_title_{{ $video->id }}" value="{{ $video->title }}" required>

                                            <label class="mt-2 mb-1" for="video_url_{{ $video->id }}">Video URL</label>
                                            <input type="url" class="form-control" name="video_urls[]"
                                                id="video_url_{{ $video->id }}" value="{{ $video->video_url }}">

                                            <label class="mt-2 mb-1"
                                                for="video_duration_{{ $video->id }}">Duration</label>
                                            <input type="text" class="form-control" name="video_durations[]"
                                                id="video_duration_{{ $video->id }}" value="{{ $video->duration }}"
                                                required>
                                            <hr>
                                        </div>
                                    @endforeach
                                </div>

                                <button type="button" class="btn btn-light"
                                    onclick="window.history.back();">Cancel</button>
                                <button type="submit" class="btn btn-primary" style="float: right;">Save Changes</button>


                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
