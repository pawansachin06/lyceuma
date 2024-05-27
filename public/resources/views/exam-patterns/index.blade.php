<x-admin-layout sweetalert="1">
    <div class="lg:container px-3 py-3">
        <div class="mb-2 flex flex-wrap justify-between items-center">
            <div class="">
                <h1 class="text-2xl font-sans font-semibold">Exam Patterns</h1>
            </div>
            <form action="{{ route('exam-patterns.store') }}" method="post" data-js="app-create-form">
                <x-button data-js="app-form-btn" type="submit">Create</x-button>
            </form>
        </div>
        @if( !empty($items) && count($items) )
            <div class="overflow-x-auto mb-3">
                <table class="w-full bg-white">
                    <thead>
                        <tr class="border-solid border-b border-gray-200">
                            <th class="px-2 py-2">Name</th>
                            <th class="px-2 py-2">Type</th>
                            <th class="px-2 py-2 text-center">Status</th>
                            <th class="px-2 py-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                            <tr class="border border-b border-gray-100">
                                <td class="px-2 py-2">{{ $item->name }}</td>
                                <td class="px-2 py-2">{{ $item?->type?->name }}</td>
                                <td class="px-2 py-2 text-center">
                                    @if( $item->isStatusPublished() )
                                        <x-icons.task-alt class="w-8 h-8 px-1 py-1 text-green-800 bg-green-200 rounded" />
                                    @elseif( $item->isStatusDraft() )
                                        <x-icons.draft-orders class="w-8 h-8 px-1 py-1 text-yellow-800 bg-yellow-200 rounded" />
                                    @else
                                        {{ $item->status }}
                                    @endif
                                </td>
                                <td class="px-2 py-2">
                                    <div class="inline-flex flex items-center flex-wrap gap-1 justify-end">
                                        <x-button href="{{ route('exam-patterns.edit', $item->id) }}" size="sm">Edit</x-button>
                                        <form action="{{ route('exam-patterns.destroy', $item->id) }}" method="post" data-js="app-delete-form">
                                            @method('DELETE')
                                            <x-button type="submit" size="sm">Delete</x-button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
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