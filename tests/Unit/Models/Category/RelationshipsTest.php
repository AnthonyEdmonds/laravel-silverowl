<?php

namespace AnthonyEdmonds\SilverOwl\Tests\Unit\Models\Category;

use AnthonyEdmonds\SilverOwl\Models\Category;
use AnthonyEdmonds\SilverOwl\Models\Content;
use AnthonyEdmonds\SilverOwl\Models\Tag;
use AnthonyEdmonds\SilverOwl\Tests\TestCase;

class RelationshipsTest extends TestCase
{
    protected Category $category;

    protected function setUp(): void
    {
        parent::setUp();

        $this->category = Category::factory()
            ->hasChildren(3)
            ->hasContents(3)
            ->hasParent()
            ->hasTags(3)
            ->create();
    }

    public function testHasManyChildren(): void
    {
        $this->assertCount(3, $this->category->children);

        foreach ($this->category->children as $child) {
            $this->assertInstanceOf(
                Category::class,
                $child,
            );
        }
    }

    public function testHasManyContents(): void
    {
        $this->assertCount(3, $this->category->contents);

        foreach ($this->category->contents as $content) {
            $this->assertInstanceOf(
                Content::class,
                $content,
            );
        }
    }

    public function testBelongsToParent(): void
    {
        $this->assertInstanceOf(Category::class, $this->category->parent);
    }

    public function testBelongsToManyTags(): void
    {
        $this->assertCount(3, $this->category->tags);

        foreach ($this->category->tags as $tag) {
            $this->assertInstanceOf(
                Tag::class,
                $tag,
            );
        }
    }
}