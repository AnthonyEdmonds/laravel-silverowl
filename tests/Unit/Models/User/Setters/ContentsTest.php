<?php

namespace AnthonyEdmonds\LaravelSilverowl\Tests\Unit\Models\User\Setters;

use AnthonyEdmonds\SilverOwl\Models\User;
use AnthonyEdmonds\SilverOwl\Tests\TestCase;

class ContentsTest extends TestCase
{
    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->make();
        $this->user->username = 'My cool username';
    }

    public function testSetsUsername(): void
    {
        $this->assertEquals(
            'My cool username',
            $this->user->username,
        );
    }

    public function testSetsSlug(): void
    {
        $this->assertEquals(
            'my-cool-username',
            $this->user->slug,
        );
    }
}
