<?php


use App\Http\Controllers\Api\V1\User\MeController;
use App\Http\Controllers\Api\NodesEdgeController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\TaskBoxController;
use App\Http\Controllers\Api\TaskNodeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')
    ->namespace('\App\Http\Controllers\Api\V1')
    ->middleware(['auth:sanctum', 'verified'])
    ->group(function () {
        Route::get('/me', MeController::class);
    });



Route::resource('tasks', TaskController::class)
->except([
    'create', 'edit','show', 
]);
Route::post('/tasks/update_sort',[TaskController::class, 'updateTasksSort']);


Route::resource('taskBoxes', TaskBoxController::class)
->except([
   'create', 'edit','show', 
]);


Route::resource('nodes', TaskNodeController::class)
->except([
   'create', 'edit','show', 
]);

Route::resource('edges', NodesEdgeController::class)
->except([
   'index', 'create', 'edit','show', 
]);