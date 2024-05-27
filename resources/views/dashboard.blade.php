<x-admin-layout title="Dashboard">
    <div class="px-3 py-3">
        <h2 class="font-sans">Dashboard</h2>
        @if($user->isSuperAdmin() || $user->isAdmin())
            <div class="mb-3 hidden">
                <form action="{{ route('backup.download') }}" data-js="app-form">
                    <x-button type="submit" data-js="app-form-btn">Download Backup</x-button>
                </form>
            </div>
        @endif
        @if(!empty($cards))
            <div class="flex flex-wrap -mx-1">
                @foreach($cards as $card)
                    <div class="w-full sm:w-6/12 md:w-4/12 xl:w-3/12 px-1 py-1">
                        <a href="{{ @$card['link'] }}" class="block no-underline text-gray-800 px-3 py-3 shadow-sm rounded bg-white">
                            <div class="flex justify-between">
                                <div class="truncate">
                                    <p class="text-sm mb-1 font-medium truncate">{{ @$card['title'] }}</p>
                                    <p class="text-xl mb-0 leading-none font-bold">{{ @$card['content'] }}</p>
                                </div>
                                <div class="text-gray-300">

                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-admin-layout>
