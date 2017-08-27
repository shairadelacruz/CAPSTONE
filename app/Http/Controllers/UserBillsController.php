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
        $bills = new Bill;
        $bills->client_id = $request->client_id;
        $bills->reference_no = $request->bill_no;
        $bills->vendor_id = $request->vendor_id;
        $bills->bill_date = $request->bill_date;
        $bills->due_date = $request->due_date;

        $id = $bills->save();

        var_dump($_POST);
        if($id != 0){
            foreach ($request->item_id as $key => $v)
            {
                $data = array('bill_id'=>$id,
                                'item_id'=>[$key],
                                'client_coa_id'=>$request->coa_id[$key],
                                'vat_id'=>$request->vat_id[$key],
                                'vat_amount'=>$request->vat_amount[$key],
                                'description'=>$request->description[$key],
                                'price'=>$request->price[$key],
                                'qty'=>$request->qty[$key]);
                BillDetail::insert($data);
            }
        }

        
    }

    /*public function print(Request $request)
    {
       dd ($request->all());

    }*/

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
