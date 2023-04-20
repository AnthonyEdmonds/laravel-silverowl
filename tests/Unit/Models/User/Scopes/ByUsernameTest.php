<?php

namespace AnthonyEdmonds\LaravelSilverowl\Tests\Unit\Models\User\Scopes;

use AnthonyEdmonds\SilverOwl\Models\User;
use AnthonyEdmonds\SilverOwl\Tests\TestCase;
use Illuminate\Support\Collection;

class ByUsernameTest extends TestCase
{
    protected User $expected;
    
    protected Collection $unexpected;

    protected function setUp(): void
    {
        parent::setUp();

        $this->expected = User::factory()->create();
        $this->unexpected = User::factory()
            ->count(3)
            ->create();
    }

    public function testScopesResults(): void
    {
        $this->assertResultsMatch(
            User::byUsername($this->expected->username)->get(),
            collect([$this->expected]),
            $this->unexpected,
        );
    }
}
