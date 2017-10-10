<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Client;
use App\Invoice;
use App\InvoiceDetail;
use App\Customer;
use App\Item;
use App\Coa;
use App\Vat;
use App\Journal;
use App\JournalDetails;
use App\Http\Requests;

class UserInvoicesController extends Controller
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

        $invoices = $client->invoice;

        return view('users.receivable.invoice.index', compact('invoices'));
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
        $customers = $client->customer;
        $invoices = $client->invoice;
        $items = $client->item;
        $coas = $client->coas;
        $refs = $client->log;
        $vats = Vat::all();
        $carbon = \Carbon\Carbon::now();
        $count = Invoice::whereYear('created_at','=', $carbon->year)->count()+1;
        return view('users.receivable.invoice.create', compact('client_id', 'client', 'items', 'coas', 'vats', 'customers', 'count', 'refs'));
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
            'invoice_date' => 'required',
            'item_id' => 'required',
            'coa_id' => 'required'
        ]);
       

        $invoices = new Invoice;
        $invoices->transaction_no = $request->transaction_no;
        $invoices->client_id = $request->client_id;
        $invoices->reference_no = $request->reference_no;
        $invoices->invoice_date = $request->invoice_date;
        $invoices->due_date = $request->due_date;
        $invoices->customer_id = $request->customer_id;
        $invoices->amount = $request->grandTotal;
        $invoices->balance = $request->grandTotal;

        $id = $invoices->save();

        $invoiceLast = Invoice::all()->last();
        $invoiceId = $invoiceLast->id;

        $client_id = $request->client_id;
        //Create Journal Header
        $journals = new Journal;
        $journals->invoice_id = $invoiceId;
        $journals->client_id = $client_id;
        $journals->transaction_no = $request->transaction_no;
        $journals->date = $request->invoice_date;
        $journals->debit_total = $request->grandTotal;
        $journals->credit_total = $request->grandTotal;
        $journals->type = 1;
        $id = $journals->save();

        $journ = Journal::all()->last();
        $journalId = $journ->id;

        //Create debit detail
        $debit = new JournalDetails;
        $debit->journal_id = $journalId;
        $debit->coa_id = 2;
        $debit->debit = $request->grandTotal;
        $debit->reference_no = 0;
        $debit->vat_amount = 0;
        $debit->save();


        if($id != 0){
            foreach ($request->item_id as $key => $v)
            {

                $invoiceDetail = new InvoiceDetail([
                            'invoice_id'=>$invoiceId,
                            'coa_id'=>$request->coa_id[$key],
                            'item_id'=>$request->item_id[$key],
                            'descriptions'=>$request->descriptions[$key],
                            'qty'=>$request->qty[$key],
                            'price'=>$request->price[$key],
                            'vat_amount'=>$request->vat_amount[$key],
                            'vat_id'=>$request->vat_id[$key],
                            'total'=>$request->total[$key]

                ]);

            $invoiceDetail->save();


                //Create credit detail
             $subTotal = $request->total[$key] - $request->vat_amount[$key];

                $credit = new JournalDetails([
                            'journal_id'=>$journalId,
                            'coa_id'=>$request->coa_id[$key],
                            'credit'=>$subTotal,
                            'descriptions'=>$request->descriptions[$key],
                            'vat_amount'=>$request->vat_amount[$key],
                            'vat_id'=>$request->vat_id[$key],
                            'reference_no'=>$request->reference_no

                ]);

                $credit->save();


            }
        }
        //$client_id = $request->client_id;
        return \Redirect::route('invoice', [$client_id]);
        
    }

    public function pay(Request $request, $id)
    {
        //
        $invoice = Invoice::findOrFail($id);

        $balance = $invoice->balance;

        $minus = $request->amount;

        $amount = $balance - $request->amount;

        $invoice->balance = $amount;

        $invoice->update();
    
        $client_id = $invoice->client_id;

        $invoiceId = $invoice->id;

        //Update Journal with payment debit and credit

        $journals = Journal::where('invoice_id', $invoiceId)->first();

        $journalId = $journals->id;

        //Create Debit detail
        $debit = new JournalDetails;
        $debit->journal_id = $journalId;
        $debit->coa_id = 1;
        $debit->debit = $minus;
        $debit->descriptions = $request->description;
        $debit->reference_no = 0;
        $debit->vat_amount = 0;
        $debit->save();

        //Create Credit detail
        $credit = new JournalDetails;
        $credit->journal_id = $journalId;
        $credit->coa_id = 2;
        $credit->credit = $minus;
        $credit->descriptions = $request->description;
        $credit->reference_no = 0;
        $credit->vat_amount = 0;
        $credit->save();


        //Get how many journal to put in transaction_no
        //$count = Journal::where('type','=','3')->count();
        //Create Journal Header
        /*$journals = new Journal;
        $journals->client_id = $client_id;
        $journals->transaction_no = "IP".$count;
        $journals->date = $request->date;
        $journals->description = $request->description;
        $journals->debit_total = $minus;
        $journals->credit_total = $minus;
        $journals->type = 3;
        $id = $journals->save();

        $journ = Journal::all()->last();
        $journalId = $journ->id;

        //Create Debit detail
        $debit = new JournalDetails;
        $debit->journal_id = $journalId;
        $debit->coa_id = 1;
        $debit->debit = $minus;
        $debit->save();

        //Create Credit detail
        $credit = new JournalDetails;
        $credit->journal_id = $journalId;
        $credit->coa_id = 2;
        $credit->credit = $minus;
        $credit->save();*/

        return \Redirect::route('invoice', [$client_id]);
        
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
        $invoice = Invoice::findOrFail($id);
        $details = $invoice->invoice_details;
        $client = Client::find($client_id);
        $customers = $client->customer;
        $invoices = $client->invoice;
        $items = $client->item;
        $coas = $client->coas;
        $refs = $client->log;
        $vats = Vat::all();

        //return $details;
        return view('users.receivable.invoice.edit', compact('invoice','details','client_id', 'client', 'items', 'coas', 'vats', 'customers', 'refs'));
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
            'invoice_date' => 'required',
            'item_id' => 'required',
            'coa_id' => 'required'
        ]);
        
        $invoices= Invoice::findOrFail($id);
        $invoices->client_id = $request->client_id;
        $invoices->reference_no = $request->reference_no;
        $invoices->invoice_date = $request->invoice_date;
        $invoices->due_date = $request->due_date;
        $invoices->customer_id = $request->customer_id;
        if($invoices->balance == $invoices->amount)
        {
            $invoices->balance = $request->grandTotal;
        }
        else
        {
            $invoice_amount = $invoices->amount;
            $new_amount = $request->amount;

            if($invoice_amount < $new_amount)
            {
                $difference = $new_amount - $invoice_amount;
                $new_balance = $invoice_amount + $difference;
                $invoices->balance = $new_balance;

            }
            elseif ($invoice_amount > $new_amount)
            {
                $difference = $invoice_amount - $new_amount;
                $new_balance = $invoice_amount + $difference;
                $invoices->balance = $new_balance;
            }
            else
            {
                $invoices->balance = $request->grandTotal;
            }
        }

        $invoices->amount = $request->grandTotal;
        

        $invoices->update();

        $id = $invoices->id;


        $invoiceId = $invoices->id;

        $client_id = $request->client_id;

        InvoiceDetail::where('invoice_id', $invoiceId)->delete();

        //Create Journal Header
        $journals = Journal::where('invoice_id', $invoiceId)->first();

        $journals->invoice_id = $invoiceId;
        $journals->client_id = $client_id;
        //$journals->transaction_no = "B".$count;
        $journals->date = $request->invoice_date;
        $journals->debit_total = $request->grandTotal;
        $journals->credit_total = $request->grandTotal;
        $journals->type = 1;
        $journals->update();

        //$id = $journals->id;
        $journalId = $journals->id;

         //Create Debit detail

        JournalDetails::where('journal_id', $journalId)->delete();

        $debit = new JournalDetails;
        $debit->journal_id = $journalId;
        $debit->coa_id = 2;
        $debit->debit = $request->grandTotal;
        $debit->save();


        if($id != 0){
            foreach ($request->item_id as $key => $v)
            {

                $invoiceDetail = new InvoiceDetail([
                            'invoice_id'=>$invoiceId,
                            'coa_id'=>$request->coa_id[$key],
                            'item_id'=>$request->item_id[$key],
                            'descriptions'=>$request->descriptions[$key],
                            'qty'=>$request->qty[$key],
                            'price'=>$request->price[$key],
                            'vat_amount'=>$request->vat_amount[$key],
                            'vat_id'=>$request->vat_id[$key],
                            'total'=>$request->total[$key]

                ]);

                $invoiceDetail->save();

                //Create Credit detail

                $subTotal = $request->total[$key] - $request->vat_amount[$key];

                $credit = new JournalDetails([
                            'journal_id'=>$journalId,
                            'coa_id'=>$request->coa_id[$key],
                            'vat_amount'=>$request->vat_amount[$key],
                            'vat_id'=>$request->vat_id[$key],
                            'credit'=>$subTotal
                            //not adding vat. only getting price but not getting subtotal for credit...store update invoice bill
                ]);

                $debit->save();

            }
        }
       return \Redirect::route('invoice', [$client_id]);

        
    }

    public function findPrice(/*$item_id*/Request $request)
    {


        $data= Item::find($request->id);

        return response()->json($data);
        //return Response::json($data);

    }
    
    public function destroy($id, $client_id)
    {
        //
        $invoice = Invoice::findOrFail($id);

        $invoice->balance = 0;

        $invoice->amount = 0;
        
        $invoice->update();

        $invoiceId = $invoice->id;

        InvoiceDetail::where('invoice_id', '=', $invoiceId)
        ->update(['price' => 0, 'total' => 0, 'vat_amount' => 0]);

        $journal = Journal::where('invoice_id', $invoiceId)->first();

        $journal->debit_total = 0;

        $journal->credit_total = 0;
        
        $journal->update();

        $journalId = $journal->id;

        JournalDetails::where('journal_id', '=', $journalId)
        ->update(['debit' => 0, 'credit' => 0, 'vat_amount' => 0]);

        Session::flash('deleted_invoice','The invoice has been voided');

        return \Redirect::route('invoice', [$client_id]);
    }
}
