<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CategoryController;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('views.posts.index');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    
    Route::get('/posts/index', [PostController::class, 'index'])->name('post.index');
    
    //投稿フォームの表示
    Route::get('/posts/create', [PostController::class, 'create'])->name('post.create'); 
    //画像を含めた投稿の保存処理
    Route::post('/posts', [PostController::class, 'store'])->name('post.store'); 
    //投稿詳細画面の表示
    Route::get('/posts/{post}', [PostController::class, 'show'])->name('post.show'); 
    
    Route::post('/posts/comment', [CommentController::class, 'store'])->name('comment.store');
    
});

require __DIR__.'/auth.php';
