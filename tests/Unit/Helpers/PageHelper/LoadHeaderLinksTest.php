<?php

namespace AnthonyEdmonds\SilverOwl\Tests\Unit\Helpers\PageHelper;

use AnthonyEdmonds\SilverOwl\Helpers\PageHelper;
use AnthonyEdmonds\SilverOwl\Models\Category;
use AnthonyEdmonds\SilverOwl\Tests\TestCase;
use Illuminate\Support\Collection;

class LoadHeaderLinksTest extends TestCase
{
    protected Collection $expected;

    protected function setUp(): void
    {
        parent::setUp();

        $unexpected = Category::factory()
            ->forParent()
            ->create();

        $this->expected = Category::factory()
            ->count(2)
            ->create()
            ->push($unexpected->parent);
    }

    public function testHasHeaders(): void
    {
        $this->assertEquals(
            $this->expected->sortBy('name')
                ->mapWithKeys(function ($category) {
                    return [$category->name => route('categories.show', $category)];
                })
                ->toArray(),
            PageHelper::loadHeaderLinks(),
        );
    }
}
