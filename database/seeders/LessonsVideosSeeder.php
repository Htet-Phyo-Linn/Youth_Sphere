<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Lessons;
use App\Models\Videos;

class LessonsVideosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        // Create lessons first (or retrieve existing ones)
        $lessons = [];
        for ($i = 1; $i <= 3; $i++) { // Assuming you want to create 3 lessons
            $lesson = Lessons::create([
                'course_id' => 1,
                'title' => "Lesson $i",
                'content' => "This is the content for Lesson $i.",
            ]);
            $lessons[] = $lesson; // Store the lesson object for later use
        }

        // Now that we have the lessons, we can insert videos for each
        foreach ($lessons as $i => $lesson) {
            // Number of videos for each lesson
            $videoCount = 6; // Set to 6 for all lessons

            // Insert videos based on the determined count
            for ($j = 1; $j <= $videoCount; $j++) {
                Videos::create([
                    'lesson_id' => $lesson->id,
                    'title' => "Video {$j} for Lesson {$i}",
                    'video_url' => "https://example.com/video{$j}-lesson{$i}.mp4",
                    'duration' => rand(60, 300), // Random duration between 1 to 5 minutes
                ]);
            }
        }
    }
}
