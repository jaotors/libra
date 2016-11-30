<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role();
        $role->name = "Student";
        $role->save();

        $role = new Role();
        $role->name = "Employee";
        $role->save();

        $role = new Role();
        $role->name = "Librarian";
        $role->save();
    }
}
