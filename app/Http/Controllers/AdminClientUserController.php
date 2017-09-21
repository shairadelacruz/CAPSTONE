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

        $allUsers = User::all();

        return view('admin.management.assign.index', compact('clients', 'allClients', 'allUsers'));
    }


    public function store(Request $request)
    {
        //
        $client_id = $request->client_id;

        $client = Client::findOrFail($client_id);

        $users = $request->get('user_id');

        $client->users()->sync($users);

        return redirect('/admin/management/assign');
    }


}
