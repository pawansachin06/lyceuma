<?php

namespace App\Http\Controllers;

use App\Enums\ModelStatusEnum;
use Exception;
use App\Models\Difficulty;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Enum;

class DifficultyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $req)
    {
        $currentUser = $req->user();
        if ($currentUser->cannot('viewAny', Difficulty::class)) {
            abort(403);
        }
        $items = Difficulty::latest()->orderBy('name', 'asc')->paginate(10)->withQueryString();
        return view('difficulties.index', ['items'=> $items]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $req)
    {
        $currentUser = $req->user();
        if ($currentUser->cannot('create', Difficulty::class)) {
            abort(403);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        $currentUser = $req->user();
        if ($currentUser->cannot('create', Difficulty::class)) {
            return response()->json(['message' => 'Forbidden'], 403);
        }
        try {
            $item = Difficulty::create([
                'name' => '',
            ]);
            return response()->json([
                'success' => true,
                'message' => 'Loading...',
                'redirect' => route('difficulties.edit', $item),
            ]);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $req, Difficulty $difficulty)
    {
        $currentUser = $req->user();
        if ($currentUser->cannot('create', $difficulty)) {
            abort(403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $req, Difficulty $difficulty)
    {
        $currentUser = $req->user();
        if ($currentUser->cannot('update', $difficulty)) {
            abort(403);
        }
        $statuses = ModelStatusEnum::toArray();
        return view('difficulties.edit', [
            'item'=> $difficulty,
            'statuses'=> $statuses,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req, Difficulty $difficulty)
    {
        $currentUser = $req->user();
        if ($currentUser->cannot('update', $difficulty)) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $req->merge(['slug' => Str::slug($req['slug']) ]);
        $validated = $req->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255', Rule::unique(Difficulty::class)->ignore($difficulty->id)],
            'status' => [new Enum(ModelStatusEnum::class)],
        ]);

        try {
            $difficulty->update($validated);
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
    public function destroy(Request $req, Difficulty $difficulty)
    {
        $currentUser = $req->user();
        if ($currentUser->cannot('delete', $difficulty)) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        try {
            $difficulty->delete();
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
