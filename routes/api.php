<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});




Route::resource('posts', App\Http\Controllers\API\PostAPIController::class)
    ->except(['create', 'edit']);

Route::resource('comments', App\Http\Controllers\API\CommentAPIController::class)
    ->except(['create', 'edit']);

Route::resource('tags', App\Http\Controllers\API\TagAPIController::class)
    ->except(['create', 'edit']);

Route::resource('categories', App\Http\Controllers\API\CategoryAPIController::class)
    ->except(['create', 'edit']);

Route::resource('authors', App\Http\Controllers\API\AuthorAPIController::class)
    ->except(['create', 'edit']);