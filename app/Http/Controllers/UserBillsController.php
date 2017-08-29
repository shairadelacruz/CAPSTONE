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

        $id = $bills->save();

        $billLast = Bill::all()->last();
        $billId = $billLast->id;


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

            }
        }
        $client_id = $request->client_id;
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
        $vendors = $client->vendors;
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
