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
            $start = $getFinancialYear;
        }


        $journals = $client->journal()->whereBetween('date',[$start,$end])->pluck('id')->all();

        $details = JournalDetails::whereIn('journal_id', $journals)->get();

        //return $getFinancialYear;

        return view('users.report.general.trialbalance', compact('coas','details','start', 'end'));

    }

    public function trial_balance_generate($client_id, $end)
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
            $start = $getFinancialYear;
        }


        $journals = $client->journal()->whereBetween('date',[$start,$end])->pluck('id')->all();

        $details = JournalDetails::whereIn('journal_id', $journals)->get();

        //return $getFinancialYear;

        $pdf = PDF::loadView('users.report.general.generate.trialbalance', compact('coas','details','start', 'end'));

        return $pdf->download('trialbalance.pdf');
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

        $pdf = PDF::loadView('users.report.general.generate.generalledger', compact('coas','ledgers','start', 'end'));

        return $pdf->download('generalledger.pdf');
        
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
            $start = $getFinancialYear;
        }


        $journals = $client->journal()->whereBetween('date',[$start,$end])->pluck('id')->all();

        $details = JournalDetails::whereIn('journal_id', $journals)->get();

        //return $getFinancialYear;

        return view('users.report.general.balancesheet', compact('coas','details','start', 'end'));
    }

    public function balance_sheet_generate($client_id, $end)
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
            $start = $getFinancialYear;
        }


        $journals = $client->journal()->whereBetween('date',[$start,$end])->pluck('id')->all();

        $details = JournalDetails::whereIn('journal_id', $journals)->get();

        //return $getFinancialYear;

        $pdf = PDF::loadView('users.report.general.generate.balancesheet', compact('coas','details','start', 'end'));

        return $pdf->download('balancesheet.pdf');
    }

    public function profit_and_loss_index($client_id, $start, $end)
    {
        //

        $client = Client::find($client_id);

        $coas = $client->coas;

        //$ledgers = $client->journal()->whereBetween('date',[$start,$end])->with('journal_details')->get();

        $journals = $client->journal()->whereBetween('date',[$start,$end])->pluck('id')->all();

        $details = JournalDetails::whereIn('journal_id', $journals)->get();

        return view('users.report.general.profitandloss', compact('coas','details'));

    }

    public function profit_and_loss_generate($client_id, $start, $end)
    {
        //
        $client = Client::find($client_id);

        $coas = $client->coas;

        $ledgers = $client->journal()->whereBetween('date',[$start,$end])->with('journal_details')->get();

        $pdf = PDF::loadView('users.report.general.generate.profitandloss', compact('coas','ledgers','start', 'end'));

        return $pdf->download('generalledger.pdf');
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
