<?php

namespace AnthonyEdmonds\SilverOwl\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rule;

class SilverOwlServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../../config/silverowl.php',
            'silverowl'
        );
    }

    public function boot(): void
    {
        $this->bootPublishes();
        $this->bootViews();
    }

    protected function bootPublishes(): void
    {
        $this->publishes([
            __DIR__.'/../../resources/views' => resource_path('views/vendor/silverowl'),
        ], 'silverowl-blade');
    }

    protected function bootViews(): void
    {
        $this->loadViewsFrom(
            __DIR__.'/../../resources/views',
            'silverowl'
        );
    }
}
