<?php

namespace Atin\LaravelSocialAccount\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SocialAccount;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use function App\Http\Controllers\auth;
use function App\Http\Controllers\event;
use function App\Http\Controllers\now;
use function App\Http\Controllers\redirect;

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
            $socialAccount = SocialAccount::where('social_provider_user_id', $user->getId())
                ->where('social_provider', $social)
                ->first()
        ) {
            Auth::login($socialAccount->user);
        } else {
            $newSocialAccount = new SocialAccount;
            $newSocialAccount->social_provider = $social;
            $newSocialAccount->social_provider_user_id = $user->getId();

            $newUser = User::create([
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'email_verified_at' => $user->getEmail() ? now() : null,
            ]);

            $newSocialAccount->user()->associate($newUser);
            $newSocialAccount->save();

            event(new Registered($newUser));
            Auth::login($newUser);
        }

        $home = auth()->user()->isAdmin()
            ? '/nova/dashboards/main'
            : (
                ! Auth::user()->subscribed() && ! Auth::user()->onTrial()
                    ? '/billing'
                    : '/dashboard'
            );

        return redirect($home);
    }
}
