@extends('layouts.admin')

@section('page_title')

Invoice

@endsection

@extends('includes.form_includes');

@section('content')
    <div id="bill">

        <div class = "panel panel-default" v-clock>
            
            <div class = "panel-heading">

                <div class = "clearfix">
                    
                    <span class = "panel-title">Edit Invoice</span>
                    <a href="{{ route('invoice', $client_id) }}" class="btn btn-default pull-right">Back</a>

                </div>    

            </div>

            <div class="panel-body">
                
                {!! Form::model($invoice,['method'=>'PATCH','action'=>['UserInvoicesController@update',
                $client_id, $invoice->id]]) !!}

                            
                <div class="row">

                    <div class="col-sm-12">

                        <input type="hidden" class="clientHidden" name='client_id' value="{{ $client_id }}">

                        <input type="hidden" class="invoiceHidden" name='bill_id' value="{{ $invoice->id }}">

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Transaction No.</label>
                                @if($client_name = Auth::user()->clients->find(request()->route('client_id')))
                                <input type="text" class="form-control" name='transaction_no' value="{{$invoice->transaction_no}}" readonly="true">
                                @endif
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Reference No.</label>

                                <select class="chosen-select" name="reference_no">
                                @if($invoice->reference_no)
                                <option value="{{$invoice->reference_no}}" selected="true">{{$invoice->logs->reference_no}}</option>
                                @else
                                <option value="0" selected="true">Select an option</option>
                                @endif
                                
                                @if($refs)
                                @foreach($refs as $ref)
                                    <option value="{{$ref->id}}">{{$ref->reference_no}}</option>
                                @endforeach
                                @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Customer</label>
                                <select class="table-control chosen-select" name="customer_id">
                                    <option value="{{$invoice->customer->id}}" selected="true">{{$invoice->customer->name}}</option>
                                        @if($customers)
                                        @foreach($customers as $customer)
                                            <option value="{{$customer->id}}">{{$customer->name}}</option>
                                        @endforeach
                                        @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Invoice Date</label>
                                <input type="date" class="form-control" name='invoice_date' value="{{$invoice->invoice_date->toDateString()}}" min="{{ \Carbon\Carbon::parse($client->closing->where('status', 0)->last()->created_at)->format('Y-m') }}-01">
                            </div>
                            <div class="form-group">
                                <label>Due Date</label>
                                <input type="date" class="form-control" name='due_date'
                                value='{{$invoice->due_date->toDateString()}}' min="{{ \Carbon\Carbon::parse($client->closing->where('status', 0)->last()->created_at)->format('Y-m') }}-01">
                            </div>
                        </div>
                
                    </div>

                </div>
              
                    <div class="body table-responsive">
                        <table class="table table-bordered">
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
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="billTbody">
                                @if($details)
                                @foreach($details as $detail)
                                <tr>
                                    <td class="table-item_id">
                                    <select class="table-control chosen-select productname getrate" name="item_id[]">
                                          <option value="{{$detail->item->id}}" selected="true">{{$detail->item->name}}
                                        </option>      
                                                @if($items)
                                                @foreach($items as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                                @endif
                                    </select>
                                        
                                    </td>
                                    <td class="table-coa_id">
                                    <select class="table-control chosen-select coaname" name="coa_id[]">
                                                 <option value="{{$detail->coa->id}}" selected="true">{{$detail->coa->name}}</option>  
                                                @if($coas)
                                                @foreach($coas as $coa)
                                                    <option value="{{$coa->id}}">{{$coa->name}}</option>
                                                @endforeach
                                                @endif
                                    </select>
                                        
                                    </td>
                                    <td class="table-descriptions">
                                        <input type="text" class="description" name="descriptions[]" value='{{$detail->descriptions}}'>
                                    </td>
                                    <td class="table-qty">
                                        <input type="number" class="qty right-align-text getrate" value='{{$detail->qty}}' name="qty[]" >
                                    </td>
                                    <td class="table-price">
                                        <input type="number" class="price right-align-text getrate" value='{{$detail->price}}' name="price[]" step="0.01">
                                    </td>

                                    <td class="table-vat_id">
                                        <select class="vat_id table-control chosen-select getrate" name="vat_id[]">
                                                @if(!empty($detail->vat->id))
                                                <option value="{{$detail->vat->id}}" selected="true">{{$detail->vat->vat_code}}</option>
                                                @else
                                                <option value="0" selected="true" disabled="true"></option>
                                                @endif
                                                @if($vats)
                                                @foreach($vats as $vat)
                                                    <option value="{{$vat->id}}">{{$vat->vat_code}}</option>
                                                @endforeach
                                                @endif
                                        </select>
                                    </td>
                                    <td class="table-vat_amount" >
                                        <input type="number" name="vat_amount[]" value='{{$detail->vat_amount}}' class="right-align-text vat_amount" step="0.01">
                                    </td>
                                    <td class="table-total">
                                        <input type="number" value='{{$detail->total}}' class="subTotal right-align-text" name="total[]" step="0.01">
                                    </td>

                                    <td class="table-remove">
                                        <span onclick="removeRow(this)" class="table-remove-btn">X</span>
                                    </td>
                                </tr>
                                @endforeach
                                    @endif
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td class="table-empty">
                                        <span onclick="addRow()" class="table-add_line">+ Add Line</span>
                                    </td>
                                    <td>Total</td>
                                    <td class="table-grandTotal">
                                        <input type="number" value="{{$invoice->amount}}" class="table-control right-align-text grandTotal" name="grandTotal" step="0.01">
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

            </div>

            <div class="panel-footer">


                
                <a href="{{ route('invoice', $client_id) }}" class="btn btn-default">Cancel</a>
                
                <input type='submit' value='Edit' class="btn btn-success">
                
                {!!Form::close()!!}
                @include('includes.form_error')

            </div>

        </div>
        
    </div>


@section('scripts')
    
<script>
    function addRow() {
        var tr = '<tr>'+
            '<td class="table-item_id">'+
            '<select class="table-control chosen-select productname getrate" name="item_id[]">'+
            '<option value="0" selected="true" disabled="true">Choose</option>'+  '@if($items)@foreach($items as $item)'+
                    '<option value="{{$item->id}}">{{$item->name}}</option>'+
                    '@endforeach @endif'+
            '</select>'+
                                        
            '</td>'+
            '<td class="table-coa_id">'+
            '<select class="table-control chosen-select coaname" name="coa_id[]">'+
                '<option value="0" selected="true" disabled="true">Choose</option>'+
                    '@if($coas)@foreach($coas as $coa)'+
                        '<option value="{{$coa->id}}">{{$coa->name}}</option>'+
                    '@endforeach @endif'+
            '</select>'+                           
            '</td>'+
            '<td class="table-descriptions">'+
            '<input type="text" class="description" name="descriptions[]">'+
            '</td>'+
            '<td class="table-qty">'+
            '<input type="number" class="qty right-align-text getrate" name="qty[]" value="0">'+
            '</td>'+
            '<td class="table-price">'+
            '<input type="number" class="price right-align-text getrate" name="price[]" value="0" step="0.01">'+
            '</td>'+

            '<td class="table-vat_id">'+
            '<select class="vat_id table-control chosen-select getrate" name="vat_id[]">'+
                '<option value="0" selected="true" disabled="true">Choose</option>'+
                '@if($vats)@foreach($vats as $vat)'+
                '<option value="{{$vat->id}}">{{$vat->vat_code}} - <span class = "vat_rate">{{ number_format($vat->rate, 0) }}</span>%</option>'+
                '@endforeach @endif'+
            '</select>'+
            '</td>'+
            '<td class="table-vat_amount" >'+
            '<input type="number" name="vat_amount[]" value="0" class="right-align-text vat_amount" step="0.01">'+
            '</td>'+
            '<td class="table-total">'+
            '<input type="number" value="0" class="subTotal right-align-text" name="total[]" value="0" step="0.01">'+
            '</td>'+
            '<td><span class="table-remove-btn" onclick="removeRow(this)">X</span></td>'+
            '</tr>';

    $('#billTbody').append(tr);
    $(".chosen-select").chosen()
}

function removeRow(btn) {

        var row = btn.parentNode.parentNode;
        row.parentNode.removeChild(row);
}

$('tbody').delegate('.productname','change',function(){

    var tr = $(this).parent().parent();
    var newtr = tr.next('tr').parent().parent();
    newtr.find('.description').val();
    var id = tr.find('.productname').val();
    var client_id = $('.clientHidden').val();
    var invoice_id = $('.invoiceHidden').val();
    var dataId = {'id':id};
    $.ajax({
        type    : 'get',
        url     : '/user/'+client_id+'/receivable/invoice/'+invoice_id+'/edit/findPrice/'+id,
        dataType: 'json',
        data    : {'id':id},
        success:function(data){
            
            tr.find('.coaname').val(data.coa_id);
            tr.find('.description').val(data.description);
            tr.find('.price').val(data.price);
            tr.find('.vat_id').val(data.vat_id);
            tr.find('.qty').focus();
  
        }
       
    });
            tr.find('.chosen-select').trigger("chosen:updated");
            //tr.find('.chosen-select').trigger("liszt:updated");
           
});


//subTotals

$('tbody').delegate('.getrate','change',function(){
    var tr = $(this).parent().parent();
    var qty = tr.find('.qty').val();
    var price = tr.find('.price').val();
    var getrate = tr.find('.vat_id').find(":selected").text().slice(0, -1);
    var rates = getrate.split('-').splice(1);  
    var rate = rates/100;
    var subtotal = price * qty;
    var vat = subtotal * rate;
    tr.find('.vat_amount').val(vat.toFixed(2));
    var subtotalvat = subtotal + vat;
    tr.find('.subTotal').val(subtotalvat.toFixed(2));
    var total = 0;

    $('.subTotal').each(function() {
        total += Number($(this).val());
    });
    $('.grandTotal').val(total.toFixed(2));
});


</script>
 
@endsection
@stop