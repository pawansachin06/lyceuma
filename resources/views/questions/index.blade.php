<x-admin-layout sweetalert="1" mathjax="1">
    <div class="lg:container px-3 py-3">
        <div class="mb-2 flex flex-wrap justify-between items-center">
            <div class="">
                <h1 class="text-2xl font-sans font-semibold">Manage Questions</h1>
            </div>
            <div class="">
                <x-button href="{{ route('questions.create') }}">Add</x-button>
            </div>
        </div>
        <form class="flex flex-wrap gap-2 mb-3">
            @if( !empty($classrooms) )
                <div class="w-auto">
                    <select name="classroomId" required class="rounded py-1 focus:border-primary-500 focus:ring-primary-400">
                        @foreach($classrooms as $classroom)
                            <option value="{{ $classroom->id }}" <?= $classroom->id == $classroomId ? 'selected' : '' ?>>{{ $classroom->name }}</option>
                        @endforeach
                    </select>
                </div>
            @endif
            @if( !empty($subjects) )
                <div class="w-auto">
                    <select name="subjectId" required class="rounded py-1 focus:border-primary-500 focus:ring-primary-400">
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}" <?= $subject->id == $subjectId ? 'selected' : '' ?>>{{ $subject->name }}</option>
                        @endforeach
                    </select>
                </div>
            @endif
            @if( !empty($courses) )
                <div class="w-auto">
                    <select name="courseId" class="rounded py-1 focus:border-primary-500 focus:ring-primary-400">
                            <option value="">All Courses</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}" <?= $course->id == $courseId ? 'selected' : '' ?>>{{ $course->name }}</option>
                        @endforeach
                    </select>
                </div>
            @endif
            @if( !empty($statuses) )
                <div class="w-auto">
                    <select name="statusId" class="rounded py-1 focus:border-primary-500 focus:ring-primary-400">
                            <option value="">All Status</option>
                        @foreach($statuses as $status)
                            <option value="{{ $status }}" <?= $status == $statusId ? 'selected' : '' ?>>{{ $status }}</option>
                        @endforeach
                    </select>
                </div>
            @endif
            <x-button size="sm">Filter</x-button>
        </form>
        @if( !empty($items) && count($items) )
            <div class="overflow-x-auto mb-3">
                <table class="w-full bg-white">
                    <thead>
                        <tr class="border-solid border-b border-gray-200">
                            <th class="px-2 py-2">QuesID</th>
                            <th class="px-2 py-2">Question</th>
                            <th class="px-2 py-2">Answer</th>
                            <th class="px-2 py-2">Positive</th>
                            <th class="px-2 py-2">Negative</th>
                            <th class="px-2 py-2 text-center">Status</th>
                            <th class="px-2 py-2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                            <tr class="border border-b border-gray-100">
                                <td class="px-2 py-2">{{ $item->id }}</td>
                                <td class="px-2 py-2">{!! $item->question !!}</td>
                                <td class="px-2 py-2">{{ $item->answer }}</td>
                                <td class="px-2 py-2">{{ $item->positive_marks }}</td>
                                <td class="px-2 py-2">{{ $item->negative_marks }}</td>
                                <td class="px-2 py-2 text-center">
                                    @if( $item->status == 'PUBLISHED' )
                                        <x-icons.task-alt class="w-8 h-8 px-1 py-1 text-green-800 bg-green-200 rounded" />
                                    @elseif( $item->status == 'DRAFT' )
                                        <x-icons.draft-orders class="w-8 h-8 px-1 py-1 text-yellow-800 bg-yellow-200 rounded" />
                                    @else
                                        {{ $item->status }}
                                    @endif
                                </td>
                                <td class="px-2 py-2">
                                    <div class="inline-flex flex items-center flex-wrap gap-1 justify-end">
                                        <x-button href="{{ route('questions.edit', ['tableId'=> $tableId, 'quesId'=> $item->id]) }}" size="sm">Edit</x-button>
                                        @if( $currentUser->isSuperAdmin() || $currentUser->isAdmin() || $currentUser->isEditor() )
                                            <form action="{{ route('questions.destroy',['tableId'=> $tableId, 'quesId'=> $item->id]) }}" method="post" data-js="app-delete-form">
                                                @method('DELETE')
                                                <x-button type="submit" size="sm">Delete</x-button>
                                            </form>
                                        @endif
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
                <p class="mb-0 text-center">No records found, try another filter.</p>
            </div>
        @endif
    </div>
</x-admin-layout>