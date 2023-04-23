<?php

namespace AnthonyEdmonds\SilverOwl\Tests\Unit\Controllers\Content;

use AnthonyEdmonds\SilverOwl\Http\Controllers\ContentController;
use AnthonyEdmonds\SilverOwl\Http\Controllers\Controller;
use AnthonyEdmonds\SilverOwl\Models\Content;
use AnthonyEdmonds\SilverOwl\Tests\TestCase;
use Illuminate\Contracts\View\View;

class ShowTest extends TestCase
{
    protected Content $content;

    protected Controller $controller;

    protected View $view;

    protected function setUp(): void
    {
        parent::setUp();

        $this->content = Content::factory()->create();
        $this->controller = new ContentController();
        $this->view = $this->controller->show($this->content);
    }

    public function testAddsViewCount(): void
    {
        $this->assertEquals(
            1,
            $this->content->views,
        );
    }

    public function testHasView(): void
    {
        $this->assertEquals(
            'silverowl::contents.show',
            $this->view->name(),
        );
    }
}
