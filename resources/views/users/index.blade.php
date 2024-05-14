<x-admin-layout sweetalert="1" title="Users">
    <div class="lg:container px-3 py-3">
        <div class="mb-2 flex flex-wrap justify-between items-center">
            <div class="">
                <h1 class="text-2xl font-sans font-semibold">Users</h1>
            </div>
            <div class="">
                <x-button :href="route('users.create')">Create</x-button>
            </div>
        </div>
        @if( !empty($items) && count($items) )
            <table class="w-full bg-white">
                <thead>
                    <tr class="border-solid border-b border-gray-200">
                        <th class="px-2 py-2 w-16">Image</th>
                        <th class="px-2 py-2">Name</th>
                        <th class="px-2 py-2">Role</th>
                        <th class="px-2 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                        <tr class="border border-b border-gray-100">
                            <td class="px-2 py-2">
                                <picture>
                                    <img src="{{ $item->profilePhotoUrl }}" alt="image" class="w-12 h-12 rounded" />
                                </picture>
                            </td>
                            <td class="px-2 py-2">
                                <div class="flex flex-col truncate">
                                    <p class="mb-0 leading-none font-semibold truncate">{{ $item->name }}</p>
                                    <small class="block truncate text-gray-600">
                                        {{ $item->email }} <br> {{ $item->created_at->format('d M Y') }}
                                    </small>
                                </div>
                            </td>
                            <td class="px-2 py-2">
                                @if( $item->isAdmin() )
                                    <span class="inline-flex items-center rounded-md bg-red-50 px-1 py-1 leading-none text-xs font-medium text-red-700 border border-red-600">
                                        {{ $item->role }}
                                    </span>
                                @elseif( $item->isEditor() )
                                    <span class="inline-flex items-center rounded-md bg-green-50 px-1 py-1 leading-none text-xs font-medium text-green-700 border border-green-600">
                                        {{ $item->role }}
                                    </span>
                                @else
                                    <span class="inline-flex items-center rounded-md bg-gray-500 px-1 py-1 leading-none text-xs font-medium text-white border border-gray-600">
                                        {{ $item->role }}
                                    </span>
                                @endif
                            </td>
                            <td class="px-2 py-2">
                                <div class="inline-flex flex items-center flex-wrap gap-1 justify-end">
                                    <x-button href="{{ route('users.edit', $item->id) }}" size="sm">Edit</x-button>
                                    <form action="{{ route('users.destroy', $item->id) }}" method="post" data-js="app-delete-form">
                                        @method('DELETE')
                                        <x-button type="submit" size="sm">Delete</x-button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            {{ $items->onEachSide(2)->links() }}
        @else
            <div class="px-2 py-2 rounded border shadow-sm bg-white">
                <p class="mb-0 text-center">No records found</p>
            </div>
        @endif
    </div>
</x-admin-layout>