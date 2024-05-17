<?php

use App\Http\Controllers\ChapterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/chapters/', [
    ChapterController::class, 'apiIndex'
])->name('api.chapters.index');


