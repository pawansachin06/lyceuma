<header id="site-header" class="site-header sticky top-0 shadow-sm bg-white">
    <div class="container mx-auto px-3 flex justify-between">
        <a href="{{ route('home') }}" class="inline-block focus:outline-offset-2 focus:outline-primary-500">
            <x-application-logo class="w-48 shrink-0 my-2 rounded" />
        </a>
        <div class="flex gap-2 py-2">
            @guest
                <a href="{{ route('login') }}" class="inline-flex px-4 py-2 items-center justify-center font-semibold rounded no-underline focus:outline-offset-2 focus:outline-secondary-500 bg-secondary-500 hover:bg-secondary-800 text-white transition-colors">
                    <span>Make Sample Test</span>
                </a>
            @endguest
            @auth
                <a href="{{ route('dashboard') }}" class="inline-flex px-4 py-2 items-center justify-center font-semibold rounded no-underline focus:outline-offset-2 focus:outline-secondary-500 bg-secondary-500 hover:bg-secondary-800 text-white transition-colors">
                    <span>My Account</span>
                </a>
            @endauth
        </div>
    </div>
</header>