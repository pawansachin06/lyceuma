<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
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

Route::middleware('auth')->group(function(){
    Route::resource('users', UserController::class, ['name'=> 'users']);
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
