<?php

namespace Atin\LaravelSocialAuth\Traits;

use Atin\LaravelSocialAuth\Models\SocialAccount;
use Illuminate\Database\Eloquent\SoftDeletes;

trait HasSocialAccount
{
    use SoftDeletes;

    public function socialAccount()
    {
        return $this->hasOne(SocialAccount::class);
    }
}