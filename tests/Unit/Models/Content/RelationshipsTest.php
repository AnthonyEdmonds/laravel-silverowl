<?php

namespace AnthonyEdmonds\SilverOwl\Tests\Unit\Models\Content;

use AnthonyEdmonds\SilverOwl\Models\Category;
use AnthonyEdmonds\SilverOwl\Models\Content;
use AnthonyEdmonds\SilverOwl\Models\Tag;
use AnthonyEdmonds\SilverOwl\Models\User;
use AnthonyEdmonds\SilverOwl\Tests\TestCase;

class RelationshipsTest extends TestCase
{
    protected Content $content;

    protected function setUp(): void
    {
        parent::setUp();

        $this->content = Content::factory()
            ->hasAuthor()
            ->hasCategory()
            ->hasTags(3)
            ->create();
    }

    public function testBelongsToAuthor(): void
    {
        $this->assertInstanceOf(User::class, $this->content->author);
    }

    public function testBelongsToCategory(): void
    {
        $this->assertInstanceOf(Category::class, $this->content->category);
    }

    public function testBelongsToManyTags(): void
    {
        $this->assertCount(3, $this->content->tags);

        foreach ($this->content->tags as $tag) {
            $this->assertInstanceOf(
                Tag::class,
                $tag,
            );
        }
    }
}
