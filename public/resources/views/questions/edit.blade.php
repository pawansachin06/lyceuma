<x-admin-layout ckeditor="1" question="1" mathjax="1">
    <div class="lg:container px-3 py-3">
        <div class="mb-2 flex flex-wrap justify-between items-center">
            <div class="">
                <h1 class="text-2xl font-sans font-semibold">Edit Question</h1>
            </div>
            <div class="">
                <x-button :href="route('questions.index', ['subjectId'=> $subjectId, 'classroomId'=> $classroomId, ])">Back</x-button>
            </div>
        </div>
        <form action="{{ route('questions.update', ['tableId'=> $tableId, 'quesId' => $item->id]) }}" method="post" data-js="app-form">
            @method('PUT')
            <div class="flex flex-wrap -mx-1">
                <div class="w-full px-1 mb-3">
                    <div>Question</div>
                    <textarea class="app-ckeditor-textarea" data-name="question" style="display:none;"><?= $item->question ?></textarea>
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
                        <img src="{{ !empty($images['question_image']['url']) ? $images['question_image']['url'] : '/img/dummy/blank.png' }}" id="preview-question-image" class="w-full h-full rounded border border-solid border-gray-500 object-center object-cover" />
                        <button type="button" data-table="{{ $tableId }}" data-ques="{{ $item->id }}" data-name="question_image" data-target-img="preview-question-image" id="preview-question-delete-image-btn" data-route="{{ $imageDeleteRoute }}" data-js="preview-image-delete-btn" class="{{ !empty($images['question_image']['url']) ? '' : 'hidden' }} absolute inline-flex items-center justify-center rounded border border-solid top-0 right-0 mx-1 my-1 px-1 py-1 bg-red-500 text-white">
                            <x-icons.delete data-js="btn-text" class="w-5 h-5 pointer-events-none" />
                            <x-loader class="hidden w-5 h-5" />
                        </button>
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
                <div class="w-full sm:w-6/12 px-1 mb-3">
                    <div>Option 1</div>
                    <textarea class="rounded w-full focus:border-primary-500 focus:ring-primary-400" name="option1"><?= $item->option1 ?></textarea>
                </div>
                <div class="w-full sm:w-6/12 px-1 mb-3 flex justify-between gap-2">
                    <div class="flex flex-col w-full grow">
                        <span>Option 1 Image</span>
                        <input type="file" name="option1_image" data-js="preview-img-input" data-target-delete-btn="" data-target-img="preview-option1-image" accept=".jpg,.jpeg,.png,.gif" class="block w-full rounded file:mr-2 file:px-3 file:py-2 file:border-0 border border-solid border-gray-500 file:bg-gray-200 hover:file:bg-gray-100 file:cursor-pointer focus:outline-primary-400 focus:border-primary-500 cursor-pointer bg-white" />
                    </div>
                    <div class="w-20 h-20 relative flex-none">
                        <img src="{{ !empty($images['option1_image']['url']) ? $images['option1_image']['url'] : '/img/dummy/blank.png' }}" id="preview-option1-image" class="w-full h-full rounded border border-solid border-gray-500 object-center object-cover" />
                        <button type="button" data-table="{{ $tableId }}" data-ques="{{ $item->id }}" data-name="option1_image" data-target-img="preview-option1-image" id="preview-option1-delete-image-btn" data-route="{{ $imageDeleteRoute }}" data-js="preview-image-delete-btn" class="{{ !empty($images['option1_image']['url']) ? '' : 'hidden' }} absolute inline-flex items-center justify-center rounded border border-solid top-0 right-0 mx-1 my-1 px-1 py-1 bg-red-500 text-white">
                            <x-icons.delete data-js="btn-text" class="w-5 h-5 pointer-events-none" />
                            <x-loader class="hidden w-5 h-5" />
                        </button>
                    </div>
                </div>
                <div class="w-full sm:w-6/12 px-1 mb-3">
                    <div>Option 2</div>
                    <textarea class="rounded w-full focus:border-primary-500 focus:ring-primary-400" name="option2"><?= $item->option2 ?></textarea>
                </div>
                <div class="w-full sm:w-6/12 px-1 mb-3 flex justify-between gap-2">
                    <div class="flex flex-col w-full grow">
                        <span>Option 2 Image</span>
                        <input type="file" name="option2_image" data-js="preview-img-input" data-target-delete-btn="" data-target-img="preview-option2-image" accept=".jpg,.jpeg,.png,.gif" class="block w-full rounded file:mr-2 file:px-3 file:py-2 file:border-0 border border-solid border-gray-500 file:bg-gray-200 hover:file:bg-gray-100 file:cursor-pointer focus:outline-primary-400 focus:border-primary-500 cursor-pointer bg-white" />
                    </div>
                    <div class="w-20 h-20 relative flex-none">
                        <img src="{{ !empty($images['option2_image']['url']) ? $images['option2_image']['url'] : '/img/dummy/blank.png' }}" id="preview-option2-image" class="w-full h-full rounded border border-solid border-gray-500 object-center object-cover" />
                        <button type="button" data-table="{{ $tableId }}" data-ques="{{ $item->id }}" data-name="option2_image" data-target-img="preview-option2-image" id="preview-option2-delete-image-btn" data-route="{{ $imageDeleteRoute }}" data-js="preview-image-delete-btn" class="{{ !empty($images['option2_image']['url']) ? '' : 'hidden' }} absolute inline-flex items-center justify-center rounded border border-solid top-0 right-0 mx-1 my-1 px-1 py-1 bg-red-500 text-white">
                            <x-icons.delete data-js="btn-text" class="w-5 h-5 pointer-events-none" />
                            <x-loader class="hidden w-5 h-5" />
                        </button>
                    </div>
                </div>
                <div class="w-full sm:w-6/12 px-1 mb-3">
                    <div>Option 3</div>
                    <textarea class="rounded w-full focus:border-primary-500 focus:ring-primary-400" name="option3"><?= $item->option3 ?></textarea>
                </div>
                <div class="w-full sm:w-6/12 px-1 mb-3 flex justify-between gap-2">
                    <div class="flex flex-col w-full grow">
                        <span>Option 3 Image</span>
                        <input type="file" name="option3_image" data-js="preview-img-input" data-target-delete-btn="" data-target-img="preview-option3-image" accept=".jpg,.jpeg,.png,.gif" class="block w-full rounded file:mr-2 file:px-3 file:py-2 file:border-0 border border-solid border-gray-500 file:bg-gray-200 hover:file:bg-gray-100 file:cursor-pointer focus:outline-primary-400 focus:border-primary-500 cursor-pointer bg-white" />
                    </div>
                    <div class="w-20 h-20 relative flex-none">
                        <img src="{{ !empty($images['option3_image']['url']) ? $images['option3_image']['url'] : '/img/dummy/blank.png' }}" id="preview-option3-image" class="w-full h-full rounded border border-solid border-gray-500 object-center object-cover" />
                        <button type="button" data-table="{{ $tableId }}" data-ques="{{ $item->id }}" data-name="option3_image" data-target-img="preview-option3-image" id="preview-option3-delete-image-btn" data-route="{{ $imageDeleteRoute }}" data-js="preview-image-delete-btn" class="{{ !empty($images['option3_image']['url']) ? '' : 'hidden' }} absolute inline-flex items-center justify-center rounded border border-solid top-0 right-0 mx-1 my-1 px-1 py-1 bg-red-500 text-white">
                            <x-icons.delete data-js="btn-text" class="w-5 h-5 pointer-events-none" />
                            <x-loader class="hidden w-5 h-5" />
                        </button>
                    </div>
                </div>
                <div class="w-full sm:w-6/12 px-1 mb-3">
                    <div>Option 4</div>
                    <textarea class="rounded w-full focus:border-primary-500 focus:ring-primary-400" name="option4"><?= $item->option4 ?></textarea>
                </div>
                <div class="w-full sm:w-6/12 px-1 mb-3 flex justify-between gap-2">
                    <div class="flex flex-col w-full grow">
                        <span>Option 4 Image</span>
                        <input type="file" name="option4_image" data-js="preview-img-input" data-target-delete-btn="" data-target-img="preview-option4-image" accept=".jpg,.jpeg,.png,.gif" class="block w-full rounded file:mr-2 file:px-3 file:py-2 file:border-0 border border-solid border-gray-500 file:bg-gray-200 hover:file:bg-gray-100 file:cursor-pointer focus:outline-primary-400 focus:border-primary-500 cursor-pointer bg-white" />
                    </div>
                    <div class="w-20 h-20 relative flex-none">
                        <img src="{{ !empty($images['option4_image']['url']) ? $images['option4_image']['url'] : '/img/dummy/blank.png' }}" id="preview-option4-image" class="w-full h-full rounded border border-solid border-gray-500 object-center object-cover" />
                        <button type="button" data-table="{{ $tableId }}" data-ques="{{ $item->id }}" data-name="option4_image" data-target-img="preview-option4-image" id="preview-option4-delete-image-btn" data-route="{{ $imageDeleteRoute }}" data-js="preview-image-delete-btn" class="{{ !empty($images['option4_image']['url']) ? '' : 'hidden' }} absolute inline-flex items-center justify-center rounded border border-solid top-0 right-0 mx-1 my-1 px-1 py-1 bg-red-500 text-white">
                            <x-icons.delete data-js="btn-text" class="w-5 h-5 pointer-events-none" />
                            <x-loader class="hidden w-5 h-5" />
                        </button>
                    </div>
                </div>
                <div class="w-full sm:w-6/12 px-1 mb-3">
                    <div>Option 5</div>
                    <textarea class="rounded w-full focus:border-primary-500 focus:ring-primary-400" name="option5"><?= $item->option5 ?></textarea>
                </div>
                <div class="w-full sm:w-6/12 px-1 mb-3 flex justify-between gap-2">
                    <div class="flex flex-col w-full grow">
                        <span>Option 5 Image</span>
                        <input type="file" name="option5_image" data-js="preview-img-input" data-target-delete-btn="preview-option5-delete-image-btn" data-target-img="preview-option5-image" accept=".jpg,.jpeg,.png,.gif" class="block w-full rounded file:mr-2 file:px-3 file:py-2 file:border-0 border border-solid border-gray-500 file:bg-gray-200 hover:file:bg-gray-100 file:cursor-pointer focus:outline-primary-400 focus:border-primary-500 cursor-pointer bg-white" />
                    </div>
                    <div class="w-20 h-20 relative flex-none">
                        <img src="{{ !empty($images['option5_image']['url']) ? $images['option5_image']['url'] : '/img/dummy/blank.png' }}" id="preview-option5-image" class="w-full h-full rounded border border-solid border-gray-500 object-center object-cover" />
                        <button type="button" data-table="{{ $tableId }}" data-ques="{{ $item->id }}" data-name="option5_image" data-target-img="preview-option5-image" id="preview-option5-delete-image-btn" data-route="{{ $imageDeleteRoute }}" data-js="preview-image-delete-btn" class="{{ !empty($images['option5_image']['url']) ? '' : 'hidden' }} absolute inline-flex items-center justify-center rounded border border-solid top-0 right-0 mx-1 my-1 px-1 py-1 bg-red-500 text-white">
                            <x-icons.delete data-js="btn-text" class="w-5 h-5 pointer-events-none" />
                            <x-loader class="hidden w-5 h-5" />
                        </button>
                    </div>
                </div>
                @if( !empty($courses) )
                <div class="w-full px-1 mb-3 select-none">
                    <div>Pick Course</div>
                    <div class="flex flex-wrap gap-x-5 gap-y-1">
                        @foreach($courses as $course)
                            <label class="inline-flex gap-2 items-center cursor-pointer">
                                <input type="checkbox" name="course_id[]" value="{{ $course->id }}" <?= in_array($course->id, $itemCourseIds) ? 'checked' : '' ?> class="rounded w-5 h-5 my-1 border-gray-500 text-primary-500 shadow-sm focus:ring-primary-500 border-solid" />
                                <span>{{ $course->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
                @endif
                @if( !empty($difficulties) )
                <div class="w-full px-1 mb-3">
                    <div>Pick Difficulty</div>
                    <div class="flex flex-wrap gap-x-5 gap-y-1">
                        @foreach($difficulties as $difficulty)
                            <label class="inline-flex gap-2 items-center cursor-pointer">
                                <input type="checkbox" name="difficulty_id[]" value="{{ $difficulty->id }}" <?= in_array($difficulty->id, $itemDifficultyIds) ? 'checked' : '' ?> class="rounded w-5 h-5 my-1 border-gray-500 text-primary-500 shadow-sm focus:ring-primary-500 border-solid" />
                                <span>{{ $difficulty->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
                @endif
                @if( !empty($chapters) )
                <div class="w-full sm:w-6/12 px-1 mb-3">
                    <div class="flex flex-col">
                        <span>Pick Chapter</span>
                        <select name="chapter_id" required data-js="chapters-select" class="rounded focus:border-primary-500 focus:ring-primary-400">
                            <option value="">Pick chapter</option>
                            @foreach($chapters as $chapter)
                                <option value="{{ $chapter->id }}" <?= $chapter->id == $item->chapter_id ? 'selected' : '' ?>>{{ $chapter->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="w-full sm:w-6/12 px-1 mb-3">
                    <div class="flex flex-col">
                        <span>Pick Topic</span>
                        <select name="topic_id" required data-js="topics-select" class="rounded focus:border-primary-500 focus:ring-primary-400">
                            <option value="">Pick topic</option>
                            @if( !empty($item->chapter_id) )
                                @foreach($chapters as $chapter)
                                    @if( !empty($chapter->topics) && count($chapter->topics) )
                                        @foreach($chapter->topics as $topic)
                                            <option value="{{ $topic->id }}" <?= $topic->id == $item->topic_id ? 'selected' : '' ?>>{{ $topic->name }}</option>
                                        @endforeach
                                    @endif
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                @endif
                @if(!empty($examAnswerTypes))
                    <div class="w-full sm:w-6/12 px-1 mb-3">
                        <div>Answer Type</div>
                        <select name="answer_type" class="rounded focus:border-primary-500 focus:ring-primary-400 w-full">
                            @foreach($examAnswerTypes as $examAnswerType)
                                <option value="{{ $examAnswerType['key'] }}" <?= $examAnswerType['key'] == $item->answer_type ? 'selected' : '' ?>>
                                    {{ $examAnswerType['value'] }} ({{$examAnswerType['key']}})
                                </option>
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
                <div class="w-full px-1 mb-3">
                    <div>Source</div>
                    <textarea class="rounded w-full focus:border-primary-500 focus:ring-primary-400" name="source"><?= $item->source ?></textarea>
                </div>
                <div class="w-full px-1 my-4">
                    <div data-js="app-form-status" class="hidden font-semibold hidden w-full mb-2"></div>
                    <div class="flex flex-wrap gap-2">
                        <x-button :href="route('questions.index', ['subjectId'=> $subjectId, 'classroomId'=> $classroomId, ])">Back</x-button>
                        <x-button type="submit" data-js="app-form-btn">Update Question</x-button>
                    </div>
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