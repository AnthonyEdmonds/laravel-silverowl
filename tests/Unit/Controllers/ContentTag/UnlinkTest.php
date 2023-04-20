<?php

namespace AnthonyEdmonds\Silverowl\Tests\Unit\Controllers\ContentTag;

use AnthonyEdmonds\SilverOwl\Http\Controllers\ContentTagController;
use AnthonyEdmonds\SilverOwl\Models\Content;
use AnthonyEdmonds\SilverOwl\Models\Tag;
use AnthonyEdmonds\SilverOwl\Tests\TestCase;
use Illuminate\Http\RedirectResponse;

class UnlinkTest extends TestCase
{
    protected Content $content;

    protected ContentTagController $controller;

    protected RedirectResponse $redirect;

    protected Tag $tag;

    protected function setUp(): void
    {
        parent::setUp();

        $this->content = Content::factory()
            ->hasTags(1)
            ->create();

        $this->tag = $this->content->tags->first();

        $this->controller = new ContentTagController();
        $this->redirect = $this->controller->unlink($this->content, $this->tag);
    }

    public function testUnlinksContentWithTag(): void
    {
        $this->assertDatabaseMissing('content_tag', [
            'content_id' => $this->content->id,
            'tag_id' => $this->tag->id,
        ]);
    }

    public function testFlashesSuccess(): void
    {
        $this->assertFlashed(
            "Removed the \"{$this->tag->label}\" Tag from the \"{$this->content->title}\" Content.",
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
