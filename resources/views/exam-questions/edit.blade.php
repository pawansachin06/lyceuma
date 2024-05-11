<x-admin-layout ckeditor="1">
    <div class="lg:container px-3 py-3">
        <div class="mb-2 flex flex-wrap justify-between items-center">
            <div class="">
                <h1 class="text-2xl font-semibold">Edit Question</h1>
            </div>
            <div class="">
                <x-button href="{{ route('exam-questions.index') }}">Back</x-button>
            </div>
        </div>
        <form action="{{ route('exam-questions.update', $item) }}" method="post" data-js="app-form">
            @method('PUT')
            <div class="flex flex-wrap -mx-1">
                <div class="w-full sm:w-6/12 px-1 mb-3">
                    <div class="flex flex-col">
                        <span>Name</span>
                        <input type="text" name="name" value="{{ $item->name }}" required class="rounded focus:border-primary-500 focus:ring-primary-400" />
                    </div>
                </div>
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
                @if( !empty($examPatterns) )
                <div class="w-full sm:w-6/12 px-1 mb-3">
                    <div class="flex flex-col">
                        <span>Exam Pattern</span>
                        <select name="exam_pattern_id" required class="rounded focus:border-primary-500 focus:ring-primary-400">
                            <option value="">Pick exam pattern</option>
                            @foreach($examPatterns as $examPattern)
                            <option value="{{ $examPattern->id }}" <?= $examPattern->id == $item->exam_pattern_id ? 'selected' : '' ?>>{{ $examPattern->name }} - {{ $examPattern?->type?->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                @endif
                @if( !empty($examSubjects) )
                <div class="w-full sm:w-6/12 px-1 mb-3">
                    <div class="flex flex-col">
                        <span>Exam Subject</span>
                        <select name="exam_subject_id" required class="rounded focus:border-primary-500 focus:ring-primary-400">
                            <option value="">Pick subject</option>
                            @foreach($examSubjects as $examSubject)
                            <option value="{{ $examSubject->id }}" <?= $examSubject->id == $item->exam_subject_id ? 'selected' : '' ?>>{{ $examSubject->name }}</option>
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
                @if( false && !empty($examAnswerTypes) )
                <div class="w-full sm:w-6/12 px-1 mb-3">
                    <div class="flex flex-col">
                        <span>Answer Type</span>
                        <select name="answer_type" required class="rounded focus:border-primary-500 focus:ring-primary-400">
                            @foreach($examAnswerTypes as $examAnswerType)
                            <option value="{{ $examAnswerType }}" <?= $examAnswerType == $item->answer_type->value ? 'selected' : '' ?>>{{ $examAnswerType }}</option>
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
                    <div>Answer 1</div>
                    <textarea class="app-ckeditor-textarea" data-name="answer1" style="display:none;"><?= $item->answer1 ?></textarea>
                </div>
                <div class="w-full px-1 mb-3">
                    <div>Answer 2</div>
                    <textarea class="app-ckeditor-textarea" data-name="answer2" style="display:none;"><?= $item->answer2 ?></textarea>
                </div>
                <div class="w-full px-1 mb-3">
                    <div>Answer 3</div>
                    <textarea class="app-ckeditor-textarea" data-name="answer3" style="display:none;"><?= $item->answer3 ?></textarea>
                </div>
                <div class="w-full px-1 mb-3">
                    <div>Answer 4</div>
                    <textarea class="app-ckeditor-textarea" data-name="answer4" style="display:none;"><?= $item->answer4 ?></textarea>
                </div>
                <div class="w-full px-1 mb-3">
                    <div>Correct Answer</div>
                    <div class="flex flex-wrap gap-3">
                        @for($i = 1; $i <= 4; $i++)
                            <div class="relative">
                                <input type="radio" id="correct-ans-number-{{ $i }}" value="{{ $i }}" <?= $item->correct_answer == $i ? 'checked' : '' ?> class="peer w-1 h-1 absolute right-0 top-0 opacity-0" required name="correct_answer">
                                <label for="correct-ans-number-{{ $i }}" class="group cursor-pointer inline-flex px-3 py-1 font-medium leading-tight rounded-md border border-solid border-primary-500 peer-checked:bg-blue-500 peer-checked:text-white">
                                    <span>Answer {{ $i }}</span>
                                </label>
                            </div>
                        @endfor
                    </div>
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