<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TaskNode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class TaskNodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {    
        return TaskNode::where('user_id', Auth::user()->id)->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->merge([
            'user_id' => Auth::user()->id,
        ]);
        return TaskNode::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(TaskNode $taskNode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TaskNode $taskNode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TaskNode $taskNode)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TaskNode $taskNode)
    {
        //
    }
}
