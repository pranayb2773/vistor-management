<?php

namespace Database\Factories;

use App\Enums\UserStatus;
use App\Enums\UserType;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
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
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'status' => fake()->randomElement(UserStatus::cases()),
            'user_type' => fake()->randomElement(UserType::cases()),
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

    /**
     * Indicate that the model's user type should be external.
     */
    public function external(): static
    {
        return $this->state(fn (array $attributes) => [
            'user_type' => UserType::EXTERNAL->value,
        ]);
    }

    /**
     * Indicate that the model's user_type should be internal.
     */
    public function internal(): static
    {
        return $this->state(fn (array $attributes) => [
            'user_type' => UserType::INTERNAL->value,
        ]);
    }

    /**
     * Indicate that the model's status should be active.
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => UserStatus::ACTIVE->value,
        ]);
    }

    /**
     * Indicate that the model's status should be inactive.
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => UserStatus::INACTIVE->value,
        ]);
    }

    /**
     * Indicate that the model's status should be pending.
     */
    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => UserStatus::PENDING->value,
        ]);
    }
}
