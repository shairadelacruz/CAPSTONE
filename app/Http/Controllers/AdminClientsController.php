<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use App\Http\Requests\ClientsEditRequest;
use App\Http\Requests\ClientsRequest;
use Illuminate\Http\Request;
use App\Client;
use App\Closing;
use App\User;
use App\Role;
use App\Business;
use App\Http\Requests;


class AdminClientsController extends Controller
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

        return view('admin.clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $industries = Business::pluck('name', 'id')->all();
        return view('admin.clients.create', compact('industries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientsRequest $request)
    {
        //

        Client::create($request->all());

        $client = Client::latest()->first();

        //Assign admin

        $client->assignAdmin();

        $client_id = $client->id;

        //Attach Generic COA

        $client->coas()->sync([1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30]);

        //Add Closing

        $closing1 = new Closing;

        $closing1->client_id = $client_id;

        $closing1->save();

        Session::flash('created_client',$client_id);
        
        return redirect('/admin/clients');

        
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
        return view('admin.clients.show');
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
        $industries = Business::pluck('name', 'id')->all();
        return view('admin.clients.edit', compact('client', 'industries'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClientsEditRequest $request, $id)
    {
        //

        $client = Client::findOrFail($id);
        $input = $request->all();
        $client->update($input);
        return redirect('/admin/clients');
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
        $client = Client::findOrFail($id);

        $client->coas()->detach();

        $client->delete();

        Session::flash('deleted_client','The client has been deleted');

        return redirect('/admin/clients');
    }
}
