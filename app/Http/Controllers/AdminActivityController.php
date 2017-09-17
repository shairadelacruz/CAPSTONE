<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Activity;
use App\Http\Requests;

class AdminActivityController extends Controller
{

    public function index()
    {
        $activities = Activity::with('subject')->get();
        return view('admin.utilities.activity.index', compact('activities'));
    }

}
