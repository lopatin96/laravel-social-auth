# Install
### Views
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

### FortifyServiceProvider
Add these lines to *app/Providers/FortifyServiceProvider.php* as uses to manage redirections:

```php
use Atin\LaravelSocialAuth\Http\Responses\LoginResponse;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Laravel\Fortify\Contracts\TwoFactorLoginResponse as TwoFactorLoginResponseContract;
```

then add singletons to *boot* method in *app/Providers/FortifyServiceProvider.php*

```php
public function boot(): void
{
    …
    $this->app->singleton(LoginResponseContract::class, LoginResponse::class);
    $this->app->singleton(TwoFactorLoginResponseContract::class, LoginResponse::class);
}
```

### Trait
Add **HasSocialAccount** trait to User model

```php

use Atin\LaravelSocialAuth\Traits\HasSocialAccount;

class User extends Authenticatable
{
    use HasSocialAccount, …
```

### Configuration
Add these keys to *config/services.php* to manage google and facebook authentications:

```json
'google' => [
        'api_key' => env('GOOGLE_API_KEY'),
        'client_id' => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
        'redirect' => env('GOOGLE_REDIRECT'),
    ],

'facebook' => [
    'client_id' => env('FACEBOOK_CLIENT_ID'),
    'client_secret' => env('FACEBOOK_CLIENT_SECRET'),
    'redirect' => env('FACEBOOK_REDIRECT'),
],
```

# Publishing
### Migrations
```php
php artisan vendor:publish --tag="laravel-social-auth-migrations"
```

### Localization
```php
php artisan vendor:publish --tag="laravel-social-auth-lang"
```

### Views
```php
php artisan vendor:publish --tag="laravel-social-auth-views"
```