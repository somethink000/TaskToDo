<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\TaskBox;
use App\Http\Services\Api\TaskBoxService;

use App\Http\Requests\TaskBoxStoreRequest;


class TaskBoxController extends Controller
{

    public function __construct(protected readonly TaskBoxService $service)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {    
        $boxes = TaskBox::get();  
        $boxes->load('tasks');
        return $boxes;
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskBoxStoreRequest $request): TaskBox
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

    public function destroy(TaskBox $taskBox): ?bool
    {
        return $taskBox->delete();
    }
}
