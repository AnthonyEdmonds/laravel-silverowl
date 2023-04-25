<?php

namespace AnthonyEdmonds\LaravelSilverowl\Tests\Unit\Models\Category\Setters;

use AnthonyEdmonds\SilverOwl\Models\Category;
use AnthonyEdmonds\SilverOwl\Tests\TestCase;

class NameTest extends TestCase
{
    protected Category $category;

    protected function setUp(): void
    {
        parent::setUp();

        $this->category = Category::factory()->make();
        $this->category->name = 'My cool name';
    }

    public function testSetsUsername(): void
    {
        $this->assertEquals(
            'My cool name',
            $this->category->name,
        );
    }

    public function testSetsSlug(): void
    {
        $this->assertEquals(
            'my-cool-name',
            $this->category->slug,
        );
    }
}
