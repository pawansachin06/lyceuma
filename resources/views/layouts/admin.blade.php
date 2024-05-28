@props([
    'aos' => 0,
    'exam' => 0,
    'examsCreate' => 0,
    'swiper' => 0,
    'tippy' => 0,
    'tinymce' => 0,
    'mathjax' => 0,
    'question' => 0,
    'ckeditor' => 0,
    'sweetalert' => 0,
    'title' => config('app.name', 'Laravel'),
    'description' => 'Lyceuma',
])<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ $title }} | {{ config('app.name', 'Laravel') }}</title>
    <meta name="description" content="{{ $description }}">

    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1" />
    <meta name="googlebot" content="index, follow" />
    <meta name="distribution" content="global" />
    <link rel="manifest" href="/manifest.json" />

    <meta name="color-scheme" content="light" />
    <meta name="theme-color" content="#212121" />
    <meta name="apple-mobile-web-app-status-bar" content="#212121" />
    <link rel="icon" href="/favicon.ico" />
    <link rel="apple-touch-icon" href="/pwa/icon-192.png" />

    <meta property="og:title" content="{{ $title }}" />
    <meta property="og:image:alt" content="{{ $title }}" />
    <meta property="og:description" content={`Best Website Development Company, Domain Registration, Hosting, Website Designing. 100% Quality Work Guaranteed. On call support. Development Starts @2,999.`} />
    <meta property="og:site_name" content="{{ $title }}" />
    <meta property="og:locale" content="en_IN" />
    <meta property="og:type" content="website" />

    <meta name="twitter:title" content="{{ $title }}" />
    <meta name="twitter:card" content="summary_large_image" />

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
        'toastify' => '/css/lib/toastify.min.css?v=1.12.0',
        'ckeditor' => !empty($ckeditor) ? '/css/lib/ckeditor.css?v='. $version : '',
        'global' => '/css/admin/global.css?v=' . $version,
        'inter' => 'https://fonts.googleapis.com/css2?family=Inter:wght@500;600;800&display=swap',
        'montserrat' => 'https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap',
    ];
    @endphp
    @foreach($stylesArr as $stylePath)
        @if( !empty($stylePath) )
            <link rel="preload" as="style" href="{{ $stylePath }}" />
            <link rel="stylesheet" href="{{ $stylePath }}" />
        @endif
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
                <div id="app-sidebar" class="flex flex-col bg-primary-600">
                    <div class="flex-none flex px-2 shadow z-10 justify-between h-14">
                        <a href="{{ route('profile.show') }}" class="flex flex-row gap-2 items-center leading-tight truncate justify-center select-none no-underline hover:no-underline">
                            <picture>
                                <img src="{{ auth()->user()->profilePhotoUrl }}" alt="image" class="w-10 h-10 rounded object-cover object-center" />
                            </picture>
                            <span class="flex flex-col truncate">
                                <span class="truncate font-medium font-sans text-white">{{ auth()->user()->name }}</span>
                                <small class="inline-block text-gray-100 truncate">{{ auth()->user()->email }}</small>
                            </span>
                        </a>
                        <div class="flex gap-1">
                            <label for="app-sidebar-checkbox" title="Toggle sidebar" class="app-sidebar-close-btn lg:hidden group inline-flex items-center justify-center cursor-pointer text-gray-600 hover:text-gray-900 transition-colors">
                                <span class="w-10 h-10 inline-flex items-center justify-center rounded-full bg-gray-100 group-hover:bg-gray-300 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" width="24" height="24" viewBox="0 -960 960 960">
                                        <path d="M480-424 284-228q-11 11-28 11t-28-11q-11-11-11-28t11-28l196-196-196-196q-11-11-11-28t11-28q11-11 28-11t28 11l196 196 196-196q11-11 28-11t28 11q11 11 11 28t-11 28L536-480l196 196q11 11 11 28t-11 28q-11 11-28 11t-28-11L480-424Z" /></svg>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="grow overflow-y-auto app-scrollbar border-b select-none">
                        @foreach($navLinks as $navLink)
                            @if($navLink['show'])
                                @if( !empty($navLink['type']) )
                                    @if( $navLink['type'] == 'form' )
                                        <form action="{{ route($navLink['route']) }}" method="POST" class="block w-full" data-js="app-create-form">
                                            <button data-js="app-form-btn" type="submit" class="hidden {{ request()->routeIs($navLink['routes']) ? 'text-white bg-primary-500' : 'text-gray-200 bg-transparent hover:bg-primary-700' }} w-full flex px-2 py-2 items-center gap-2 no-underline focus:outline-primary-500 font-medium border-0">
                                                <x-dynamic-component :component="$navLink['icon']" class="w-5 h-5" />
                                                <span>{{ $navLink['title'] }}</span>
                                                <x-loader class="hidden w-4 h-4" />
                                            </button>
                                        </form>
                                    @endif
                                @else
                                    <a href="{{ route($navLink['route']) }}" class="{{ request()->routeIs($navLink['routes']) ? 'text-white bg-primary-500' : 'text-gray-200 hover:bg-primary-700' }} flex px-2 py-2 items-center gap-2 no-underline focus:outline-primary-500 font-medium">
                                        <x-dynamic-component :component="$navLink['icon']" class="w-5 h-5" />
                                        <span>{{ $navLink['title'] }}</span>
                                    </a>
                                @endif
                            @endif
                        @endforeach

                        <form method="POST" action="{{ route('logout') }}" class="block w-full">
                            @csrf
                            <button type="submit" class="text-left w-full text-red-100 bg-primary-600 hover:bg-red-500 hover:text-white flex px-2 py-2 border-0 items-center gap-2 font-medium focus:outline-secondary-500 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="h-5 w-5" width="24" height="24" viewBox="0 -960 960 960">
                                    <path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h280v80H200v560h280v80H200Zm440-160-55-58 102-102H360v-80h327L585-622l55-58 200 200-200 200Z" />
                                </svg>
                                <span>{{ __('Log out') }}</span>
                            </button>
                        </form>
                    </div>
                    <div class="text-center select-none">
                        <a href="{{ config('app.url') }}" target="_blank" rel="noopener noreferrer nofollow" class="text-sm leading-none no-underline text-white">Built with {{ config('app.name') }} Team</a>
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
    @if( !empty($scripts) )
        {{ $scripts }}
    @endif
    @php
    $scriptsArr = [
        'sweetalert' => !empty($sweetalert) ? '/js/lib/sweetalert2.min.js?v=11.9.0' : '',
        'popper' => !empty($tippy) ? '/js/lib/popper.min.js?v=2.11.8' : '',
        'tippy' => !empty($tippy) ? '/js/lib/tippy-bundle.umd.min.js?v=6.3.7' : '',
        'exam' => !empty($exam) ? '/js/exam.js?v='. $version : '',
        'examsCreate' => !empty($examsCreate) ? '/js/exams.create.js?v='. $version : '',
        'mathjax-local' => !empty($mathjax) ? '/js/mathjax.js?v='. $version : '',
        'mathjax' => !empty($mathjax) ? 'https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js' : '',
        'global' => '/js/global.js?v='. $version,
        'question' => !empty($question) ? '/js/question.js?v'. $version : '',
    ];
    @endphp
    <script defer src="/js/lib/toastify.min.js?v=1.12.0"></script>
    @if(!empty($ckeditor))
        <script src="/external/ckeditor5/build/ckeditor.js?v={{ $version }}"></script>
        <script type="text/javascript">
            var appCkEditor = null;
            var appCkEditors = [];
            (function(){
                var appCkeditorTextarea = document.getElementById('app-ckeditor-textarea');
                var appCkeditorTextareas = document.querySelectorAll('.app-ckeditor-textarea');
                if(appCkeditorTextareas){
                    for (var i = 0; i < appCkeditorTextareas.length; i++) {
                        ClassicEditor.create(appCkeditorTextareas[i])
                        .then(function(editor){
                            appCkEditors.push({
                                name: editor.sourceElement.getAttribute('data-name'),
                                editor: editor,
                            })
                            // console.log(editor.getData());
                        }).catch(function(error){
                            console.error( error );
                        });
                    }
                } else {
                    console.warn('CK Editor not in use, consider removing from this page');
                }
            })();
        </script>
    @endif

    @foreach($scriptsArr as $scriptPath)
        @if( !empty($scriptPath) )
            <script defer src="{{ $scriptPath }}"></script>
        @endif
    @endforeach

    @livewireScripts
</body>
</html>
