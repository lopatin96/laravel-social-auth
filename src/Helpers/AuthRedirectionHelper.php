<?php

namespace App\Helpers;

namespace Atin\LaravelSocialAuth\Helpers;

class AuthRedirectionHelper
{
    public static function getRoute(): string
    {
        return auth()->user()->isAdmin()
            ? '/nova/dashboards/main'
            : '/dashboard';
    }
}
