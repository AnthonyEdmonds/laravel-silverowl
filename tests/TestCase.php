<?php

namespace AnthonyEdmonds\SilverOwl\Tests;

use AnthonyEdmonds\SilverOwl\Providers\SilverOwlServiceProvider;
use AnthonyEdmonds\SilverOwl\Tests\Traits\AssertsFlashMessages;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Laracasts\Flash\FlashServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    use AssertsFlashMessages;
    use LazilyRefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->app->useDatabasePath(__DIR__.'/../src/database');
    }

    protected function getPackageProviders($app): array
    {
        return [
            SilverOwlServiceProvider::class,
            FlashServiceProvider::class,
        ];
    }
}
