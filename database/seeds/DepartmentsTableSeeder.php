<?php

use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Department::truncate();
        
        $department = new Department();
        $department->name = "Accountancy";
        $department->save();

        $department = new Department();
        $department->name = "Information Technology";
        $department->save();

        $department = new Department();
        $department->name = "Hospitality Management";
        $department->save();

        $department = new Department();
        $department->name = "Education";
        $department->save();

        $department = new Department();
        $department->name = "Industrial Engineering";
        $department->save();

        $department = new Department();
        $department->name = "Employee";
        $department->save();
    }
}
