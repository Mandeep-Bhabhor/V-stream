<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [UserController::class, 'login'])->name('login');
Route::get('/logout', [UserController::class, 'ulogout'])->name('ulogout');

Route::get('/register', [UserController::class, 'register'])->name('rewgister');


Route::post('/adduser', [UserController::class, 'adduser'])->name('adduser');
Route::post('/ulogin', [UserController::class, 'ulogin'])->name('ulogin');