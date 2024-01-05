<?php

use Illuminate\Support\Facades\Route;

Route::controller(\Atin\LaravelSocialAuth\Http\Controllers\SocialController::class)
    ->group(static function () {
        Route::get('/auth/{social}', 'socialLogin')
            ->whereIn('social', array_keys(config('laravel-social-auth.providers') ?? []));
        Route::get('/auth/{social}/callback', 'handleProviderCallback')
            ->whereIn('social', array_keys(config('laravel-social-auth.providers') ?? []));
    });