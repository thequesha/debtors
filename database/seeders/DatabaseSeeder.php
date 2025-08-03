<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Dealership;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);

        // // Создаем администратора
        $admin = User::factory()->create([
            'name' => 'Администратор',
            'surname' => 'Администратор',
            'email' => 'admin@admin.com',
            'username' => 'admin',
            'phone' => '+7 999 9999999',
            'password' => bcrypt('12345678'),
        ]);
        $admin->assignRole('Администратор');

        $admin->addMedia(public_path("factory/profile.jpg"))
            ->preservingOriginal()
            ->toMediaCollection('users');

        // Создаем остальных пользователей
        // User::factory(2)->create();

        $this->call([
            // CarSeeder::class,
        ]);
    }
}
