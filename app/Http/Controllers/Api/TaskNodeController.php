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
        $boxes = TaskNode::where('user_id', Auth::user()->id)->get();
        $boxes->load('tasks');
        return $boxes;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
