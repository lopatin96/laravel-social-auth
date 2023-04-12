<?php

namespace App\Helpers;

namespace Atin\LaravelSocialuth\Helpers;

use Illuminate\Support\Facades\Auth;

class AuthRedirectionHelper
{
    public static function getRoute(): string
    {
        return Auth::user()->isAdmin()
            ? '/nova/dashboards/main'
            : (
            ! Auth::user()->subscribed() && ! Auth::user()->onTrial()
                ? '/billing'
                : '/dashboard'
            );
    }
}
