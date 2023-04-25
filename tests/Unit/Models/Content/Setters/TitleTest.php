<?php

namespace AnthonyEdmonds\LaravelSilverowl\Tests\Unit\Models\Content\Setters;

use AnthonyEdmonds\SilverOwl\Models\Content;
use AnthonyEdmonds\SilverOwl\Tests\TestCase;

class TitleTest extends TestCase
{
    protected Content $content;

    protected function setUp(): void
    {
        parent::setUp();

        $this->content = Content::factory()->make();
        $this->content->title = 'My cool title';
    }

    public function testSetsUsername(): void
    {
        $this->assertEquals(
            'My cool title',
            $this->content->title,
        );
    }

    public function testSetsSlug(): void
    {
        $this->assertEquals(
            'my-cool-title',
            $this->content->slug,
        );
    }
}
