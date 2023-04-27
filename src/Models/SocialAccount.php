<?php

namespace Atin\LaravelSocialAuth\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialAccount extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $primaryKey = 'user_id';

    public function user()
    {
        return $this->belongsTo(config('auth.providers.users.model'));
    }
}
