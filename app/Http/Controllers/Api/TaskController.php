<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Api\TaskService;

use App\Models\Task;
use App\Http\Requests\TaskStoreRequest;

class TaskController extends Controller
{

    public function __construct(protected readonly TaskService $service)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Task::get();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskStoreRequest $request): Task
    {
        return $this->service->create($request);
    }

    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
