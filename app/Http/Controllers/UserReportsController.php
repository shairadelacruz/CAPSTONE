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
    public function trial_balance_index($client_id)
    {
        //
        $client = Client::find($client_id);

        $trials = $client->coas()->with('journals_details')->get();

        //$trials = $client->with(['journal','coas.journals_details'])->get();

        //dd($trials);

        return view('users.report.general.trialbalance', compact('trials'));
    }

    public function trial_balance_generate(Request $request)
    {
        //
        $client = Client::find($request->client_id);

        $start = \Carbon\Carbon::parse($request->from)->toDateString();  

        $end = \Carbon\Carbon::parse($request->to)->toDateString();

        //select a.name from coas a inner join journal_details b on a.id = b.coa_id inner join journals c on b.journal_id = c.id WHERE (c.date BETWEEN '2017-10-01' AND '2017-10-30')

        //$data= $client->coas()->with('journals_details')->whereBetween('date',[$start,$end])->get();

        $data = DB::select("select a.name, sum(b.debit), sum(b.credit) from coas a inner join journal_details b on a.id = b.coa_id inner join journals c on b.journal_id = c.id WHERE (c.date BETWEEN '$start' AND '$end') GROUP BY b.coa_id");
        

        return response()->json($data);
    }
    

    public function general_ledger_index($client_id)
    {
        //
        /*$client = Client::find($client_id);

        $ledgers = $client->coas()->with('journals_details')->get();

        return view('users.report.general.generalledger', compact('ledgers'));*/

        $client = Client::find($client_id);

        //$ledgers = $client->coas()->with('journals_details')->get();

        //$ledgers = $client->with(['journal','coas.journals_details'])->get(); from Bh0uzwhzszz

        $coas = $client->coas;

        $ledgers = $client->journal()->whereBetween('date',['2016-10-01','2016-10-30'])->with('journal_details')->get();

        return view('users.report.general.generalledger', compact('coas','ledgers'));


    }

    public function general_ledger_generate($client_id)
    {
        //
        
    }

    public function balance_sheet_index($client_id)
    {
        //
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
