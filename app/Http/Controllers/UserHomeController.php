<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\Http\Requests;

class UserHomeController extends Controller
{
    //
    public function index($client_id)
    {
        //
        $client = Client::find($client_id);

        return view('users.index', compact('client'));
        //return $customers;
    }
}
