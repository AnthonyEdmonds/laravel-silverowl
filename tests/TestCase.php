<?php

namespace AnthonyEdmonds\SilverOwl\Tests;

use AnthonyEdmonds\SilverOwl\Providers\SilverOwlServiceProvider;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;
use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    use LazilyRefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->app->useDatabasePath(__DIR__.'/../src/database');
        //$this->runLaravelMigrations();
    }

    protected function getPackageProviders($app): array
    {
        return [
            SilverOwlServiceProvider::class,
        ];
    }
}
