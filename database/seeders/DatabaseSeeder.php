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
            PermissionSeed::class,
            RoleSeed::class,
            UserSeeder::class,
            PageSeeder::class,
            BlogSeeder::class,
            CategorySeeder::class,
            SettingsSeeder::class,
            // MediaSeeder::class
        ]);

    }
}
