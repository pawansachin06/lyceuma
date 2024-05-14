<x-admin-layout ckeditor="1">
    <div class="lg:container px-3 py-3">
        <div class="mb-2 flex flex-wrap justify-between items-center">
            <div class="">
                <h1 class="text-2xl font-sans font-semibold">Edit Question</h1>
            </div>
            <div class="">
                <x-button href="{{ route('exams.edit', $exam) }}">Back</x-button>
            </div>
        </div>
        <form action="{{ route('exams.update-question', ['exam'=> $exam, 'id'=> $item->id]) }}" method="post" data-js="app-form">
            @method('PUT')
            <div class="flex flex-wrap -mx-1">
                <div class="w-full sm:w-6/12 px-1 mb-3">
                    <div class="flex flex-col">
                        <span>Name</span>
                        <input type="text" name="name" value="{{ !empty($item->name) ? $item->name : '' }}" required class="rounded focus:border-primary-500 focus:ring-primary-400" />
                    </div>
                </div>
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
                @if( !empty($examChapters) )
                <div class="w-full sm:w-6/12 px-1 mb-3">
                    <div class="flex flex-col">
                        <span>Chapter</span>
                        <select name="exam_chapter_id" required class="rounded focus:border-primary-500 focus:ring-primary-400">
                            <option value="">Pick chapter</option>
                            @foreach($examChapters as $examChapter)
                            <option value="{{ $examChapter->id }}" <?= $examChapter->id == $item->exam_chapter_id ? 'selected' : '' ?>>{{ $examChapter->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @endif
                @if( !empty($examSubjects) )
                <div class="w-full sm:w-6/12 px-1 mb-3">
                    <div class="flex flex-col">
                        <span>Subject</span>
                        <select name="exam_subject_id" required class="rounded focus:border-primary-500 focus:ring-primary-400">
                            <option value="">Pick subject</option>
                            @foreach($examSubjects as $examSubject)
                            <option value="{{ $examSubject->id }}" <?= $examSubject->id == $item->exam_subject_id ? 'selected' : '' ?>>{{ $examSubject->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @endif
                @if( !empty($examTopics) )
                <div class="w-full sm:w-6/12 px-1 mb-3">
                    <div class="flex flex-col">
                        <span>Topic</span>
                        <select name="exam_topic_id" class="rounded focus:border-primary-500 focus:ring-primary-400">
                            <option value="">Pick topic</option>
                            @foreach($examTopics as $examTopic)
                            <option value="{{ $examTopic->id }}" <?= $examTopic->id == $item->exam_topic_id ? 'selected' : '' ?>>{{ $examTopic->name }}</option>
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
                <div class="w-full px-1 mb-3">
                    <div>Question</div>
                    <textarea class="app-ckeditor-textarea" data-name="question" style="display:none;"><?= $item->question ?></textarea>
                    <hr class="mb-0">
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
                <div class="w-full px-1 my-4">
                    <div data-js="app-form-status" class="hidden font-semibold hidden w-full mb-2"></div>
                    <x-button type="submit" data-js="app-form-btn">Update Question</x-button>
                </div>
            </div>
        </form>
    </div>
</x-admin-layout>