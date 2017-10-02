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
                <input type="date" class="form-control" name='date' value="{{$journal->date->toDateString()}}" min="{{ \Carbon\Carbon::parse($client->closing->where('status', 0)->last()->created_at)->format('Y-m') }}-01">
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


<script type="text/javascript">
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
            '<td>'+
            '<input type="number" class="table-control right-align-text sumThis debit creddeb getrate" name="debit[]" value="0" >'+
            '</td>'+

            '<td>'+
            '<input type="number" class="table-control right-align-text sumThis1 credit creddeb getrate" name="credit[]" value="0" >'+
            '</td>'+
            '<td class="table-description">'+
            '<input type="text" class="table-control" name="descriptions[]">'+
            '</td>'+
            '<td class="table-vat_id">'+
            '<select class="table-control chosen-select vat_id getrate" name="vat_id[]" data-live-search="true">'+
            '<option value="0" selected="true" disabled="true"></option>'+
            '@if($vats)'+
            '@foreach($vats as $vat)'+
                '<option value="{{$vat->id}}">{{$vat->vat_code}} - <span class = "vat_rate" >{{ number_format($vat->rate, 0) }}</span>%</option>'+
            '@endforeach'+
            '@endif'+
            '</select>'+
            '</td>'+
            '<td>'+
            '<input type="number" class="table-control right-align-text vat_amount" value="0" name="vat_amount[]" readonly="true">'+
            '</td>'+
            '<td><span class="table-remove-btn" onclick="removeRow(this)">X</span></td>'+
            '</tr>' +


            '<tr>'+
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
            '<input type="number" class="table-control right-align-text sumThis debit creddeb getrate" name="debit[]" value="0" >'+
            '</td>'+

            '<td class="table-credit">'+
            '<input type="number" class="table-control right-align-text sumThis1 credit creddeb getrate" name="credit[]" value="0" >'+
            '</td>'+
            '<td class="table-description">'+
            '<input type="text" class="table-control" name="descriptions[]">'+
            '</td>'+
            '<td class="table-vat_id">'+
            '<select class="table-control chosen-select vat_id getrate" name="vat_id[]" data-live-search="true">'+
            '<option value="0" selected="true" disabled="true"></option>'+
            '@if($vats)'+
            '@foreach($vats as $vat)'+
                '<option value="{{$vat->id}}">{{$vat->vat_code}} - <span class = "vat_rate">{{ number_format($vat->rate, 0) }}</span>%</option>'+
            '@endforeach'+
            '@endif'+
            '</select>'+
            '</td>'+
            '<td>'+
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
//Disable Debit or Credit

$('tbody').delegate('.debit','change',function(){
    var tr = $(this).parent().parent();
    //tr.find('.qty').focus();
    var debit = tr.find('.debit').val();

    if(debit != 0)
    {
        var old = tr.find('.credit').val();
        var tot = $('#credittot').val();
        var sum = tot - old;
        $('#credittot').val(sum);
        tr.find('.credit').val(0);
        //tr.find('.credit').prop("disabled",true);
        

    }
    else if(debit == 0)
    {
        tr.find('.credit').prop("disabled",false);
    }
    
});

$('tbody').delegate('.credit','change',function(){
    var tr = $(this).parent().parent();
    //tr.find('.qty').focus();
    var credit = tr.find('.credit').val();
    if(credit != 0)
    {
        var old = tr.find('.debit').val();
        var tot = $('#debittot').val();
        var sum = tot - old;
        $('#debittot').val(sum);
        tr.find('.debit').val(0);
        //tr.find('.debit').prop("disabled",true);
        
    }
    else if(debit == 0)
    {
        tr.find('.debit').prop("disabled",false);
    }
    
});


//Total

var body= $('#journalTable').children('tbody').first();
var totals = $('#totals');
body.on('change', '.sumThis', function() {
  var total = 0;
  var columnIndex = $(this).closest('td').index();
  var rows = body.find('tr');
  $.each(rows, function() {
      var amount = $(this).children('td').eq(columnIndex).children('.sumThis').val();    
      total += new Number(amount);
  });
  //totals.children('td').eq(columnIndex).text(total);
   document.getElementById("debittot").value = total;

   var debittot = document.getElementById("debittot").value;
   var credittot = document.getElementById("credittot").value;

   var sum1 = Math.abs(debittot-credittot);
      //var firstEmptyCell = $('.credit:empty:eq(1)').val(sum1);
    
   
});

var body1= $('#journalTable').children('tbody').first();
var totals1 = $('#totals');

body1.on('change', '.sumThis1', function() {
  var total = 0;
  var columnIndex = $(this).closest('td').index();
  var rows = body1.find('tr');
  $.each(rows, function() {
      var amount = $(this).children('td').eq(columnIndex).children('.sumThis1').val();    
      total += new Number(amount);
  });
  //totals.children('td').eq(columnIndex).text(total);
   document.getElementById("credittot").value = total;

   var debittot = document.getElementById("debittot").value;
   var credittot = document.getElementById("credittot").value;

   var sum1 = Math.abs(debittot-credittot);
    //var firstEmptyCell = $('.debit:empty:eq(1)').val(sum1);

});


//VAT

$('tbody').delegate('.getrate','change',function(){

    var tr = $(this).parent().parent();
    var deb = tr.find('.debit').val();
    var cred = tr.find('.credit').val();

    var getrate = tr.find('.vat_id').find(":selected").text().slice(0, -1);
    var rates = getrate.split('-').splice(1);

    var rate = rates/100;

    if(deb != 0)
    {
        var amount = (rate*deb);
        tr.find('.vat_amount').val(amount);
    }
    else if (cred != 0){
        var amount = (rate*cred);
        tr.find('.vat_amount').val(amount);
    }
    else{
        //alert('No amount in either debit or credit');
        tr.find('.debit').focus();
    }

});

</script>
  
    
@stop