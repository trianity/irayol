<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();

        $jesus = \App\Models\User::create([
            'name' => 'Jesus Avelar',
            'email' => 'admin@admin.com',
            'password' => bcrypt('123456')
        ]);

        $jesus->assignRole('admin');
    }
}
