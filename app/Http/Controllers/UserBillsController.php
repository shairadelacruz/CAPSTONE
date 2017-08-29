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
        $vats = Vat::all();
        return view('users.payable.bill.create', compact('client_id', 'client', 'items', 'coas', 'vats', 'vendors'));


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
            'item_id' => 'required',
            'coa_id' => 'required'
        ]);

        $bills = new Bill;
        $bills->client_id = $request->client_id;
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
        //Get how many journal to put in transaction_no
        $count = Journal::where('type','=','2')->count();
        //Create Journal Header
        $journals = new Journal;
        $journals->client_id = $client_id;
        $journals->transaction_no = "B".$count;
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
        $credit->save();


        if($id != 0){
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

                $debit = new JournalDetails([
                            'journal_id'=>$journalId,
                            'coa_id'=>$request->coa_id[$key],
                            'debit'=>$request->total[$key]

                ]);

                $debit->save();

            }
        }
        //$client_id = $request->client_id;
        return \Redirect::route('bill', [$client_id]);
        
    }

    public function pay(Request $request, $id)
    {
        //
        $bill = Bill::findOrFail($id);

        $balance = $bill->balance;

        $minus = $request->amount;

        $amount = $balance - $request->amount;

        $bill->balance = $amount;

        $bill->update();
    
        $client_id = $bill->client_id;


        //Get how many journal to put in transaction_no
        $count = Journal::where('type','=','4')->count();
        //Create Journal Header
        $journals = new Journal;
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
        $credit->save();

        return \Redirect::route('bill', [$client_id]);
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
        return view('users.payable.bill.edit', compact('bill','details','client_id', 'client', 'items', 'coas', 'vats', 'vendors'));
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
        //
        /*$this->validate($request, [
            'reference_no' => 'required',
            'bill_date' => 'required',
            'item_id' => 'required',
            'coa_id' => 'required'
        ]);*/

        $bills= Bill::findOrFail($id);
        $bills->client_id = $request->client_id;
        $bills->reference_no = $request->reference_no;
        $bills->bill_date = $request->bill_date;
        $bills->due_date = $request->due_date;
        $bills->vendor_id = $request->vendor_id;
        $bills->amount = $request->grandTotal;
        $bills->balance = $request->grandTotal;

        $id = $bills->update();

        return $id;
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

        $bill->delete();

        Session::flash('deleted_bill','The bill has been deleted');

        return \Redirect::route('bill', [$client_id]);
    }
}
