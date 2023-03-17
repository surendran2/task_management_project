<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        ini_set('memory_limit', '1024M');
        $tasks = Task::latest()->paginate(5);
        if ($request->listview) {
            $tasks = Task::select('*')
                ->where('status', '=', $request->listview)->latest()->paginate(5);
        }
     
        return view('tasks.index', compact('tasks'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tasks.create');
    }
    public function tasklist($id)
    {
        echo $id;
        exit;
        return view('tasks.show', compact('task'));
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
            'task' => 'required',
            'description' => 'required',
            'assign_date' => 'required',
        ]);
        $newTask = new Task();
        $newTask->task = $request->task;
        $newTask->description = $request->description;
        $newTask->status = $request->status;
        $newTask->assign_date = date("Y-m-d", strtotime($request->assign_date));
        $newTask->completed_date = date("Y-m-d", strtotime($request->assign_date));
        $newTask->save();
        return redirect()->route('tasks.index')
            ->with('success', 'Task created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        // $newTask = Task::find($id);

        $request->validate([
            'task' => 'required',
            'description' => 'required',
            'assign_date' => 'required',
        ]);
        // $newTask = new Task();

        $newTask = Task::find($request->id);
        $newTask->task = $request->task;
        $newTask->description = $request->description;
        $newTask->status = $request->status;
        $newTask->assign_date = date("Y-m-d", strtotime($request->assign_date));
        $newTask->completed_date = date("Y-m-d", strtotime($request->assign_date));
        $newTask->update();
        return redirect()->route('tasks.index')
            ->with('success', 'Task updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')
            ->with('success', 'Task deleted successfully');
    }
}
