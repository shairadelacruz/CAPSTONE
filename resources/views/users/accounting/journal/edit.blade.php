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
                    
                    <span class = "panel-title">Edit Journal</span>
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
                <input type="text" class="form-control" name='transaction_no' value="{{$journal->transaction_no}}">
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label>Date</label>
                <input type="date" class="form-control" name='date' value="{{$journal->date->toDateString()}}">
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label>Description</label>
                <textarea class="form-control" name='description'>{{$journal->description}}</textarea>
            </div>
        </div>

    </div>

</div>

    
    <div class="body table-responsive">
        <table id="journalTable" class="table table-bordered table-form">
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
                    <select class="table-control chosen-select" name="coa_cli_id[]">
                                <option value="{{$detail->coa->id}}" selected="true">{{$detail->coa->name}}</option>
                                @if($coas)
                                @foreach($coas as $coa)
                                <option value="{{$coa->id}}">{{$coa->name}}</option>
                                @endforeach
                                @endif
                    </select>
                        
                    </td>
                    <td class="table-debit">
                        <input type="number" class="table-control right-align-text sumThis" name="debit[]" value="{{$detail->debit}}" onchange="update_vats()">
                    </td>
                    <td class="table-credit">
                        <input type="number" class="table-control right-align-text sumThis1" name="credit[]" value="{{$detail->credit}}" onchange="update_vats()">
                    </td>
                    <td class="table-description">
                        <input type="text" class="table-control" name="descriptions[]" value="{{$detail->descriptions}}">
                    </td>
                    <td class="table-vat_id col-sm-2">
                        <select class="table-control chosen-select" name="vat_id[]">
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
                    <td class="table-vat_amount">
                        <input type="number" class="table-control right-align-text" name="vat_amount[]" value="{{$detail->vat_amount}}">
                    </td>
                    <!--<td class="table-vendor_id">
                        <input type="text" class="table-control" name="vendor_id[]">
                    </td>-->
                    <td class="table-remove">
                        <span class="table-remove-btn" onclick="removeRow(this)">X</span>
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
            <tfoot>
                <tr id="totals">
                    <td class="table-empty">
                        <span class="table-add_line" onclick="addRow()" >+ Add Line</span>
                    </td>
                    <td>Total</td>
                    <td class="table-debittot"><input id="debittot" type="number" class="table-control right-align-text" name="debittot" readonly="true" value="{{$journal->debit_total}}"></td>
                    <td class="table-credittot"><input id="credittot"t type="number" class="table-control right-align-text" name="credittot" readonly="true" value="{{$journal->credit_total}}"></td>
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


<script>
    function addRow() {
    var tr = '<tr>'+
            '<td class="table-reference_no">'+
            '<select class="table-control chosen-select" name="reference_no[]" data-live-search="true">'+
            '<option value="0" selected="true" disabled="true"></option>'+
            '@if($refs)'+
            '@foreach($refs as $ref)'+
            '<option value="{{$ref->id}}">{{$ref->reference_no}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>'+
            '@endforeach'+
            '@endif'+
            '</select>'+
            '</td>'+
            '<td class="table-client_coa_id">'+
            '<select class="table-control chosen-select" name="coa_cli_id[]" data-live-search="true">'+
            '<option value="0" selected="true"  disabled="true"></option>'+
            '@if($coas)'+
            '@foreach($coas as $coa)'+
                '<option value="{{$coa->id}}">{{$coa->name}}</option>'+
            '@endforeach'+
            '@endif'+
            '</select>'+
            '</td>'+
            '<td class="table-debit">'+
            '<input type="number" class="table-control right-align-text sumThis" name="debit[]" value="0" onchange="update_vats()">'+
            '</td>'+

            '<td class="table-credit">'+
            '<input type="number" class="table-control right-align-text sumThis1" name="credit[]" value="0" onchange="update_vats()">'+
            '</td>'+
            '<td class="table-description">'+
            '<input type="text" class="table-control" name="descriptions[]">'+
            '</td>'+
            '<td class="table-vat_id">'+
            '<select class="table-control chosen-select vat_id" name="vat_id[]" data-live-search="true">'+
            '<option value="0" selected="true" disabled="true"></option>'+
            '@if($vats)'+
            '@foreach($vats as $vat)'+
                '<option value="{{$vat->id}}">{{$vat->vat_code}} - <span class = "vat_rate" onchange="update_vats()">{{ number_format($vat->rate, 0) }}</span>%</option>'+
            '@endforeach'+
            '@endif'+
            '</select>'+
            '</td>'+
            '<td class="table-vat_amount">'+
            '<input type="number" class="table-control right-align-text vat_amount" value="0" name="vat_amount[]" readonly="true">'+
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
//Total

var body= $('#journalTable').children('tbody').first();
var totals = $('#totals');
body.on('change', '.sumThis', function() {
  alert('hi');
  var total = 0;
  var columnIndex = $(this).closest('td').index();
  var rows = body.find('tr');
  $.each(rows, function() {
      var amount = $(this).children('td').eq(columnIndex).children('.sumThis').val();    
      total += new Number(amount);
  });
  //totals.children('td').eq(columnIndex).text(total);
   document.getElementById("debittot").value = total;
  
});

var body1= $('#journalTable').children('tbody').first();
var totals1 = $('#totals');

body1.on('change', '.sumThis1', function() {
      alert('hi');
  var total = 0;
  var columnIndex = $(this).closest('td').index();
  var rows = body1.find('tr');
  $.each(rows, function() {
      var amount = $(this).children('td').eq(columnIndex).children('.sumThis1').val();    
      total += new Number(amount);
  });
  //totals.children('td').eq(columnIndex).text(total);
   document.getElementById("credittot").value = total;
  
});


//VAT


function update_vats()
{

    var sum = 0.0;
    $('#journalTable > tbody  > tr:not(:last)').each(function() {
        var debcred = parseFloat($(this).find('.sumThis').val() || 0,10);
        var vat = parseFloat($(this).find('.vat_rate').val() || 0,10);
        var rate = vat/100;
        var amount = (rate*debcred);
        sum+=amount;
        $(this).find('.vat_amount').val(''+amount);
    });

}


</script>    
    
@stop