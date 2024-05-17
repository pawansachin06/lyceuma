<?php

namespace App\Http\Controllers;

use App\Enums\ModelStatusEnum;
use App\Models\Classroom;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Classroom::latest()->orderBy('name', 'asc')->paginate(10)->withQueryString();
        return view('classrooms.index', ['items'=> $items]);
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
        try {
            $item = Classroom::create([
                'name' => '',
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Loading...',
                'redirect' => route('classrooms.edit', $item),
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
    public function show(Classroom $classroom)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classroom $classroom)
    {
        $statuses = ModelStatusEnum::toArray();
        return view('exam-classes.edit', [
            'item'=> $classroom,
            'statuses'=> $statuses,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req, Classroom $classroom)
    {
        $validated = $req->validate([
            'name' => ['required', 'string', 'max:255'],
            'status' => [new Enum(ModelStatusEnum::class)],
        ]);

        try {
            $classroom->update($validated);
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
    public function destroy(Classroom $classroom)
    {
        try {
            $classroom->delete();
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
