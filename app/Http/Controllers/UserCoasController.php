<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Coa;
use App\Client;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;


class UserCoasController extends Controller
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

        $coas = $client->coas;

        /*$amount = DB::select(DB::raw('SELECT `amount` FROM `client_coa` WHERE `client_coa`.`client_id` = 1'));*/

        return view('users.accounting.coa.index', compact('coas', 'client_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*public function create($client_id)
    {
        //
        //return $client_id;

    }*/

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

        $client = Client::find($client_id);

        $coaName = $request->name;

        $coaCat = $request->coacategory_id;

        $coa = Coa::where('name', '=', $coaName)->where('coacategory_id', '=', $coaCat)->first();

            if($coa!=null){
                
                $client->coas()->attach($coa);

            }

            else{

                Coa::create($request->all());

                $newCoa = Coa::latest()->first();

                $client->coas()->attach($newCoa);

            }

        $input = $request->all();
        
        return \Redirect::route('coa', [$client_id]);
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
    public function destroy($id, $client_id)
    {
        //

        $client = Client::findOrFail($client_id);

        $coa = Coa::findOrFail($id)->first();

        //$client->coas()->detach($coa);

        return $client;

       // Session::flash('deleted_coa','The account has been deleted');

       // return \Redirect::route('coa', [$client_id]);
    }
}
