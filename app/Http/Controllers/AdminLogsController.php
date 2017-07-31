<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Log;
use App\User;
use App\Client;
use App\DocumentType;
use App\Http\Requests;

class AdminLogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $logs = Log::all();
        //$date = $log->date_received->toDateString();
        return view('admin.management.logs.index', compact('logs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $documents = DocumentType::pluck('name', 'id')->all();
        $clients = Client::pluck('company_name', 'id')->all();
        $users = User::pluck('name', 'id')->all();
        return view('admin.management.logs.create', compact('documents', 'clients', 'users'));
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

        Log::create($request->all());
        return redirect('/admin/management/logs');
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
        $log = Log::findOrFail($id);
        $date = $log->date_received->toDateString();
        $documents = DocumentType::lists('name', 'id')->all();
        $clients = Client::lists('company_name', 'id')->all();
        $users = User::lists('name', 'id')->all();
        //$roles = Role::lists('name', 'id')->all();
        return view('admin.management.logs.edit', compact('log','date','documents', 'clients', 'users'));
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
        $log = Log::findOrFail($id);

        $input = $request->all();

        $log->update($input);
        //return $input;
        return redirect('/admin/management/logs');
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
        $log = Log::findOrFail($id);

        $log->delete();

        //return $id;

        Session::flash('deleted_log','The log has been deleted');

        return redirect('/admin/management/logs');
    }
}
