<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Bill;
use App\BillDetails;
use App\Client;
use App\Vendor;
use App\Item;
use App\Coa;
use App\Vat;
use App\Journal;
use App\JournalDetails;
use PDF;
use App\Http\Requests;

class UserBillsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index($client_id)
    {
        //
        $client = Client::find($client_id);

        $bills = $client->bill;

        return view('users.payable.bill.index', compact('bills'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($client_id)
    {
        //
        $client = Client::find($client_id);
        $vendors = $client->vendor;
        $bills = $client->bill;
        $items = $client->item;
        $coas = $client->coas;
        $refs = $client->log;
        $vats = Vat::all();
        $carbon = \Carbon\Carbon::now();
        $count = Bill::whereYear('created_at','=', $carbon->year)->count()+1;
        return view('users.payable.bill.create', compact('client_id', 'client', 'items', 'coas', 'vats', 'vendors', 'count', 'refs'));


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

       $this->validate($request, [
            'reference_no' => 'required',
            'bill_date' => 'required',
            'coa_id' => 'required',
            'vendor_id' => 'required'
        ]);



        $bills = new Bill;
        $bills->client_id = $request->client_id;
        $bills->transaction_no = $request->transaction_no;
        $bills->reference_no = $request->reference_no;
        $bills->bill_date = $request->bill_date;
        $bills->due_date = $request->due_date;
        $bills->vendor_id = $request->vendor_id;
        $bills->amount = $request->grandTotal;
        $bills->balance = $request->grandTotal;

        $id = $bills->save();

        $billLast = Bill::all()->last();
        $billId = $billLast->id;

        $client_id = $request->client_id;
        //Create Journal Header
        $journals = new Journal;
        $journals->bill_id = $billId;
        $journals->client_id = $client_id;
        $journals->transaction_no = $request->transaction_no;
        $journals->date = $request->bill_date;
        $journals->debit_total = $request->grandTotal;
        $journals->credit_total = $request->grandTotal;
        $journals->type = 2;
        $id = $journals->save();

        $journ = Journal::all()->last();
        $journalId = $journ->id;

        //Create Credit detail
        $credit = new JournalDetails;
        $credit->journal_id = $journalId;
        $credit->coa_id = 8;
        $credit->credit = $request->grandTotal;
        $credit->reference_no = 0;
        $credit->vat_amount = 0;
        $credit->save();


        if($journalId != 0){
            foreach ($request->item_id as $key => $v)
            {

                $billDetail = new BillDetails([
                            'bill_id'=>$billId,
                            'coa_id'=>$request->coa_id[$key],
                            'item_id'=>$request->item_id[$key],
                            'descriptions'=>$request->descriptions[$key],
                            'qty'=>$request->qty[$key],
                            'price'=>$request->price[$key],
                            'vat_amount'=>$request->vat_amount[$key],
                            'vat_id'=>$request->vat_id[$key],
                            'total'=>$request->total[$key]

                ]);

                $billDetail->save();


                //Create Debit detail
                $subTotal = $request->price[$key] * $request->qty[$key];

                $debit = new JournalDetails([
                            'journal_id'=>$journalId,
                            'coa_id'=>$request->coa_id[$key],
                            'debit'=>$subTotal,
                            'descriptions'=>$request->descriptions[$key],
                            'vat_amount'=>$request->vat_amount[$key],
                            'vat_id'=>$request->vat_id[$key],
                            'reference_no'=>$request->reference_no

                ]);

                $debit->save();

            }
        }
        //$client_id = $request->client_id;
        return \Redirect::route('bill', [$client_id]);
        
    }
    public function cbstore(Request $request)
    {
        
        foreach ($request->coa_id as $key => $v)
            {

                $client = Client::findOrFail($request->client_id[$key]);
                $client_code = $client->code;
                //Get how many journal to put in transaction_no
                $count = Journal::where('type','=','5')->count() + 1;
                $year = \Carbon\Carbon::now()->year;

                $bill = new Bill([
                            'client_id'=>$request->client_id[$key],
                            'transaction_no'=>$year.'-'.$client_code.'-'.$count.'-'."CB",
                            'reference_no'=>$request->reference_no[$key],
                            'bill_date'=>$request->bill_date[$key],
                            'due_date'=>$request->bill_date[$key],
                            'vendor_id'=>$request->vendor_id[$key],
                            'amount'=>$request->amount[$key],
                            'balance'=>0,
                            'vat_amount'=>$request->vat_amount[$key],
                            'vat_id'=>$request->vat_id[$key],
                            'total'=>$request->total_cd[$key]

                ]);

                $bill->save();

                $billLast = Bill::all()->last();
                $billId = $billLast->id;

                $billDetail = new BillDetails([
                            'bill_id'=>$billId,
                            'coa_id'=>$request->coa_id[$key],
                            'qty'=>1,
                            'price'=>$request->amount[$key],
                            'vat_amount'=>$request->vat_amount[$key],
                            'vat_id'=>$request->vat_id[$key],
                            'total'=>$request->amount[$key] + $request->vat_amount[$key]

                ]);

                $billDetail->save();

            

                
                

                //Create Journal Header
                $journals = new Journal([
                            'bill_id'=>$billId,
                            'client_id'=>$request->client_id[$key],
                            'transaction_no'=>$year.'-'.$client_code.'-'.$count.'-'."CB",
                            'date'=>$request->bill_date[$key],
                            'debit_total'=>$request->amount[$key] + $request->vat_amount[$key],
                            'credit_total'=>$request->amount[$key] + $request->vat_amount[$key],
                            'type'=>5,
                ]);

                $journals->save();

                $journ = Journal::all()->last();
                $journalId = $journ->id;

                //Create Credit detail
                $credit = new JournalDetails([
                            'journal_id'=>$journalId,
                            'coa_id'=> 1,
                            'credit'=>$request->amount[$key] + $request->vat_amount[$key]
                ]);

                $credit->save();

                //Create Debit detail
                $debit = new JournalDetails([
                            'journal_id'=>$journalId,
                            'coa_id'=>$request->coa_id[$key],
                            'debit'=>$request->amount[$key],
                            
                ]);

                $debit->save();
            }
            $client_id = $request->client_id[1];
            return \Redirect::route('bill', [$client_id]);
    }

    public function pay(Request $request, $id)
    {
        //
        //return $request->all();
        $bill = Bill::findOrFail($id);

        $balance = $bill->balance;

        $minus = $request->amount;

        $amount = $balance - $request->amount;

        $bill->balance = $amount;

        $bill->update();
    
        $client_id = $bill->client_id;

        $billId = $bill->id;

        //Update Journal with payment debit and credit
        //Get Journal
        $journals = Journal::where('bill_id', $billId)->first();
        //Change debit and credit total to include payment
        $journalOldDeb = $journals->debit_total;
        $journalOldCred = $journals->credit_total;

        $journals->debit_total = $journalOldDeb + $request->amount;
        $journals->credit_total = $journalOldCred + $request->amount;
        $journals->update();

        $journalId = $journals->id;

        //Create Debit detail
        $debit = new JournalDetails;
        $debit->journal_id = $journalId;
        $debit->coa_id = 8;
        $debit->debit = $minus;
        $debit->descriptions = $request->description;
        $debit->reference_no = 0;
        $debit->vat_amount = 0;
        $debit->save();

        //Create Credit detail
        $credit = new JournalDetails;
        $credit->journal_id = $journalId;
        $credit->coa_id = 1;
        $credit->credit = $minus;
        $credit->descriptions = $request->description;
        $credit->reference_no = 0;
        $credit->vat_amount = 0;
        $credit->save();


        //Get how many journal to put in transaction_no
        //$count = Journal::where('type','=','4')->count();
        //Create Journal Header
        /*$journals = new Journal;
        $journals->client_id = $client_id;
        $journals->transaction_no = "BP".$count;
        $journals->date = $request->date;
        $journals->description = $request->description;
        $journals->debit_total = $minus;
        $journals->credit_total = $minus;
        $journals->type = 4;
        $id = $journals->save();

        $journ = Journal::all()->last();
        $journalId = $journ->id;

        //Create Debit detail
        $debit = new JournalDetails;
        $debit->journal_id = $journalId;
        $debit->coa_id = 8;
        $debit->debit = $minus;
        $debit->save();

        //Create Credit detail
        $credit = new JournalDetails;
        $credit->journal_id = $journalId;
        $credit->coa_id = 1;
        $credit->credit = $minus;
        $credit->save();*/

        return \Redirect::route('bill', [$client_id]);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($client_id, $id)
    {
        //
        $bill = Bill::findOrFail($id);
        $details = $bill->bill_detail;
        $client = Client::find($client_id);
        $vendors = $client->vendor;
        $bills = $client->bill;
        $items = $client->item;
        $coas = $client->coas;
        $vats = Vat::all();
        $refs = $client->log;

        $pdf = PDF::loadView('users.payable.bill.show', compact('bill','details','client_id', 'client', 'items', 'coas', 'vats', 'vendors','refs'));

        return $pdf->download('bill.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($client_id, $id)
    {
        //
        $bill = Bill::findOrFail($id);
        $details = $bill->bill_detail;
        $client = Client::find($client_id);
        $vendors = $client->vendor;
        $bills = $client->bill;
        $items = $client->item;
        $coas = $client->coas;
        $vats = Vat::all();
        $refs = $client->log;
        return view('users.payable.bill.edit', compact('bill','details','client_id', 'client', 'items', 'coas', 'vats', 'vendors','refs'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $client_id, $id)
    {
        //

        $this->validate($request, [
            'reference_no' => 'required',
            'bill_date' => 'required',
            'coa_id' => 'required'
        ]);
        
        $bills= Bill::findOrFail($id);
        $bills->client_id = $request->client_id;
        $bills->transaction_no = $request->transaction_no;
        $bills->reference_no = $request->reference_no;
        $bills->bill_date = $request->bill_date;
        $bills->due_date = $request->due_date;
        $bills->vendor_id = $request->vendor_id;
        $bills->amount = $request->grandTotal;
        $bills->balance = $request->grandTotal;

        $bills->update();

        $id = $bills->id;

        //$billLast = Bill::all()->last();
        $billId = $bills->id;

        $client_id = $request->client_id;

        BillDetails::where('bill_id', $billId)->delete();


        //Create Journal Header
        $journals = Journal::where('bill_id', $billId)->first();

        $journals->bill_id = $billId;
        $journals->client_id = $client_id;
        //$journals->transaction_no = "B".$count;
        $journals->date = $request->bill_date;
        $journals->debit_total = $request->grandTotal;
        $journals->credit_total = $request->grandTotal;
        $journals->type = 2;
        $journals->update();

        //$id = $journals->id;
        $journalId = $journals->id;

        //Create Credit detail

        JournalDetails::where('journal_id', $journalId)->delete();

        $credit = new JournalDetails;
        $credit->journal_id = $journalId;
        $credit->coa_id = 8;
        $credit->credit = $request->grandTotal;
        $credit->save();

        if($journalId != 0){
            foreach ($request->item_id as $key => $v)
            {

                $billDetail = new BillDetails([
                            'bill_id'=>$billId,
                            'coa_id'=>$request->coa_id[$key],
                            'item_id'=>$request->item_id[$key],
                            'descriptions'=>$request->descriptions[$key],
                            'qty'=>$request->qty[$key],
                            'price'=>$request->price[$key],
                            'vat_amount'=>$request->vat_amount[$key],
                            'vat_id'=>$request->vat_id[$key],
                            'total'=>$request->total[$key]

                ]);

                $billDetail->save();

                 //Create Debit detail
                $subTotal = $request->price[$key] * $request->qty[$key];

                $debit = new JournalDetails([
                            'journal_id'=>$journalId,
                            'coa_id'=>$request->coa_id[$key],
                            'descriptions'=>$request->descriptions[$key],
                            'debit'=>$subTotal

                ]);

                $debit->save();

            }
        }
       return \Redirect::route('bill', [$client_id]);

        
    }

    public function findPrice(/*$item_id*/Request $request)
    {


        $data= Item::find($request->id);

        return response()->json($data);
        //return Response::json($data);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $client_id)
    {
        //
        $bill = Bill::findOrFail($id);

        $bill->balance = 0;

        $bill->amount = 0;
        
        $bill->update();

        $billId = $bill->id;

        BillDetails::where('bill_id', '=', $billId)
        ->update(['price' => 0, 'total' => 0, 'vat_amount' => 0]);

        $journal = Journal::where('bill_id', $billId)->first();

        $journal->debit_total = 0;

        $journal->credit_total = 0;
        
        $journal->update();

        $journalId = $journal->id;

        JournalDetails::where('journal_id', '=', $journalId)
        ->update(['debit' => 0, 'credit' => 0, 'vat_amount' => 0]);

        Session::flash('deleted_bill','The bill has been voided');

        return \Redirect::route('bill', [$client_id]);
    }
}
