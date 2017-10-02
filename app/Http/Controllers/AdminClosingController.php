<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Closing;
use App\Client;
use App\Http\Requests;
use Carbon\Carbon;

class AdminClosingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $clients = Client::all();
        return view('admin.utilities.closing.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
     
        
        $closing = Closing::findOrFail($request->closing_id);
        $created_at = $closing->created_at;
        $created_atYear = Carbon::createFromFormat('Y-m-d H:i:s', $created_at)->year;

        $created_atMonth = Carbon::createFromFormat('Y-m-d H:i:s', $created_at)->month;

        $year = Carbon::now()->format('Y');

        $month = Carbon::now()->format('m');

        if($created_atYear = $year && $created_atMonth < $month || $created_atYear < $year)
        {   
            //Update to done
            $closing->status = 1;
            $closing->update();
            //Insert current period
            $closing1 = new Closing;
            $closing1->client_id = $request->client_id;
            $closing1->save();
            Session::flash('updated_closing','The book has been closed for the month');
            return redirect('/admin/utilities/closing'); 
        }
        else
        {
            return redirect('/admin/utilities/closing'); 
        }

         
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        return $request->all();
    }
        
}
