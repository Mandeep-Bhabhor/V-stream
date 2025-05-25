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
   // Route::get('/admin/user-stats', [AdminController::class, 'userStats'])->name('admin.userstats');
    Route::get('/admin/audit', [AdminController::class, 'audit'])->name('admin.audit');
    Route::get('/admin/videos', [AdminController::class, 'showCreatorVideos'])->name('admin.creator.videos');
    Route::get('/admin/profile', [UserController::class, 'profile']);

});

Route::middleware([CreatorMiddleware::class])->group(function () {  
    Route::get('/creatorview/dashboard', [CreatorController::class, 'creatordash'])->name('creatordash');
    Route::get('/creator/upload', [CreatorController::class, 'upload'])->name('upload');
    Route::post('/uploadvideo', [CreatorController::class, 'uploadvideo'])->name('creator.videos.store');
    Route::get('/creator/videos', [CreatorController::class, 'myvideos'])->name('creator.myvideos');
 //   Route::get('/creator/myvideos', [CreatorController::class, 'myUploadedVideos'])->name('creator.myUploadedVideos');
    Route::get('/creator/profile', [UserController::class, 'profile']);

});



Route::post('/toggle-like/{video}', [LikeController::class, 'toggle'])->name('like.video');
Route::get('/liked', [LikeController::class, 'likedVideos'])->name('liked.videos');


Route::get('/profile', [UserController::class, 'profile'])->name('profile');
Route::get('/editprofile/{id}', [UserController::class, 'vieweditprofile']);
Route::put('/editprofile/{id}', [UserController::class, 'editprofile']);    
Route::get('/deleteprofile/{id}', [UserController::class, 'deleteprofile']);
Route::get('/search', [UserController::class, 'search'])->name('search');
