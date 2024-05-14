@props([
    'aos' => 0,
    'swiper' => 0,
    'mathjax' => 0,
    'title' => config('app.name', 'Laravel'),
    'description' => '',
])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title }} | {{ config('app.name', 'Laravel') }}</title>

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
        'global' => '/css/global.css?v=' . $version,
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
    <x-header />
    <main class="min-h-screen">{{ $slot }}</main>
    @stack('modals')
    @php
    $scriptsArr = [
        'polyfill' => !empty($mathjax) ? 'https://polyfill.io/v3/polyfill.min.js?features=es6' : '',
        'mathjax-local' => !empty($mathjax) ? '/js/mathjax.js?v='. $version : '',
        'mathjax' => !empty($mathjax) ? 'https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js' : '',
        'global' => '/js/global.js?v='. $version,
    ];
    @endphp
    @foreach($scriptsArr as $scriptPath)
        @if( !empty($scriptPath) )
            <script defer src="{{ $scriptPath }}"></script>
        @endif
    @endforeach

    @livewireScripts
</body>

</html>