<?php

namespace AnthonyEdmonds\SilverOwl\Database\Factories;

use AnthonyEdmonds\SilverOwl\Models\Category;
use AnthonyEdmonds\SilverOwl\Models\Content;
use AnthonyEdmonds\SilverOwl\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContentFactory extends Factory
{
    protected $model = Content::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->unique()->words(3, true),
            'markdown' => '#Hello',
            'author_id' => User::factory(),
            'category_id' => Category::factory(),
            'index' => '1/2/3',
        ];
    }
}
