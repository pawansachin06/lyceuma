<header id="site-header" class="site-header sticky top-0 shadow-sm bg-white">
    <div class="container mx-auto px-3 flex justify-between">
        <a href="{{ route('home') }}" class="inline-block focus:outline-offset-2 focus:outline-primary-500">
            <x-application-logo class="w-48 shrink-0 my-1 rounded" />
        </a>
        <div class="flex items-center gap-2 py-1">
            <button data-tippy-content="Install Lite App" title="Install Lite App" class="lite-app-btn hidden inline-flex w-10 h-10 items-center justify-center text-gray-600 hover:text-gray-900 bg-gray-100 hover:bg-gray-300 transition-colors rounded-full border border-solid border-gray-400">
                <x-icons.install-mobile class="w-6 h-6 pointer-events-none" />
            </button>
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