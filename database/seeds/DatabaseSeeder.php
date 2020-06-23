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
        $this->call(PermissionSeed::class);
        $this->call(RoleSeed::class);
        $this->call(UserSeed::class);
        $this->call(PageSeeder::class);
        $this->call(BlogSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(SettingsSeeder::class);
    }
}
