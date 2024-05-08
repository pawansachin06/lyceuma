<div {{ $attributes->merge(['class' => '']) }}>
    <div class="px-4 py-3 bg-white shadow rounded-md">
        <x-section-title>
            <x-slot name="title">{{ $title }}</x-slot>
            <x-slot name="description">{{ $description }}</x-slot>
        </x-section-title>
        {{ $content }}
    </div>
</div>
