<?php

use Illuminate\Database\Seeder;
use App\Models\Reservation;
use Faker\Factory;

class ReservationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Reservation::truncate();

        $faker = Factory::create();

        for($index = 0; $index < 100; ++$index) {
            Reservation::create([
                'user_id' => $faker->numberBetween($min = 1, $max = 100),
                'book_id' => $faker->unique()->numberBetween($min = 1, $max = 100),
                'return_date' => $faker->date,
            ]);
        }
    }
}
