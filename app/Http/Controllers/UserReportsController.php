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
    

    public function general_ledger_index($client_id)
    {
        //
        $client = Client::find($client_id);

        $ledgers = $client->coas()->with('journals_details')->get();

        return view('users.report.general.generalledger', compact('ledgers'));
    }
}
