<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Client;
use App\Coa;
use App\Journal;
use App\JournalDetails;
use App\Http\Requests;

class UserReportsController extends Controller
{
    //
    public function trial_balance_index($client_id)
    {
        //
        $client = Client::find($client_id);

        $trials = $client->coas()->with('journals_details')->get();

        return view('users.report.general.trialbalance', compact('trials'));
    }

    public function trial_balance_generate(Request $request)
    {
        //
        $client = Client::find($request->client_id);

        $start = \Carbon\Carbon::parse($request->from)->startOfDay();  

        $end = \Carbon\Carbon::parse($request->to)->endOfDay();

        //select a.name from coas a inner join journal_details b on a.id = b.coa_id inner join journals c on b.journal_id = c.id WHERE (c.date BETWEEN '2017-10-01' AND '2017-10-30')

        //$data= $client->coas()->with('journals_details')->whereBetween('date',[$start,$end])->get();
        $data = DB::select("select a.name from coas a inner join journal_details b on a.id = b.coa_id inner join journals c on b.journal_id = c.id WHERE (c.date BETWEEN '$start' AND '$end')");

        return response()->json($data);
    }
    

    public function general_ledger_index($client_id)
    {
        //
        $client = Client::find($client_id);

        $ledgers = $client->coas()->with('journals_details')->get();

        return view('users.report.general.generalledger', compact('ledgers'));
    }

    public function general_ledger_generate($client_id)
    {
        //
        
    }
}
