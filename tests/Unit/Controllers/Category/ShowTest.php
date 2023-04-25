<?php

namespace AnthonyEdmonds\SilverOwl\Tests\Unit\Controllers\Category;

use AnthonyEdmonds\SilverOwl\Http\Controllers\CategoryController;
use AnthonyEdmonds\SilverOwl\Models\Category;
use AnthonyEdmonds\SilverOwl\Tests\TestCase;
use Illuminate\Contracts\View\View;

class ShowTest extends TestCase
{
    protected Category $category;

    protected CategoryController $controller;

    protected View $view;

    protected function setUp(): void
    {
        parent::setUp();

        $this->category = Category::factory()->create();
        $this->controller = new CategoryController();
        $this->view = $this->controller->show($this->category);
    }

    public function testHasBreadcrumbs(): void
    {
        $this->assertEquals(
            $this->category->breadcrumbs,
            $this->view->getData()['breadcrumbs'],
        );
    }

    public function testHasCategory(): void
    {
        $this->assertEquals(
            $this->category,
            $this->view->getData()['category'],
        );
    }

    public function testHasTitle(): void
    {
        $this->assertEquals(
            $this->category->name,
            $this->view->getData()['title'],
        );
    }

    public function testHasView(): void
    {
        $this->assertEquals(
            'silverowl::categories.show',
            $this->view->name(),
        );
    }
}
