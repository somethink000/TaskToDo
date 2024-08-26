<?php


use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\TaskBoxController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});


Route::resource('tasks', TaskController::class)
 ->except([
     'create', 'edit' 
 ]);

Route::resource('taskBoxes', TaskBoxController::class)
->except([
    'create', 'edit' 
]);