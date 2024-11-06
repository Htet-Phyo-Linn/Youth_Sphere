<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Models\Courses;
use App\Models\Lessons;
use App\Models\Videos;


class LessonsController extends Controller
{
    public function list($id) {
        // Step 1: Retrieve all lessons for the given course ID
        $lessons = Lessons::where('course_id', $id)->get();

        // Step 2: Retrieve all video IDs for the retrieved lessons
        $lessonIds = $lessons->pluck('id'); // Get the IDs of the lessons

        // Step 3: Retrieve all videos that belong to those lessons
        $videos = Videos::whereIn('lesson_id', $lessonIds)->get();

        // Dump the retrieved videos
        return view('admin.layouts.lesson.list', compact('lessons', 'videos'));

    }

    public function listUpdate(Request $request) {
        // Validate the incoming request
        $request->validate([
            'course_id' => 'required|exists:courses,id|integer',
            'lesson_title' => 'required|string|max:255',
            'content' => 'required|string',
            'videos' => 'array', // Expecting an array of videos
            'videos.*.title' => 'string|max:255',
            'videos.*.url' => 'string|max:255',
            'videos.*.duration' => 'string|max:255',
        ]);

        // Prepare data for insertion
        $lessonData = [
            'course_id' => $request->course_id,
            'title' => $request->lesson_title,
            'content' => $request->content,
        ];
        // dd($lessonData);

        // Insert data into the database and get the inserted ID
        $lesson = Lessons::create($lessonData);
        $lessonId = $lesson->id; // Assuming the model uses auto-incrementing ID

        if (is_array($request->videos) && collect($request->videos)->isNotEmpty()) {
            foreach ($request->videos as $video) {
                Log::info('Processing Video: ', $video);

                // Ensure each video has necessary fields
                if (isset($video['title'], $video['url'], $video['duration'])) {
                    Videos::create([
                        'lesson_id' => $lessonId,
                        'title' => $video['title'],
                        'video_url' => $video['url'],
                        'duration' => $video['duration'],
                    ]);
                }
            }
        }


        // After successfully creating the lesson, return the response
        return response()->json([
            'lesson_id' => $lessonId,
            'course_id' => $request->course_id, // Include the course ID in the response
            'message' => 'Lesson created successfully.'
        ]);
    }


    public function edit(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'lesson_id' => 'required|integer|exists:lessons,id',
            'lesson_title' => 'required|string|max:255',
            'content' => 'required|string',
            'video_ids' => 'array',
            'video_titles' => 'required|array',
            'video_urls' => 'required|array',
            'video_durations' => 'nullable|array',
            'video_titles.*' => 'required|string|max:255',
            'video_urls.*' => 'required|url',
            'video_durations.*' => 'nullable|string|max:255',
        ]);

        // Find the lesson by ID and update it
        $lesson = Lessons::find($validated['lesson_id']);
        // dd($validated);
        $courseId = $lesson->course_id;


        if (!$lesson) {
            return response()->json(['error' => 'Lesson not found.'], 404);
        }

        // Update the lesson's title and content
        $lesson->update([
            'title' => $validated['lesson_title'],
            'content' => $validated['content'],
        ]);

        // Update each video related to the lesson
        if (isset($validated['video_ids'])) {
            foreach ($validated['video_ids'] as $index => $videoId) {
                // Find the video by ID
                $video = Videos::find($videoId);
                if ($video) {
                    // Update the video with the new data
                    $video->update([
                        'title' => $validated['video_titles'][$index],
                        'video_url' => $validated['video_urls'][$index],
                        'duration' => $validated['video_durations'][$index] ?? null,
                    ]);
                }
            }
        }

        // After successfully updating the lesson and videos
        return redirect()->route('lesson.list', ['id' => $courseId])->with(['updateSuccess' => 'Course updated successfully.']);
    }


    public function editPage($id)
    {
        // Step 1: Retrieve the lesson by ID
        $lesson = Lessons::find($id);

        // Step 2: Check if the lesson exists
        if (!$lesson) {
            return redirect()->back()->with('error', 'Lesson not found.');
        }

        // Step 3: Retrieve associated videos
        $videos = Videos::where('lesson_id', $id)->get();

        // Step 4: Pass lesson and videos data to the view
        return view('admin.layouts.lesson.edit', compact('lesson', 'videos'));
    }


    public function delete($id)
    {
        // Step 1: Find the lesson by ID
        $lesson = Lessons::find($id);

        // Step 2: Check if the lesson exists
        if (!$lesson) {
            return redirect()->back()->with('error', 'Lesson not found.');
        }

        // Step 3: Delete related videos
        Videos::where('lesson_id', $lesson->id)->delete();

        // Step 4: Delete the lesson itself
        $lesson->delete();

        // Step 5: Return a response or redirect
        return redirect()->route('lesson.list', ['id' => $lesson->course_id])->with('success', 'Lesson and associated videos deleted successfully.');
    }

}
