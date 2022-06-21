<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    public function definition(): array
    {
        return [
            'login' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => bcrypt($this->faker->password),
            'license' => $this->faker->boolean,
            'user_photo' => $this->faker->imageUrl(100, 100),
            'online' => $this->faker->boolean,
            'confirm_send_email' => $this->faker->boolean,
            'remember_token' => Str::random(10),
        ];
    }
}
