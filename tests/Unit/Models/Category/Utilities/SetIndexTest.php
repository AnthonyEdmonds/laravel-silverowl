<?php

namespace AnthonyEdmonds\SilverOwl\Tests\Unit\Models\Category\Utilities;

use AnthonyEdmonds\SilverOwl\Models\Category;
use AnthonyEdmonds\SilverOwl\Tests\TestCase;

class SetIndexTest extends TestCase
{
    protected Category $category;

    protected Category $parent;

    public function testSetsAsIdWhenNoParent(): void
    {
        $this->category = Category::factory()->make();

        $this->category->id = 12;
        $this->category->setIndex();

        $this->assertEquals(
            '12,',
            $this->category->index,
        );
    }

    public function testAddsParentIndex(): void
    {
        $this->parent = Category::factory()->make([
            'index' => '13,67,',
        ]);

        $this->category = Category::factory()->make();

        $this->category->parent()->associate($this->parent);
        $this->category->id = 12;
        $this->category->setIndex();

        $this->assertEquals(
            '13,67,12,',
            $this->category->index,
        );
    }
}
