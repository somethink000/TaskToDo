<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Api\TaskService;
use Illuminate\Support\Facades\DB;

use App\Models\Task;
use App\Http\Requests\TaskStoreRequest;
use App\Http\Requests\TaskUpdateRequest;

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
    public function update(TaskUpdateRequest $request, Task $task): Task
    {
        $task->update($request->all());
        
        return $task;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task): ?bool
    {
        return $task->delete();
    }


        /**
     * Update the specified resource in storage.
     */
    public function updateTasksSort(Request $request)
    {
        $data = $request->all();
        foreach ($data as $value) {
            
            DB::table('tasks')
                ->where('id', $value['id'])
                ->update(['sort_id' => $value['sort_id']]);
        }

    }
}
