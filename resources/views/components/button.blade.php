@props([
    'variant' => 'primary',
    'size' => '',
    'href' => '',
    'type' => '',
])
@php
    $classes = ' select-none inline-flex gap-2 items-center justify-center border border-transparent rounded-md font-semibold tracking-wide transition-colors focus:outline focus:outline-offset-2';

    if( !empty($href) ){
        $type = '';
        $classes .= ' no-underline';
    }

    if($size == 'lg') {
        $classes .= ' text-lg px-4 py-2';
    } elseif($size == 'sm') {
        $classes .= ' text-sm px-2 py-1';
    } else {
        $classes .= ' text-base px-4 py-2';
    }

    if($variant == 'primary'){
        $classes .= ' text-white bg-primary-500 hover:bg-primary-800 focus:outline-primary-500';
    } elseif($variant == 'secondary'){
        $classes .= ' text-white bg-secondary-500 hover:bg-secondary-800 focus:outline-secondary-500';
    } else {
        $classes .= ' text-gray-800 bg-gray-300 hover:bg-gray-200 focus:outline-gray-500';
    }


@endphp
<{{ !empty($href) ? 'a' : 'button' }} {{ !empty($href) ? 'href='. $href . '' : '' }} {{ $attributes->merge(['class' => $classes ]) }} {{ !empty($href) ? '' : ( !empty($type) ? 'type="'. $type .'"' : 'type="submit"' ) }}>
    <span data-js="btn-text">{{ $slot }}</span>
    <svg  data-js="btn-loader" xmlns="http://www.w3.org/2000/svg" fill="none" class="animate-spin hidden shrink-0 w-4 h-4" viewBox="0 0 24 24" width="24" height="24">
        <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" class="opacity-25"></circle>
        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
    </svg>
</{{ !empty($href) ? 'a' : 'button' }}>
