<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;



use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function __construct()
    {
        $this->middleware('auth:api');
    }


    public function index()
    {
        $tasks = Task::all();
        return $tasks;
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required','description'=>'required', 'img_url'=>'image|mimes:jpeg,png,svg|max:1024'
        ]);

        $task = new Task($request->all());

        if ($request->hasFile('img_url')){
            $path = $request->img_url->store('public/tasks_img');
            $task->img_url = 'tasks_img/' . basename($path);
        }

       
        $task->save();

        return response()->json($task, 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $task = Task::findOrFail($request->id);

        $task-> name = $request-> name;

        $task->description = $request->description;

        $task-> name = $request-> name;

        $task->description = $request->description;

        if ($request->hasFile('img_url')){
            $path = $request->img_url->store('public/tasks_img');
            $task->img_url = 'tasks_img/' . basename($path);
        }

        $task->id_user = $request->id_user;
        $task->state = $request->state;

        $task->update();

        return response()->json($task, 200);

    }

   
    public function delete(Request $request)
    {
        $task = Task::destroy($request->id);
    
        return response()->json($task, 204);
    }
}
