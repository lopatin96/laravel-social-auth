<?php

namespace Atin\LaravelSocialAccount\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Redirector;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function socialLogin(string $social)
    {
        return Socialite::driver($social)->redirect();
    }

    public function handleProviderCallback(string $social)
    {
        try {
            $user = Socialite::driver($social)->stateless()->user();
        } catch (\Exception) {
            return redirect('/login');
        }

        if (
            $socialAccount = \Atin\LaravelSocialAccount\Models\SocialAccount::where('social_provider_user_id', $user->getId())
                ->where('social_provider', $social)
                ->first()
        ) {
            Auth::login($socialAccount->user);
        } else {
            $newSocialAccount = new \Atin\LaravelSocialAccount\Models\SocialAccount;
            $newSocialAccount->social_provider = $social;
            $newSocialAccount->social_provider_user_id = $user->getId();

            $newUser = User::create([
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'email_verified_at' => $user->getEmail() ? Carbon::now() : null,
            ]);

            $newSocialAccount->user()->associate($newUser);
            $newSocialAccount->save();

            event(new Registered($newUser));
            Auth::login($newUser);
        }

        return redirect(self::getRouteToRedirect());
    }

    public static function getRouteToRedirect(): string
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
