<?php

namespace Atin\LaravelSocialAccount\Traits;

use Atin\LaravelSocialAccount\Models\SocialAccount;

trait HasSocialAccount
{
    public function socialAccount()
    {
        return $this->hasOne(SocialAccount::class);
    }
}