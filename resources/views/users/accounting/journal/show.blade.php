
                    
<div class="row">

    <h1>Journal</h1>      
    <h2> {{$client->company_name}} </h2>       
    <h3>{{$journal->date->toDateString()}}</h3>

    <div class="col-sm-12">

        <div class="col-sm-3">
            <div class="form-group">
                
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <label>Transaction No:</label>
                {{$journal->transaction_no}}
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <label>Description:</label>
                {{$journal->description}}
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                
            </div>
        </div>

    </div>
</div>

    

    
<div class="body table-responsive">
    <table id="datatable-fixed-header"  class="table table-bordered table-striped table-condensed table-hover table-responsive" align="center" style="width:100%">
        <thead>
            <tr>
                <th>Reference No.</th>
                <th>Account</th>
                <th>Debit</th>
                <th>Credit</th>
                <th>Description</th>
                <th>VAT Code</th>
                <th>VAT Amount</th>
            </tr>
        </thead>
        <tbody>
                @if($details)
                @foreach($details as $detail)

            <tr>
                <td>
                    @if($detail->reference_no)
                    {{$detail->log->reference_no}}
                    @endif
                </td>
                <td>{{$detail->coa->id}}</td>
                <td>{{$detail->debit or 0}}</td>
                <td>{{$detail->credit or 0}}</td>
                <td>{{$detail->descriptions}}</td>
                <td>
                    @if(!empty($detail->vat->id))
                    {{$detail->vat->vat_code}}
                        @endif
                </td>
                <td>{{$detail->vat_amount}}</td>
                    
            </tr>
            @endforeach
            @endif
        </tbody>
        <tfoot>
            <tr>
                <td></td>
                <td>Total</td>
                <td>{{$journal->debit_total}}</td>
                <td>{{$journal->credit_total}}</td>
            </tr>
        </tfoot>
    </table>
</div>
