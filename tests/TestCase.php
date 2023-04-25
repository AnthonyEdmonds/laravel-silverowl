<?php

namespace AnthonyEdmonds\SilverOwl\Tests;

use AnthonyEdmonds\SilverOwl\Models\User;
use AnthonyEdmonds\SilverOwl\Providers\SilverOwlServiceProvider;
use AnthonyEdmonds\SilverOwl\Tests\Traits\AssertsFlashMessages;
use AnthonyEdmonds\SilverOwl\Tests\Traits\AssertsResults;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Laracasts\Flash\FlashServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    use AssertsFlashMessages;
    use AssertsResults;

    protected function setUp(): void
    {
        parent::setUp();

        config()->set('database.default', 'sqlite');
        $this->app->useDatabasePath(__DIR__.'/../src/database');
        $this->runLaravelMigrations();
    }

    protected function tearDown(): void
    {
        Schema::disableForeignKeyConstraints();

        parent::tearDown();
    }

    protected function getPackageProviders($app): array
    {
        return [
            SilverOwlServiceProvider::class,
            FlashServiceProvider::class,
        ];
    }

    protected function signIn(User $user = null): User
    {
        if ($user === null) {
            $user = User::factory()->create();
        }

        Auth::login($user);

        return $user;
    }
}
