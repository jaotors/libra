<?php

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::truncate();

        Setting::create([
            'title' => 'Student Books',
            'value' => 3
        ]);

        Setting::create([
            'title' => 'Employee Books',
            'value' => 20
        ]);

        Setting::create([
            'title' => 'Student Duration',
            'value' => 3
        ]);

        Setting::create([
            'title' => 'Employee Duration',
            'value' => 7
        ]);
        
        Setting::create([
            'title' => 'Employee Penalty',
            'value' => 5
        ]);
        
        Setting::create([
            'title' => 'Student Penalty',
            'value' => 20
        ]);
    }
}
