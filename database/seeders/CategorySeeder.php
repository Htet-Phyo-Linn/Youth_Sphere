<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categories;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [];

        for ($i = 1; $i <= 20; $i++) {
            $categories[] = [
                'name' => 'Category ' . $i,
                'description' => 'Description for Category ' . $i,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        Categories::insert($categories);
    }
}
