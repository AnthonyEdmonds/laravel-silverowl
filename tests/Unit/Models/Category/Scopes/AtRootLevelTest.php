<?php

namespace AnthonyEdmonds\LaravelSilverowl\Tests\Unit\Models\Category\Scopes;

use AnthonyEdmonds\SilverOwl\Models\Category;
use AnthonyEdmonds\SilverOwl\Tests\TestCase;
use Illuminate\Support\Collection;

class AtRootLevelTest extends TestCase
{
    protected Collection $expected;

    protected Collection $unexpected;

    protected function setUp(): void
    {
        parent::setUp();

        $this->unexpected = Category::factory()
            ->count(3)
            ->forParent()
            ->create();

        $this->expected = Category::factory()
            ->count(2)
            ->create()
            ->push($this->unexpected->first()->parent);
    }

    public function testScopesResults(): void
    {
        $this->assertResultsMatch(
            Category::atRootLevel()->get(),
            $this->expected,
            $this->unexpected,
        );
    }
}
