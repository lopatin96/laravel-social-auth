@if(config('laravel-social-auth.providers'))
    <div class="flex flex-col space-y-4">
        @foreach (config('laravel-social-auth.providers') as $key => $provider)
            @include("laravel-social-auth::button", [
                'provider' => $key,
                'title' => __($title, ['social' => $provider['title']])
            ])
        @endforeach
    </div>

    <p class="my-7 text-gray-400 text-center">
        {{ __('laravel-social-auth::social-auth.or') }}
    </p>
@endif