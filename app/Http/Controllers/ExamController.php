<?php

namespace App\Http\Controllers;

use App\Enums\ExamAnswerTypeEnum;
use App\Enums\ModelStatusEnum;
use App\Models\Exam;
use App\Models\ExamCategory;
use App\Models\ExamChapter;
use App\Models\ExamClass;
use App\Models\ExamDifficulty;
use App\Models\ExamSubject;
use App\Models\ExamTopic;
use App\Models\ExamType;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Enum;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Exam::with('type:id,name')->latest()->orderBy('name', 'asc')->paginate(10)->withQueryString();
        return view('exams.index', ['items' => $items]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $examCategories = ExamCategory::where('status', ModelStatusEnum::PUBLISHED)->get(['id', 'name']);
        $examTypes = ExamType::where('status', ModelStatusEnum::PUBLISHED)->get(['id', 'name']);
        $examClasses = ExamClass::where('status', ModelStatusEnum::PUBLISHED)->get(['id', 'name']);
        $examSubjects = ExamSubject::where('status', ModelStatusEnum::PUBLISHED)->get(['id', 'name']);
        // $examDifficulties = ExamDifficulty::where('status', ModelStatusEnum::PUBLISHED)->orderBy('order', 'asc')->get(['id', 'name']);
        return view('exams.create', [
            'examTypes' => $examTypes,
            'examClasses' => $examClasses,
            'examCategories' => $examCategories,
            // 'examDifficulties'=> $examDifficulties,
            'examSubjects' => $examSubjects,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        $validated = $req->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique(Exam::class)],
            'exam_category_id' => ['required', Rule::exists(ExamCategory::class, 'id')],
            'exam_type_id' => ['required', Rule::exists(ExamType::class, 'id')],
            'exam_class_id' => ['required'],
            'exam_class_id.*' => ['required', Rule::exists(ExamClass::class, 'id')],
            'exam_subject_id' => ['required'],
            'exam_subject_id.*' => ['required'],
            'duration' => ['required', 'numeric', 'min:0'],
            'date' => ['required', 'date', 'date_format:Y-m-d', 'after:yesterday'],
            'start_time' => ['required', 'date_format:H:i'],
            'end_time' => ['required', 'date_format:H:i', 'after:start_time'],
            'exam_subject_difficulty' => ['nullable'],
        ], [
            'exam_category_id.required' => 'Exam category is required',
            'exam_type_id.required' => 'Exam type is required',
            'exam_class_id.required' => 'Minimum 1 class is required',
            'exam_subject_id' => 'Minimum 1 suject is required',
            'date.after' => 'Date should be of future',
            'end_time.after' => 'Then end time must be after start time',
        ]);
        $validated['table'] = Str::slug($validated['name'], '_', 'en', ['-' => '_']);
        $validated['table'] = 'exam__' . $validated['table'];

        if (Schema::hasTable($validated['table'])) {
            return response()->json(['message' => 'Please choose another name for exam'], 422);
        }

        $subjects = $validated['exam_subject_id'];
        $subjects['difficulty'] = $validated['exam_subject_difficulty'] ?? [];

        try {
            Schema::create($validated['table'], function (Blueprint $table) {
                $table->id();
                $table->string('name')->nullable();
                $table->text('question');
                $table->text('option1')->nullable();
                $table->text('option2')->nullable();
                $table->text('option3')->nullable();
                $table->text('option4')->nullable();
                $table->text('option5')->nullable();
                $table->text('option6')->nullable();
                $table->text('answer')->nullable();
                $table->text('solution')->nullable();
                $table->decimal('positive_marks', 5, 2)->nullable();
                $table->decimal('negative_marks', 5, 2)->nullable();
                $table->string('answer_type')->nullable();
                $table->uuid('exam_subject_id')->nullable();
                $table->uuid('exam_chapter_id')->nullable();
                $table->uuid('exam_topic_id')->nullable();
                $table->uuid('exam_difficulty_id')->nullable();
                $table->integer('order')->unsigned()->default(1);
                $table->string('status')->default(ModelStatusEnum::DRAFT);
                $table->timestamps();
            });
            $exam = Exam::create([
                'name' => $validated['name'],
                'table' => $validated['table'],
                'exam_category_id' => $validated['exam_category_id'],
                'exam_type_id' => $validated['exam_type_id'],
                'duration' => $validated['duration'],
                'date' => $validated['date'],
                'start_time' => $validated['start_time'],
                'end_time' => $validated['end_time'],
                'classes' => $validated['exam_class_id'],
                'subjects' => $subjects,
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Loading exam...',
                'redirect' => route('exams.edit', $exam->id),
            ]);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Exam $exam)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Exam $exam)
    {
        $items = DB::table($exam->table)->paginate(10)->withQueryString();
        return view('exams.edit', ['exam' => $exam, 'items'=> $items]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req, Exam $exam)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exam $exam)
    {
        try {
            if (!empty($exam->table)) {
                Schema::dropIfExists($exam->table);
            }
            $exam->delete();
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
        return response()->json([
            'success' => true,
            'reload' => true,
            'message' => 'Deleted successfully',
        ]);
    }


    public function addQuestion(Request $req, Exam $exam)
    {
        $table = $exam->table;
        if (empty($table)) {
            return response()->json(['message' => 'Table name is empty'], 500);
        }

        if (!Schema::hasTable($table)) {
            return response()->json(['message' => 'Table does not exist'], 500);
        }

        try {
            $id = DB::table($table)->insertGetId([
                'question' => '',
            ]);
            return response()->json([
                'success'=> true,
                'redirect'=> route('exams.edit-question', [
                    'exam'=> $exam,
                    'id'=> $id,
                ]),
                'message'=> 'Loading question...',
            ]);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function editQuestion(Request $req, Exam $exam, $id)
    {
        if(empty($exam->table)){
            abort(404);
        }

        $item = DB::table($exam->table)->where('id', $id)->first();
        if(empty($item)){
            abort(404);
        }

        $statuses = ModelStatusEnum::toArray();
        $examAnswerTypes = ExamAnswerTypeEnum::toFormattedArray();
        $examChapters = ExamChapter::where('status', ModelStatusEnum::PUBLISHED)->get(['id', 'name']);
        $examSubjects = ExamSubject::where('status', ModelStatusEnum::PUBLISHED)->get(['id', 'name']);
        $examTopics = ExamTopic::where('status', ModelStatusEnum::PUBLISHED)->get(['id', 'name']);
        $examDifficulties = ExamDifficulty::where('status', ModelStatusEnum::PUBLISHED)->get(['id', 'name']);
        return view('exams.questions-edit', [
            'item'=> $item,
            'exam'=> $exam,
            'statuses' => $statuses,
            'examChapters' => $examChapters,
            'examSubjects' => $examSubjects,
            'examTopics' => $examTopics,
            'examAnswerTypes' => $examAnswerTypes,
            'examDifficulties' => $examDifficulties,
        ]);
    }

    public function updateQuestion(Request $req, Exam $exam, $id)
    {
        $validated = $req->validate([
            'name' => ['required', 'string', 'max:255'],
            'status' => ['required', new Enum(ModelStatusEnum::class)],
            'exam_chapter_id' => [Rule::exists(ExamChapter::class, 'id')],
            'exam_subject_id' => [Rule::exists(ExamSubject::class, 'id')],
            'exam_topic_id' => ['nullable', Rule::exists(ExamTopic::class, 'id')],
            'exam_difficulty_id' => [Rule::exists(ExamDifficulty::class, 'id')],
            'question' => ['required', 'string'],
            'option1' => ['nullable', 'string'],
            'option2' => ['nullable', 'string'],
            'option3' => ['nullable', 'string'],
            'option4' => ['nullable', 'string'],
            'option5' => ['nullable', 'string'],
            'option6' => ['nullable', 'string'],
            'answer_type' => ['required', new Enum(ExamAnswerTypeEnum::class)],
            'answer' => ['required'],
            'positive_marks' => ['required'],
            'negative_marks' => ['required'],
            'solution' => ['nullable', 'string'],
        ], [
            'question.required' => 'Please write the question',
        ]);

        try {
            DB::table($exam->table)->where('id', $id)->update($validated);
        } catch(Exception $e) {
            return response()->json(['message'=> $e->getMessage()], 500);
        }
        return response()->json([
            'success'=> true, 'message'=> 'Saved successfully'
        ]);
    }

    public function destroyQuestion(Request $req, Exam $exam, $id)
    {
        if (empty($exam->table)) {
            return response()->json(['message'=> 'Table does not exist'], 500);
        }
        try {
            DB::table($exam->table)->where('id', $id)->delete();
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
        return response()->json([
            'success' => true,
            'reload' => true,
            'message' => 'Deleted successfully',
        ]);
    }
}
