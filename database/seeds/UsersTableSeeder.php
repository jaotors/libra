<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use Faker\Factory;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        $faker = Factory::create();
        // create admin user
        User::create([
            'first_name' => 'Abigail',
            'last_name' => 'Cruz',
            'role_id' => '3',
            'department_id' => '6',
            'email' => 'acruz@gmail.com',
            'user_id' => '20140174227',
            'password' => bcrypt('admin'),
        ]);

        for ($index = 0; $index < 100; ++$index) {
            User::create([
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'role_id' => '1',
                'department_id' => '1',
                'email' => $faker->email,
                'user_id' => $faker->randomNumber(9),
                'password' => bcrypt('password'),
            ]);
        }
    }
}
