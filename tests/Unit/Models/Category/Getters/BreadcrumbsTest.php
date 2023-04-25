<?php

namespace AnthonyEdmonds\LaravelSilverowl\Tests\Unit\Models\Category\Getters;

use AnthonyEdmonds\SilverOwl\Models\Category;
use AnthonyEdmonds\SilverOwl\Tests\TestCase;

class BreadcrumbsTest extends TestCase
{
    protected Category $ancestor;

    protected Category $parent;

    protected Category $category;

    protected Category $child;

    protected Category $grandchild;

    protected function setUp(): void
    {
        parent::setUp();

        $this->ancestor = Category::factory()->create([
            'id' => 69,
            'name' => 'z',
        ]);

        $this->parent = Category::factory()
            ->forParent($this->ancestor)
            ->create([
                'id' => 5,
                'name' => 's',
            ]);

        $this->category = Category::factory()
            ->forParent($this->parent)
            ->create([
                'id' => 12,
                'name' => 'a',
            ]);

        $this->child = Category::factory()
            ->forParent($this->category)
            ->create([
                'id' => 72,
                'name' => 't',
            ]);

        $this->grandchild = Category::factory()
            ->forParent($this->child)
            ->create([
                'id' => 3,
                'name' => 'b',
            ]);
    }

    public function testHasBreadcrumbs(): void
    {
        $this->assertEquals(
            [
                $this->ancestor->name => route('categories.show', $this->ancestor),
                $this->parent->name => route('categories.show', $this->parent),
                $this->category->name => route('categories.show', $this->category),
                $this->child->name => route('categories.show', $this->child),
                $this->grandchild->name => route('categories.show', $this->grandchild),
            ],
            $this->grandchild->breadcrumbs,
        );
    }
}
