<?php

use App\Models\Post;
use App\Http\Controllers\newPost;
use App\Http\Controllers\newMember;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('app');
});

Route::get('/signup', function () {
    return view('signup');
});

Route::get('/home', function () {
  // $posts = Post::where('user_id',auth()->id()) -> get();
    $posts = auth()->user()->usersCoolPosts()->latest()->get();
    return view('home',['posts'=>$posts]);
});

Route::post('/newMember', [userController::class,'signup']);
Route::post('/login', [userController::class,'login']);
Route::get('/logout', [userController::class,'logout']);
Route::get('/login/google', [userController::class,'redirectToGoogle']);
Route::get('/callback', [userController::class,'handleGoogleCallback']);

// Blog related routes
Route::post('/post', [postController::class,'post']);
Route::get('/edit-post/{post}', [postController::class,'showEditScreen']);
Route::put('/edit-post/{post}', [postController::class,'updatePost']);
Route::delete('/delete-post/{post}', [postController::class,'deletePost']);