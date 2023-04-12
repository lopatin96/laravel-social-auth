# Usage
Add these lines to *resources/views/auth/login.blade.php*:

```html
<div class="flex flex-col space-y-4">
    @include('laravel-social-auth::social-auth.google-button', ['title' => __('laravel-social-auth::social-auth.Sign in with :social', ['social' => 'Google'])])
    @include('laravel-social-auth::social-auth.fb-button', ['title' => __('laravel-social-auth::social-auth.Sign in with :social', ['social' => 'Facebook'])])
</div>

<p class="my-7 text-gray-400 text-center">
    {{ __('laravel-social-auth::social-auth.or') }}
</p>
```

and these to *resources/views/auth/register.blade.php*:

```html
<div class="flex flex-col space-y-4">
    @include('laravel-social-auth::social-auth.google-button', ['title' => __('laravel-social-auth::social-auth.Sign up with :social', ['social' => 'Google'])])
    @include('laravel-social-auth::social-auth.fb-button', ['title' => __('laravel-social-auth::social-auth.Sign up with :social', ['social' => 'Facebook'])])
</div>

<p class="my-7 text-gray-400 text-center">
    {{ __('laravel-social-auth::social-auth.or') }}
</p>
```

and these lines to *app/Providers/FortyServiceProvider.php* as uses to manage redirections:

```php
use Atin\LaravelSocialAuth\Http\Responses\LoginResponse;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Laravel\Fortify\Contracts\TwoFactorLoginResponse as TwoFactorLoginResponseContract;
```

also don't forget to add **HasSocialAccount** trait to User model

```php

use Atin\LaravelSocialAuth\Traits\HasSocialAccount;

class User extends Authenticatable
{
    use HasSocialAccount, …
```

# Migrations
```php
php artisan vendor:publish --tag="laravel-social-auth-migrations"
```

# Localization
```php
php artisan vendor:publish --tag="laravel-social-auth-lang"
```

# Views
```php
php artisan vendor:publish --tag="laravel-social-auth-views"
```