<?php

namespace AnthonyEdmonds\SilverOwl\Tests;

use AnthonyEdmonds\SilverOwl\Providers\SilverOwlServiceProvider;
use AnthonyEdmonds\SilverOwl\Tests\Traits\AssertsFlashMessages;
use AnthonyEdmonds\SilverOwl\Tests\Traits\AssertsResults;
use Laracasts\Flash\FlashServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    use AssertsFlashMessages;
    use AssertsResults;
    
    protected function setUp(): void
    {
        parent::setUp();

        $this->app->useDatabasePath(__DIR__.'/../src/database');
        $this->runLaravelMigrations();
    }

    protected function getPackageProviders($app): array
    {
        return [
            SilverOwlServiceProvider::class,
            FlashServiceProvider::class,
        ];
    }
}
