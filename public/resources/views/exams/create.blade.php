<x-admin-layout exam="1">
    <div class="lg:container px-3 py-3">
        <div class="mb-2 flex flex-wrap justify-between items-center">
            <div class="">
                <h1 class="text-2xl font-sans font-semibold">Create Exam</h1>
            </div>
            <div class="">
                <x-button href="{{ route('exams.index') }}">Back</x-button>
            </div>
        </div>
        <form action="{{ route('exams.store') }}" method="post" data-js="app-form">
            <div class="flex flex-wrap -mx-1">
                <div class="w-full px-1 mb-3">
                    <div class="flex flex-col">
                        <span>Name (must be unique)</span>
                        <input type="text" name="name" value="" required autofocus class="rounded focus:border-primary-500 focus:ring-primary-400" />
                    </div>
                </div>
                @if( !empty($examCategories) )
                <div class="w-full sm:w-6/12 px-1 mb-3">
                    <div class="flex flex-col">
                        <span>Category</span>
                        <select name="exam_category_id" required class="rounded focus:border-primary-500 focus:ring-primary-400">
                            <option value="">Pick category</option>
                            @foreach($examCategories as $examCategory)
                            <option value="{{ $examCategory->id }}">{{ $examCategory->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @endif
                <div class="w-full sm:w-6/12 px-1 mb-3">
                    <div class="flex flex-col">
                        <span>Durantion (in minutes)</span>
                        <input type="number" name="duration" value="" min="0" step="1" required class="rounded focus:border-primary-500 focus:ring-primary-400" />
                    </div>
                </div>
                <div class="w-full sm:w-6/12 px-1 mb-3">
                    <div class="flex flex-col">
                        <span>Date</span>
                        <input type="date" name="date" value="" required class="rounded focus:border-primary-500 focus:ring-primary-400" />
                    </div>
                </div>
                <div class="w-full sm:w-6/12 px-1 mb-3">
                    <div class="flex flex-col">
                        <span>Start Time</span>
                        <input type="time" name="start_time" value="" required class="rounded focus:border-primary-500 focus:ring-primary-400" />
                    </div>
                </div>
                <div class="w-full sm:w-6/12 px-1 mb-3">
                    <div class="flex flex-col">
                        <span>End Time</span>
                        <input type="time" name="end_time" value="" required class="rounded focus:border-primary-500 focus:ring-primary-400" />
                    </div>
                </div>
                @if( !empty($examTypes) )
                <div class="w-full sm:w-6/12 px-1 mb-3">
                    <div class="flex flex-col">
                        <span>Type</span>
                        <select name="exam_type_id" required class="rounded focus:border-primary-500 focus:ring-primary-400">
                            <option value="">Pick type</option>
                            @foreach($examTypes as $examType)
                            <option value="{{ $examType->id }}">{{ $examType->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @endif
                @if( !empty($examClasses) )
                <div class="w-full px-1 mb-3 select-none">
                    <div>Classes</div>
                    <div class="flex flex-wrap gap-5">
                        @foreach($examClasses as $examClass)
                            <label class="inline-flex gap-2 items-center cursor-pointer">
                                <input type="checkbox" name="exam_class_id[]" value="{{ $examClass->id }}" class="w-5 h-5 my-1 rounded border-gray-500 text-primary-500 shadow-sm focus:ring-primary-500 border-solid" />
                                <span>{{ $examClass->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
                @endif
                @if( !empty($examSubjects) )
                <div class="w-full px-1 mb-3 select-none">
                    <div>Subjects</div>
                    <div class="flex flex-wrap gap-5">
                        @foreach($examSubjects as $examSubject)
                            <label class="inline-flex gap-2 items-center cursor-pointer">
                                <input type="checkbox" name="exam_subject_id[]" value="{{ $examSubject->id }}" data-difficulty-box-id="exam-subject-difficulty-box-{{ $examSubject->id }}" data-js="exam-subject-difficulty-input" class="w-5 h-5 my-1 rounded border-gray-500 text-primary-500 shadow-sm focus:ring-primary-500 border-solid" />
                                <span>{{ $examSubject->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
                    @if(!empty($examDifficulties))
                        <div class="w-full px-1 mb-3 select-none flex flex-wrap gap-5">
                            @foreach($examSubjects as $examSubject)
                                <div id="exam-subject-difficulty-box-{{ $examSubject->id }}" class="w-auto hidden">
                                    <div>{{ $examSubject->name }} difficulty</div>
                                    <select name="exam_subject_difficulty[{{ $examSubject->id }}][difficulty]" class="w-full rounded focus:border-primary-500 focus:ring-primary-400">
                                        @foreach($examDifficulties as $examDifficulty)
                                            <option value="{{ $examDifficulty->id }}">{{ $examDifficulty->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endforeach
                        </div>
                    @endif
                @endif
                <div class="w-full px-1 my-4">
                    <div data-js="app-form-status" class="hidden font-semibold hidden w-full mb-2"></div>
                    <x-button type="submit" data-js="app-form-btn">Create Exam</x-button>
                </div>
            </div>
        </form>
    </div>
</x-admin-layout>