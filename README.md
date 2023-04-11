# Usage
Add these lines to *resources/views/auth/login.blade.php*

```html
<div class="flex flex-col space-y-4">
    @include('laravel-social-account::social-account.google-button', ['title' => __('laravel-social-account::social-account.Sign in with :social', ['social' => 'Google'])])
    @include('laravel-social-account::social-account.fb-button', ['title' => __('laravel-social-account::social-account.Sign in with :social', ['social' => 'Facebook'])])
</div>

<p class="my-7 text-gray-400 text-center">
    {{ __('laravel-social-account::social-account.or') }}
</p>
```

and these to *resources/views/auth/register.blade.php*

```html
<div class="flex flex-col space-y-4">
    @include('laravel-social-account::social-account.google-button', ['title' => __('laravel-social-account::social-account.Sign up with :social', ['social' => 'Google'])])
    @include('laravel-social-account::social-account.fb-button', ['title' => __('laravel-social-account::social-account.Sign up with :social', ['social' => 'Facebook'])])
</div>

<p class="my-7 text-gray-400 text-center">
    {{ __('laravel-social-account::social-account.or') }}
</p>
```

also add **HasSocialAccount** trait to User model. 

# Migrations
    php artisan vendor:publish --tag="laravel-social-account-migrations"

# Localization
    php artisan vendor:publish --tag="laravel-social-account-lang"

# Views
    php artisan vendor:publish --tag="laravel-social-account-views"