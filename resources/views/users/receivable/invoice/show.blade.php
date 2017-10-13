<div class="row">

    <h1>Invoice</h1>      
    <h2> {{$client->company_name}} </h2>       

    <div class="col-sm-12">

        <div class="col-sm-4">
            <div class="form-group">
                <label>Transaction No: </label>{{$invoice->transaction_no}}
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label>Reference No: </label> 
                    @if($invoice->reference_no)
                    {{$invoice->logs->reference_no}}
                    @endif
            </div>
            <div class="form-group">
                <label>Customer</label>{{$invoice->customer->name}}
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label>Invoice Date: </label>{{$invoice->invoice_date->toDateString()}}
            </div>
            <div class="form-group">
                <label>Due Date</label>{{$invoice->due_date->toDateString()}}
            </div>
        </div>
                
    </div>

</div>
              
<div class="body table-responsive">
    <table id="datatable-fixed-header"  class="table table-bordered table-striped table-condensed table-hover table-responsive" align="center" style="width:100%">
        <thead>
            <tr>
                <th>Item</th>
                <th>Account</th>
                <th>Description</th>
                <th>Qty</th>
                <th>Price</th>
                <th>VAT Code</th>
                <th>VAT Amount</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @if($details)
            @foreach($details as $detail)
            <tr>
                <td>{{$detail->item->name}}</td>
                <td>{{$detail->coa->name}}</td>
                <td>{{$detail->descriptions}}</td>
                <td>{{$detail->qty}}</td>
                <td>{{$detail->price}}</td>
                <td>
                    @if(!empty($detail->vat->id))
                    {{$detail->vat->vat_code}}
                    @endif
                </td>
                <td>{{$detail->vat_amount}}</td>
                <td>{{$detail->total}}</td>
            </tr>
                                @endforeach
                                    @endif
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td></td>
                                    <td>Total</td>
                                    <td>{{$invoice->amount}}</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
            </div>