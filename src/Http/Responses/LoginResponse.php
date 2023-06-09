<?php

namespace Atin\LaravelSocialAuth\Http\Responses;

use Atin\LaravelSocialAuth\Helpers\AuthRedirectionHelper;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Illuminate\Routing\Redirector;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        return redirect()->intended(AuthRedirectionHelper::getRoute());
    }
}
