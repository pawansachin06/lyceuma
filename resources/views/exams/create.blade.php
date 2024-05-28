<x-admin-layout examsCreate="1">
    <div class="lg:container px-3 py-5">
        <div class="mb-2">
            <div class="text-center">
                <h1 class="text-2xl font-sans font-semibold">Create Exam</h1>
            </div>
        </div>
        <form action="{{ route('exams.store') }}" method="post" id="exam-create-form">
            <div class="max-w-2xl mx-auto">
                <div class="flex flex-wrap -mx-1">
                    <div class="w-full sm:w-6/12 px-1 mb-4">
                        <div>Exam Name</div>
                        <input type="text" name="name" required class="w-full rounded focus:border-primary-500 focus:ring-primary-400" />
                    </div>
                    <div class="w-full sm:w-6/12 px-1 mb-4">
                        <div>Target Exam</div>
                        <select required name="course_id" class="w-full rounded focus:border-primary-500 focus:ring-primary-400">
                            <option value=""></option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-full px-1 mb-4">
                        <div>Classes:</div>
                        <div class="flex flex-wrap gap-x-5 gap-y-1">
                            @foreach($classrooms as $classroom)
                                <label class="inline-flex gap-2 items-center cursor-pointer">
                                    <input type="checkbox" name="classroom_id[]" value="{{ $classroom->id }}" data-js="exam-create-classrooms-checkbox" class="rounded w-5 h-5 my-1 border-gray-500 text-primary-500 shadow-sm focus:ring-primary-500 border-solid" />
                                    <span>{{ $classroom->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                    <div class="w-full px-1 mb-4">
                        <div>Subjects:</div>
                        <div class="flex flex-wrap gap-x-5 gap-y-1">
                            @foreach($subjects as $subject)
                                <label class="inline-flex gap-2 items-center cursor-pointer">
                                    <input type="checkbox" name="subject_id[]" value="{{ $subject->id }}" data-js="exam-create-subjects-checkbox" class="rounded w-5 h-5 my-1 border-gray-500 text-primary-500 shadow-sm focus:ring-primary-500 border-solid" />
                                    <span>{{ $subject->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                    <div id="difficulties-box" class="hidden w-full px-1 mb-4">
                        <div>Difficulty:</div>
                        <div class="flex flex-wrap gap-x-5 gap-y-1">
                            @foreach($subjects as $subject)
                                <div id="sub-diff-{{ $subject->id }}" class="hidden inline-block">
                                    <div>{{ $subject->name }}</div>
                                    <select id="sub-diff-select-{{ $subject->id }}" name="difficulty_id[{{ $subject->id }}]" class="w-full rounded focus:border-primary-500 focus:ring-primary-400">
                                        <option value=""></option>
                                        @foreach($difficulties as $difficulty)
                                            <option value="{{ $difficulty->id }}">{{ $difficulty->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="w-full px-1 text-center my-4">
                        <div data-js="app-form-status" class="hidden font-semibold hidden w-full mb-2"></div>
                        <x-button type="submit" id="exam-create-submit-btn" class="hidden">Create Full Exam</x-button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</x-admin-layout>