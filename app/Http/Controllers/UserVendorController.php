<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Vendor;
use App\Client;
use App\Http\Requests;


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
        //return redirect('/user/{client_id}/payable/vendor');
       //return redirect(route('users.client_id.payable.vendor', ['client_id' => $client_id]));
        $input = $request->all();
        return $input;
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
    public function destroy($id)
    {
        //
    }
}
