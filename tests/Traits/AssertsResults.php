<?php

namespace AnthonyEdmonds\SilverOwl\Tests\Traits;

use Illuminate\Support\Collection;

/**
 * Assert that a given collection contains (and / or does not contain) a set of expected (and / or unexpected) data
 *
 * @author Anthony Edmonds
 * @link https://github.com/AnthonyEdmonds
 */
trait AssertsResults
{
    public function assertResultsMatch(
        Collection $results,
        Collection $expected,
        Collection $unexpected,
        string $key = 'id'
    ): void
    {
        $this->assertResultsContain($results, $expected, $key);
        $this->assertResultsDontContain($results, $unexpected, $key);
    }

    public function assertResultsContain(
        Collection $results,
        Collection $expected,
        string $key = 'id'
    ): void
    {
        $this->assertResultsCount($results, $expected);

        $expected = $expected->pluck($key);

        $results
            ->pluck($key)
            ->each(function ($result) use ($expected) {
                $this->assertTrue(
                    $expected->contains($result),
                    "Expected result missing: $result"
                );
            });
    }

    public function assertResultsDontContain(
        Collection $results,
        Collection $unexpected,
        string $key = 'id'
    ): void
    {
        $results = $results->pluck($key);

        $unexpected
            ->pluck($key)
            ->each(function ($unexpected) use ($results) {
                $this->assertFalse(
                    $results->contains($unexpected),
                    "Unexpected result present: $unexpected"
                );
            });
    }

    public function assertResultsCount(
        Collection $results,
        Collection $expected
    ): void
    {
        $expectedCount = $expected->count();
        $resultsCount = $results->count();

        $this->assertEquals(
            $expectedCount,
            $resultsCount,
            "Wrong number of results: $resultsCount out of $expectedCount"
        );
    }
}
