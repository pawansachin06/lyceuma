<?php

use App\Http\Controllers\ExamChapterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/chapters/', [
    ExamChapterController::class, 'apiIndex'
])->name('api.exam-chapters.index');


