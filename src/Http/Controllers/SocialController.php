<?php

namespace Atin\LaravelSocialAuth\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\User;
use Atin\LaravelSocialAuth\Helpers\AuthRedirectionHelper;
use Atin\LaravelSocialAuth\Models\SocialAccount;
use Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Routing\Redirector;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Jetstream\Jetstream;

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

        $socialAccount = SocialAccount::where('social_provider_user_id', $user->getId())
            ->where('social_provider', $social)
            ->first();

        if ($socialAccount && $socialAccount->user) {
            auth()->login($socialAccount->user);
        } else if ($socialAccount && ! $socialAccount->user) {
            abort(404);
        } else {
            $newSocialAccount = new SocialAccount;
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

            if (Jetstream::hasTeamFeatures()) {
                $this->createTeam($newUser);
            }

            event(new Registered($newUser));

            auth()->login($newUser);
        }

        return redirect(AuthRedirectionHelper::getRoute());
    }

    protected function createTeam(User $user): void
    {
        $user->ownedTeams()->save(Team::forceCreate([
            'user_id' => $user->id,
            'name' => explode(' ', $user->name, 2)[0]."'s Team",
            'personal_team' => true,
        ]));
    }
}
