<x-admin-layout ckeditor="1" question="1" mathjax="1">
    <div class="lg:container px-3 py-3">
        <div class="mb-2 flex flex-wrap justify-between items-center">
            <div class="">
                <h1 class="text-2xl font-sans font-semibold">Add Question</h1>
            </div>
            <div class="">
                <x-button href="{{ route('questions.index') }}">Back</x-button>
            </div>
        </div>
        <form action="{{ route('questions.store') }}" method="post" data-js="app-form">
            <div class="flex flex-wrap -mx-1">
                @if( !empty($examSubjects) )
                <div class="w-full sm:w-6/12 px-1 mb-3">
                    <div class="flex flex-col">
                        <span>Subject</span>
                        <select name="exam_subject_id" data-js="exam-subjects-select" required class="rounded focus:border-primary-500 focus:ring-primary-400">
                            <option value="">Pick subject</option>
                            @foreach($examSubjects as $examSubject)
                                <option value="{{ $examSubject->id }}">{{ $examSubject->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @endif
                @if( !empty($examClasses) )
                <div class="w-full sm:w-6/12 px-1 mb-3">
                    <div class="flex flex-col">
                        <span>Class</span>
                        <select name="exam_class_id" required class="rounded focus:border-primary-500 focus:ring-primary-400">
                            <option value="">Pick class</option>
                            @foreach($examClasses as $examClasse)
                                <option value="{{ $examClasse->id }}">{{ $examClasse->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @endif
                @if( !empty($examChapters) )
                <div class="w-full sm:w-6/12 px-1 mb-3">
                    <div class="flex flex-col">
                        <span>Topic</span>
                        <select name="exam_chapter_id" required data-js="exam-chapters-select" class="rounded focus:border-primary-500 focus:ring-primary-400">
                            <option value="">Pick topic</option>
                        </select>
                    </div>
                </div>
                @endif
                @if( !empty($examDifficulties) )
                <div class="w-full sm:w-6/12 px-1 mb-3">
                    <div class="flex flex-col">
                        <span>Difficulty</span>
                        <select name="exam_difficulty_id" required class="rounded focus:border-primary-500 focus:ring-primary-400">
                            <option value="">Pick difficulty</option>
                            @foreach($examDifficulties as $examDifficulty)
                                <option value="{{ $examDifficulty->id }}">{{ $examDifficulty->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @endif
                <div class="w-full px-1 mb-3">
                    <div>Question</div>
                    <textarea class="app-ckeditor-textarea" data-name="question" style="display:none;"></textarea>
                    <hr class="mb-0">
                </div>
                <div class="w-full px-1 mb-3">
                    <x-button type="button" data-name="question" data-preview="mathjax-question-preview" data-js="ckeditor-to-mathjax-btn" size="sm" class="mb-2">Render</x-button>
                    <div id="mathjax-question-preview" class="px-3 py-3 rounded-md bg-white shadow-sm"></div>
                </div>
                <div class="w-full px-1 mb-3">
                    <div>Option 1</div>
                    <textarea class="rounded w-full focus:border-primary-500 focus:ring-primary-400" name="option1"></textarea>
                </div>
                <div class="w-full px-1 mb-3">
                    <div>Option 2</div>
                    <textarea class="rounded w-full focus:border-primary-500 focus:ring-primary-400" name="option2"></textarea>
                </div>
                <div class="w-full px-1 mb-3">
                    <div>Option 3</div>
                    <textarea class="rounded w-full focus:border-primary-500 focus:ring-primary-400" name="option3"></textarea>
                </div>
                <div class="w-full px-1 mb-3">
                    <div>Option 4</div>
                    <textarea class="rounded w-full focus:border-primary-500 focus:ring-primary-400" name="option4"></textarea>
                </div>
                <div class="w-full px-1 mb-3">
                    <div>Option 5</div>
                    <textarea class="rounded w-full focus:border-primary-500 focus:ring-primary-400" name="option5"></textarea>
                </div>
                @if(!empty($examAnswerTypes))
                    <div class="w-full sm:w-6/12 px-1 mb-3">
                        <div>Answer Type</div>
                        <select name="answer_type" class="rounded focus:border-primary-500 focus:ring-primary-400 w-full">
                            @foreach($examAnswerTypes as $examAnswerType)
                                <option value="{{ $examAnswerType['key'] }}">{{ $examAnswerType['value'] }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
                <div class="w-full sm:w-6/12 px-1 mb-3">
                    <div>Answer</div>
                    <input type="text" name="answer" value="" required class="rounded w-full focus:border-primary-500 focus:ring-primary-400" />
                    <small>Please enter numerical eg:1(single choice) 2,3(multiple choice)</small>
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
                <div class="w-full px-1 my-4">
                    <div data-js="app-form-status" class="hidden font-semibold hidden w-full mb-2"></div>
                    <x-button type="submit" data-js="app-form-btn">Add Question</x-button>
                </div>
            </div>
        </form>
    </div>
    <x-slot name="scripts">
        <script type="text/javascript">
            var EXAM_CHAPTERS_API = "{{ route('api.exam-chapters.index') }}";
        </script>
    </x-slot>
</x-admin-layout>