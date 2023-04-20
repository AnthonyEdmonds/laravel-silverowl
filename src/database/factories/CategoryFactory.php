<?php

namespace AnthonyEdmonds\SilverOwl\Database\Factories;

use AnthonyEdmonds\SilverOwl\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->name(),
            'description' => $this->faker->text(),
            'index' => '1/2/3',
        ];
    }
}
