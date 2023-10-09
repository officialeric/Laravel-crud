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

Route::post('/newMember', [newMember::class,'signup']);
Route::post('/login', [newMember::class,'login']);
Route::get('/logout', [newMember::class,'logout']);
Route::post('/post', [newPost::class,'post']);