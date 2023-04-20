<?php

namespace AnthonyEdmonds\LaravelSilverowl\Tests\Unit\Models\Tag\Setters;

use AnthonyEdmonds\SilverOwl\Models\Tag;
use AnthonyEdmonds\SilverOwl\Tests\TestCase;

class ContentsTest extends TestCase
{
    protected Tag $tag;

    protected function setUp(): void
    {
        parent::setUp();

        $this->tag = Tag::factory()->make();
        $this->tag->label = 'My cool label';
    }

    public function testSetsUsername(): void
    {
        $this->assertEquals(
            'My cool label',
            $this->tag->label,
        );
    }

    public function testSetsSlug(): void
    {
        $this->assertEquals(
            'my-cool-label',
            $this->tag->slug,
        );
    }
}
