<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $firstName = fake()->firstName();
        $lastName = fake()->lastName();
        $name = $firstName . ' ' . $lastName;
        $email = strtolower($firstName) . '.' . strtolower($lastName) . '@example.com';
        return [
            'name' => $name,
            'email' => $email,
            'email_verified_at' => now(),
            'no_hp' => fake()->phoneNumber(),
            'password' => static::$password ??= Hash::make('Plmoki09'),
            'remember_token' => Str::random(10),
            'role' => 'player',
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
