<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Classroom;
use App\Models\Chapter;
use App\Models\Subject;
use Hidehalo\Nanoid\Client;
use App\Models\QuestionTable;
use App\Enums\ModelStatusEnum;
use App\Models\Difficulty;
use App\Enums\ExamAnswerTypeEnum;
use App\Exports\QuestionsExport;
use App\Imports\QuestionsImport;
use App\Models\Course;
use App\Models\Photo;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class QuestionController extends Controller
{
    private $validationRules;

    public function __construct()
    {
        $this->validationRules = [
            'chapter_id' => ['required', Rule::exists(Chapter::class, 'id')],
            'difficulty_id' => ['required', Rule::exists(Difficulty::class, 'id')],
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
            'question_image' => ['nullable', 'file', 'max:2000'],
            'option1_image' => ['nullable', 'file', 'max:2000'],
            'option2_image' => ['nullable', 'file', 'max:2000'],
            'option3_image' => ['nullable', 'file', 'max:2000'],
            'option4_image' => ['nullable', 'file', 'max:2000'],
            'option5_image' => ['nullable', 'file', 'max:2000'],
            'option6_image' => ['nullable', 'file', 'max:2000'],
        ];
    }

    private function saveFilesTrigger(Request $req, $tableId, $quesId){
        $this->saveFile($req, [
            'name' => 'question_image', 'itemId' => $quesId,
            'baseFolder' => 'questions', 'tableId' => $tableId,
        ]);
        $this->saveFile($req, [
            'name' => 'option1_image', 'itemId' => $quesId,
            'baseFolder' => 'questions', 'tableId' => $tableId,
        ]);
        $this->saveFile($req, [
            'name' => 'option2_image', 'itemId' => $quesId,
            'baseFolder' => 'questions', 'tableId' => $tableId,
        ]);
        $this->saveFile($req, [
            'name' => 'option3_image', 'itemId' => $quesId,
            'baseFolder' => 'questions', 'tableId' => $tableId,
        ]);
        $this->saveFile($req, [
            'name' => 'option4_image', 'itemId' => $quesId,
            'baseFolder' => 'questions', 'tableId' => $tableId,
        ]);
        $this->saveFile($req, [
            'name' => 'option5_image', 'itemId' => $quesId,
            'baseFolder' => 'questions', 'tableId' => $tableId,
        ]);
        $this->saveFile($req, [
            'name' => 'option6_image', 'itemId' => $quesId,
            'baseFolder' => 'questions', 'tableId' => $tableId,
        ]);
    }

    private function saveFile(Request $req, $data = [])
    {
        $name = !empty($data['name']) ? $data['name'] : '';
        $baseFolder = !empty($data['baseFolder']) ? $data['baseFolder'] : '';
        $itemId = !empty($data['itemId']) ? $data['itemId'] : '';
        $tableId = !empty($data['tableId']) ? $data['tableId'] : '';

        if (empty($name) || empty($baseFolder) || empty($tableId) || empty($itemId)) {
            return response()->json([
                'message' => 'Photo saving parameters are missing'
            ], 500);
        }

        if ($req->hasFile($name)) {
            $folder = $baseFolder . '/' . date('Y/m');
            try {
                $photoable_id = $tableId . '--' . $itemId;
                $client = new Client();
                $nano_id = $client->generateId();
                $photo = $req->file($name);
                $photo_filename = $itemId . '-' . $nano_id . '.' . $photo->extension();
                $photo->storeAs($folder, $photo_filename, 'public');
                $oldPhoto = Photo::where('tag', $name)->where('photoable_id', $photoable_id)
                    ->where('photoable_type', Question::class)->first();

                Photo::create([
                    'photoable_id' => $photoable_id,
                    'photoable_type' => Question::class,
                    'name' => $photo_filename,
                    'folder' => $folder,
                    'tag' => $name,
                ]);

                if (!empty($oldPhoto)) {
                    Storage::delete('/public/' . $oldPhoto->folder . '/' . $oldPhoto->name);
                    $oldPhoto->delete();
                }
            } catch (Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => $e->getMessage(),
                    'errors' => [],
                ], 500);
            }
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $req)
    {
        $currentUser = $req->user();
        $classroomId = $req->classroomId;
        $classrooms = Classroom::orderBy('order', 'asc')->get(['id', 'name']);
        if (empty($classroomId) && !empty($classrooms)) {
            $classroom = $classrooms->first();
            $classroomId = $classroom->id;
        }

        $subjectId = $req->subjectId;
        $subjects = Subject::orderBy('name', 'asc')->get(['id', 'name']);
        if (empty($subjectId) && !empty($subjects)) {
            $subject = $subjects->first();
            $subjectId = $subject->id;
        }

        $courseId = $req->courseId;
        $courses = Course::orderBy('name', 'asc')->get(['id', 'name']);

        $statusId = $req->statusId;

        $items = null;
        $tableId = '';
        $questionsTable = QuestionTable::where('classroom_id', $classroomId)
            ->where('subject_id', $subjectId)->first();
        if($currentUser->isTeacher()) {
            $allowedSubjects = $currentUser->subjects->pluck('id')->toArray();
            $allowedClassrooms = $currentUser->classrooms->pluck('id')->toArray();
            if(in_array($classroomId, $allowedClassrooms) && in_array($subjectId, $allowedSubjects)){
                // all good
            } else {
                $questionsTable = null;
            }
        }
        if (!empty($questionsTable) && !empty($questionsTable->table)) {
            $tableId = $questionsTable->id;
            $table = $questionsTable->table;
            $query = DB::table($table);
            if(!empty($courseId)){
                $query = $query->where('course_id', $courseId);
            }

            if(!empty($statusId)){
                $query = $query->where('status', $statusId);
            }

            $items = $query->paginate(10)->withQueryString();
        }
        $statuses = ModelStatusEnum::toArray();
        return view('questions.index', [
            'items' => $items,
            'currentUser' => $currentUser,
            'tableId' => $tableId,
            'statusId' => $statusId,
            'classroomId' => $classroomId,
            'courseId' => $courseId,
            'statuses'=> $statuses,
            'courses' => $courses,
            'classrooms' => $classrooms,
            'subjects' => $subjects,
            'subjectId' => $subjectId,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $req)
    {
        $currentUser = $req->user();
        if($currentUser->isSuperAdmin() || $currentUser->isAdmin() || $currentUser->isEditor()){
        } else {
            abort(404);
        }
        $subjects = Subject::where('status', ModelStatusEnum::PUBLISHED)->orderBy('order', 'asc')->get(['id', 'name']);
        $classrooms = Classroom::where('status', ModelStatusEnum::PUBLISHED)->orderBy('order', 'asc')->get(['id', 'name']);
        $difficulties = Difficulty::where('status', ModelStatusEnum::PUBLISHED)->orderBy('order', 'asc')->get(['id', 'name']);
        $chapters = Chapter::with('topics:id,name,parent_id')->where('status', ModelStatusEnum::PUBLISHED)->orderBy('order')->get(['id', 'name', 'parent_id']);
        $examAnswerTypes = ExamAnswerTypeEnum::toFormattedArray();
        $courses = Course::where('status', ModelStatusEnum::PUBLISHED)->orderBy('name', 'asc')->get(['id', 'name']);
        return view('questions.create', [
            'subjects' => $subjects,
            'classrooms' => $classrooms,
            'difficulties' => $difficulties,
            'chapters' => $chapters,
            'courses' => $courses,
            'examAnswerTypes' => $examAnswerTypes,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        $currentUser = $req->user();
        if ($currentUser->isSuperAdmin() || $currentUser->isAdmin() || $currentUser->isEditor()) {
        } else {
            abort(404);
        }
        $rules = $this->validationRules;
        $rules['subject_id'] = ['required', Rule::exists(Subject::class, 'id')];
        $rules['classroom_id'] = ['required', Rule::exists(Classroom::class, 'id')];
        $rules['course_id'] = ['required', Rule::exists(Course::class, 'id')];

        $input = $req->validate($rules, []);

        try {
            $questionTable = QuestionTable::where('classroom_id', $input['classroom_id'])
                ->where('subject_id', $input['subject_id'])->first(['id', 'table']);
            if (empty($questionTable)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Table not found for this subject and class',
                ]);
            }
            $table = $questionTable->table;
            unset($input['subject_id']);
            unset($input['classroom_id']);
            unset($input['question_image']);
            unset($input['option1_image']);
            unset($input['option2_image']);
            unset($input['option3_image']);
            unset($input['option4_image']);
            unset($input['option5_image']);
            unset($input['option6_image']);
            $quesId = DB::table($table)->insertGetId($input);
            $this->saveFilesTrigger($req, $questionTable->id, $quesId);
            return response()->json([
                'success' => true,
                'redirect' => route('questions.index', [
                    'courseId' => $req->course_id,
                    'classroomId' => $req->classroom_id,
                    'subjectId' => $req->subject_id,
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

        $questionsTable = QuestionTable::findOrFail($tableId, ['id', 'table', 'subject_id', 'classroom_id']);
        $table = $questionsTable->table;
        $item = DB::table($table)->where('id', $quesId)->first();
        if (empty($item)) abort(404);

        $classroomId = $questionsTable->classroom_id;
        $subjectId = $questionsTable->subject_id;

        if($currentUser->isTeacher()){
            $allowedSubjects = $currentUser->subjects->pluck('id')->toArray();
            $allowedClassrooms = $currentUser->classrooms->pluck('id')->toArray();
            if(in_array($classroomId, $allowedClassrooms) && in_array($subjectId, $allowedSubjects)){
                // all good
            } else {
                abort(404);
            }
        }

        $examDifficulties = Difficulty::where('status', ModelStatusEnum::PUBLISHED)->orderBy('order', 'asc')->get(['id', 'name']);
        $examChapters = Chapter::with('topics:id,name,parent_id')->where('status', ModelStatusEnum::PUBLISHED)
            ->where('subject_id', $questionsTable->subject_id)
            ->orderBy('order')->get(['id', 'name', 'parent_id']);
        $examAnswerTypes = ExamAnswerTypeEnum::toFormattedArray();
        $statuses = ModelStatusEnum::toArray();
        $courses = Course::where('status', ModelStatusEnum::PUBLISHED)->orderBy('name', 'asc')->get(['id', 'name']);

        $photoable_id = $questionsTable->id . '--' . $quesId;
        $imagesObj = Photo::where('photoable_type', Question::class)
                        ->where('photoable_id', $photoable_id)->get(['name', 'folder', 'tag']);
        $images = [];
        if(!empty($imagesObj) && count($imagesObj)){
            foreach ($imagesObj as $imgObj) {
                if(!empty($imgObj->tag)){
                    $images[$imgObj->tag] = [
                        'url'=> '/storage/'. $imgObj->folder . '/'. $imgObj->name,
                    ];
                }
            }
        }
        $imageDeleteRoute = route('questions.image.destroy');
        return view('questions.edit', [
            'item' => $item,
            'images' => $images,
            'classroomId' => $classroomId,
            'statuses' => $statuses,
            'subjectId' => $subjectId,
            'chapters' => $examChapters,
            'courses' => $courses,
            'tableId' => $questionsTable->id,
            'examAnswerTypes' => $examAnswerTypes,
            'imageDeleteRoute' => $imageDeleteRoute,
            'difficulties' => $examDifficulties,
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
            unset($input['question_image']);
            unset($input['option1_image']);
            unset($input['option2_image']);
            unset($input['option3_image']);
            unset($input['option4_image']);
            unset($input['option5_image']);
            unset($input['option6_image']);
            DB::table($table)->where('id', $quesId)->update($input);
            $this->saveFilesTrigger($req, $questionTable->id, $quesId);
            return response()->json([
                'success' => true,
                'message' => 'Updated successfully',
            ]);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function destroyImage(Request $req)
    {
        $name = $req->name;
        $quesId = $req->quesId;
        $tableId = $req->tableId;
        $photoable_id = $tableId . '--' . $quesId;

        if(empty($name) || empty($quesId) || empty($tableId)){
            return response()->json([
                'message'=> 'Parameters missing in request'
            ], 500);
        }

        try {
            $photo = Photo::where('tag', $name)->where('photoable_id', $photoable_id)
                        ->where('photoable_type', Question::class)->first();
            if( !empty($photo) && !empty($photo->folder) && !empty($photo->name) ){
                Storage::delete('/public/' . $photo->folder . '/' . $photo->name);
                $photo->delete();
            } else {
                return response()->json(['message'=> 'Image not in database'], 500);
            }
        } catch(Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
        return response()->json([
            'success' => true, 'message' => 'Deleted image',
        ]);
    }

    public function destroy(Request $req, $tableId, $quesId)
    {
        $currentUser = $req->user();
        if ($currentUser->isStudent()) {
            abort(404);
        }
    }

    public function import()
    {
        $subjects = Subject::where('status', ModelStatusEnum::PUBLISHED)->get(['id', 'name']);
        $classrooms = Classroom::where('status', ModelStatusEnum::PUBLISHED)->orderBy('order', 'asc')->get(['id', 'name']);

        return view('questions.import', [
            'classrooms' => $classrooms,
            'subjects' => $subjects,
        ]);
    }

    public function importUpload(Request $req)
    {
        $req->validate([
            'subjectId' => ['required', Rule::exists(Subject::class, 'id')],
            'classroomId' => ['required', Rule::exists(Classroom::class, 'id')],
            'importFile'=> ['file', 'mimes:xls,xlsx'],
        ]);

        try {
            $questionTable = QuestionTable::where('classroom_id', $req->classroomId)
                ->where('subject_id', $req->subjectId)->first(['id', 'table']);
            if (empty($questionTable) || empty($questionTable->table)) {
                return response()->json([
                    'message' => 'Table not found for this subject and class',
                ], 422);
            }
            $table = $questionTable->table;
            $data = [];

            $chapters = Chapter::pluck('id', 'slug');
            $courses = Course::pluck('id', 'slug');
            $difficulties = Difficulty::pluck('id', 'slug');
            $import = new QuestionsImport($table, $chapters, $courses, $difficulties);
            Excel::import($import, $req->file('importFile'));

            return response()->json([
                'success'=> true,
                'reset'=> true,
                'data'=> $data,
                'message'=> 'Questions imported with DRAFT status',
            ]);
        } catch(Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function export(Request $req)
    {
        $subjects = Subject::where('status', ModelStatusEnum::PUBLISHED)->orderBy('order', 'asc')->get(['id', 'name']);
        $classrooms = Classroom::where('status', ModelStatusEnum::PUBLISHED)->orderBy('order', 'asc')->get(['id', 'name']);

        return view('questions.export', [
            'classrooms' => $classrooms,
            'subjects' => $subjects,
        ]);
    }

    public function exportDownload(Request $req)
    {
        $req->validate([
            'subjectId' => ['required', Rule::exists(Subject::class, 'id')],
            'classroomId' => ['required', Rule::exists(Classroom::class, 'id')],
        ]);

        $questionTable = QuestionTable::where('classroom_id', $req->classroomId)
                ->where('subject_id', $req->subjectId)->first(['id', 'table']);
        if (empty($questionTable) || empty($questionTable->table)) {
            return response()->json([
                'message' => 'Table not found for this subject and class',
            ], 422);
        }
        $table = $questionTable->table;

        if($req->download){
            $query = DB::table($table)->orderBy('id');
            $filename = 'questions-'. date('Y-m-d-H-i-s') . '.xlsx';
            $chapters = Chapter::pluck('slug', 'id');
            $courses = Course::pluck('slug', 'id');
            $difficulties = Difficulty::pluck('slug', 'id');
            return (new QuestionsExport($query, $chapters, $courses, $difficulties))->download($filename);
        } else {
            return response()->json([
                'success'=> true,
                'download'=> route('questions.export.download', [
                    'subjectId'=> $req->subjectId,
                    'classroomId'=> $req->classroomId,
                    'download'=> 1,
                ]),
            ]);
        }
    }
}
