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
        $vats = Vat::all();
        return view('users.receivable.invoice.create', compact('client_id', 'client', 'items', 'coas', 'vats', 'customers'));
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
        $invoices->client_id = $request->client_id;
        $invoices->reference_no = $request->reference_no;
        $invoices->invoice_date = $request->invoice_date;
        $invoices->due_date = $request->due_date;
        $invoices->customer_id = $request->customer_id;
        $invoices->amount = $request->grandTotal;

        $id = $invoices->save();

        $invoiceLast = Invoice::all()->last();
        $invoiceId = $invoiceLast->id;


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

            }
        }
        $client_id = $request->client_id;
        return \Redirect::route('invoice', [$client_id]);
        
    }

    public function pay(Request $request)
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
        //
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
        $invoice = Invoice::findOrFail($id);

        $invoice->delete();

        Session::flash('deleted_invoice','The invoice has been deleted');

        return \Redirect::route('invoice', [$client_id]);
    }
}
