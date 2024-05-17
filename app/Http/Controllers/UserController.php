<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Enums\UserRoleEnum;
use App\Models\Classroom;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Enum;

class UserController extends Controller
{
    public function __construct()
    {
    }


    public function index(Request $req)
    {
        $keyword = $req->s;
        $currentUser = $req->user();
        $query = User::query();

        if($currentUser->isSuperAdmin() || $currentUser->isAdmin()){
        } else {
            abort(404);
        }

        if(!empty($keyword)){
            $query = $query->where('name', 'like', '%' . $keyword . '%')
                        ->orWhere('lastname', 'like', '%' . $keyword . '%')
                        ->orWhere('email', 'like', '%' . $keyword . '%')
                        ->orWhere('uid', 'like', '%' . $keyword . '%')
                        ->orWhere('phone', 'like', '%' . $keyword . '%');
        }
        $items = $query->latest()->paginate(10)->withQueryString();
        return view('users.index', ['items' => $items, 'keyword'=> $keyword]);
    }


    public function create(Request $req)
    {
        $currentUser = $req->user();

        if($currentUser->isSuperAdmin() || $currentUser->isAdmin()){
            return view('users.create', [
                'user_roles' => UserRoleEnum::toArray(),
            ]);
        }
        abort(403);
    }


    public function store(Request $req)
    {
        $currentUser = $req->user();
        if($currentUser->isSuperAdmin() || $currentUser->isAdmin()){
        } else {
            return response()->json([
                'message'=> 'Only allowed to admins'
            ], 403);
        }

        $req->merge(['email' => strtolower($req['email']) ]);
        $validated = $req->validate([
            'name' => ['required', 'string', 'max:255'],
            'lastname' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique(User::class)],
            'phone' => ['required', 'numeric', 'digits:10', Rule::unique(User::class)],
            'username' => ['required', 'string', 'max:255', Rule::unique(User::class)],
            'role' => [new Enum(UserRoleEnum::class)],
            'password' => ['string', 'max:26'],
        ]);

        if( $currentUser->isAdmin() ) {
            if( in_array($validated['role'], [
                UserRoleEnum::SUPERADMIN, UserRoleEnum::ADMIN
            ]) ){
                $validated['role'] = UserRoleEnum::EDITOR;
            }
        }

        if( $currentUser->isEditor() ){
            if( in_array($validated['role'], [
                UserRoleEnum::SUPERADMIN, UserRoleEnum::ADMIN, UserRoleEnum::EDITOR
            ]) ){
                $validated['role'] = UserRoleEnum::STUDENT;
            }
            $validated['referral_code'] = $currentUser->unique_code;
        }

        if( $currentUser->isStudent() ) {
            return response()->json([
                'message' => 'User creation not allowed to students',
            ], 422);
        }

        try {
            $item = User::create($validated);
            return response()->json([
                'success' => true,
                'redirect' => route('users.edit', $item->id),
                'message' => 'User created',
            ]);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }


    public function show(User $user)
    {
        //
    }


    public function edit(Request $req, User $user)
    {
        $currentUser = $req->user();
        if($currentUser->isSuperAdmin() || $currentUser->isAdmin()){
        } else {
            abort(404);
        }

        $classrooms = Classroom::orderBy('order', 'asc')->get(['id', 'name']);
        $subjects = Subject::orderBy('name', 'asc')->get(['id', 'name']);
        $userClassrooms = $user->classrooms->pluck('id')->toArray();
        $userSubjects = $user->subjects->pluck('id')->toArray();
        return view('users.edit', [
            'item' => $user,
            'classrooms'=> $classrooms,
            'subjects'=> $subjects,
            'userClassrooms' => $userClassrooms,
            'currentUser'=> $currentUser,
            'userSubjects' => $userSubjects,
            'user_roles' => UserRoleEnum::toArray(),
        ]);
    }


    public function update(Request $req, User $user)
    {
        $currentUser = $req->user();
        if($currentUser->isSuperAdmin() || $currentUser->isAdmin()){
        } else {
            return response()->json([
                'message'=> 'Only allowed to admins'
            ], 403);
        }

        $item = $user;
        $req->merge(['email' => strtolower($req['email']) ]);

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'lastname' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
            'username' => ['required', 'string', 'max:255', Rule::unique(User::class)->ignore($user->id)],
            'phone' => ['required', 'numeric', 'digits:10', Rule::unique(User::class)->ignore($user->id)],
        ];

        if( ($currentUser->isSuperAdmin() || $currentUser->Admin()) && $item->isTeacher() ){
            $rules['role'] = ['required', new Enum(UserRoleEnum::class)];
            $rules['classroom_id'] = ['nullable'];
            $rules['classroom_id.*'] = ['nullable', Rule::exists(Classroom::class, 'id')];
            $rules['subject_id'] = ['nullable'];
            $rules['subject_id.*'] = ['nullable', Rule::exists(Subject::class, 'id')];
        } else {
            // $validated['role'] = UserRoleEnum::STUDENT;
        }

        $validated = $req->validate($rules);

        try {
            if( ($currentUser->isSuperAdmin() || $currentUser->Admin()) && $item->isTeacher() ){
                if(empty($validated['classroom_id'])){
                    $item->classrooms()->sync([]);
                } else {
                    $item->classrooms()->sync($validated['classroom_id']);
                }
                if(empty($validated['subject_id'])){
                    $item->subjects()->sync([]);
                } else {
                    $item->subjects()->sync($validated['subject_id']);
                }
            }
            $item->update($validated);
            return response()->json([
                'success' => true, 'message' => 'Saved successfully',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false, 'message' => $e->getMessage(),
            ], 500);
        }
    }


    public function destroy(Request $req, User $user)
    {
        $currentUser = $req->user();
        if($currentUser->isSuperAdmin() || $currentUser->isAdmin()){
        } else {
            return response()->json(['message'=> 'Admins only'], 404);
        }

        if($currentUser->isSuperAdmin()){
            if($currentUser->id == $user->id){
                return response()->json(['success'=> false, 'message'=> 'Can not deleted own super admin account']);
            } else {
                try {
                    $user->delete();
                } catch( Exception $e) {
                    return response()->json(['success' => false, 'message'=> $e->getMessage()]);
                }
                return response()->json(['success'=> true, 'reload' => true, 'message'=> 'Deleted user']);
            }
        }
        try {
            $user->delete();
        } catch(Exception $e){
            return response()->json(['success'=> false, 'message'=> $e->getMessage()]);
        }
        return response()->json(['success'=> true, 'reload' => true, 'message'=> 'Deleted user']);
    }
}
