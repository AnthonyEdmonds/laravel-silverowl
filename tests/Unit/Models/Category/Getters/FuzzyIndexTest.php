<?php

namespace AnthonyEdmonds\LaravelSilverowl\Tests\Unit\Models\Category\Getters;

use AnthonyEdmonds\SilverOwl\Models\Category;
use AnthonyEdmonds\SilverOwl\Tests\TestCase;

class FuzzyIndexTest extends TestCase
{
    protected Category $category;

    protected function setUp(): void
    {
        parent::setUp();

        $this->category = Category::factory()
            ->forParent()
            ->hasChildren(1)
            ->create()
            ->children
            ->first();
    }

    public function test(): void
    {
        $this->assertEquals(
            $this->category->index.'%',
            $this->category->fuzzyIndex,
        );
    }
}
