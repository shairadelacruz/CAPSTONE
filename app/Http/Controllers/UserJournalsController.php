<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Client;
use App\Journal;
use App\JournalDetails;
use App\Http\Requests;

class UserJournalsController extends Controller
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

        $journals = $client->journal;

        return view('users.accounting.journal.index', compact('journals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($client_id)
    {
        //
        return view('users.accounting.journal.create', compact('client_id'));
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
        $this->validate($request, [
            'transaction_no' => 'required',
            'date' => 'required',
            'coa_cli_id' => 'required'
        ]);
        
        $details = collect($request->details)->transform(function($detail){

            $credeb = $detail['debit'] + $detail['credit'];
            $detail['total'] = (($detail['vat_amount']/100) * $credeb) + $credeb;
            return new JournalDetails($detail);
        });

        if($details->isEmpty()){

            return response()
                ->json([

                        'details_empty' => ['One or more entry is required.']

                    ], 422);
        }

        $data = $request->except('details');

        $journal = Journal::create($data);

        $journal->journal_details()->saveMany($products);

        return response()

            ->json([

                'created' => true,
                'id' => $journal->id

                ]);
        
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
         return view('users.accounting.journal.edit');
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
        $journal = Journal::findOrFail($id);

        $journal->delete();

        Session::flash('deleted_journal','The journal has been deleted');

        return \Redirect::route('journal', [$client_id]);
    }
}
