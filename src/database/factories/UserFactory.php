<?php

namespace Database\Factories;

use AnthonyEdmonds\SilverOwl\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'username' => $this->faker->unique()->userName,
            'password' => 'secret',
        ];
    }
}
