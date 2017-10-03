<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Coa;
use App\Coapartner;
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

        //$coas = $client->coas;

        $coaselect = $client->coas->pluck('name', 'id')->all();

        /*$amount = DB::select(DB::raw('SELECT `amount` FROM `client_coa` WHERE `client_coa`.`client_id` = 1'));*/

        $coas = $client->coas()->with('journals_details')->get();

        return view('users.accounting.coa.index', compact('coas', 'client_id', 'coaselect'));
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

                $coaId = $coa->id;

                if($request->debit_partner != null && $request->credit_partner == null)
                {
                    $client->coas()->attach($coa);

                    $coapartner = new Coapartner;
                    $coapartner->client_id = $client_id;
                    $coapartner->coa_id = $coaId;
                    $coapartner->partnercoa_id = $request->debit_partner;
                    $coapartner->type = 0;
                    $coapartner->save();

                }

                else if($request->credit_partner != null && $request->debit_partner == null)
                {
                    $client->coas()->attach($coa);

                    $coapartner = new Coapartner;
                    $coapartner->client_id = $client_id;
                    $coapartner->coa_id = $coaId;
                    $coapartner->partnercoa_id = $request->credit_partner;
                    $coapartner->type = 1;
                    $coapartner->save();

                }

                else if($request->debit_partner != null && $request->credit_partner != null)
                {
                    $client->coas()->attach($coa);

                    $coapartner1 = new Coapartner;
                    $coapartner1->client_id = $client_id;
                    $coapartner1->coa_id = $coaId;
                    $coapartner1->partnercoa_id = $request->debit_partner;
                    $coapartner1->type = 0;
                    $coapartner1->save();

                    $coapartner = new Coapartner;
                    $coapartner->client_id = $client_id;
                    $coapartner->coa_id = $coaId;
                    $coapartner->partnercoa_id = $request->credit_partner;
                    $coapartner->type = 1;
                    $coapartner->save();

                }

                else
                {
                    $client->coas()->attach($coa);
                }
                

            }

            else{

                $newCoa = new Coa;
                $newCoa->name = $request->name;
                $newCoa->coacategory_id = $request->coacategory_id;
                $newCoa->description = $request->description;
                $newCoa->is_generic = $request->is_generic;
                $newCoa->save();

                $newCoaId = $newCoa->id;

                //$newCoa = Coa::latest()->first();

                if($request->debit_partner != null && $request->credit_partner == null)
                {
                    $client->coas()->attach($newCoa);

                    $coapartner = new Coapartner;
                    $coapartner->client_id = $client_id;
                    $coapartner->coa_id = $newCoaId;
                    $coapartner->partnercoa_id = $request->debit_partner;
                    $coapartner->type = 0;
                    $coapartner->save();

                }

                else if($request->credit_partner != null && $request->debit_partner == null)
                {
                    $client->coas()->attach($newCoa);

                    $coapartner = new Coapartner;
                    $coapartner->client_id = $client_id;
                    $coapartner->coa_id = $newCoaId;
                    $coapartner->partnercoa_id = $request->credit_partner;
                    $coapartner->type = 1;
                    $coapartner->save();

                }

                else if($request->debit_partner != null && $request->credit_partner != null)
                {
                    $client->coas()->attach($newCoa);

                    $coapartner1 = new Coapartner;
                    $coapartner1->client_id = $client_id;
                    $coapartner1->coa_id = $newCoaId;
                    $coapartner1->partnercoa_id = $request->debit_partner;
                    $coapartner1->type = 0;
                    $coapartner1->save();

                    $coapartner = new Coapartner;
                    $coapartner->client_id = $client_id;
                    $coapartner->coa_id = $newCoaId;
                    $coapartner->partnercoa_id = $request->credit_partner;
                    $coapartner->type = 1;
                    $coapartner->save();

                }

                else
                {
                    $client->coas()->attach($newCoa);
                }

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
    public function update(Request $request, $client_id, $id)
    {
        //
        $client_id = $request->client_id;

        $client = Client::find($client_id);

        $coa = Coa::findOrFail($id);

                $coa->name = $request->name;
                $coa->coacategory_id = $request->coacategory_id;
                $coa->description = $request->description;
                $coa->is_generic = $request->is_generic;
                $coa->update();

                $newCoaId = $coa->id;


                if($request->debit_partner != null && $request->credit_partner == null)
                {

                    $coapartnerid = $coa->debitPartnerId($client_id);

                    $coapartner = Coapartner::findOrFail($coapartnerid);
                    $coapartner->client_id = $client_id;
                    $coapartner->coa_id = $newCoaId;
                    $coapartner->partnercoa_id = $request->debit_partner;
                    $coapartner->type = 0;
                    $coapartner->update();

                }

                else if($request->credit_partner != null && $request->debit_partner == null)
                {

                    $coapartnerid = $coa->creditPartnerId($client_id);

                    $coapartner = Coapartner::findOrFail($coapartnerid);
                    $coapartner->client_id = $client_id;
                    $coapartner->coa_id = $newCoaId;
                    $coapartner->partnercoa_id = $request->credit_partner;
                    $coapartner->type = 1;
                    $coapartner->update();

                }

                else if($request->debit_partner != null && $request->credit_partner != null)
                {

                    $coapartnerid = $coa->debitPartnerId($client_id);

                    $coapartner1 = Coapartner::findOrFail($coapartnerid);
                    $coapartner1->client_id = $client_id;
                    $coapartner1->coa_id = $newCoaId;
                    $coapartner1->partnercoa_id = $request->debit_partner;
                    $coapartner1->type = 0;
                    $coapartner1->update();

                    $coapartnerid = $coa->creditPartnerId($client_id);

                    $coapartner = Coapartner::findOrFail($coapartnerid);
                    $coapartner->client_id = $client_id;
                    $coapartner->coa_id = $newCoaId;
                    $coapartner->partnercoa_id = $request->credit_partner;
                    $coapartner->type = 1;
                    $coapartner->update();

                }

                else
                {
                    //return \Redirect::route('coa', [$client_id]);

                }
        
        return \Redirect::route('coa', [$client_id]);

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
        
        $client = Client::findOrFail($client_id);

        //$coa = Coa::findOrFail($id);

        $client->coas()->detach($id);

        Session::flash('deleted_coa','The account has been deleted');

        return \Redirect::route('coa', [$client_id]);

    }
}
