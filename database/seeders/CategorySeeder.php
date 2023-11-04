<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'Teknologi',
        ]);
        Category::create([
            'name' => 'Kesehatan',
        ]);
        Category::create([
            'name' => 'Edukasi',
        ]);
        Category::create([
            'name' => 'Gaya Hidup',
        ]);
        Category::create([
            'name' => 'Politik',
        ]);
        Category::create([
            'name' => 'Hobby',
        ]);
        Category::create([
            'name' => 'Entertainment',
        ]);
    }
}
