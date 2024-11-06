<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Enrollments;
use Carbon\Carbon;

class EnrollmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define some sample status options
        $statuses = ['active', 'completed', 'pending', 'cancelled'];

        // Create 10 dummy enrollments
        for ($i = 1; $i <= 10; $i++) {
            Enrollments::create([
                'user_id' => $i,  // Assuming user IDs 1 through 10 exist
                'course_id' => rand(1, 5),  // Assuming course IDs 1 through 5 exist
                'enrolled_at' => Carbon::now()->subDays(rand(1, 100)),
                'status' => $statuses[array_rand($statuses)],  // Random status
            ]);
        }
    }
}
