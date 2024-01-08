<a href="/auth/{{ $provider }}">
    <div class="flex items-center justify-between hover:bg-gray-100 transition rounded-lg border px-4 py-2.5">
        <div class="flex items-center space-x-4">
             <span>
                 @include("laravel-social-auth::logos.$provider")
             </span>
            <span>
                {{ $title }}
            </span>
        </div>
        <span class="mr-1">
            <svg width="8" height="12" viewBox="0 0 8 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 0.5L6.5 6L1 11.5" stroke="currentColor" stroke-linecap="round"></path></svg>
        </span>
    </div>
</a>
