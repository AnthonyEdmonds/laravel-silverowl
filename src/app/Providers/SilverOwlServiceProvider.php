<?php

namespace AnthonyEdmonds\SilverOwl\Providers;

use AnthonyEdmonds\SilverOwl\Console\Commands\AddUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

class SilverOwlServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../../config/silverowl.php',
            'silverowl'
        );

        $this->commands([
            AddUser::class,
        ]);
    }

    public function boot(): void
    {
        $this->bootMigrations();
        $this->bootPublishes();
        $this->bootRoutes();
        $this->bootViews();

        Model::preventLazyLoading(app()->environment() !== 'production');
    }

    protected function bootMigrations(): void
    {
        $this->loadMigrationsFrom([
            __DIR__.'/../../database/migrations',
        ]);
    }

    protected function bootPublishes(): void
    {
        $this->publishes([
            __DIR__.'/../../resources/views' => resource_path('views/vendor/silverowl'),
        ], 'silverowl-blade');
    }

    protected function bootRoutes(): void
    {
        $this->loadRoutesFrom(__DIR__.'/../../routes/silverowl.php');
    }

    protected function bootViews(): void
    {
        $this->loadViewsFrom(
            __DIR__.'/../../resources/views',
            'silverowl'
        );
    }
}
