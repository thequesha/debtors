<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create roles
        $roles = [
            'Super-Admin',
            'Администратор',
            'Пользователь',
        ];

        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }

        // Assign all permissions to Super-Admin
        $permissions = Permission::all();
        Role::findByName('Super-Admin')->givePermissionTo($permissions);

        // Assign specific permissions to Администратор
        Role::findByName('Администратор')->givePermissionTo('manage users');
    }
}
