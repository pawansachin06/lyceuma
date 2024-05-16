<x-admin-layout ckeditor="1" mathjax="1">
    <div class="lg:container px-3 py-3">
        <div class="mb-2 flex flex-wrap justify-between items-center">
            <div class="">
                <h1 class="text-2xl font-sans font-semibold">Edit Question</h1>
            </div>
            <div class="">
                <x-button :href="route('questions.index', ['subjectId'=> $subjectId, 'classId'=> $classId, ])">Back</x-button>
            </div>
        </div>
        <form action="{{ route('questions.update', ['tableId'=> $tableId, 'quesId' => $item->id]) }}" method="post" data-js="app-form">
            @method('PUT')
            <div class="flex flex-wrap -mx-1">
                @if( !empty($examChapters) )
                <div class="w-full sm:w-6/12 px-1 mb-3">
                    <div class="flex flex-col">
                        <span>Chapter</span>
                        <select name="exam_chapter_id" required class="rounded focus:border-primary-500 focus:ring-primary-400">
                            <option value="">Pick chapter</option>
                            @foreach($examChapters as $examChapter)
                                <optgroup label="{{ $examChapter->name }}">
                                    @if( !empty($examChapter->topics) && count($examChapter->topics) )
                                        @foreach($examChapter->topics as $topic)
                                            <option value="{{ $topic->id }}" <?= $topic->id == $item->exam_chapter_id ? 'selected' : '' ?>>{{ $topic->name }}</option>
                                        @endforeach
                                    @endif
                                </optgroup>
                            @endforeach
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
                            <option value="{{ $examDifficulty->id }}" <?= $examDifficulty->id == $item->exam_difficulty_id ? 'selected' : '' ?>>{{ $examDifficulty->name }}</option>
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
                            <option value="{{ $status }}" <?= $item->status == $status ? 'selected' : ''; ?>>{{ $status }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @endif
                <div class="w-full px-1 mb-3">
                    <div>Question</div>
                    <textarea class="app-ckeditor-textarea" data-name="question" style="display:none;"><?= $item->question ?></textarea>
                    <hr class="mb-0">
                </div>
                <div class="w-full px-1 mb-3">
                    <x-button type="button" data-name="question" data-preview="mathjax-question-preview" data-js="ckeditor-to-mathjax-btn" size="sm" class="mb-2">Render</x-button>
                    <div id="mathjax-question-preview" class="px-3 py-3 rounded-md bg-white shadow-sm"></div>
                </div>
                <div class="w-full px-1 mb-3">
                    <div>Option 1</div>
                    <textarea class="rounded w-full focus:border-primary-500 focus:ring-primary-400" name="option1"><?= $item->option1 ?></textarea>
                </div>
                <div class="w-full px-1 mb-3">
                    <div>Option 2</div>
                    <textarea class="rounded w-full focus:border-primary-500 focus:ring-primary-400" name="option2"><?= $item->option2 ?></textarea>
                </div>
                <div class="w-full px-1 mb-3">
                    <div>Option 3</div>
                    <textarea class="rounded w-full focus:border-primary-500 focus:ring-primary-400" name="option3"><?= $item->option3 ?></textarea>
                </div>
                <div class="w-full px-1 mb-3">
                    <div>Option 4</div>
                    <textarea class="rounded w-full focus:border-primary-500 focus:ring-primary-400" name="option4"><?= $item->option4 ?></textarea>
                </div>
                <div class="w-full px-1 mb-3">
                    <div>Option 5</div>
                    <textarea class="rounded w-full focus:border-primary-500 focus:ring-primary-400" name="option5"><?= $item->option5 ?></textarea>
                </div>
                @if(!empty($examAnswerTypes))
                    <div class="w-full sm:w-6/12 px-1 mb-3">
                        <div>Answer Type</div>
                        <select name="answer_type" class="rounded focus:border-primary-500 focus:ring-primary-400 w-full">
                            @foreach($examAnswerTypes as $examAnswerType)
                                <option value="{{ $examAnswerType['key'] }}" <?= $examAnswerType['key'] == $item->answer_type ? 'selected' : '' ?>>{{ $examAnswerType['value'] }}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
                <div class="w-full sm:w-6/12 px-1 mb-3">
                    <div>Answer</div>
                    <input type="text" name="answer" value="{{ $item->answer }}" required class="rounded w-full focus:border-primary-500 focus:ring-primary-400" />
                    <small>Please enter numerical eg:1(single choice) 2,3(multiple choice)</small>
                </div>
                <div class="w-full sm:w-6/12 px-1 mb-3">
                    <div>Positive Marks</div>
                    <input type="number" name="positive_marks" value="{{ $item->positive_marks }}" step="0.5" min="0" required class="rounded w-full focus:border-primary-500 focus:ring-primary-400" />
                </div>
                <div class="w-full sm:w-6/12 px-1 mb-3">
                    <div>Negative Marks</div>
                    <input type="number" name="negative_marks" value="{{ $item->negative_marks }}" step="0.5" min="0" required class="rounded w-full focus:border-primary-500 focus:ring-primary-400" />
                </div>
                <div class="w-full px-1 mb-3">
                    <div>Solution</div>
                    <textarea class="app-ckeditor-textarea" data-name="solution" style="display:none;"><?= $item->solution ?></textarea>
                </div>
                <div class="w-full px-1 mb-3">
                    <x-button type="button" data-name="solution" data-preview="mathjax-solution-preview" data-js="ckeditor-to-mathjax-btn" size="sm" class="mb-2">Render</x-button>
                    <div id="mathjax-solution-preview" class="px-3 py-3 rounded-md bg-white shadow-sm"></div>
                </div>
                <div class="w-full px-1 my-4">
                    <div data-js="app-form-status" class="hidden font-semibold hidden w-full mb-2"></div>
                    <div class="flex flex-wrap gap-2">
                        <x-button :href="route('questions.index', ['subjectId'=> $subjectId, 'classId'=> $classId, ])">Back</x-button>
                        <x-button type="submit" data-js="app-form-btn">Update Question</x-button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</x-admin-layout>