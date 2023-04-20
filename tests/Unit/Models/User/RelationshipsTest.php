<?php

namespace AnthonyEdmonds\SilverOwl\Tests\Unit\Models\User;

use AnthonyEdmonds\SilverOwl\Models\Content;
use AnthonyEdmonds\SilverOwl\Models\User;
use AnthonyEdmonds\SilverOwl\Tests\TestCase;

class RelationshipsTest extends TestCase
{
    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()
            ->hasContents(3)
            ->create();
    }

    public function testHasManyContents(): void
    {
        $this->assertCount(3, $this->user->contents);

        foreach ($this->user->contents as $content) {
            $this->assertInstanceOf(
                Content::class,
                $content,
            );
        }
    }
}
