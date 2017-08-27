<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Coa;
use App\Vat;
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
        $client = Client::find($client_id);
        $coas = $client->coas;
        $vats = Vat::all();
        return view('users.accounting.journal.create', compact('client_id','coas', 'vats'));
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

        $journals = new Journal;
        $journals->client_id = $request->client_id;
        $journals->transaction_no = $request->transaction_no;
        $journals->date = $request->date;
        $journals->description = $request->description;

        $id = $journals->save();

        
        $journ = Journal::all()->last();
        $journalId = $journ->id;


        if($id != 0){
            foreach ($request->coa_cli_id as $key => $v)
            {
                /*$data = array('journal_id'=>$journalId,
                            'reference_no'=>$request->reference_no[$key],
                            'descriptions'=>$request->descriptions[$key],
                            'debit'=>$request->debit[$key],
                            'credit'=>$request->credit[$key],
                            'vat_amount'=>$request->vat_amount[$key],
                            'vat_id'=>$request->vat_id[$key],
                            );


                JournalDetails::insert($data);*/

                $journalDetail = new JournalDetails([
                      'journal_id'=>$journalId,
                            'reference_no'=>$request->reference_no[$key],
                            'descriptions'=>$request->descriptions[$key],
                            'debit'=>$request->debit[$key],
                            'credit'=>$request->credit[$key],
                            'vat_amount'=>$request->vat_amount[$key],
                            'vat_id'=>$request->vat_id[$key]
                ]);
            $journalDetail->save();
            }
        }
        //return $data;
        //return $request->all();      
        //return $key;  
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
