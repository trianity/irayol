<?php

namespace Modules\Courses\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $permissions = [
            // Courses Permision
            'course.index',
            'course.create',
            'course.show',
            'course.edit',
            'course.delete',

            // Sections Permision
            'section.index',
            'section.create',
            'section.show',
            'section.edit',
            'section.delete',

            // Classes Permision
            'class.index',
            'class.create',
            'class.show',
            'class.edit',
            'class.delete',
        ];


        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
