<?php

namespace App\Http\Controllers;

use App\Enums\ExamAnswerTypeEnum;
use App\Enums\ModelStatusEnum;
use App\Models\ExamChapter;
use App\Models\ExamClass;
use App\Models\ExamDifficulty;
use App\Models\ExamPattern;
use App\Models\ExamSubject;
use App\Models\QuestionTable;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{
    private $validationRules;

    public function __construct()
    {
        $this->validationRules = [
            'exam_chapter_id' => ['required', Rule::exists(ExamChapter::class, 'id')],
            'exam_difficulty_id' => ['required', Rule::exists(ExamDifficulty::class, 'id')],
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
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $req)
    {
        $classId = $req->classId;
        $examClasses = ExamClass::orderBy('order', 'asc')->get(['id', 'name']);
        if (empty($classId)) {
            $class = $examClasses->first();
            $classId = $class->id;
        }
        $subjectId = $req->subjectId;
        $examSubjects = ExamSubject::get(['id', 'name']);
        if (empty($subjectId)) {
            $subject = $examSubjects->first();
            $subjectId = $subject->id;
        }
        $items = null;
        $tableId = '';
        $questionsTable = QuestionTable::where('exam_class_id', $classId)
            ->where('exam_subject_id', $subjectId)->first();
        if (!empty($questionsTable) && !empty($questionsTable->table)) {
            $tableId = $questionsTable->id;
            $table = $questionsTable->table;
            $items = DB::table($table)->paginate(10)->withQueryString();
        }

        return view('questions.index', [
            'items' => $items,
            'tableId' => $tableId,
            'classId' => $classId,
            'examClasses' => $examClasses,
            'examSubjects' => $examSubjects,
            'subjectId' => $subjectId,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $examSubjects = ExamSubject::where('status', ModelStatusEnum::PUBLISHED)->get(['id', 'name']);
        $examClasses = ExamClass::where('status', ModelStatusEnum::PUBLISHED)->orderBy('order', 'asc')->get(['id', 'name']);
        $examDifficulties = ExamDifficulty::where('status', ModelStatusEnum::PUBLISHED)->get(['id', 'name']);
        $examChapters = ExamChapter::with('topics:id,name,parent_id')->where('status', ModelStatusEnum::PUBLISHED)->orderBy('order')->get(['id', 'name', 'parent_id']);
        $examAnswerTypes = ExamAnswerTypeEnum::toFormattedArray();
        return view('questions.create', [
            'examSubjects' => $examSubjects,
            'examClasses' => $examClasses,
            'examDifficulties' => $examDifficulties,
            'examChapters' => $examChapters,
            'examAnswerTypes' => $examAnswerTypes,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        $currentUser = $req->user();
        if ($currentUser->isStudent()) {
            abort(404);
        }
        $rules = $this->validationRules;
        $rules['exam_subject_id'] = ['required', Rule::exists(ExamSubject::class, 'id')];
        $rules['exam_class_id'] = ['required', Rule::exists(ExamClass::class, 'id')];

        $input = $req->validate($rules, []);

        try {
            $questionTable = QuestionTable::where('exam_class_id', $input['exam_class_id'])
                ->where('exam_subject_id', $input['exam_subject_id'])->first(['id', 'table']);
            if (empty($questionTable)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Table not found for this subject and class',
                ]);
            }
            $table = $questionTable->table;
            unset($input['exam_subject_id']);
            unset($input['exam_class_id']);
            $quesId = DB::table($table)->insertGetId($input);
            return response()->json([
                'success' => true,
                'redirect' => route('questions.index', [
                    'classId' => $req->exam_class_id,
                    'subjectId' => $req->exam_subject_id,
                ]),
                // 'redirect' => route('questions.edit', [
                //     'tableId' => $questionTable->id, 'quesId' => $quesId
                // ]),
                'message' => 'Saved successfully',
            ]);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $req, $tableId, $quesId)
    {
        $currentUser = $req->user();
        if ($currentUser->isStudent()) abort(404);

        $questionsTable = QuestionTable::findOrFail($tableId, ['id', 'table', 'exam_subject_id', 'exam_class_id']);
        $table = $questionsTable->table;
        $item = DB::table($table)->where('id', $quesId)->first();
        if (empty($item)) abort(404);

        $classId = $questionsTable->exam_class_id;
        $subjectId = $questionsTable->exam_subject_id;
        $examDifficulties = ExamDifficulty::where('status', ModelStatusEnum::PUBLISHED)->get(['id', 'name']);
        $examChapters = ExamChapter::with('topics:id,name,parent_id')->where('status', ModelStatusEnum::PUBLISHED)
            ->where('exam_subject_id', $questionsTable->exam_subject_id)
            ->orderBy('order')->get(['id', 'name', 'parent_id']);
        $examAnswerTypes = ExamAnswerTypeEnum::toFormattedArray();
        $statuses = ModelStatusEnum::toArray();
        return view('questions.edit', [
            'item' => $item,
            'statuses' => $statuses,
            'classId' => $classId,
            'subjectId' => $subjectId,
            'examAnswerTypes' => $examAnswerTypes,
            'examChapters' => $examChapters,
            'examDifficulties' => $examDifficulties,
            'tableId' => $questionsTable->id,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req, $tableId, $quesId)
    {
        $currentUser = $req->user();
        if ($currentUser->isStudent()) {
            abort(404);
        }
        $rules = $this->validationRules;
        $rules['status'] = ['required', new Enum(ModelStatusEnum::class)];
        $input = $req->validate($rules, []);
        try {
            $questionTable = QuestionTable::where('id', $tableId)->first(['id', 'table']);
            if (empty($questionTable)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Table not found for this subject and class',
                ]);
            }
            $table = $questionTable->table;
            DB::table($table)->where('id', $quesId)->update($input);
            return response()->json([
                'success' => true,
                'message' => 'Updated successfully',
            ]);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $req, $tableId, $quesId)
    {
        $currentUser = $req->user();
        if ($currentUser->isStudent()) {
            abort(404);
        }
    }
}
