<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SocialLoginController;

Route::get('/', function () {
    return view('pages.index');
<<<<<<< HEAD
})->name('pages.index');
Route::get('/contactus', function () {
    return view('pages.contactUs');
})->name('pages.contactUs');
=======
})->name('home');


Route::middleware('guest')->group(function () {
    Route::get('/login/redirect/google', [
        SocialLoginController::class, 'googleRedirect'
    ])->name('login.google');
    Route::get('/login/callback/google', [
        SocialLoginController::class, 'googleCallback'
    ]);
});
>>>>>>> 344c6ee509a06002bcdc9f922ef8c0dea2656983

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
