<?php

namespace Modules\Courses\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class CourseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        \Modules\Courses\Entities\Course::factory(5)->create();
        // $this->call("OthersTableSeeder");
    }
}
