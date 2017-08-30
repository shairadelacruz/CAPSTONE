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

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Reference No.</label>
                                <input type="text" class="form-control" name='reference_no' value="{{$invoice->reference_no}}">
                               
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Bill Date</label>
                                <input type="date" class="form-control" name='invoice_date' value="{{$invoice->invoice_date->toDateString()}}">
                                
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Due Date</label>
                                <input type="date" class="form-control" name='due_date'
                                value='{{$invoice->due_date->toDateString()}}'>
                                
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Customer</label>
                                <select class="table-control" name="customer_id">
                                    <option value="{{$invoice->customer->id}}" selected="true">{{$invoice->customer->name}}</option>
                                        @if($customers)
                                        @foreach($customers as $customer)
                                            <option value="{{$customer->id}}">{{$customer->name}}</option>
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
                                    <select name="item_id[]">
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
                                    <select name="coa_id[]" v-model="detail.coa_id">
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
                                        <input type="number" class="table-control" v-model="detail.qty" name="qty[]" value='{{$detail->qty}}' step="0.01">
                                    </td>
                                    <td>
                                        <input type="number" name="price[]" value='{{$detail->price}}' step="0.01">
                                    </td>

                                    <td>
                                        <select name="vat_id[]">
                                                    <option value="{{$detail->vat->id}}" selected="true">{{$detail->vat->vat_code}}</option>
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
                                        <span>X</span>
                                    </td>
                                </tr>
                                @endforeach
                                    @endif
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td class="table-empty">
                                        <span>+ Add Line</span>
                                    </td>
                                    <td>Total</td>
                                    <td class="table-grandTotal"><input type="number" step="0.01" readonly="true" value="{{$invoice->amount}}"></td>
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
    

 
@endsection
@stop