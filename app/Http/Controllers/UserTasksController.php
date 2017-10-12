<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Auth;
use App\Task;
use App\Log;
use App\User;
use App\Client;
use App\Http\Requests;

class UserTasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $user = Auth::user();
        $tasks = $user->tasks;

        return view('users.task.index',compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $task = Task::findOrFail($request->task);
        $client_id = $task->client_id;
        //$documents = $task->log->pluck('reference_no');

        if($task->task_type == 0){
            Session::flash('task',$task);

            return redirect('/user/'.$client_id.'/accounting/journal/create');
        }
        else if($task->task_type == 1){

            return redirect('/user/'.$client_id.'/receivable/invoice/create');
        }

        else if($task->task_type == 2){

            return redirect('/user/'.$client_id.'/payable/bill/create');
        }

        else{

            return redirect('/user/tasks');
        }
        
    }
    
    public function update(Request $request, $id)
    {
        //
        $task = Task::findOrFail($id);
        $input = $request->all();
        $task->update($input);
        return redirect('/user/tasks');
    }

    public function show($id)
    {
        //
        $task = Task::findOrFail($id);
        return view('users.task.show', compact('task'));
    }

}
