<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Coa;
use App\Coaamount;
use App\Log;
use App\Vat;
use App\Client;
use App\Journal;
use App\JournalDetails;
use App\Http\Requests;
use PDF;
use Illuminate\Support\Facades\DB;

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

        $journals = $client->journal->all();

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
        $refs = $client->log;
        $carbon = \Carbon\Carbon::now(); 
        $count = Journal::whereYear('created_at','=', $carbon->year)->count()+1;

        return view('users.accounting.journal.create', compact('client_id','coas', 'vats', 'refs','count', 'client'));
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
            'coa_cli_id' => 'required',
            'debittot' => 'required',
            'credittot' => 'required|same:debittot'
        ]);

    
        $journals = new Journal;
        $journals->client_id = $request->client_id;
        $journals->transaction_no = $request->transaction_no;
        $journals->date = $request->date;
        $journals->description = $request->description;
        $journals->debit_total = $request->debittot;
        $journals->credit_total = $request->credittot;

        $id = $journals->save();

        
        $journ = Journal::all()->last();
        $journalId = $journ->id;


        if($id != 0){
            foreach ($request->coa_cli_id as $key => $v)
            {

                $journalDetail = new JournalDetails([
                            'journal_id'=>$journalId,
                            'coa_id'=>$request->coa_cli_id[$key],
                            'reference_no'=>$request->reference_no[$key],
                            'descriptions'=>$request->descriptions[$key],
                            'debit'=>$request->debit[$key],
                            'credit'=>$request->credit[$key],
                            'vat_id'=>$request->vat_id[$key],
                            'vat_amount'=>$request->vat_amount[$key]
                            
                ]);

            $journalDetail->save();

            }
        }
        $client_id = $request->client_id;
        return \Redirect::route('journal', [$client_id]); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($client_id, $id)
    {
        //
        $journal = Journal::findOrFail($id);
        $details = $journal->journal_details;
        $client = Client::findOrFail($client_id);
        $coas = $client->coas;
        $vats = Vat::all();
        $refs = $client->log;

        $pdf = PDF::loadView('users.accounting.journal.show', compact('journal','details','client_id','coas', 'vats', 'refs', 'client'));
        //$pdf = PDF::loadView('users.accounting.journal.show');
        return $pdf->download('journal.pdf');
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

        $journal = Journal::findOrFail($id);
        $details = $journal->journal_details;
        $client = Client::findOrFail($client_id);
        $coas = $client->coas;
        $vats = Vat::all();
        $refs = $client->log;

        return view('users.accounting.journal.edit', compact('journal','details','client_id','coas', 'vats', 'refs', 'client'));
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
        $this->validate($request, [
            'transaction_no' => 'required',
            'date' => 'required',
            'coa_cli_id' => 'required',
            'debittot' => 'required',
            'credittot' => 'required|same:debittot'
        ]);
        

        $journals= Journal::findOrFail($id);
        $journals->client_id = $request->client_id;
        $journals->transaction_no = $request->transaction_no;
        $journals->date = $request->date;
        $journals->description = $request->description;
        $journals->debit_total = $request->debittot;
        $journals->credit_total = $request->credittot;

        $journals->update();

        
        $id = $journals->id;


        $journalId = $journals->id;

        $client_id = $request->client_id;

        JournalDetails::where('journal_id', $journalId)->delete();


        if($id != 0){
            foreach ($request->coa_cli_id as $key => $v)
            {

                $journalDetail = new JournalDetails([
                            'journal_id'=>$journalId,
                            'coa_id'=>$request->coa_cli_id[$key],
                            'reference_no'=>$request->reference_no[$key],
                            'descriptions'=>$request->descriptions[$key],
                            'debit'=>$request->debit[$key],
                            'credit'=>$request->credit[$key],
                            'vat_id'=>$request->vat_id[$key],
                            'vat_amount'=>$request->vat_amount[$key]
                            
                ]);

            $journalDetail->save();

            }
        }

        return \Redirect::route('journal', [$client_id]); 
    }

    public function pdfview(Request $request)
    {

        $journal = Journal::findOrFail($id);
        $details = $journal->journal_details;
        $client = Client::findOrFail($client_id);
        $coas = $client->coas;
        $vats = Vat::all();
        $refs = $client->log;

        $items = DB::table("items")->get();
        view()->share('items',$items);

        if($request->has('download')){
            $pdf = PDF::loadView('pdfview');
            return $pdf->download('pdfview.pdf');
        }

        return view('users.accounting.journal.pdfview');
    }

    public function findDebit(Request $request, $client_id, $id)
    {

        $coa = Coa::find($request->id);

        $client = Client::find($client_id);

        $getId = $client->id;

        $partner = $coa->coapartner->where('type', 0)->where('client_id', 1)->first();

        $data = $partner->partnercoa_id;

        return response()->json($data);

    }

    public function findCredit(Request $request, $client_id, $id)
    {

        $coa = Coa::find($request->id);

        $client = Client::find($client_id);

        $getId = $client->id;

        $partner = $coa->coapartner->where('type', 1)->where('client_id', 1)->first();

        $data = $partner->partnercoa_id;

        return response()->json($data);

    }

    
    public function destroy($id, $client_id)
    {
        //
        $journal = Journal::findOrFail($id);

        $journal->debit_total = 0;

        $journal->credit_total = 0;
        
        $journal->update();

        $journalId = $journal->id;

        JournalDetails::where('journal_id', '=', $journalId)
        ->update(['debit' => 0, 'credit' => 0, 'vat_amount' => 0]);

        Session::flash('deleted_journal','The journal has been voided');

        return \Redirect::route('journal', [$client_id]);
    }

}
