<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jesus = User::create([
            'name' => 'Jesus Avelar',
            'email' => 'admin@admin.com',
            'password' => bcrypt('123456')
        ]);

        $jesus->assignRole('admin');

        factory(User::class, 10)->create();
    }
}
