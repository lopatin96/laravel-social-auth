<?php

use Illuminate\Support\Facades\Route;

Route::controller(\Atin\LaravelSocialAuth\Http\Controllers\SocialController::class)->group(static function () {
    Route::get('/auth/{social}', 'socialLogin')
        ->where('social', 'google|facebook');
    Route::get('/auth/{social}/callback', 'handleProviderCallback')
        ->where('social', 'google|facebook');
});