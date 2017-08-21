<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\User;
use App\Client;
use App\Http\Requests;

class AdminClientUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $clients = Client::all();

        $allClients = Client::pluck('company_name', 'id')->all();

        $allUsers = User::pluck('name', 'id')->all();

        return view('admin.management.assign.index', compact('clients', 'allClients', 'allUsers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.management.assign.create');
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
        $client_id = $request->client_id;

        $client = Client::findOrFail($client_id);

        $users = $request->get('user_id');

        $client->users()->sync($users);

        return redirect('/admin/management/assign');
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
        $client = Client::findOrFail($id);
        $user = User::findOrFail($id);
        return view('admin.management.assign.edit', compact('client', 'user'));
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
        $client_id = $request->client_id;

        $client = Client::findOrFail($client_id);

        $users = $request->get('user_id');

        $client->users()->sync($users);

        return redirect('/admin/management/assign');
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
    }
}
