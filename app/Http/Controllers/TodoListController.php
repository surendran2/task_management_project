<?php

namespace App\Http\Controllers;

use App\Models\Todolist;

use Illuminate\Http\Request;

class TodoListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        ini_set('memory_limit', '1024M');
        $toDoLists = Todolist::latest()->paginate(5);
        return view('todo_lists.index', compact('toDoLists'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('todo_lists.create');
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
            'work' => 'required',
        ]);
        $newList = new Todolist();
        $newList->work = $request->work;
        $newList->notes = $request->notes;
        $newList->type = $request->type;
        $newList->start_date = date("Y-m-d", strtotime($request->start_date));
        $newList->end_date = date("Y-m-d", strtotime($request->end_date));
        $newList->save();
        return redirect()->route('todo_lists.index')
            ->with('success', 'To Do List created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todolist $id)
    {
        $res=Todolist::find($id)->delete();

        return redirect()->route('todo_lists.index')
            ->with('success', 'List deleted successfully');
    }
}
