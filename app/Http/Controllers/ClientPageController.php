<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Client;
use App\Coa;

class ClientPageController extends Controller
{
    //

    public function clientPageShow($client_id, $coa_id)
    {
        //
       $client = Client::find($client_id);
       $coa = Coa::find($coa_id);
       echo $client;
       echo $coa;
    }
}
