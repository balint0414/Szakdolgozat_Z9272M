<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\Controller;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [Controllers\HomeController::class, 'index'])->name('home');

//Route::get('/publish',[Controllers\PostController::class, 'create'])->name('post.create');
//Route::post('/publish',[Controllers\PostController::class, 'store']);


Route::middleware(['auth'])->group(function() {
    Route::get('/publish',[Controllers\PostController::class, 'create'])->name('post.create');
    Route::post('/publish',[Controllers\PostController::class, 'store']);

    Route::get('/post/{post}/edit', [Controllers\PostController::class, 'edit'])->name('post.edit');
    Route::post('/post/{post}/edit', [Controllers\PostController::class, 'update']);

    Route::post('/post/{post}/comment', [Controllers\PostController::class, 'comment'])->name('post.comment');

    Route::get('/profile/{user}', [Controllers\ProfileController::class, 'show'])->name('profile.details');
    Route::get('/profile/{user}/edit', [Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profiles/{user}', [Controllers\ProfileController::class, 'update'])->name('profile.update');
});

//próba

Route::get('/edzok', [Controllers\ProfileController::class, 'showEdzo'])->name('edzok.show');

//próba vége

Route::get('/post/{post}',[Controllers\PostController::class, 'show'])->name('post.details');

Route::get('/topic/{topic}', [Controllers\TopicController::class, 'show'])->name('topic.show');

/*
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
*/

require __DIR__.'/auth.php';
