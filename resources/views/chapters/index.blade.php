<x-admin-layout sweetalert="1">
    <div class="lg:container px-3 py-3">
        <div class="mb-2 flex flex-wrap justify-between items-center">
            <div class="">
                <h1 class="text-2xl font-sans font-semibold">Chapters</h1>
            </div>
            <form action="{{ route('chapters.store') }}" method="post" data-js="app-create-form">
                <x-button data-js="app-form-btn" type="submit">Create</x-button>
            </form>
        </div>
        @if( !empty($items) && count($items) )
            <div class="overflow-x-auto mb-3">
                <table class="w-full bg-white">
                    <thead>
                        <tr class="border-solid border-b border-gray-200">
                            <th class="px-2 py-2">Name</th>
                            <th class="px-2 py-2">Subject</th>
                            <th class="px-2 py-2 text-center">Status</th>
                            <th class="px-2 py-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                            <tr class="border border-b border-gray-100">
                                <td class="px-2 py-2">
                                    {{ $item->name }}
                                    <div class="text-sm text-gray-600">{{ $item->slug }}</div>
                                </td>
                                <td class="px-2 py-2">{{ $item?->subject?->name }}</td>
                                <td class="px-2 py-2 text-center">
                                    @if( $item->isStatusPublished() )
                                        <x-icons.task-alt class="w-8 h-8 px-1 py-1 text-green-800 bg-green-200 rounded" />
                                    @elseif( $item->isStatusDraft() )
                                        <x-icons.draft-orders class="w-8 h-8 px-1 py-1 text-yellow-800 bg-yellow-200 rounded" />
                                    @else
                                        {{ $item->status }}
                                    @endif
                                </td>
                                <td class="px-2 py-2 text-end">
                                    <div class="inline-flex flex items-center flex-wrap gap-1 justify-end">
                                        <x-button href="{{ route('chapters.edit', $item->id) }}" size="sm">Edit</x-button>
                                        <form action="{{ route('chapters.destroy', $item->id) }}" method="post" data-js="app-delete-form">
                                            @method('DELETE')
                                            <x-button type="submit" size="sm">Delete</x-button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @if( !empty($item->topics) && count($item->topics) )
                                <tr>
                                    <td colspan="3" class="px-2 py-2 border border-solid border-0 border-b border-gray-500">
                                        @foreach($item->topics as $topic)
                                            <div class="flex items-center gap-2">
                                                <a href="{{ route('chapters.edit', $topic->id) }}" class="text-xs block py-1 text-gray-600">{{ !empty($topic->name) ? $topic->name : 'Draft Topic' }}</a>
                                                <form action="{{ route('chapters.destroy', $topic->id) }}" method="post" data-js="app-delete-form" class="inline-block py-1">
                                                    @method('DELETE')
                                                    <button type="submit" class="border-0 inline-block text-xs py-1 rounded leading-none bg-red-500 text-white">Delete</button>
                                                </form>
                                            </div>
                                        @endforeach
                                    </td>
                                    <td class="px-2 py-2 border border-solid border-0 border-b border-gray-500 text-end">
                                        <form action="{{ route('chapters.store') }}" method="post" data-js="app-create-form">
                                            <input type="hidden" name="parent_id" value="{{ $item->id }}" />
                                            <x-button data-js="app-form-btn" size="sm" variant="default" type="submit">Add Topic</x-button>
                                        </form>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $items->onEachSide(2)->links() }}
        @else
            <div class="px-2 py-2 rounded border shadow-sm bg-white">
                <p class="mb-0 text-center">No records found</p>
            </div>
        @endif
    </div>
</x-admin-layout>