<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CreatorController;


Route::get('/', [UserController::class, 'home'])->name('home');


Route::get('/login', [UserController::class, 'login'])->name('login');
Route::get('/logout', [UserController::class, 'ulogout'])->name('ulogout');

Route::get('/register', [UserController::class, 'register'])->name('rewgister');


Route::post('/adduser', [UserController::class, 'adduser'])->name('adduser');
Route::post('/ulogin', [UserController::class, 'ulogin'])->name('ulogin');

Route::get('/adminview/dashboard', [AdminController::class, 'admindash'])->name('admindash');
Route::get('/creatorview/dashboard', [CreatorController::class, 'creatordash'])->name('creatordash');



Route::get('/creator/upload', [CreatorController::class, 'upload'])->name('upload');

Route::post('/uploadvideo', [CreatorController::class, 'uploadvideo'])->name('creator.videos.store');