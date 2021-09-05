<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            AdminSeeder::class,
            RolesAndPermissionsSeeder::class,
        ]);

        \App\Models\Admin::factory(10)->create();
        \App\Models\User::factory(10)->create();
    }
}
