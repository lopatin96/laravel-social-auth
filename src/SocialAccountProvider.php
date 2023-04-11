<?php

namespace Atin\LaravelSocialAccount;

use Illuminate\Support\ServiceProvider;

class SocialAccountProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'laravel-social-account');
        $this->loadTranslationsFrom(__DIR__.'/../lang', 'laravel-social-account');

        $this->publishes([
            __DIR__.'/../database/migrations' => database_path('/migrations')
        ], 'laravel-social-account-migrations');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/views')
        ], 'laravel-social-account-views');

        $this->publishes([
            __DIR__.'/../lang' => $this->app->langPath('vendor/laravel-social-account'),
        ], 'laravel-social-account-lang');
    }
}