<?php

namespace AnthonyEdmonds\SilverOwl\Tests\Unit\Models\Content\Setup;

use AnthonyEdmonds\SilverOwl\Models\Content;
use AnthonyEdmonds\SilverOwl\Tests\TestCase;

class GetRouteKeyNameTest extends TestCase
{
    public function testReturnsRouteKey(): void
    {
        $content = new Content();

        $this->assertEquals(
            'slug',
            $content->getRouteKeyName(),
        );
    }
}
