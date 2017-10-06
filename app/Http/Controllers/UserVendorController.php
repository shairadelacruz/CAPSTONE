<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Vendor;
use App\Client;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;


class UserVendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($client_id)
    {
        //
        $client = Client::find($client_id);
        //$vendors = Vendor::all();
        $vendors = $client->vendor;
       
        return view('users.payable.vendor.index', compact('vendors'));
        //return $vendors;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($client_id)
    {
        //
        //return $client_id;
        $client = Client::find($client_id);
        $vendors = $client->vendors;
        return view('users.payable.vendor.create', compact('client_id', 'client'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $client_id)
    {
        //
        Vendor::create($request->all());

        $input = $request->all();
        
        return \Redirect::route('vendor', [$client_id]);
        //return redirect('/user/{client_id}/payable/vendor');
        //return redirect(route('users.client_id.payable.vendor', ['client_id' => $client_id]));
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
    public function edit($client_id, $id)
    {
        //
        $client = Client::findOrFail($client_id);
        $vendor = Vendor::findOrFail($id);

        return view('users.payable.vendor.edit', compact('client_id','client', 'vendor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $client_id, $id)
    {
        //
        $vendor = Vendor::findOrFail($id);

        $input = $request->all();

        $vendor->update($input);

    
        $client_id = $vendor->client_id;

        return \Redirect::route('vendor', [$client_id]);
        //return \Redirect::route('vendor', [$client_id])->with('message', 'State saved correctly!!!');
        //return $client;
        //return redirect('/user/{client}/payable/vendor', $client);
        //return redirect(route('users.client_id.payable.vendor', ['client_id' => $client]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($client_id, $id)
    {
        //
        $vendor = Vendor::findOrFail($id);

        $vendor->delete();

        Session::flash('deleted_vendor','The vendor has been deleted');

        return \Redirect::route('vendor', [$client_id]);
    }
}
