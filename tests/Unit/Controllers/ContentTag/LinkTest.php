<?php

namespace AnthonyEdmonds\Silverowl\Tests\Unit\Controllers\ContentTag;

use AnthonyEdmonds\SilverOwl\Http\Controllers\ContentTagController;
use AnthonyEdmonds\SilverOwl\Models\Content;
use AnthonyEdmonds\SilverOwl\Models\Tag;
use AnthonyEdmonds\SilverOwl\Tests\TestCase;
use Illuminate\Http\RedirectResponse;

class LinkTest extends TestCase
{
    protected Content $content;

    protected ContentTagController $controller;

    protected RedirectResponse $redirect;

    protected Tag $tag;

    protected function setUp(): void
    {
        parent::setUp();

        $this->content = Content::factory()->create();
        $this->tag = Tag::factory()->create();

        $this->controller = new ContentTagController();
        $this->redirect = $this->controller->link($this->content, $this->tag);
    }

    public function testLinksContentWithTag(): void
    {
        $this->assertDatabaseHas('content_tag', [
            'content_id' => $this->content->id,
            'tag_id' => $this->tag->id,
        ]);
    }

    public function testFlashesSuccess(): void
    {
        $this->assertFlashed(
            "Added the \"{$this->tag->label}\" Tag to the \"{$this->content->title}\" Content.",
            'success',
        );
    }

    public function testRedirects(): void
    {
        $this->assertEquals(
            route('admin.contents.edit', $this->content),
            $this->redirect->getTargetUrl(),
        );
    }
}
