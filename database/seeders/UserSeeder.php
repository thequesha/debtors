<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // admin
        $user =   User::updateOrCreate([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@proautochina.com',
            'phone' => '',
            'password' => bcrypt('12345678'),
        ]);
        $user->addMedia(public_path("factory/profile.jpg"))
            ->preservingOriginal()
            ->toMediaCollection('users');
    }
}
