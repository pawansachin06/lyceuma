@props(['submit'])

<div {{ $attributes->merge(['class' => '']) }}>
    <form wire:submit="{{ $submit }}">
        <div class="px-4 py-4 bg-white shadow rounded-md {{ isset($actions) ? ' ' : ' ' }}">
            <x-section-title>
                <x-slot name="title">{{ $title }}</x-slot>
                <x-slot name="description">{{ $description }}</x-slot>
            </x-section-title>
            {{ $form }}
            @if (isset($actions))
                {{ $actions }}
            @endif
        </div>
    </form>
</div>
