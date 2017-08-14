<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Log;
use App\Client;
use App\Http\Requests;

class UserDocumentsController extends Controller
{
    //
    public function index($client_id)
    {
        //
        $client = Client::find($client_id);

        $documents = $client->log;
       
        return view('users.documents.index', compact('documents'));
        //return $customers;
    }
}
