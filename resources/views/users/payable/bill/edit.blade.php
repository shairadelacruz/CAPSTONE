@extends('layouts.admin')

@section('page_title')

Bill

@endsection

@extends('includes.form_includes');

@section('content')
    <div id="bill">

        <div class = "panel panel-default" v-clock>
            
            <div class = "panel-heading">

                <div class = "clearfix">
                    
                    <span class = "panel-title">Edit Bill</span>
                    <a href="{{ route('bill', $client_id) }}" class="btn btn-default pull-right">Back</a>

                </div>    

            </div>

            <div class="panel-body">
                
                {!! Form::model($bill,['method'=>'PATCH','action'=>['UserBillsController@update',
                $client_id, $bill->id]]) !!}

                            
                <div class="row">

                    <div class="col-sm-12">

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Reference No.</label>
                                <input type="text" class="form-control" name='reference_no' value="{{$bill->reference_no}}">
                               
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Bill Date</label>
                                <input type="date" class="form-control" name='bill_date' value="{{$bill->bill_date->toDateString()}}" min="{{ \Carbon\Carbon::parse($client->closing->where('status', 0)->last()->created_at)->format('Y-m') }}-01">
                                
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Due Date</label>
                                <input type="date" class="form-control" name='due_date'
                                value='{{$bill->due_date->toDateString()}}' min="{{ \Carbon\Carbon::parse($client->closing->where('status', 0)->last()->created_at)->format('Y-m') }}-01">
                                
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Vendor</label>
                                <select class="table-control chosen-select" name="vendor_id">
                                    <option value="{{$bill->vendor->id}}" selected="true">{{$bill->vendor->name}}</option>
                                        @if($vendors)
                                        @foreach($vendors as $vendor)
                                            <option value="{{$vendor->id}}">{{$vendor->name}}</option>
                                        @endforeach
                                        @endif
                                </select>
                            </div>
                        </div>
                
                    </div>

                </div>
              
                    <div class="body table-responsive">
                        <table class="table table-bordered table-form">
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

                                    <td>
                                    <select class="chosen-select" name="item_id[]">
                                        <option value="{{$detail->item->id}}" selected="true">{{$detail->item->name}}
                                        </option>
                                                @if($items)
                                                @foreach($items as $item)
                                                <option value="{{$item->id}}">{{$item->name}}
                                                </option>
                                                @endforeach
                                                @endif
                                    </select>
                                        
                                    </td>
                                    <td class="table-coa_id">
                                    <select class="chosen-select" name="coa_id[]" v-model="detail.coa_id">
                                        <option value="{{$detail->coa->id}}" selected="true">{{$detail->coa->name}}</option>
                                        @if($coas)
                                        @foreach($coas as $coa)
                                        <option value="{{$coa->id}}">{{$coa->name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                        
                                    </td>
                                    
                                    <td>
                                        <input type="text" name="descriptions[]" value='{{$detail->descriptions}}'>
                                    </td>
                                    
                                    <td class="table-qty">
                                        <input type="number" class="table-control" v-model="detail.qty" name="qty[]" value='{{$detail->qty}}'>
                                    </td>
                                    <td>
                                        <input type="number" name="price[]" value='{{$detail->price}}' step="0.01">
                                    </td>

                                    <td>
                                        <select class="chosen-select" name="vat_id[]">
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
                                    <td>
                                        <input type="number" name="vat_amount[]" value='{{$detail->vat_amount}}' step="0.01">
                                    </td>
                                    <td>
                                        <input type="number" name="total[]" step="0.01" value='{{$detail->total}}' >
                                    </td>
                                    <td class="table-remove">
                                        <span onclick="removeRow(this)">X</span>
                                    </td>
                                </tr>
                                @endforeach
                                    @endif
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td class="table-empty">
                                        <span onclick="addRow()">+ Add Line</span>
                                    </td>
                                    <td>Total</td>
                                    <td class="table-grandTotal right-align-text"><input type="number" step="0.01" readonly="true" value="{{$bill->amount}}"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

            </div>

            <div class="panel-footer">


                
                <a href="{{ route('bill', $client_id) }}" class="btn btn-default">Cancel</a>
                
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
            '<select class="table-control chosen-select productname" name="item_id[]">'+
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
            '<input type="number" class="qty" name="qty[]">'+
            '</td>'+
            '<td class="table-price">'+
            '<input type="number" class="price" name="price[]" step="0.01">'+
            '</td>'+

            '<td class="table-vat_id">'+
            '<select class="table-control chosen-select" name="vat_id[]">'+
                '<option value="0" selected="true" disabled="true">Choose</option>'+
                '@if($vats)@foreach($vats as $vat)'+
                '<option value="{{$vat->id}}">{{$vat->vat_code}}</option>'+
                '@endforeach @endif'+
            '</select>'+
            '</td>'+
            '<td class="table-vat_amount" >'+
            '<input type="number" name="vat_amount[]" step="0.01">'+
            '</td>'+
            '<td class="table-total">'+
            '<input type="number" value="" class="table-control" name="total[]" step="0.01">'+
            '</td>'+
            '<td><span class="table-remove-btn" onclick="removeRow(this)">X</span></td>'+
            '</tr>';

    $('tbody').append(tr);
    $(".chosen-select").chosen()
}

function removeRow(btn) {

        var row = btn.parentNode.parentNode;
        row.parentNode.removeChild(row);
}

</script>
 
@endsection
@stop