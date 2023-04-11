<?php

namespace Atin\LaravelWelcomePage;

use Illuminate\Support\ServiceProvider;

class SocialAccountProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'laravel-welcome-page');
        $this->loadTranslationsFrom(__DIR__.'/../lang', 'laravel-welcome-page');
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'laravel-welcome-page');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/views')
        ], 'laravel-welcome-page-views');

        $this->publishes([
            __DIR__.'/../lang' => $this->app->langPath('vendor/laravel-welcome-page'),
        ], 'laravel-welcome-page-lang');

        $this->publishes([
            __DIR__.'/../config/config.php' => config_path('laravel-welcome-page.php')
        ], 'laravel-welcome-page-config');
    }
}