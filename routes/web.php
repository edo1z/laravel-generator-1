<?php

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
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();


Route::resource('posts', App\Http\Controllers\PostController::class);
Route::resource('authors', App\Http\Controllers\AuthorController::class);
Route::resource('categories', App\Http\Controllers\CategoryController::class);
Route::resource('tags', App\Http\Controllers\TagController::class);
Route::resource('comments', App\Http\Controllers\CommentController::class);