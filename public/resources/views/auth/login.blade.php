<x-app-layout>
    <div class="w-full max-w-md mx-auto my-10 bg-white rounded-lg shadow">
        <x-auth.card-ajax />
    </div>
    <x-slot name="scripts">
        <script src="/js/auth.js?v={{ date('Y-m-d-h-i-s') }}"></script>
    </x-slot>
</x-app-layout>
