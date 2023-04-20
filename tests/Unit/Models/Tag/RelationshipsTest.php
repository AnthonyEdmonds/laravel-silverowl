<?php

namespace AnthonyEdmonds\SilverOwl\Tests\Unit\Models\Tag;

use AnthonyEdmonds\SilverOwl\Models\Category;
use AnthonyEdmonds\SilverOwl\Models\Content;
use AnthonyEdmonds\SilverOwl\Models\Tag;
use AnthonyEdmonds\SilverOwl\Tests\TestCase;

class RelationshipsTest extends TestCase
{
    protected Tag $category;

    protected function setUp(): void
    {
        parent::setUp();

        $this->category = Tag::factory()
            ->hasCategories(3)
            ->hasContents(3)
            ->create();
    }

    public function testHasManyCategories(): void
    {
        $this->assertCount(3, $this->category->categories);

        foreach ($this->category->categories as $category) {
            $this->assertInstanceOf(
                Category::class,
                $category,
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
}
