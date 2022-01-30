<?php

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
          StateSeeder::class,
          AuthSeeder::class,
          UserSeeder::class,
          CompaniesSeeder::class,
          ProfilesSeeder::class,
          PermissionsSeeder::class,
          RolePermissionsSeeder::class,
          CitiesSeeder::class,
        ]);
    }
}
