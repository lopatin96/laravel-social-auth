<?php

namespace Atin\LaravelSocialAuth\Traits;

use Atin\LaravelSocialAuth\Models\SocialAccount;

trait HasSocialAccount
{
    public function socialAccount()
    {
        return $this->hasOne(SocialAccount::class);
    }
}
