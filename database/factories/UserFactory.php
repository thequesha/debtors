<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'surname' => fake()->lastName(),
            'middle_name' => fake()->name(),
            'username' => fake()->userName(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => bcrypt('12345678'), // password
            'remember_token' => Str::random(10),
            'birth_date' => fake()->date(),
            'phone' => fake()->phoneNumber(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return $this
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * Configure the model's default state.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(function ($user) {
            // Случайным образом назначаем одну из ролей
            $roles  = Role::where('name', '!=', 'Super-Admin')->get()->pluck('name')->toArray();
            $user->assignRole($roles[array_rand($roles)]);

            $user->addMedia(public_path("factory/profile.jpg"))
                ->preservingOriginal()
                ->toMediaCollection('users');
        });
    }
}
