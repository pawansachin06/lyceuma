<?php

namespace App\Http\Controllers;

use App\Enums\ModelStatusEnum;
use App\Models\Course;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Enum;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $req)
    {
        $currentUser = $req->user();
        if($currentUser->isStudent() || $currentUser->isTeacher()){
            abort(404);
        }
        $items = Course::latest()->orderBy('name', 'asc')->paginate(10)->withQueryString();
        return view('courses.index', ['items' => $items]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        $currentUser = $req->user();
        if($currentUser->isStudent() || $currentUser->isTeacher()){
            abort(404);
        }

        try {
            $item = Course::create([
                'name' => '',
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Loading...',
                'redirect' => route('courses.edit', $item),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $req, Course $course)
    {
        $currentUser = $req->user();
        if($currentUser->isStudent() || $currentUser->isTeacher()){
            abort(404);
        }

        $statuses = ModelStatusEnum::toArray();
        return view('courses.edit', [
            'item'=> $course,
            'statuses'=> $statuses,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req, Course $course)
    {
        $currentUser = $req->user();
        if($currentUser->isStudent() || $currentUser->isTeacher()){
            abort(404);
        }

        $req->merge(['slug' => Str::slug($req['slug']) ]);
        $validated = $req->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique(Course::class)->ignore($course->id)],
            'status' => [new Enum(ModelStatusEnum::class)],
        ]);

        try {
            $course->update($validated);
            return response()->json([
                'success' => true,
                'message' => 'Saved successfully',
            ]);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $req, Course $course)
    {
        $currentUser = $req->user();
        if($currentUser->isStudent() || $currentUser->isTeacher()){
            abort(404);
        }

        try {
            $course->delete();
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
