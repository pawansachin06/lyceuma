<x-admin-layout question="1">
    <div class="lg:container px-3 py-3">
        <div class="mb-2">
            <h1 class="text-2xl mb-1 font-sans font-semibold">Generate Excel Export File</h1>
            <p>Generate a sample file with real data and use it as base format of columns for bulk uploading your questions.</p>
        </div>
        <form action="{{ route('questions.export.download') }}" id="questions-export-form" class="hidden flex flex-wrap">
            @if( !empty($subjects) )
                <div class="w-full px-1 mb-3 select-none">
                    <div>Select Subject</div>
                    <div class="flex flex-wrap gap-5">
                        @foreach($subjects as $subject)
                            <label class="inline-flex gap-2 items-center cursor-pointer">
                                <input type="radio" name="subjectId" required value="{{ $subject->id }}" class="w-5 h-5 my-1 border-gray-500 text-primary-500 shadow-sm focus:ring-primary-500 border-solid" />
                                <span>{{ $subject->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            @endif

            @if( !empty($classrooms) )
                <div class="w-full px-1 mb-3 select-none">
                    <div>Select Class</div>
                    <div class="flex flex-wrap gap-5">
                        @foreach($classrooms as $classroom)
                            <label class="inline-flex gap-2 items-center cursor-pointer">
                                <input type="radio" name="classroomId" required value="{{ $classroom->id }}" class="w-5 h-5 my-1 border-gray-500 text-primary-500 shadow-sm focus:ring-primary-500 border-solid" />
                                <span>{{ $classroom->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="w-full px-1 mb-3">
                <p data-js="app-form-status" class="mb-2 hidden"></p>
                <div class="flex flex-wrap gap-2">
                    <x-button type="submit" data-js="app-form-btn">Download File</x-button>
                    <x-button :href="route('questions.import')" variant="default">Upload File</x-button>
                </div>
            </div>
        </form>
    </div>
</x-admin-layout>