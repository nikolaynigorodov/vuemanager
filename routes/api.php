<?php

use App\Http\Controllers\Api\SubtaskController;
use App\Http\Controllers\Api\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::controller(TaskController::class)->group(function () {
    Route::get('/tasks/{token}', 'index');
    Route::get('/tasks/{token}/{task_id}', 'show');
    Route::post('/tasks/{token}', 'store');
    Route::put('/tasks/{token}/{task_id}', 'update');
    Route::delete('/tasks/{token}/{task_id}', 'destroy');
});

Route::controller(SubtaskController::class)->group(function () {
    Route::get('/subtask/{token}/{subtask_id}', 'show');
    Route::post('/subtask/{token}/{task_id}', 'store');
    Route::put('/subtask/{token}/{subtask_id}', 'update');
    Route::delete('/subtask/{token}/{subtask_id}', 'destroy');
});
