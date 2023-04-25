<?php

namespace AnthonyEdmonds\SilverOwl\Tests\Unit\Models\Content\Getters;

use AnthonyEdmonds\SilverOwl\Models\Category;
use AnthonyEdmonds\SilverOwl\Models\Content;
use AnthonyEdmonds\SilverOwl\Tests\TestCase;

class BreadcrumbsTest extends TestCase
{
    protected Category $category;

    protected Content $content;

    protected function setUp(): void
    {
        parent::setUp();

        $this->content = Content::factory()->create();
        $this->category = $this->content->category;
    }

    public function testAppendsContentToCategory(): void
    {
        $this->assertEquals(
            [
                $this->category->name => route('categories.show', $this->category),
                $this->content->title => route('contents.show', [$this->category, $this->content]),
            ],
            $this->content->breadcrumbs,
        );
    }
}
