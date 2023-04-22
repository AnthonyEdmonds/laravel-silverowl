<?php

namespace AnthonyEdmonds\SilverOwl\Tests\Unit\Models\Category\Setup;

use AnthonyEdmonds\SilverOwl\Models\Category;
use AnthonyEdmonds\SilverOwl\Tests\TestCase;

class BootedTest extends TestCase
{
    protected Category $category;

    protected Category $parent;

    protected function setUp(): void
    {
        parent::setUp();

        $this->category = Category::factory()->make();
        $this->parent = Category::factory()->create();
    }

    public function testOrdersByName(): void
    {
        $expected = Category::factory()
            ->count(2)
            ->create()
            ->push($this->parent);

        $this->assertEquals(
            $expected->sortBy('name')->pluck('name'),
            Category::pluck('name'),
        );
    }

    public function testSetsIndexOnCreated(): void
    {
        $this->category->save();

        $this->assertEquals(
            $this->category->id,
            $this->category->index,
        );
    }

    public function testReindexesWhenParentDirty(): void
    {
        $this->category->save();
        $this->category->parent()->associate($this->parent);
        $this->category->save();

        $this->assertEquals(
            $this->parent->id.'-'.$this->category->id,
            $this->category->index,
        );
    }
}
