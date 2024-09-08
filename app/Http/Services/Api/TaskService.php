<?php

namespace App\Http\Services\Api;


use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Auth;
use App\Models\TaskBox;
use Illuminate\Support\Str;
use App\Http\Requests\TaskStoreRequest;
use Exception;

class TaskService
{

    public function create(TaskStoreRequest $request): Task
    {
        return Task::create($request->all());
    }


    public function handleOwner(int $taskbox_id){
        //Check task owner
        try {
            $box = TaskBox::where('id', $taskbox_id)->first();
            
            if ($box->user_id != Auth::user()->id) {
                throw new Exception("The field is undefined."); 
            }
        }
        catch (Exception $e) {
            abort(404, "The Partner was not found");
        }
    }

    // public function update(TaskUpdateRequest $request, Task $blog): Task
    // {
    //     $blog->update($request->all());
    //     return $blog;
    // }

    // public function destroy(Task $blog): ?bool
    // {
    //     return $blog->delete();
    // }
}