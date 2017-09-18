<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\Coa;
use App\JournalDetails;
use App\Http\Requests;

class UserReportsController extends Controller
{
    //
    public function trial_balance_index($client_id)
    {
        //
        $client = Client::find($client_id);

        $coa = $client->coas->journals_details;

        return $coa;

        //return view('users.report.general.trialbalance', compact('trial'));
    }
}
