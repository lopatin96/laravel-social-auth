# Usage
Add these lines to *resources/views/auth/login.blade.php*:

```html
<div class="flex flex-col space-y-4">
    @include('laravel-social-account::social-account.google-button', ['title' => __('laravel-social-account::social-account.Sign in with :social', ['social' => 'Google'])])
    @include('laravel-social-account::social-account.fb-button', ['title' => __('laravel-social-account::social-account.Sign in with :social', ['social' => 'Facebook'])])
</div>

<p class="my-7 text-gray-400 text-center">
    {{ __('laravel-social-account::social-account.or') }}
</p>
```

and these to *resources/views/auth/register.blade.php*:

```html
<div class="flex flex-col space-y-4">
    @include('laravel-social-account::social-account.google-button', ['title' => __('laravel-social-account::social-account.Sign up with :social', ['social' => 'Google'])])
    @include('laravel-social-account::social-account.fb-button', ['title' => __('laravel-social-account::social-account.Sign up with :social', ['social' => 'Facebook'])])
</div>

<p class="my-7 text-gray-400 text-center">
    {{ __('laravel-social-account::social-account.or') }}
</p>
```

and these lines to *app/Providers/FortyServiceProvider.php as uses to manage redirections:

```php
use Atin\LaravelSocialAccount\Http\Responses\LoginResponse;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Laravel\Fortify\Contracts\TwoFactorLoginResponse as TwoFactorLoginResponseContract;
```

also don't forget to add **HasSocialAccount** trait to User model

# Migrations
```php
php artisan vendor:publish --tag="laravel-social-account-migrations"
```

# Localization
```php
php artisan vendor:publish --tag="laravel-social-account-lang"
```

# Views
```php
php artisan vendor:publish --tag="laravel-social-account-views"
```