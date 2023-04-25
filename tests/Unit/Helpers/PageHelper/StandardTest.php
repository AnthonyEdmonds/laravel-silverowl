<?php

namespace AnthonyEdmonds\SilverOwl\Tests\Unit\Helpers\PageHelper;

use AnthonyEdmonds\SilverOwl\Helpers\PageHelper;
use AnthonyEdmonds\SilverOwl\Models\Category;
use AnthonyEdmonds\SilverOwl\Tests\TestCase;
use Illuminate\Contracts\View\View;

class StandardTest extends TestCase
{
    const BREADCRUMBS = [
        'My breadcrumbs' => 'are not for ducks',
    ];

    const FOOTER_LINKS = [
        'My footer' => 'is very smelly',
    ];

    protected Category $category;

    protected View $view;

    protected function setUp(): void
    {
        parent::setUp();

        $this->category = Category::factory()->create();
        config()->set('silverowl.footer.links', self::FOOTER_LINKS);

        $this->view = PageHelper::standard(
            'My title',
            'silverowl::home',
            self::BREADCRUMBS,
        );
    }

    public function testHasBlade(): void
    {
        $this->assertEquals(
            'silverowl::home',
            $this->view->name(),
        );
    }

    public function testHasBreadcrumbs(): void
    {
        $this->assertEquals(
            self::BREADCRUMBS,
            $this->view->getData()['breadcrumbs'],
        );
    }

    public function testHasFooterLinks(): void
    {
        $this->assertEquals(
            self::FOOTER_LINKS,
            $this->view->getData()['footerLinks'],
        );
    }

    public function testHasHeaderLinks(): void
    {
        $this->assertEquals(
            [
                $this->category->name => route('categories.show', $this->category),
            ],
            $this->view->getData()['headerLinks'],
        );
    }

    public function testHasTitle(): void
    {
        $this->assertEquals(
            'My title',
            $this->view->getData()['title'],
        );
    }
}
