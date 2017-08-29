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
                
                {!! Form::model($bill,['method'=>'PATCH', 'action'=>['UserBillsController@update' ,$bill->id,
                $client_id]]) !!}

                            
                <div class="row">

                    <div class="col-sm-12">

                        <input type="hidden" name='client_id' value="{{ $client_id }}" class="form-control">

                        <input type="hidden" name='id' value="{{ $bill->id }}" class="form-control">

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Reference No.</label>
                                <input type="text" class="form-control" v-model="form.reference_no" name='reference_no' value="{{$bill->reference_no}}">
                               
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Bill Date</label>
                                <input type="date" class="form-control" v-model="form.bill_date" name='bill_date' value="{{$bill->bill_date->toDateString()}}">
                                
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Due Date</label>
                                <input type="date" class="form-control" v-model="form.due_date" name='due_date'
                                value='{{$bill->due_date->toDateString()}}'>
                                
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label>Vendor</label>
                                <select class="table-control" name="vendor_id" v-model="detail.vendor_id">
                                    <option value="{$vendor->id}}" selected="true" disabled="true">{{$bill->vendor->name}}</option>
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
                        <table class="table table-bordered table-form" width="100">
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
                                <tr v-for="detail in form.details">

                                    <td class="table-item_id">
                                    <select class="table-control" name="item_id[]" v-model="detail.item_id">
                                                    <option value="0" selected="true" disabled="true">{{$detail->item->name}}</option>
                                                @if($items)
                                                @foreach($items as $item)
                                                    <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                                @endif
                                    </select>
                                        
                                    </td>
                                    <td class="table-coa_id">
                                    <select class="table-control" name="coa_id[]" v-model="detail.coa_id">
                                        <option value="0" selected="true" disabled="true">{{$detail->coa->name}}</option>
                                        @if($coas)
                                        @foreach($coas as $coa)
                                        <option value="{{$coa->id}}">{{$coa->name}}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                        
                                    </td>
                                    
                                    <td class="table-descriptions">
                                        <input type="text" class="table-control" v-model="detail.descriptions" name="descriptions[]" value='{{$detail->descriptions}}'>
                                    </td>
                                    
                                    <td class="table-qty">
                                        <input type="number" class="table-control" v-model="detail.qty" name="qty[]" value='{{$detail->qty}}' step="0.01">
                                    </td>
                                    <td class="table-price">
                                        <input type="number" class="table-control" v-model="detail.price" name="price[]" value='{{$detail->price}}' step="0.01">
                                    </td>

                                    <td class="table-vat_id">
                                        <select class="table-control" name="vat_id[]" v-model="detail.vat_id">
                                                    <option value="0" selected="true" disabled="true">{{$detail->vat->vat_code}}</option>
                                                @if($vats)
                                                @foreach($vats as $vat)
                                                    <option value="{{$vat->id}}">{{$vat->vat_code}}</option>
                                                @endforeach
                                                @endif
                                    </select>
                                    </td>
                                    <td class="table-vat_amount">
                                        <input type="number" class="table-control" v-model="detail.vat_amount" name="vat_amount[]" value='{{$detail->vat_amount}}' step="0.01">
                                    </td>
                                    <td class="table-total">
                                        <input type="number" class="table-control" v-model="detail.total" name="total[]" step="0.01" value='{{$detail->total}}' >
                                    </td>
                                    <td class="table-remove">
                                        <span @click="remove(detail)" class="table-remove-btn">X</span>
                                    </td>
                                </tr>
                                @endforeach
                                    @endif
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td class="table-empty">
                                        <span @click="addLine" class="table-add_line">+ Add Line</span>
                                    </td>
                                    <td>Total</td>
                                    <td class="table-grandTotal"><input type="number" value="@{{ grandTotal }}" class="table-control" v-model="detail.grandTotal" name="grandTotal" step="0.01" readonly="true"></td>
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
    

 
@endsection
@stop