<?php

namespace AnthonyEdmonds\SilverOwl\Tests\Unit\Models\Content\Utilities;

use AnthonyEdmonds\SilverOwl\Models\Content;
use AnthonyEdmonds\SilverOwl\Tests\TestCase;

class AddViewTest extends TestCase
{
    protected Content $content;

    protected function setUp(): void
    {
        parent::setUp();

        $this->content = Content::factory()->create([
            'views' => 68,
        ]);

        $this->content->addView();
    }

    public function testAddsView(): void
    {
        $this->assertDatabaseHas('contents', [
            'id' => $this->content->id,
            'views' => 69,
        ]);
    }
}
