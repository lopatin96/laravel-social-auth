<?php

namespace Atin\LaravelSocialAuth\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Atin\LaravelSocialAuth\Helpers\AuthRedirectionHelper;
use Event;
use Illuminate\Auth\Events\Registered;
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

        $socialAccount = \Atin\LaravelSocialAuth\Models\SocialAccount::where('social_provider_user_id', $user->getId())
            ->where('social_provider', $social)
            ->first();

        if ($socialAccount && $socialAccount->user) {
            auth()->login($socialAccount->user);
        } else if ($socialAccount && ! $socialAccount->user) {
            abort(404);
        } else {
            $newSocialAccount = new \Atin\LaravelSocialAuth\Models\SocialAccount;
            $newSocialAccount->social_provider = $social;
            $newSocialAccount->social_provider_user_id = $user->getId();

            $newUser = User::forceCreate([
                'name' => $user->getName(),
                'email' => $user->getEmail(),
                'email_verified_at' => $user->getEmail() ? now() : null,
                'locale' => request()->cookie('locale'),
                'country' => request()->cookie('country'),
                'variant' => request()->cookie('variant'),
                'keyword' => request()->cookie('keyword'),
            ]);

            $newSocialAccount->user()->associate($newUser);
            $newSocialAccount->save();

            event(new Registered($newUser));

            auth()->login($newUser);
        }

        return redirect(AuthRedirectionHelper::getRoute());
    }
}
