<?php

namespace AnthonyEdmonds\Silverowl\Tests\Unit\Controllers\CategoryTag;

use AnthonyEdmonds\SilverOwl\Http\Controllers\CategoryTagController;
use AnthonyEdmonds\SilverOwl\Models\Category;
use AnthonyEdmonds\SilverOwl\Models\Tag;
use AnthonyEdmonds\SilverOwl\Tests\TestCase;
use Illuminate\Http\RedirectResponse;

class LinkTest extends TestCase
{
    protected Category $category;

    protected CategoryTagController $controller;

    protected RedirectResponse $redirect;

    protected Tag $tag;

    protected function setUp(): void
    {
        parent::setUp();

        $this->category = Category::factory()->create();
        $this->tag = Tag::factory()->create();

        $this->controller = new CategoryTagController();
        $this->redirect = $this->controller->link($this->category, $this->tag);
    }

    public function testLinksCategoryWithTag(): void
    {
        $this->assertDatabaseHas('category_tag', [
            'category_id' => $this->category->id,
            'tag_id' => $this->tag->id,
        ]);
    }

    public function testFlashesSuccess(): void
    {
        $this->assertFlashed(
            "Added the \"{$this->tag->label}\" Tag to the {$this->category->name} Category.",
            'success',
        );
    }

    public function testRedirects(): void
    {
        $this->assertEquals(
            route('admin.categories.edit', $this->category),
            $this->redirect->getTargetUrl(),
        );
    }
}
