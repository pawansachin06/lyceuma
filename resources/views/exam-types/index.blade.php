<x-admin-layout sweetalert="1">
    <div class="lg:container px-3 py-3">
        <div class="mb-2 flex flex-wrap justify-between items-center">
            <div class="">
                <h1 class="text-2xl font-semibold">Exam Types</h1>
            </div>
            <div class="">
                <x-button :href="route('exam-types.create')">Create</x-button>
            </div>
        </div>
        @if( !empty($items) && count($items) )
            <table class="w-full bg-white">
                <thead>
                    <tr class="border-solid border-b border-gray-200">
                        <th class="px-2 py-2">Name</th>
                        <th class="px-2 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                        <tr class="border border-b border-gray-100">
                            <td class="px-2 py-2">{{ $item->name }}</td>
                            <td class="px-2 py-2">
                                <div class="inline-flex flex items-center flex-wrap gap-1 justify-end">
                                    <x-button href="{{ route('exam-types.edit', $item->id) }}" size="sm">Edit</x-button>
                                    <form action="{{ route('exam-types.destroy', $item->id) }}" method="post" data-js="app-delete-form">
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