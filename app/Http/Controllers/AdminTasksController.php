<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Task;
use App\Log;
use App\User;
use App\Client;
use App\Http\Requests;

class AdminTasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tasks = Task::all();
        return view('admin.management.task.index',compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $logs = Log::pluck('reference_no', 'id')->all();
        $clients = Client::pluck('company_name', 'id')->all();
        $users = User::pluck('name', 'id')->all();

        return view('admin.management.task.create', compact('documents', 'clients', 'users', 'logs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
        'name' => 'required',
        'deadline' => 'required',
        'user_id' => 'required',
        'client_id' => 'required',
        ]);

        $documents = $request->log_id;

        Task::create($request->all());

        $tasks = Task::all();

        $task = $tasks->last();

        $task->log()->sync($documents);

        return redirect('/admin/management/task');
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
        $task = Task::findOrFail($id);
        return view('admin.management.task.edit', compact('task'));
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
        $task = Task::findOrFail($id);

        $date = $task->deadline->toDateString();

        $logs = Log::lists('reference_no', 'id')->all();

        $clients = Client::lists('company_name', 'id')->all();

        $users = User::lists('name', 'id')->all();

        return view('admin.management.task.edit', compact('task','date','logs', 'clients', 'users'));
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
        $this->validate($request, [
        'name' => 'required',
        'deadline' => 'required',
        'user_id' => 'required',
        'client_id' => 'required',
        ]);

        $documents = $request->log_id;

        $task = Task::findOrFail($id);

        $input = $request->all();

        $task->update($input);

        $task->log()->sync($documents);

        return redirect('/admin/management/task');      

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $task = Task::findOrFail($id);

        $task->delete();

        Session::flash('deleted_task','The task has been deleted');

        return redirect('/admin/management/task');
    }
}
