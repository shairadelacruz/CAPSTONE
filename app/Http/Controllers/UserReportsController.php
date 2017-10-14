<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\User;
use App\Client;
use App\Coa;
use App\Journal;
use App\JournalDetails;
use PDF;
use App\Http\Requests;

class UserReportsController extends Controller
{
    //
    /*

        //$trials = $client->coas()->with('journals_details')->get();

        //$trials = $client->with(['journal','coas.journals_details'])->get();


        //$end = new \Carbon\Carbon('last day of this month');

        //$start = $start->toDateString();

        //$end = $end->toDateString();

        //$trials = $client->journal()->whereBetween('date',[$start,$end])->with('journal_details')->get();

        //$journals = $client->journal()->whereBetween('date',[$start,$end])->get();
    */



    public function trial_balance_index($client_id, $end)
    {
        //
        $client = Client::find($client_id);

        $coas = $client->coas;

        $getFinancialYear = \Carbon\Carbon::now()->year.'-'.$client->financial_year->format('m-d');

        if (\Carbon\Carbon::now()->format('Y-m-d') <= $getFinancialYear)
        {
            $lastyear = new \Carbon\Carbon('last year');
            $start = $lastyear->format('Y').'-'.$client->financial_year->format('m-d');
        }
        else
        {
            $start = \Carbon\Carbon::now()->year.'-'.$client->financial_year->format('m-d');
        }


        $journals = $client->journal()->whereBetween('date',[$start,$end])->pluck('id')->all();

        $details = JournalDetails::whereIn('journal_id', $journals)->get();

        //return $getFinancialYear;

        return view('users.report.general.trialbalance', compact('coas','details','start', 'end'));

    }

    public function trial_balance_generate(Request $request)
    {
        //
        $client = Client::find($request->client_id);

        $start = \Carbon\Carbon::parse($request->from);  

        $end = \Carbon\Carbon::parse($request->to);

        $start = $start->toDateString();

        $end = $end->toDateString();

        $data = $client->journal()->whereBetween('date',[$start,$end])->with('journal_details')->get();
        
        return response()->json($data);
    }
    

    public function general_ledger_index($client_id, $start, $end)
    {
        //

        $client = Client::find($client_id);

        //$ledgers = $client->coas()->with('journals_details')->get();

        //$ledgers = $client->with(['journal','coas.journals_details'])->get(); from Bh0uzwhzszz

        $coas = $client->coas;

        //$start = new \Carbon\Carbon('first day of this month');

        //$end = new \Carbon\Carbon('last day of this month');

        //$start = $start->toDateString();

        //$end = $end->toDateString();

        $ledgers = $client->journal()->whereBetween('date',[$start,$end])->with('journal_details')->get();

        return view('users.report.general.generalledger', compact('coas','ledgers','start', 'end'));


    }

    public function general_ledger_generate($client_id, $start, $end)
    {
        //
        $client = Client::find($client_id);

        $coas = $client->coas;

        $ledgers = $client->journal()->whereBetween('date',[$start,$end])->with('journal_details')->get();

        return view('users.report.general.generalledger', compact('coas','ledgers','start', 'end'));
        
    }

    public function balance_sheet_index($client_id, $end)
    {
        //
        $client = Client::find($client_id);

        $coas = $client->coas;

        $getFinancialYear = \Carbon\Carbon::now()->year.'-'.$client->financial_year->format('m-d');

        if (\Carbon\Carbon::now()->format('Y-m-d') <= $getFinancialYear)
        {
            $lastyear = new \Carbon\Carbon('last year');
            $start = $lastyear->format('Y').'-'.$client->financial_year->format('m-d');
        }
        else
        {
            $start = \Carbon\Carbon::now()->year.'-'.$client->financial_year->format('m-d');
        }


        $journals = $client->journal()->whereBetween('date',[$start,$end])->pluck('id')->all();

        $details = JournalDetails::whereIn('journal_id', $journals)->get();

        //return $getFinancialYear;

        return view('users.report.general.balancesheet', compact('coas','details','start', 'end'));
    }

    public function balance_sheet_generate($client_id)
    {
        //
        
    }

    public function profit_and_loss_index($client_id)
    {
        //

    }

    public function profit_and_loss_generate($client_id)
    {
        //
        
    }

    public function employee_evaluation_index()
    {
        /*$all = DB::table('tasks')
        ->join('users', 'users.id','=','tasks.user_id')
        ->select('users.name as name', 'tasks.deadline as deadline','tasks.name as task','tasks.description as description','tasks.status as status','tasks.revisions as revisions')
        ->get();*/

        $users = User::with('tasks')->get();

        return view('admin.management.evaluation.evaluation', compact('users'));

    }

    public function employee_evaluation_generate()
    {
        $users = User::with('tasks')->get();
        $pdf = PDF::loadView('admin.management.evaluation.evaluationgenerate', compact('users'));
        return $pdf->download('evaluation.pdf');

    }
}
