<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CreatorController;
use App\Http\Middleware\AdminMiddleware;  
use App\Http\Middleware\CreatorMiddleware;  
use App\Http\Controllers\LikeController;
 


Route::get('/', [UserController::class, 'home'])->name('home');


Route::get('/login', [UserController::class, 'login'])->name('login');
Route::get('/logout', [UserController::class, 'ulogout'])->name('ulogout');

Route::get('/register', [UserController::class, 'register'])->name('rewgister');


Route::post('/adduser', [UserController::class, 'adduser'])->name('adduser');
Route::post('/ulogin', [UserController::class, 'ulogin'])->name('ulogin');








///admin


Route::post('/admin/video/{id}/encode', [AdminController::class, 'encodevideo'])->name('admin.encode');


//Route::post('/admin/video/{id}/encode', [VideoController::class, 'encode'])->name('admin.encode');



Route::get('{id}/deletevideo', [CreatorController::class, 'delete']);





Route::middleware([AdminMiddleware::class])->group(function () {
    Route::get('/admin/encode', [AdminController::class, 'encode'])->name('admin.encodeview');
    Route::get('/adminview/dashboard', [AdminController::class, 'admindash'])->name('admindash');
    Route::post('/admin/video/{id}/encode', [AdminController::class, 'encodevideo'])->name('admin.encode');
});

Route::middleware([CreatorMiddleware::class])->group(function () {
    Route::get('/creatorview/dashboard', [CreatorController::class, 'creatordash'])->name('creatordash');
    Route::get('/creator/upload', [CreatorController::class, 'upload'])->name('upload');
    Route::post('/uploadvideo', [CreatorController::class, 'uploadvideo'])->name('creator.videos.store');
    Route::get('/creator/videos', [CreatorController::class, 'myvideos'])->name('creator.myvideos');

});



Route::post('/toggle-like/{video}', [LikeController::class, 'toggle'])->name('like.video');
Route::get('/trending', [LikeController::class, 'likedVideos'])->name('liked.videos');
