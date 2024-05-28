<?php

namespace App\Http\Controllers;

use Exception;
use App\Enums\ModelStatusEnum;
use App\Enums\ExamAnswerTypeEnum;
use App\Models\Classroom;
use App\Models\Course;
use App\Models\Difficulty;
use App\Models\Exam;
use App\Models\ExamType;
use App\Models\ExamClass;
use App\Models\ExamTopic;
use App\Models\ExamChapter;
use App\Models\ExamSubject;
use App\Models\ExamCategory;
use App\Models\ExamDifficulty;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class ExamController extends Controller
{

    private static $table_exams = 'exams';
    private static $table_exam_pivot_classroom = 'exam_pivot_classroom';
    private static $table_exam_pivot_subject = 'exam_pivot_subject';

    /**
     * Display a listing of the resource.
     */
    public function index(Request $req)
    {
        $user = $req->user();

        $items = DB::table($this::$table_exams)
                    ->where('user_id', $user->id)
                    ->join('courses', 'exams.course_id', '=', 'courses.id')
                    ->select('exams.*', 'exams.id as exam_id', 'courses.name as course_name')
                    ->paginate(10)->withQueryString();

        foreach ($items as &$item) {
            $subjects = DB::table($this::$table_exam_pivot_subject)->where('exam_id', $item->id)
                        ->join('subjects', 'exam_pivot_subject.subject_id', '=', 'subjects.id')
                        // ->join('difficulties', 'exam_pivot_subject.difficulty_id', '=', 'difficulties.id')
                        ->select(
                            'subjects.name as name',
                            // 'difficulties.name as difficulty'
                        )
                        ->get();
            if($subjects && count($subjects)){
                $item->subjects = $subjects->pluck('name')->toArray();
            }
        }
        return view('exams.index', [
            'items'=> $items,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $courses = Course::where('status', ModelStatusEnum::PUBLISHED)->orderBy('order', 'ASC')->get(['id', 'name']);
        $classrooms = Classroom::where('status', ModelStatusEnum::PUBLISHED)->orderBy('order', 'ASC')->get(['id', 'name']);
        $subjects = Subject::where('status', ModelStatusEnum::PUBLISHED)->orderBy('order', 'ASC')->get(['id', 'name']);
        $difficulties = Difficulty::where('status', ModelStatusEnum::PUBLISHED)->orderBy('order', 'ASC')->get(['id', 'name']);
        return view('exams.create', [
            'courses'=> $courses,
            'subjects'=> $subjects,
            'classrooms'=> $classrooms,
            'difficulties'=> $difficulties,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        $user = $req->user();
        $input = $req->validate([
            'name' => ['required', 'string', 'max:255'],
            'course_id' => ['required', Rule::exists(Course::class, 'id')],
            'classroom_id' => ['required'],
            'classroom_id.*' => ['required', Rule::exists(Classroom::class, 'id')],
            'subject_id' => ['required'],
            'subject_id.*' => ['required', Rule::exists(Subject::class, 'id')],
            'difficulty_id'=> ['required'],
        ]);


        // check difficulties
        $difficulties_arr = $input['difficulty_id'];
        $subjects = [];
        foreach ($input['subject_id'] as $subject_id) {
            $difficulty_id = !empty($difficulties_arr[$subject_id]) ? $difficulties_arr[$subject_id] : '';
            $subjects[] = [
                'subject_id'=> $subject_id,
                'difficulty_id'=> $difficulty_id,
            ];
        }
        $classroom_ids = $input['classroom_id'];

        try {
            $exam_id = DB::table($this::$table_exams)->insertGetId([
                'name'=> $input['name'],
                'course_id'=> $input['course_id'],
                'user_id'=> $user->id,
                'status'=> ModelStatusEnum::PUBLISHED,
                'created_at'=> now(),
                'updated_at'=> now(),
            ]);

            DB::transaction(function () use ($exam_id, $classroom_ids) {
                DB::table($this::$table_exam_pivot_classroom)
                        ->where('exam_id', $exam_id)->delete();
                $pivotData = [];
                foreach ($classroom_ids as $classroom_id) {
                    $pivotData[] = [
                        'exam_id' => $exam_id,
                        'classroom_id' => $classroom_id,
                    ];
                }
                DB::table($this::$table_exam_pivot_classroom)->insert($pivotData);
            });

            DB::transaction(function () use ($exam_id, $subjects) {
                DB::table($this::$table_exam_pivot_subject)
                        ->where('exam_id', $exam_id)->delete();
                $pivotData = [];
                foreach ($subjects as $subject) {
                    $pivotData[] = [
                        'exam_id' => $exam_id,
                        'subject_id' => $subject['subject_id'],
                        'difficulty_id' => $subject['difficulty_id'],
                    ];
                }
                DB::table($this::$table_exam_pivot_subject)->insert($pivotData);
            });
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
        return response()->json([
            'success'=> true,
            'redirect'=> route('exams.index'),
            'message'=> 'Exam created successfully',
        ]);
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
        // $items = DB::table($exam->table)->paginate(10)->withQueryString();
        // return view('exams.edit', ['exam' => $exam, 'items'=> $items]);
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
            DB::table($this::$table_exam_pivot_classroom)
                ->where('exam_id', $exam->id)->delete();
            DB::table($this::$table_exam_pivot_subject)
                ->where('exam_id', $exam->id)->delete();
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
        // $table = $exam->table;
        // if (empty($table)) {
        //     return response()->json(['message' => 'Table name is empty'], 500);
        // }

        // if (!Schema::hasTable($table)) {
        //     return response()->json(['message' => 'Table does not exist'], 500);
        // }

        // try {
        //     $id = DB::table($table)->insertGetId([
        //         'question' => '',
        //     ]);
        //     return response()->json([
        //         'success'=> true,
        //         'redirect'=> route('exams.edit-question', [
        //             'exam'=> $exam,
        //             'id'=> $id,
        //         ]),
        //         'message'=> 'Loading question...',
        //     ]);
        // } catch (Exception $e) {
        //     return response()->json(['message' => $e->getMessage()], 500);
        // }
    }

    public function editQuestion(Request $req, Exam $exam, $id)
    {
        // if(empty($exam->table)){
        //     abort(404);
        // }

        // $item = DB::table($exam->table)->where('id', $id)->first();
        // if(empty($item)){
        //     abort(404);
        // }

        // $statuses = ModelStatusEnum::toArray();
        // $examAnswerTypes = ExamAnswerTypeEnum::toFormattedArray();
        // $examChapters = ExamChapter::where('status', ModelStatusEnum::PUBLISHED)->get(['id', 'name']);
        // $examSubjects = ExamSubject::where('status', ModelStatusEnum::PUBLISHED)->get(['id', 'name']);
        // $examTopics = ExamTopic::where('status', ModelStatusEnum::PUBLISHED)->get(['id', 'name']);
        // $examDifficulties = ExamDifficulty::where('status', ModelStatusEnum::PUBLISHED)->get(['id', 'name']);
        // return view('exams.questions-edit', [
        //     'item'=> $item,
        //     'exam'=> $exam,
        //     'statuses' => $statuses,
        //     'examChapters' => $examChapters,
        //     'examSubjects' => $examSubjects,
        //     'examTopics' => $examTopics,
        //     'examAnswerTypes' => $examAnswerTypes,
        //     'examDifficulties' => $examDifficulties,
        // ]);
    }

    public function updateQuestion(Request $req, Exam $exam, $id)
    {
        // $validated = $req->validate([
        //     'name' => ['required', 'string', 'max:255'],
        //     'status' => ['required', new Enum(ModelStatusEnum::class)],
        //     'exam_chapter_id' => [Rule::exists(ExamChapter::class, 'id')],
        //     'exam_subject_id' => [Rule::exists(ExamSubject::class, 'id')],
        //     'exam_topic_id' => ['nullable', Rule::exists(ExamTopic::class, 'id')],
        //     'exam_difficulty_id' => [Rule::exists(ExamDifficulty::class, 'id')],
        //     'question' => ['required', 'string'],
        //     'option1' => ['nullable', 'string'],
        //     'option2' => ['nullable', 'string'],
        //     'option3' => ['nullable', 'string'],
        //     'option4' => ['nullable', 'string'],
        //     'option5' => ['nullable', 'string'],
        //     'option6' => ['nullable', 'string'],
        //     'answer_type' => ['required', new Enum(ExamAnswerTypeEnum::class)],
        //     'answer' => ['required'],
        //     'positive_marks' => ['required'],
        //     'negative_marks' => ['required'],
        //     'solution' => ['nullable', 'string'],
        // ], [
        //     'question.required' => 'Please write the question',
        // ]);

        // try {
        //     DB::table($exam->table)->where('id', $id)->update($validated);
        // } catch(Exception $e) {
        //     return response()->json(['message'=> $e->getMessage()], 500);
        // }
        // return response()->json([
        //     'success'=> true, 'message'=> 'Saved successfully'
        // ]);
    }

    public function destroyQuestion(Request $req, Exam $exam, $id)
    {
        // if (empty($exam->table)) {
        //     return response()->json(['message'=> 'Table does not exist'], 500);
        // }
        // try {
        //     DB::table($exam->table)->where('id', $id)->delete();
        // } catch (Exception $e) {
        //     return response()->json(['message' => $e->getMessage()], 500);
        // }
        // return response()->json([
        //     'success' => true,
        //     'reload' => true,
        //     'message' => 'Deleted successfully',
        // ]);
    }
}
