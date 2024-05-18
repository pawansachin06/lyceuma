<x-admin-layout>
    <div class="container text-center px-3 py-5 my-2 flex-none">
        <p class="text-sm text-red-800 font-semibold">ERROR 403</p>
        <h1 class="font-bold font-sans text-2xl md:text-4xl mb-3">Forbidden</h1>
        <p class="mb-4">It looks like you do not enough access to view this page.</p>
        <x-button :href="route('dashboard')">Go back to Dashboard</x-button>
    </div>
</x-admin-layout>