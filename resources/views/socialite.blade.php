@if(config('laravel-social-auth.providers'))
    <div class="flex flex-col space-y-4">
        @foreach (config('laravel-social-auth.providers') as $key => $provider)
            @include("laravel-social-auth::button", [
                'provider' => $key,
                'title' => __($title, ['social' => $provider['title']])
            ])
        @endforeach
    </div>

    <div class="relative flex py-8 items-center">
        <div class="flex-grow border-t border-gray-100"></div>
        <span class="flex-shrink mx-4 text-gray-400">{{ __('laravel-social-auth::social-auth.or') }}</span>
        <div class="flex-grow border-t border-gray-100"></div>
    </div>
@endif