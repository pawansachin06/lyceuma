<x-admin-layout question="1">
    <div class="lg:container px-3 py-3">
        <div class="mb-2 flex flex-wrap justify-between items-center">
            <div class="">
                <h1 class="text-2xl font-sans font-semibold">Edit Chapter/Topic</h1>
            </div>
            <div class="">
                <x-button href="{{ route('chapters.index') }}">Back</x-button>
            </div>
        </div>
        <form action="{{ route('chapters.update', $item) }}" method="post" data-js="app-form">
            @method('PUT')
            <div class="flex flex-wrap -mx-1">
                <div class="w-full sm:w-6/12 px-1 mb-3">
                    <div class="flex flex-col">
                        <span>Name</span>
                        <input type="text" name="name" value="{{ $item->name }}" required class="rounded focus:border-primary-500 focus:ring-primary-400" />
                    </div>
                </div>
                <div class="w-full sm:w-6/12 px-1 mb-3">
                    <div class="flex flex-col">
                        <span>Slug</span>
                        <input type="text" name="slug" value="{{ $item->slug }}" required class="rounded focus:border-primary-500 focus:ring-primary-400" />
                    </div>
                </div>
                @if( !empty($subjects) )
                <div class="w-full px-1 mb-3 select-none">
                    <div>Pick Subject</div>
                    <div class="flex flex-wrap gap-x-5 gap-y-1">
                        @foreach($subjects as $subject)
                            <label class="inline-flex gap-2 items-center cursor-pointer">
                                <input type="radio" name="subject_id" required value="{{ $subject->id }}" <?= $subject->id == $item->subject_id ? 'checked' : '' ?> class="w-5 h-5 my-1 border-gray-500 text-primary-500 shadow-sm focus:ring-primary-500 border-solid" />
                                <span>{{ $subject->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
                @endif
                @if( !empty($chapters) )
                <div class="w-full sm:w-6/12 px-1 mb-3">
                    <div class="flex flex-col">
                        <span>Parent Chapter</span>
                        <select name="parent_id" class="rounded focus:border-primary-500 focus:ring-primary-400">
                            <option value="">This is parent chapter</option>
                            @foreach($chapters as $chapter)
                                <option value="{{ $chapter->id }}" <?= $chapter->id == $item->parent_id ? 'selected' : '' ?>>{{ $chapter->name }}</option>
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