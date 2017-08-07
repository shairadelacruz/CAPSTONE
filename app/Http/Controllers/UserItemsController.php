<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Item;
use App\Client;
use App\Coa;
use App\Vat;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class UserItemsController extends Controller
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

        $items = $client->item;

        //$items = Item::all();

        $coas = Coa::pluck('name', 'id')->all();

        $vats = Vat::pluck('vat_code', 'id')->all();
       
       //return $items;
    return view('users.receivable.item.index', compact('items','client_id','coas','vats' ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*public function create($client_id)
    {
        //

        $coas = Coa::pluck('name', 'id')->all();
        $vats = Vat::pluck('vat_code', 'id')->all();
        
        $client = Client::find($client_id);
        $items = $client->items;
        return view('users.receivable.item.index', compact('coas','vats','client_id', 'client'));
    }*/

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $client_id)
    {
        //
        Item::create($request->all());

        $input = $request->all();
        
        return \Redirect::route('item', [$client_id]);
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

        $coas = Coa::pluck('name', 'id')->all();
        $vats = Vat::pluck('vat_code', 'id')->all();

        $client = Client::findOrFail($client_id);
        $item = Item::findOrFail($id);

        return view('users.receivable.item.index', compact('coas','vats','client_id','client', 'item'));
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
        $item = Item::findOrFail($id);

        $input = $request->all();

        $item->update($input);
    
        $client_id = $item->client_id;

        return \Redirect::route('item', [$client_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $client_id)
    {
        //
        $item = Item::findOrFail($id);

        $item->delete();

        Session::flash('deleted_item','The item has been deleted');

        return \Redirect::route('item', [$client_id]);
    }
}
