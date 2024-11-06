<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Courses;


class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Sample courses data
        $courses = [
            [
                'instructor_id' => 1, // Assuming instructor with ID 1 exists
                'category_id' => 1, // Assuming category with ID 1 exists
                'title' => 'Introduction to Programming',
                'description' => 'Learn the basics of programming using Python.',
                'price' => 199.99,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'instructor_id' => 2, // Assuming instructor with ID 2 exists
                'category_id' => 2, // Assuming category with ID 2 exists
                'title' => 'Web Development Bootcamp',
                'description' => 'Become a full-stack web developer in this comprehensive bootcamp.',
                'price' => 299.99,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'instructor_id' => 3, // Assuming instructor with ID 3 exists
                'category_id' => 1,
                'title' => 'Data Science with R',
                'description' => 'Explore data science concepts using the R programming language.',
                'price' => 249.99,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more course records as needed
        ];

        // Insert the courses into the database
        Courses::insert($courses);
    }
}
