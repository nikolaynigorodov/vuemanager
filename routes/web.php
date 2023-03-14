<?php

use App\Http\Controllers\SubtaskController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

/*Route::get('/tasks', function () {
    return view('main');
})->middleware(['auth:sanctum'])->name('main');*/

Auth::routes();

Route::apiResource('task', TaskController::class)->middleware('auth');
Route::apiResource('subtask', SubtaskController::class)->middleware('auth');
Route::get('/user', [UserController::class, 'index'])->middleware('auth')->name('user_index');

Route::view('/{any}', 'main')
    ->middleware(['auth:sanctum'])
    ->where('any', '.*');


