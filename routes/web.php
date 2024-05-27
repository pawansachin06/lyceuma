<?php

use App\Http\Controllers\BackupController;
use App\Http\Controllers\ExamCategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\DifficultyController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\ExamPatternController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\SubjectController;
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

Route::post('/users/phone/otp', [
    UserController::class, 'loginWithPhone'
])->name('login.phone');

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
    Route::resource('courses', CourseController::class, [
        'name' => 'courses'
    ]);
    // Route::resource('exam-patterns', ExamPatternController::class, [
    //     'name' => 'exam-patterns'
    // ]);
    // Route::resource('exam-categories', ExamCategoryController::class, [
    //     'name' => 'exam-categories'
    // ]);
    Route::resource('classrooms', ClassroomController::class, [
        'name' => 'classrooms'
    ]);
    Route::resource('subjects', SubjectController::class, [
        'name' => 'subjects'
    ]);
    Route::resource('chapters', ChapterController::class, [
        'name' => 'chapters'
    ]);
    Route::resource('difficulties', DifficultyController::class, [
        'name' => 'difficulties'
    ]);
    // Route::resource('exam-topics', ExamTopicController::class, [
    //     'name' => 'exam-topics'
    // ]);


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
    Route::post('/questions/image/delete', [
        QuestionController::class, 'destroyImage'
    ])->name('questions.image.destroy');
    Route::get('/questions/export', [
        QuestionController::class, 'export'
    ])->name('questions.export');
    Route::match(['get', 'post'], '/questions/export/download', [
        QuestionController::class, 'exportDownload'
    ])->name('questions.export.download');
    Route::get('/questions/import', [
        QuestionController::class, 'import'
    ])->name('questions.import');
    Route::post('/questions/import/save', [
        QuestionController::class, 'importUpload'
    ])->name('questions.import.upload');

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


    // backup
    Route::post('/admin/download-backup', [
        BackupController::class, 'downloadBackup'
    ])->name('backup.download');

});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');
});


Route::get('/mathjax', [PageController::class, 'mathjax'])->name('mathjax');
