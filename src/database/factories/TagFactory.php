<?php

namespace AnthonyEdmonds\SilverOwl\Database\Factories;

use AnthonyEdmonds\SilverOwl\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

class TagFactory extends Factory
{
    protected $model = Tag::class;

    public function definition(): array
    {
        return [
            'label' => $this->faker->unique()->words(2, true),
            'colour' => $this->faker->colorName(),
        ];
    }
}
