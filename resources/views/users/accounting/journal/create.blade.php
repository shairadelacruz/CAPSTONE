@extends('layouts.admin')

@section('page_title')

Journal

@endsection

@extends('includes.table_includes');

@section('content')

    <div id="journal">

        <div class = "panel panel-default" v-clock>
            
            <div class = "panel-heading">

                <div class = "clearfix">
                    
                    <span class = "panel-title">Create Journal</span>
                    <a href="{{ route('journal', $client_id) }}" class="btn btn-default pull-right">Back</a>

                </div>    

            </div>

            <div class="panel-body">
                
                {!!Form::open(['route' => ['insertjournal', $client_id], 'id'=>'frmsave', 'method'=>'POST'])!!}
                
                    
<div class="row">

    <div class="col-sm-12">
               
                <ul>
                    @if(Session::has('ref_no'))
                     @foreach (Session::get('ref_no') as $ref_no)
                    <li>{{$ref_no}}</li>
                    @endforeach
                    @endif
                </ul>
                
                

        <input type="hidden" name='client_id' value="{{ $client_id }}" class="form-control">

        <div class="col-sm-3">
            <div class="form-group">
                <label>Transaction No.</label>
                <input type="text" class="form-control" name='transaction_no'>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <label>Date</label>
                <input type="date" class="form-control" name='date' value="{{\Carbon\Carbon::now()->format('Y-m-d')}}">
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <label>Description</label>
                <textarea class="form-control" name='description'></textarea>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <label>Reference Documents</label><br>
                <a href="#" class="btn btn-primary"  target="_blank">View</a>
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
                @if(Session::has('ref_no'))
                     @foreach (Session::get('ref_no') as $ref_no)
                <tr>
                    <td class="table-reference_no">
                        <select class="table-control chosen-select" name="reference_no[]" data-live-search="true">
                                <option value="0" selected="true" disabled="true">{{$ref_no}}</option>
                                @if($refs)
                                @foreach($refs as $ref)
                                    <option value="{{$ref->id}}">{{$ref->reference_no}}</option>
                                @endforeach
                                @endif
                        </select>
                    </td>
                    <td class="table-client_coa_id">
                   <select class="table-control chosen-select" name="coa_cli_id[]" data-live-search="true">
                                    <option value="0" selected="true" disabled="true"></option>
                                @if($coas)
                                @foreach($coas as $coa)
                                    <option value="{{$coa->id}}">{{$coa->name}}</option>
                                @endforeach
                                @endif
                    </select>
                        
                    </td>
                    <td class="table-debit">
                        <input type="number" class="table-control right-align-text sumThis" name="debit[]" value="0" onchange="update_vats()">
                    </td>
                    <td class="table-credit">
                        <input type="number" class="table-control right-align-text sumThis1" name="credit[]" value="0" onchange="update_vats()">
                    </td>
                    <td class="table-description">
                        <input type="text" class="table-control" name="descriptions[]">
                    </td>
                    <td class="table-vat_id">
                        <select class="table-control chosen-select vat_id" name="vat_id[]" onchange="update_vats()">
                                    <option value="0" selected="true" disabled="true"></option>
                                @if($vats)
                                @foreach($vats as $vat)
                                    <option value="{{$vat->id}}">{{$vat->vat_code}} - <span class = "vat_rate">{{ number_format($vat->rate, 0) }}</span>%</option>
                                @endforeach
                                @endif
                    </select>
                    </td>
                    <td class="table-vat_amount">
                        <input type="number" class="table-control right-align-text vat_amount" name="vat_amount[]" value="0" readonly="true">
                    </td>

                    <td class="table-remove">
                        <span onclick="removeRow(this)" class="table-remove-btn">X</span>
                    </td>
                </tr>
                @endforeach
                    @else
                    <tr>
                    <td class="table-reference_no">
                        <select class="table-control chosen-select" name="reference_no[]" data-live-search="true">
                                    <option value="0" selected="true" disabled="true"></option>
                                @if($refs)
                                @foreach($refs as $ref)
                                    <option value="{{$ref->id}}">{{$ref->reference_no}}</option>
                                @endforeach
                                @endif
                        </select>
                    </td>
                    <td class="table-client_coa_id">
                   <select class="table-control chosen-select" name="coa_cli_id[]" data-live-search="true">
                                    <option value="0" selected="true" disabled="true"></option>
                                @if($coas)
                                @foreach($coas as $coa)
                                    <option value="{{$coa->id}}">{{$coa->name}}</option>
                                @endforeach
                                @endif
                    </select>
                        
                    </td>
                    <td class="table-debit">
                        <input type="number" class="table-control right-align-text sumThis" name="debit[]" value="0" onchange="update_vats()">
                    </td>
                    <td class="table-credit">
                        <input type="number" class="table-control right-align-text sumThis1" name="credit[]" value="0" onchange="update_vats()">
                    </td>
                    <td class="table-description">
                        <input type="text" class="table-control" name="descriptions[]">
                    </td>
                    <td class="table-vat_id">
                        <select class="table-control chosen-select vat_id" name="vat_id[]" onchange="update_vats()">
                                    <option value="0" selected="true" disabled="true"></option>
                                @if($vats)
                                @foreach($vats as $vat)
                                    <option value="{{$vat->id}}">{{$vat->vat_code}} - <span class = "vat_rate">{{ number_format($vat->rate, 0) }}</span>%</option>
                                @endforeach
                                @endif
                    </select>
                    </td>
                    <td class="table-vat_amount">
                        <input type="number" class="table-control right-align-text vat_amount" name="vat_amount[]" value="0" readonly="true">
                    </td>

                    <td class="table-remove">
                        <span onclick="removeRow(this)" class="table-remove-btn">X</span>
                    </td>
                </tr>
                    @endif
            </tbody>
            <tfoot>
                <tr id="totals">
                    <td>
                        <span onclick="addRow()" class="table-add_line">+ Add Line</span>
                    </td>
                    <td>Total</td>
                    
                    <td><input id="debittot" type="number" class="table-control right-align-text" name="debittot" readonly="true" value="0"></td>
                    <td><input id="credittot" type="number" class="table-control right-align-text" name="credittot" readonly="true" value="0"></td>

                </tr>
            </tfoot>
        </table>
    </div>

            </div>

            <div class="panel-footer">


                
                <a href="{{ route('journal', $client_id) }}" class="btn btn-default">Cancel</a>
                
                <input type='submit' value='Create' class="btn btn-success">
                
                {!!Form::close()!!}
                @include('includes.form_error')

            </div>

        </div>
        
    </div>

        
@section('scripts')

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
    alert('hi');
            var row = btn.parentNode.parentNode;
            row.parentNode.removeChild(row);
}
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

@endsection
	
@stop