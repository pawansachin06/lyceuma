@props([
    'aos' => 0,
    'swiper' => 0,
    'mathjax' => 0,
    'title' => config('app.name', 'Laravel'),
    'description' => 'Lyceuma',
])
<!DOCTYPE html>
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

    <script src="https://www.gstatic.com/firebasejs/6.0.2/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/6.0.2/firebase-auth.js"></script>
    <script>
        // var firebaseConfig = {
        //     apiKey: "AIzaSyBzkrQAcUfJ91J43vSONPAdRzucUNOumW8",
        //     authDomain: "email-confirmation-238a7.firebaseapp.com",
        //     databaseURL: "https://email-confirmation-238a7.firebaseio.com",
        //     projectId: "email-confirmation-238a7",
        //     storageBucket: "email-confirmation-238a7.appspot.com",
        //     messagingSenderId: "59262427980",
        //     appId: "1:59262427980:web:6fd74056013127e2c1e5e9",
        //     measurementId: "G-41K634RF74"
        // };
        var firebaseConfig = {
            apiKey: "AIzaSyDxDXSoFRdVJD8wnK7YOkL3lCTAo1Gj5Rw",
            authDomain: "byxstage.firebaseapp.com",
            // databaseURL: "https://email-confirmation-238a7.firebaseio.com",
            projectId: "byxstage",
            storageBucket: "byxstage.appspot.com",
            messagingSenderId: "881177660369",
            appId: "1:881177660369:web:38491f09b4b128ed0deef0",
            // measurementId: "G-41K634RF74"
        };
        firebase.initializeApp(firebaseConfig);
    </script>

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
    @if( !empty($scripts) )
        {{ $scripts }}
    @endif

    @livewireScripts
</body>

</html>