<?php

namespace App\Http\Services\Api;


use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


use Illuminate\Support\Str;
use App\Http\Requests\TaskBoxStoreRequest;
use App\Models\TaskBox;

class TaskBoxService
{

    public function create(TaskBoxStoreRequest $request): TaskBox
    {
        return TaskBox::create($request->all());
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