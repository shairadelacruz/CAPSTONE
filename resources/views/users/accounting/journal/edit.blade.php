@extends('layouts.admin')

@section('page_title')

Journal

@endsection

@extends('includes.table_includes');

@section('content')

    <div id="journal">

        <div class = "panel panel-default">
            
            <div class = "panel-heading">

                <div class = "clearfix">
                    
                    <span class = "panel-title">Create Journal</span>
                    <a href="{{ route('journal', $client_id) }}" class="btn btn-default pull-right">Back</a>

                </div>    

            </div>

            <div class="panel-body">
                
                {!! Form::model($journal,['method'=>'PATCH','action'=>['UserJournalsController@update',
                $client_id, $journal->id]]) !!}
                
                    
<div class="row">

    <div class="col-sm-12">

        <div class="col-sm-4">
            <div class="form-group">
                <label>Transaction No.</label>
                <input type="text" class="form-control" v-model="form.transaction_no" name='transaction_no' value="{{$journal->transaction_no}}">
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label>Date</label>
                <input type="date" class="form-control" v-model="form.date" name='date' value="{{$journal->date->toDateString()}}">
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label>Description</label>
                <textarea class="form-control" v-model="form.description" name='description'>{{$journal->description}}</textarea>
            </div>
        </div>

    </div>

</div>

    
    <div class="body table-responsive">
        <table class="table table-bordered table-form">
            <thead>
                <tr>
                    <th>Reference No.</th>
                    <th>Account</th>
                    <th>Debit</th>
                    <th>Credit</th>
                    <th>Description</th>
                    <th>VAT Code</th>
                    <th>VAT Amount</th>
                    <!--<th>Person</th>-->
                </tr>
            </thead>
            <tbody>
                 @if($details)
                    @foreach($details as $detail)

                <tr>
                    <td class="table-reference_no">
                        <input id="reference_no" type="text" name="reference_no[]" class="table-control" value="{{$detail->reference_no}}">
                    </td>
                    <td class="table-client_coa_id">
                    <select class="table-control" name="coa_id[]">
                                <option value="{{$detail->coa->id}}" selected="true">{{$detail->coa->name}}</option>
                                @if($coas)
                                @foreach($coas as $coa)
                                <option value="{{$coa->id}}">{{$coa->name}}</option>
                                @endforeach
                                @endif
                    </select>
                        
                    </td>
                    <td class="table-debit">
                        <input type="number" class="table-control" name="debit[]" value="{{$detail->debit}}">
                    </td>
                    <td class="table-credit">
                        <input type="number" class="table-control" name="credit[]" value="{{$detail->credit}}">
                    </td>
                    <td class="table-description">
                        <input type="text" class="table-control" name="descriptions[]" value="{{$detail->descriptions}}">
                    </td>
                    <td class="table-vat_id">
                        <select class="table-control" name="vat_id[]">
                                    <option value="{{$detail->vat->id}}" selected="true">{{$detail->vat->vat_code}}</option>
                                @if($vats)
                                @foreach($vats as $vat)
                                    <option value="{{$vat->id}}">{{$vat->vat_code}}</option>
                                @endforeach
                                @endif
                    </select>
                    </td>
                    <td class="table-vat_amount">
                        <input type="number" class="table-control" name="vat_amount[]" value="{{$detail->vat_amount}}">
                    </td>
                    <!--<td class="table-vendor_id">
                        <input type="text" class="table-control" name="vendor_id[]">
                    </td>-->
                    <td class="table-remove">
                        <span class="table-remove-btn">X</span>
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
            <tfoot>
                <tr>
                    <td class="table-empty">
                        <span class="table-add_line">+ Add Line</span>
                    </td>
                    <td>Total</td>
                    <td class="table-debittot"><input type="number" class="table-control" name="debittot[]" readonly="true" value="{{$detail->debit_total}}"></td>
                    <td class="table-credittot"><input type="number" class="table-control" name="credittot[]" readonly="true" value="{{$detail->credit_total}}"></td>
                </tr>
            </tfoot>
        </table>
    </div>

            </div>

            <div class="panel-footer">

                
                <a href="{{ route('journal', $client_id) }}" class="btn btn-default">Cancel</a>
                
                <input type='submit' value='Edit' class="btn btn-success">
                
                {!!Form::close()!!}
                @include('includes.form_error')

            </div>

        </div>
        
    </div>

    
    
@stop