<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Client;
use App\Activity;
use Auth;
use App\Http\Requests;

class UserHomeController extends Controller
{
    //
    public function index($client_id)
    {
        //
        $client = Client::find($client_id);
        $activities = Activity::with('subject')->orderBy('created_at', 'desc')->take(10)->get();
        return view('users.index', compact('client', 'activities'));
        //return $customers;
    }

    public function profile()
    {
        //
        $user = Auth::user();
        $revisioncount = $user->tasks()->where('status', 3)->get()->count();
        $activities = $user->activities()->with('subject')->take(10)->get();
        return view('admin.index', compact('activities'));

    }
}
