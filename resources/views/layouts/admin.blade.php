<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Scripts -->
    @vite(['resources/css/app.scss', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles

    @php
    $version = date('Y-m-d-h-i-s');
    $stylesArr = [
        'lib' => '/css/lib.css?v='. $version,
        'global' => '/css/admin/global.css?v=' . $version,
        'montserrat' => 'https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap',
    ];
    @endphp
    @foreach($stylesArr as $stylePath)
    <link rel="preload" as="style" href="{{ $stylePath }}" />
    <link rel="stylesheet" href="{{ $stylePath }}" />
    @endforeach

    <script defer src="/js/lib/axios.min.js?v=1.6.8"></script>
    <script defer src="/js/base.js?v={{ $version }}"></script>
</head>
<body class="antialiased bg-gray-100">
    <x-banner />

    <div class="min-h-screen flex flex-col bg-gray-100">
        <div class="flex grow flex-row">
            <input type="checkbox" id="app-sidebar-checkbox" class="hidden" />
            <div id="app-sidebar-container" class="flex flex-col shrink-0">
                <label id="app-sidebar-overlay" for="app-sidebar-checkbox" class="transition-colors"></label>
                <div id="app-sidebar" class="flex flex-col bg-white shadow-sm">
                    <div class="flex-none flex px-1 shadow-sm justify-between h-14">
                        <span class="flex px-1 leading-tight truncate flex-col justify-center select-none">
                            <div class="truncate font-medium">{{ auth()->user()->name }}</div>
                            <small class="inline-block text-gray-600 truncate">{{ auth()->user()->email }}</small>
                        </span>
                        <div class="flex gap-1">
                            <label for="app-sidebar-checkbox" title="Toggle sidebar" class="app-sidebar-close-btn lg:hidden group inline-flex items-center justify-center cursor-pointer text-gray-600 hover:text-gray-900 transition-colors">
                                <span class="w-10 h-10 inline-flex items-center justify-center rounded-full bg-gray-100 group-hover:bg-gray-300 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" width="24" height="24" viewBox="0 -960 960 960">
                                        <path d="M480-424 284-228q-11 11-28 11t-28-11q-11-11-11-28t11-28l196-196-196-196q-11-11-11-28t11-28q11-11 28-11t28 11l196 196 196-196q11-11 28-11t28 11q11 11 11 28t-11 28L536-480l196 196q11 11 11 28t-11 28q-11 11-28 11t-28-11L480-424Z" /></svg>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="grow overflow-y-auto app-scrollbar border-b">
                        @foreach($navLinks as $navLink)
                            <a href="{{ route($navLink['route']) }}" class="{{ request()->routeIs($navLink['routes']) ? 'text-primary-800 bg-primary-50' : 'text-gray-600 hover:bg-gray-100' }} flex px-2 py-2 items-center gap-2 no-underline focus:outline-primary-500 font-medium">
                                <x-dynamic-component :component="$navLink['icon']" class="w-5 h-5" />
                                <span>{{ $navLink['title'] }}</span>
                            </a>
                        @endforeach

                        <form method="POST" action="{{ route('logout') }}" class="block w-full">
                            @csrf
                            <button type="submit" class="text-left w-full text-red-500 bg-red-100 hover:bg-red-500 hover:text-white flex px-2 py-2 border-0 items-center gap-2 font-medium focus:outline-secondary-500 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="h-5 w-5" width="24" height="24" viewBox="0 -960 960 960">
                                    <path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h280v80H200v560h280v80H200Zm440-160-55-58 102-102H360v-80h327L585-622l55-58 200 200-200 200Z" />
                                </svg>
                                <span>{{ __('Log out') }}</span>
                            </button>
                        </form>
                    </div>
                    <div class="text-center py-1">
                        <a href="{{ config('app.url') }}" target="_blank" rel="noopener noreferrer nofollow" class="text-sm leading-none no-underline">Built with {{ config('app.name') }} Team</a>
                    </div>
                </div>
            </div>
            <div id="app-content" class="flex flex-col grow-0 shrink w-full max-w-full">
                @livewire('navigation-menu')
                <main class="grow">{{ $slot }}</main>
            </div>
        </div>
    </div>
    @stack('modals')
    @php
    $scriptsArr = [
        'global' => '/js/global.js?v='. $version,
    ];
    @endphp
    @foreach($scriptsArr as $scriptPath)
    <script defer src="{{ $scriptPath }}"></script>
    @endforeach

    @livewireScripts
</body>
</html>
