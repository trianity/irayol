<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
           'editor',
           'subscriber',
        ];


        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }

        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo([
            // Role Permision
            'role.index',
            'role.create',
            'role.show',
            'role.edit',
            'role.delete',
            // Permissions Permision
            'permission.index',
            'permission.create',
            'permission.show',
            'permission.edit',
            'permission.delete',
            // Blog Permision
            'blog.index',
            'blog.create',
            'blog.show',
            'blog.edit',
            'blog.delete',
            // Page Permision
            'page.index',
            'page.create',
            'page.show',
            'page.edit',
            'page.delete',
            // Category Permision
            'category.index',
            'category.create',
            'category.show',
            'category.edit',
            'category.delete',
            // Menu Permision
            'menu.index',
            'menu.create',
            'menu.show',
            'menu.edit',
            'menu.delete',
            // Media Permision
            'media.index',
            'media.create',
            'media.show',
            'media.edit',
            'media.delete',
            // Setting Permision
            'setting.index',
            'setting.create',
            'setting.show',
            'setting.edit',
            'setting.delete',
            // Themes Permision
            'theme.index',
            'theme.create',
            'theme.show',
            'theme.edit',
            'theme.delete',
            // Addons Permision
            'addons.index',
            'addons.create',
            'addons.show',
            'addons.edit',
            'addons.delete',
            // Users Permision
            'users.index',
            'users.create',
            'users.show',
            'users.edit',
            'users.delete',
        ]);
    }
}
