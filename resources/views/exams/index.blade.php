<x-admin-layout sweetalert="1">
    <div class="lg:container px-3 py-3">
        <div class="mb-2 flex flex-wrap justify-between items-center">
            <div class="">
                <h1 class="text-2xl font-sans font-semibold">Exams</h1>
            </div>
            <div class="">
                <x-button href="{{ route('exams.create') }}">Add New Exam</x-button>
            </div>
        </div>
        <form class="flex flex-wrap gap-2 mb-3">
            @if( !empty($examCategories) )
                <div class="w-auto">
                    <select name="category_id" class="rounded py-1 focus:border-primary-500 focus:ring-primary-400">
                        <option value="">All categories</option>
                        @foreach($examCategories as $examCategory)
                            <option value="{{ $examCategory->id }}" <?= $examCategory->id == $category_id ? 'selected' : '' ?>>{{ $examCategory->name }}</option>
                        @endforeach
                    </select>
                </div>
            @endif

            @if( !empty($examTypes) )
                <div class="w-auto">
                    <select name="type_id" class="rounded py-1 focus:border-primary-500 focus:ring-primary-400">
                        <option value="">All types</option>
                        @foreach($examTypes as $examType)
                            <option value="{{ $examType->id }}" <?= $examType->id == $type_id ? 'selected' : '' ?>>{{ $examType->name }}</option>
                        @endforeach
                    </select>
                </div>
            @endif

            @if( !empty($examClasses) )
                <div class="w-auto">
                    <select name="class_id" class="rounded py-1 focus:border-primary-500 focus:ring-primary-400">
                        <option value="">All classes</option>
                        @foreach($examClasses as $examClass)
                            <option value="{{ $examClass->id }}">{{ $examClass->name }}</option>
                        @endforeach
                    </select>
                </div>
            @endif

            <x-button type="submit" size="sm" class="px-4">Filter</x-button>
        </form>
        @if( !empty($items) && count($items) )
            <div class="overflow-x-auto mb-3">
                <table class="w-full bg-white">
                    <thead>
                        <tr class="border-solid border-b border-gray-200">
                            <th class="px-2 py-2">Name</th>
                            <th class="px-2 py-2">Type</th>
                            <th class="px-2 py-2">Category</th>
                            <th class="px-2 py-2 text-center">Status</th>
                            <th class="px-2 py-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                            <tr class="border border-b border-gray-100">
                                <td class="px-2 py-2">{{ $item->name }}</td>
                                <td class="px-2 py-2">{{ $item->type?->name }}</td>
                                <td class="px-2 py-2">{{ $item->category?->name }}</td>
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
                                        <x-button href="{{ route('exams.edit', $item->id) }}" size="sm">Edit</x-button>
                                        <form action="{{ route('exams.destroy', $item->id) }}" method="post" data-js="app-delete-form">
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