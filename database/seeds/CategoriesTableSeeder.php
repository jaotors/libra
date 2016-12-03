<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::truncate();

        Category::create([
            'name' => 'Literature'
        ]);

        Category::create([
            'name' => 'Arts'
        ]);

        Category::create([
            'name' => 'Science'
        ]);

        Category::create([
            'name' => 'General Reference'
        ]);

        Category::create([
            'name' => 'Mathematics'
        ]);

        Category::create([
            'name' => 'History'
        ]);

        Category::create([
            'name' => 'English'
        ]);
    }
}
