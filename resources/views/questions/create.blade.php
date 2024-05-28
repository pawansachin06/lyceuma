<x-admin-layout ckeditor="1" question="1" mathjax="1" tippy="1">
    <div class="lg:container px-3 py-3">
        <div class="mb-2 flex flex-wrap justify-between items-center">
            <div class="">
                <h1 class="text-2xl font-sans font-semibold">Upload Question</h1>
            </div>
            <div class="">
                <x-button href="{{ route('questions.index') }}">Back</x-button>
            </div>
        </div>
        <form action="{{ route('questions.store') }}" method="post" data-js="app-form">
            <div class="flex flex-wrap -mx-1">
                <div class="w-full px-1 mb-3">
                    <div>Question</div>
                    <textarea class="app-ckeditor-textarea" data-name="question" style="display:none;"></textarea>
                    <hr class="mb-0">
                </div>
                <div class="w-full px-1 mb-3">
                    <x-button type="button" data-name="question" data-preview="mathjax-question-preview" data-js="ckeditor-to-mathjax-btn" size="sm" class="mb-2">Render</x-button>
                    <div id="mathjax-question-preview" class="px-3 py-3 rounded-md bg-white shadow-sm"></div>
                </div>
                <div class="w-full sm:w-6/12 px-1 mb-3 flex justify-between gap-2">
                    <div class="flex flex-col w-full grow">
                        <span>Question Image</span>
                        <input type="file" name="question_image" data-js="preview-img-input" data-target-delete-btn="" data-target-img="preview-question-image" accept=".jpg,.jpeg,.png,.gif" class="block w-full rounded file:mr-2 file:px-3 file:py-2 file:border-0 border border-solid border-gray-500 file:bg-gray-200 hover:file:bg-gray-100 file:cursor-pointer focus:outline-primary-400 focus:border-primary-500 cursor-pointer bg-white" />
                    </div>
                    <div class="w-20 h-20 relative flex-none">
                        <img src="/img/dummy/blank.png" id="preview-question-image" class="w-full h-full rounded border border-solid border-gray-500 object-center object-cover" />
                    </div>
                </div>
                <div class="w-full sm:w-6/12 px-1 "></div>
                <div class="w-full sm:w-6/12 px-1 mb-3">
                    <div>Option 1</div>
                    <textarea id="question-option1-input" class="rounded w-full focus:border-primary-500 focus:ring-primary-400" name="option1"></textarea>
                </div>
                <div class="w-full sm:w-6/12 px-1 mb-3 flex justify-between gap-2">
                    <div class="flex flex-col w-full grow">
                        <span>Option 1 Image</span>
                        <input type="file" name="option1_image" data-js="preview-img-input" data-target-delete-btn="" data-target-img="preview-option1-image" accept=".jpg,.jpeg,.png,.gif" class="block w-full rounded file:mr-2 file:px-3 file:py-2 file:border-0 border border-solid border-gray-500 file:bg-gray-200 hover:file:bg-gray-100 file:cursor-pointer focus:outline-primary-400 focus:border-primary-500 cursor-pointer bg-white" />
                    </div>
                    <div class="w-20 h-20 relative flex-none">
                        <img src="/img/dummy/blank.png" id="preview-option1-image" class="w-full h-full rounded border border-solid border-gray-500 object-center object-cover" />
                    </div>
                </div>
                <div class="w-full px-1 mb-3">
                    <x-button type="button" data-source-id="question-option1-input" data-name="option1" data-preview="mathjax-option1-preview" data-js="ckeditor-to-mathjax-btn" size="sm" class="mb-2">Render</x-button>
                    <div id="mathjax-option1-preview" class="px-3 py-3 rounded-md bg-white shadow-sm"></div>
                </div>
                <div class="w-full sm:w-6/12 px-1 mb-3">
                    <div>Option 2</div>
                    <textarea id="question-option2-input" class="rounded w-full focus:border-primary-500 focus:ring-primary-400" name="option2"></textarea>
                </div>
                <div class="w-full sm:w-6/12 px-1 mb-3 flex justify-between gap-2">
                    <div class="flex flex-col w-full grow">
                        <span>Option 2 Image</span>
                        <input type="file" name="option2_image" data-js="preview-img-input" data-target-delete-btn="" data-target-img="preview-option2-image" accept=".jpg,.jpeg,.png,.gif" class="block w-full rounded file:mr-2 file:px-3 file:py-2 file:border-0 border border-solid border-gray-500 file:bg-gray-200 hover:file:bg-gray-100 file:cursor-pointer focus:outline-primary-400 focus:border-primary-500 cursor-pointer bg-white" />
                    </div>
                    <div class="w-20 h-20 relative flex-none">
                        <img src="/img/dummy/blank.png" id="preview-option2-image" class="w-full h-full rounded border border-solid border-gray-500 object-center object-cover" />
                    </div>
                </div>
                <div class="w-full px-1 mb-3">
                    <x-button type="button" data-source-id="question-option2-input" data-name="option2" data-preview="mathjax-option2-preview" data-js="ckeditor-to-mathjax-btn" size="sm" class="mb-2">Render</x-button>
                    <div id="mathjax-option2-preview" class="px-3 py-3 rounded-md bg-white shadow-sm"></div>
                </div>
                <div class="w-full sm:w-6/12 px-1 mb-3">
                    <div>Option 3</div>
                    <textarea id="question-option3-input" class="rounded w-full focus:border-primary-500 focus:ring-primary-400" name="option3"></textarea>
                </div>
                <div class="w-full sm:w-6/12 px-1 mb-3 flex justify-between gap-2">
                    <div class="flex flex-col w-full grow">
                        <span>Option 3 Image</span>
                        <input type="file" name="option3_image" data-js="preview-img-input" data-target-delete-btn="" data-target-img="preview-option3-image" accept=".jpg,.jpeg,.png,.gif" class="block w-full rounded file:mr-2 file:px-3 file:py-2 file:border-0 border border-solid border-gray-500 file:bg-gray-200 hover:file:bg-gray-100 file:cursor-pointer focus:outline-primary-400 focus:border-primary-500 cursor-pointer bg-white" />
                    </div>
                    <div class="w-20 h-20 relative flex-none">
                        <img src="/img/dummy/blank.png" id="preview-option3-image" class="w-full h-full rounded border border-solid border-gray-500 object-center object-cover" />
                    </div>
                </div>
                <div class="w-full px-1 mb-3">
                    <x-button type="button" data-source-id="question-option3-input" data-name="option3" data-preview="mathjax-option3-preview" data-js="ckeditor-to-mathjax-btn" size="sm" class="mb-2">Render</x-button>
                    <div id="mathjax-option3-preview" class="px-3 py-3 rounded-md bg-white shadow-sm"></div>
                </div>
                <div class="w-full sm:w-6/12 px-1 mb-3">
                    <div>Option 4</div>
                    <textarea id="question-option4-input" class="rounded w-full focus:border-primary-500 focus:ring-primary-400" name="option4"></textarea>
                </div>
                <div class="w-full sm:w-6/12 px-1 mb-3 flex justify-between gap-2">
                    <div class="flex flex-col w-full grow">
                        <span>Option 4 Image</span>
                        <input type="file" name="option4_image" data-js="preview-img-input" data-target-delete-btn="" data-target-img="preview-option4-image" accept=".jpg,.jpeg,.png,.gif" class="block w-full rounded file:mr-2 file:px-3 file:py-2 file:border-0 border border-solid border-gray-500 file:bg-gray-200 hover:file:bg-gray-100 file:cursor-pointer focus:outline-primary-400 focus:border-primary-500 cursor-pointer bg-white" />
                    </div>
                    <div class="w-20 h-20 relative flex-none">
                        <img src="/img/dummy/blank.png" id="preview-option4-image" class="w-full h-full rounded border border-solid border-gray-500 object-center object-cover" />
                    </div>
                </div>
                <div class="w-full px-1 mb-3">
                    <x-button type="button" data-source-id="question-option4-input" data-name="option4" data-preview="mathjax-option4-preview" data-js="ckeditor-to-mathjax-btn" size="sm" class="mb-2">Render</x-button>
                    <div id="mathjax-option4-preview" class="px-3 py-3 rounded-md bg-white shadow-sm"></div>
                </div>
                <div class="w-full sm:w-6/12 px-1 mb-3">
                    <div>Option 5</div>
                    <textarea id="question-option5-input" class="rounded w-full focus:border-primary-500 focus:ring-primary-400" name="option5"></textarea>
                </div>
                <div class="w-full sm:w-6/12 px-1 mb-3 flex justify-between gap-2">
                    <div class="flex flex-col w-full grow">
                        <span>Option 5 Image</span>
                        <input type="file" name="option5_image" data-js="preview-img-input" data-target-delete-btn="" data-target-img="preview-option5-image" accept=".jpg,.jpeg,.png,.gif" class="block w-full rounded file:mr-2 file:px-3 file:py-2 file:border-0 border border-solid border-gray-500 file:bg-gray-200 hover:file:bg-gray-100 file:cursor-pointer focus:outline-primary-400 focus:border-primary-500 cursor-pointer bg-white" />
                    </div>
                    <div class="w-20 h-20 relative flex-none">
                        <img src="/img/dummy/blank.png" id="preview-option5-image" class="w-full h-full rounded border border-solid border-gray-500 object-center object-cover" />
                    </div>
                </div>
                <div class="w-full px-1 mb-3">
                    <x-button type="button" data-source-id="question-option5-input" data-name="option5" data-preview="mathjax-option5-preview" data-js="ckeditor-to-mathjax-btn" size="sm" class="mb-2">Render</x-button>
                    <div id="mathjax-option5-preview" class="px-3 py-3 rounded-md bg-white shadow-sm"></div>
                </div>
                @if( !empty($subjects) )
                <div class="w-full px-1 mb-3 select-none">
                    <div>Pick Subject</div>
                    <div class="flex flex-wrap gap-x-5 gap-y-1">
                        @foreach($subjects as $subject)
                            <label class="inline-flex gap-2 items-center cursor-pointer">
                                <input type="radio" name="subject_id" required value="{{ $subject->id }}" data-js="question-subjects-radio" class="w-5 h-5 my-1 border-gray-500 text-primary-500 shadow-sm focus:ring-primary-500 border-solid" />
                                <span>{{ $subject->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
                @endif
                @if( !empty($classrooms) )
                <div class="w-full px-1 mb-3 select-none">
                    <div>Pick Classroom</div>
                    <div class="flex flex-wrap gap-x-5 gap-y-1">
                        @foreach($classrooms as $classroom)
                            <label class="inline-flex gap-2 items-center cursor-pointer">
                                <input type="radio" name="classroom_id" required value="{{ $classroom->id }}" class="w-5 h-5 my-1 border-gray-500 text-primary-500 shadow-sm focus:ring-primary-500 border-solid" />
                                <span>{{ $classroom->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
                @endif
                @if( !empty($courses) )
                <div class="w-full px-1 mb-3 select-none">
                    <div>Pick Course</div>
                    <div class="flex flex-wrap gap-x-5 gap-y-1">
                        @foreach($courses as $course)
                            <label class="inline-flex gap-2 items-center cursor-pointer">
                                <input type="checkbox" name="course_id[]" value="{{ $course->id }}" class="rounded w-5 h-5 my-1 border-gray-500 text-primary-500 shadow-sm focus:ring-primary-500 border-solid" />
                                <span>{{ $course->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
                @endif
                @if( !empty($difficulties) )
                <div class="w-full px-1 mb-3 select-none">
                    <div>Pick Difficulty</div>
                    <div class="flex flex-wrap gap-x-5 gap-y-1">
                        @foreach($difficulties as $difficulty)
                            <label class="inline-flex gap-2 items-center cursor-pointer">
                                <input type="checkbox" name="difficulty_id[]" value="{{ $difficulty->id }}" class="rounded w-5 h-5 my-1 border-gray-500 text-primary-500 shadow-sm focus:ring-primary-500 border-solid" />
                                <span>{{ $difficulty->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
                @endif
                <div class="w-full sm:w-6/12 px-1 mb-3">
                    <div class="flex flex-col">
                        <span>Chapter</span>
                        <select name="chapter_id" required data-js="chapters-select" class="rounded focus:border-primary-500 focus:ring-primary-400">
                            <option value="">Pick chapter</option>
                        </select>
                    </div>
                </div>
                <div class="w-full sm:w-6/12 px-1 mb-3">
                    <div class="flex flex-col">
                        <span>Topic</span>
                        <select name="topic_id" required data-js="topics-select" class="rounded focus:border-primary-500 focus:ring-primary-400">
                            <option value="">Pick topic</option>
                        </select>
                    </div>
                </div>
                @if(!empty($examAnswerTypes))
                    <div class="w-full sm:w-6/12 px-1 mb-3">
                        <div>Answer Type</div>
                        <select name="answer_type" data-js="question-answer-type-select" class="rounded focus:border-primary-500 focus:ring-primary-400 w-full">
                            @foreach($examAnswerTypes as $examAnswerType)
                                <option value="{{ $examAnswerType['key'] }}">{{ $examAnswerType['value'] }} ({{ $examAnswerType['key'] }})</option>
                            @endforeach
                        </select>
                    </div>
                @endif
                <div class="w-full sm:w-6/12 px-1 mb-3">
                    <div>Answer</div>
                    <input type="text" name="answer" value="" required class="rounded w-full focus:border-primary-500 focus:ring-primary-400" />
                    <small>Please enter numerical eg:1(single choice) 2,3(multiple choice)</small>
                </div>
                <div data-js="question-parent-id-box" class="w-full sm:w-6/12 px-1 mb-3">
                    <div>Parent Question ID <span data-tippy-content="Enter the ID of question after which you want this question to show in exam. Leave empty for no connection with another question."><x-icons.info class="w-6 h-6" /></span></div>
                    <input type="number" name="parent_id" value="" data-js="question-parent-id" min="1" step="1" class="rounded w-full focus:border-primary-500 focus:ring-primary-400" />
                </div>
                <div data-js="question-parent-order-box" class="w-full sm:w-6/12 px-1 mb-3">
                    <div>Parent Question Order No. <span data-tippy-content="If there are multiple child questions connected to one question, then this order number will decide in which sequence the child questions should show in exam."><x-icons.info class="w-6 h-6" /></span></div>
                    <input type="number" name="parent_order" value="" data-js="question-parent-order" min="1" step="1" class="rounded w-full focus:border-primary-500 focus:ring-primary-400" />
                </div>
                <div class="w-full sm:w-6/12 px-1 mb-3">
                    <div>Positive Marks</div>
                    <input type="number" name="positive_marks" value="" step="0.5" min="0" required class="rounded w-full focus:border-primary-500 focus:ring-primary-400" />
                </div>
                <div class="w-full sm:w-6/12 px-1 mb-3">
                    <div>Negative Marks</div>
                    <input type="number" name="negative_marks" value="" step="0.5" min="0" required class="rounded w-full focus:border-primary-500 focus:ring-primary-400" />
                </div>
                <div class="w-full px-1 mb-3">
                    <div>Solution</div>
                    <textarea class="app-ckeditor-textarea" data-name="solution" style="display:none;"></textarea>
                </div>
                <div class="w-full px-1 mb-3">
                    <x-button type="button" data-name="solution" data-preview="mathjax-solution-preview" data-js="ckeditor-to-mathjax-btn" size="sm" class="mb-2">Render</x-button>
                    <div id="mathjax-solution-preview" class="px-3 py-3 rounded-md bg-white shadow-sm"></div>
                </div>
                <div class="w-full px-1 mb-3">
                    <div>Source</div>
                    <textarea class="rounded w-full focus:border-primary-500 focus:ring-primary-400" name="source"></textarea>
                </div>
                <div class="w-full px-1 my-4">
                    <div data-js="app-form-status" class="hidden font-semibold hidden w-full mb-2"></div>
                    <x-button type="submit" data-js="app-form-btn">Add Question</x-button>
                </div>
            </div>
        </form>
    </div>
    <x-slot name="scripts">
        <script type="text/javascript">
            var CHAPTERS_API = "{{ route('api.chapters.index') }}";
        </script>
    </x-slot>
</x-admin-layout>