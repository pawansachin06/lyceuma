<x-admin-layout>
    <div class="lg:container px-3 py-3">
        <div class="mb-2 flex flex-wrap justify-between items-center">
            <div class="">
                <h1 class="text-2xl font-sans font-semibold">Edit Topic</h1>
            </div>
            <div class="">
                <x-button href="{{ route('exam-topics.index') }}">Back</x-button>
            </div>
        </div>
        <form action="{{ route('exam-topics.update', $item) }}" method="post" data-js="app-form">
            @method('PUT')
            <div class="flex flex-wrap -mx-1">
                <div class="w-full px-1 mb-3">
                    <div class="flex flex-col">
                        <span>Name</span>
                        <input type="text" name="name" value="{{ $item->name }}" required class="rounded focus:border-primary-500 focus:ring-primary-400" />
                    </div>
                </div>
                @if( !empty($examChapters) )
                <div class="w-full sm:w-6/12 px-1 mb-3">
                    <div class="flex flex-col">
                        <span>Chapter</span>
                        <select name="exam_chapter_id" required class="rounded focus:border-primary-500 focus:ring-primary-400">
                            <option value="">Pick chapter</option>
                            @foreach($examChapters as $examChapter)
                            <option value="{{ $examChapter->id }}" <?= $item->exam_chapter_id == $examChapter->id ? 'selected' : ''; ?>>{{ $examChapter->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @endif
                @if( !empty($statuses) )
                <div class="w-full sm:w-6/12 px-1 mb-3">
                    <div class="flex flex-col">
                        <span>Status</span>
                        <select name="status" class="rounded focus:border-primary-500 focus:ring-primary-400">
                            @foreach($statuses as $status)
                            <option value="{{ $status }}" <?= $item->isStatus($status) ? 'selected' : ''; ?>>{{ $status }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @endif
                <div class="w-full px-1 my-4">
                    <div data-js="app-form-status" class="hidden font-semibold hidden w-full mb-2"></div>
                    <x-button type="submit" data-js="app-form-btn">Update</x-button>
                </div>
            </div>
        </form>
    </div>
</x-admin-layout>