<?php

use App\Http\Controllers\ChapterController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::match(['get', 'post'], '/chapters/', [
    ChapterController::class, 'apiIndex'
])->name('api.chapters.index');

Route::match(['get', 'post'], '/users/phone', [
    UserController::class, 'userByPhone'
])->name('api.users.phone');

