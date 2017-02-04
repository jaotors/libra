<?php

use Illuminate\Database\Seeder;
use App\Models\Book;
use Faker\Factory;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Book::truncate();

        $faker = Factory::create();

        for($index = 0; $index < 100; ++$index) {
            $sentence = $faker->sentence(5);
            $title = substr($sentence, 0, strlen($sentence) - 1);
            Book::create([
                'name' => $title,
                'year' => $faker->year,
                'isbn' => $faker->isbn13,
                'call_number' => $faker->isbn13,
                'author' => $faker->name,
                'summary' => $faker->text,
                'category_id' => 1,
                'status' => 'Available',
            ]);
        }
    }
}
