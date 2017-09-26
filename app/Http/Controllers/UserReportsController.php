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
        //$client = Client::find($client_id);

        //$coa = Journal::with('journal_details')->get();

        $coa = DB::select(DB::raw('SELECT * FROM users'));

        return $coa;

        //return view('users.report.general.trialbalance', compact('trial'));
    }
}
