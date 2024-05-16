<?php

use App\Http\Controllers\ExamCategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ExamTypeController;
use App\Http\Controllers\ExamChapterController;
use App\Http\Controllers\ExamClassController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\ExamPatternController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ExamSubjectController;
use App\Http\Controllers\ExamTopicController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\QuestionTableController;
use App\Http\Controllers\SocialLoginController;


Route::get('/', function () {
    return view('pages.index');
})->name('home');


Route::get('/contactus', function () {
    return view('pages.contactUs');
})->name('pages.contactUs');


Route::middleware('guest')->group(function () {
    Route::get('/login/redirect/google', [
        SocialLoginController::class, 'googleRedirect'
    ])->name('login.google');
    Route::get('/login/callback/google', [
        SocialLoginController::class, 'googleCallback'
    ]);
});


Route::middleware('auth')->group(function () {
    Route::resource('users', UserController::class, [
        'name' => 'users'
    ]);
    Route::resource('exams', ExamController::class, [
        'name' => 'exams'
    ]);
    Route::resource('exam-types', ExamTypeController::class, [
        'name' => 'exam-types'
    ]);
    Route::resource('exam-patterns', ExamPatternController::class, [
        'name' => 'exam-patterns'
    ]);
    Route::resource('exam-categories', ExamCategoryController::class, [
        'name' => 'exam-categories'
    ]);
    Route::resource('exam-classes', ExamClassController::class, [
        'name' => 'exam-classes'
    ]);
    Route::resource('exam-subjects', ExamSubjectController::class, [
        'name' => 'exam-subjects'
    ]);
    Route::resource('exam-chapters', ExamChapterController::class, [
        'name' => 'exam-chapters'
    ]);
    Route::resource('exam-topics', ExamTopicController::class, [
        'name' => 'exam-topics'
    ]);


    Route::get('/questions', [
        QuestionController::class, 'index'
    ])->name('questions.index');
    Route::get('questions/create', [
        QuestionController::class, 'create'
    ])->name('questions.create');
    Route::post('/questions', [
        QuestionController::class, 'store'
    ])->name('questions.store');
    Route::get('/questions/edit/{tableId}/{quesId}', [
        QuestionController::class, 'edit'
    ])->name('questions.edit');
    Route::put('/questions/save/{tableId}/{quesId}', [
        QuestionController::class, 'update'
    ])->name('questions.update');
    Route::delete('/questions/delete/{tableId}/{quesId}', [
        QuestionController::class, 'destroy'
    ])->name('questions.destroy');

    // Route::resource('questions', QuestionController::class, [
    //     'name'=> 'questions'
    // ]);

    // Route::resource('question-tables', QuestionTableController::class, [
    //     'name'=> 'question-tables',
    // ]);

    Route::post('exams/questions/{exam}', [
        ExamController::class, 'addQuestion'
    ])->name('exams.add-question');
    Route::get('exams/questions/{exam}/{id}', [
        ExamController::class, 'editQuestion',
    ])->name('exams.edit-question');
    Route::put('exams/questions/{exam}/{id}', [
        ExamController::class, 'updateQuestion',
    ])->name('exams.update-question');
    Route::delete('exams/questions/{exam}/{id}', [
        ExamController::class, 'destroyQuestion',
    ])->name('exams.destroy-question');
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::get('/mathjax', [PageController::class, 'mathjax'])->name('mathjax');
