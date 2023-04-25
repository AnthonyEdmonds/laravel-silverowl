<?php

namespace AnthonyEdmonds\SilverOwl\Tests\Unit\Models\Category\Setup;

use AnthonyEdmonds\SilverOwl\Models\Category;
use AnthonyEdmonds\SilverOwl\Tests\TestCase;

class GetRouteKeyNameTest extends TestCase
{
    public function testReturnsRouteKey(): void
    {
        $category = new Category();

        $this->assertEquals(
            'slug',
            $category->getRouteKeyName(),
        );
    }
}
