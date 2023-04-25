<?php

namespace AnthonyEdmonds\SilverOwl\Tests\Unit\Controllers\Content;

use AnthonyEdmonds\SilverOwl\Http\Controllers\ContentController;
use AnthonyEdmonds\SilverOwl\Models\Content;
use AnthonyEdmonds\SilverOwl\Tests\TestCase;
use Illuminate\Contracts\View\View;

class ShowTest extends TestCase
{
    protected Content $content;

    protected ContentController $controller;

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

    public function testHasBreadcrumbs(): void
    {
        $this->assertEquals(
            $this->content->breadcrumbs,
            $this->view->getData()['breadcrumbs'],
        );
    }

    public function testHasCategory(): void
    {
        $this->assertEquals(
            $this->content->category,
            $this->view->getData()['category'],
        );
    }

    public function testHasContent(): void
    {
        $this->assertEquals(
            $this->content,
            $this->view->getData()['content'],
        );
    }

    public function testHasTitle(): void
    {
        $this->assertEquals(
            $this->content->title,
            $this->view->getData()['title'],
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
