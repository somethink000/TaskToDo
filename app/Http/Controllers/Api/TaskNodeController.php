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


        $request->all()['data'] = json_encode($request->post('data')); 
        $request->all()['position'] = json_encode($request->post('position')); 
    
        return TaskNode::create($request->all());
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TaskNode $taskNode)
    {

        $taskNode = TaskNode::where('id', $request->all()['id'])->get();
        $request->all()['data'] = json_encode($request->post('data')); 
        $request->all()['position'] = json_encode($request->post('position')); 
        //$this->service->handleOwner($data['taskbox_id']);
        

        $taskNode[0]->update($request->all());

        return $taskNode;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TaskNode $taskNode)
    {
        //
    }
}
