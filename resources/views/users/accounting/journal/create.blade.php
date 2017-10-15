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
            
                
                

        <input type="hidden" class="clientHidden" name='client_id' value="{{ $client_id }}">

        <div class="col-sm-3">
            <div class="form-group">
                <label>Transaction No.</label>
                @if($client_name = Auth::user()->clients->find(request()->route('client_id')))
                    
                <input type="text" class="form-control" name='transaction_no' value="{{Carbon\Carbon::today()->format('Y')}}-{{$client_name->code}}{{$client_name->id}}-{{$count}}-J" readonly="true">
                @endif
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <label>Date</label>
                <input type="date" class="form-control" name='date' value="{{\Carbon\Carbon::now()->format('Y-m-d')}}" min="{{ \Carbon\Carbon::parse($client->closing->where('status', 0)->last()->created_at)->format('Y-m') }}-01">
            </div>
        </div>
        <div class="col-sm-3">
            <div class="form-group">
                <label>Description</label>
                <textarea class="form-control" name='description'></textarea>
            </div>
        </div>
        <!--<div class="col-sm-3">
            <div class="form-group">
                <label>JV No.</label>
                <input type="number" name="">
            </div>
        </div>-->
        @if(Session::has('task'))
        <div class="col-sm-3">
            <div class="form-group">
                <label>Reference Documents</label><br>
                <a href="/user/tasks/{{ Session::get('task')->id }}" class="btn btn-primary"  target="_blank">View</a>
            </div>
        </div>
        @endif
    </div>

</div>

    
    <div class="body table-responsive">
        <table id="journalTable" class="table table-bordered">
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
                @if(Session::has('task'))
                     @foreach (Session::get('task')->log as $ref_nos)
                <tr>
                    <td>
                        <select class="chosen-select" name="reference_no[]">
                                <option value="{{$ref_nos->id}}" selected="true">{{$ref_nos->reference_no}}</option>
                                @if($refs)
                                @foreach($refs as $ref)
                                    <option value="{{$ref->id}}">{{$ref->reference_no}}</option>
                                @endforeach
                                @endif
                        </select>
                    </td>
                    <td class="table-client_coa_id">
                   <select class="table-control chosen-select coa_id" name="coa_cli_id[]" required="true">
                                <option value="0" selected="true">Please select an option</option>
                                @if($coas)
                                @foreach($coas as $coa)
                                    <option value="{{$coa->id}}">{{$coa->name}}</option>
                                @endforeach
                                @endif
                    </select>
                        
                    </td>
                    <td>
                        <input type="number" class="table-control right-align-text sumThis debit creddeb getrate" name="debit[]" value="0">
                    </td>
                    <td>
                        <input type="number" class="table-control right-align-text sumThis1 credit creddeb getrate" name="credit[]" value="0">
                    </td>
                    <td class="table-description">
                        <input class="description" type="text" class="table-control" name="descriptions[]">
                    </td>
                    <td class="table-vat_id">
                        <select class="table-control chosen-select vat_id getrate" name="vat_id[]">
                                    <option value="0" selected="true">Please select an option</option>
                                @if($vats)
                                @foreach($vats as $vat)
                                    <option value="{{$vat->id}}">{{$vat->vat_code}} - 
                                        <span class ="vat_rate">{{ number_format($vat->rate, 0) }}</span>
                                    </option>
                                @endforeach
                                @endif
                    </select>
                    </td>
                    <td>
                        <input type="number" class="table-control right-align-text vat_amount" name="vat_amount[]" value="0" readonly="true">
                    </td>

                    <td style="display:none;">
                        <input type="number" class="right-align-text debsub" value="0" readonly="true">
                    </td>
                    <td style="display:none;">
                        <input type="number" class="right-align-text credsub" value="0" readonly="true">
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
                                <option value="0" selected="true">Please select an option</option>
                                @if($refs)
                                @foreach($refs as $ref)
                                    <option value="{{$ref->id}}">{{$ref->reference_no}}</option>
                                @endforeach
                                @endif
                        </select>
                    </td>
                    <td class="table-client_coa_id">
                   <select class="table-control chosen-select coa_id" name="coa_cli_id[]">
                                    <option value="0" selected="true">Please select an option</option>
                                @if($coas)
                                @foreach($coas as $coa)
                                    <option value="{{$coa->id}}">{{$coa->name}}</option>
                                @endforeach
                                @endif
                    </select>
                        
                    </td>
                    <td>
                        <input type="number" class="table-control right-align-text sumThis debit creddeb getrate" name="debit[]" value="0">
                    </td>
                    <td>
                        <input type="number" class="table-control right-align-text sumThis1 credit creddeb getrate" name="credit[]" value="0">
                    </td>
                    <td class="table-description">
                        <input class="description" type="text" class="table-control" name="descriptions[]">
                    </td>
                    <td class="table-vat_id">
                        <select class="table-control chosen-select vat_id getrate" name="vat_id[]">
                                   <option value="0" selected="true">Please select an option</option>
                                @if($vats)
                                @foreach($vats as $vat)
                                    <option value="{{$vat->id}}">{{$vat->vat_code}} - <span class = "vat_rate">{{ number_format($vat->rate, 0) }}</span>%</option>
                                @endforeach
                                @endif
                    </select>
                    </td>
                    <td>
                        <input type="number" class="table-control right-align-text vat_amount" name="vat_amount[]" value="0" readonly="true">
                    </td>
                    <td style="display:none;">
                        <input type="number" class="right-align-text debsub" value="0" readonly="true">
                    </td>
                    <td style="display:none;">
                        <input type="number" class="right-align-text credsub" value="0" readonly="true">
                    </td>

                    <td class="table-remove">
                        <span onclick="removeRow(this)" class="table-remove-btn btn btn-default">X</span>
                    </td>
                </tr>


                <tr>
                    <td class="table-reference_no">
                        <select class="table-control chosen-select" name="reference_no[]" data-live-search="true">
                                    <option value="0" selected="true">Please select an option</option>
                                @if($refs)
                                @foreach($refs as $ref)
                                    <option value="{{$ref->id}}">{{$ref->reference_no}}</option>
                                @endforeach
                                @endif
                        </select>
                    </td>
                    <td class="table-client_coa_id">
                   <select class="table-control chosen-select coa_id" name="coa_cli_id[]">
                                    <option value="0" selected="true">Please select an option</option>
                                @if($coas)
                                @foreach($coas as $coa)
                                    <option value="{{$coa->id}}">{{$coa->name}}</option>
                                @endforeach
                                @endif
                    </select>
                        
                    </td>
                    <td>
                        <input type="number" class="table-control right-align-text sumThis debit creddeb getrate" name="debit[]" value="0">
                        
                    </td>
                    <td>
                        <input type="number" class="table-control right-align-text sumThis1 credit creddeb getrate" name="credit[]" value="0">
                        
                    </td>
                    <td>
                        <input class="description" style="word-wrap:break-word" type="text" name="descriptions[]">
                    </td>
                    <td>
                        <select class="chosen-select vat_id getrate" name="vat_id[]">
                                <option value="0" selected="true">Please select an option</option>
                                @if($vats)
                                @foreach($vats as $vat)
                                    <option value="{{$vat->id}}">{{$vat->vat_code}} - <span class = "vat_rate">{{ number_format($vat->rate, 0) }}</span>%</option>
                                @endforeach
                                @endif
                    </select>
                    </td>
                    <td>
                        <input type="number" class="right-align-text vat_amount" name="vat_amount[]" value="0" readonly="true">
                    </td>
                    <td style="display:none;">
                        <input type="number" class="right-align-text debsub" value="0" readonly="true">
                    </td>
                    <td style="display:none;">
                        <input type="number" class="right-align-text credsub" value="0" readonly="true">
                    </td>

                    <td class="table-remove">
                        <span onclick="removeRow(this)" class="table-remove-btn btn btn-default">X</span>
                    </td>
                </tr>
                    @endif
            </tbody>
            <tfoot>
                <tr id="totals">
                    <td>
                        <span onclick="addRow()" class="table-add_line btn btn-default">Add Line</span>
                    </td>
                    <td>Total</td>
                    
                    <td>
                        <input id="debittot" type="number" class="table-control right-align-text" name="debittot" readonly="true" value="0">
                        <span class="debDiff text-danger"></span>

                    </td>
                    <td>
                        <input id="credittot" type="number" class="table-control right-align-text" name="credittot" readonly="true" value="0">
                        <span class="credDiff text-danger"></span>
                    </td>

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

<script type="text/javascript">
        function addRow() {
    var tr = '<tr>'+
            '<td class="table-reference_no">'+
            '<select class="table-control chosen-select" name="reference_no[]" data-live-search="true">'+
            '<option value="0" selected="true">Select an option</option>'+
            '@if($refs)'+
            '@foreach($refs as $ref)'+
            '<option value="{{$ref->id}}">{{$ref->reference_no}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>'+
            '@endforeach'+
            '@endif'+
            '</select>'+
            '</td>'+
            '<td class="table-client_coa_id">'+
            '<select class="table-control chosen-select coa_id" name="coa_cli_id[]" data-live-search="true">'+
            '<option value="0" selected="true"  disabled="true">Select an option</option>'+
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
            '<input type="text" class="table-control description" name="descriptions[]">'+
            '</td>'+
            '<td class="table-vat_id">'+
            '<select class="table-control chosen-select vat_id getrate" name="vat_id[]" data-live-search="true">'+
            '<option value="0" selected="true">Select an option</option>'+
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
            '<td style="display:none;">'+
            '<input type="number" class="right-align-text debsub" value="0" readonly="true">'+
            '</td>'+
            '<td style="display:none;">'+
            '<input type="number" class="right-align-text credsub" value="0" readonly="true">'+
            '</td>'+
            '<td><span class="table-remove-btn btn btn-default" onclick="removeRow(this)">X</span></td>'+
            '</tr>' 

    $('tbody').append(tr);
    $(".chosen-select").chosen()
}

function removeRow(btn) {

            var row = btn.parentNode.parentNode;
            row.parentNode.removeChild(row);
}

$('tbody').delegate('.creddeb','change',function(){

    var tr = $(this).parent().parent();
    var lasttr = $('table tr:last-child');
    var id = tr.find('.coa_id').val();
    var debit = tr.find('.debit').val();
    var credit = tr.find('.credit').val();
    var client_id = $('.clientHidden').val();

    if(id != 0 && debit != 0)
    {

        $.ajax({
            type    : 'get',
            url     : '/user/'+client_id+'/accounting/journal/findDebit/'+id,
            dataType: 'json',
            data    : {'id':id},
            success:function(data){
                lasttr.find('.coa_id').val(data);
                lasttr.find('.chosen-select').trigger("chosen:updated");
      
            }
       
        });
    }
    else if(id != 0 && credit != 0)
    {
        $.ajax({
            type    : 'get',
            url     : '/user/'+client_id+'/accounting/journal/findCredit/'+id,
            dataType: 'json',
            data    : {'id':id},
            success:function(data){

                lasttr.find('.coa_id').val(data);
                lasttr.find('.chosen-select').trigger("chosen:updated");
      
            }
       
        });
    }

    else
    {

    }

           
});


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
        tr.find('.credsub').val(0);
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
        tr.find('.debsub').val(0);
        //tr.find('.debit').prop("disabled",true);
        
    }
    else if(debit == 0)
    {
        tr.find('.debit').prop("disabled",false);
    }
    
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
        tr.find('.vat_amount').val(amount.toFixed(2));

        var sub = parseInt(deb)+amount;
        tr.find('.debsub').val(sub);

    }
    else if (cred != 0){
        var amount = (rate*cred);
        tr.find('.vat_amount').val(amount.toFixed(2));

        var sub = parseInt(cred)+amount;
        tr.find('.credsub').val(sub);
    }
    else{
        //alert('No amount in either debit or credit');
        tr.find('.debit').focus();
    }

 // Total
    var debtotal = 0;
    var credtotal = 0;

    $('.debsub').each(function() {
        debtotal += Number($(this).val());
    });

    $('#debittot').val(debtotal.toFixed(2));

    $('.credsub').each(function() {
        credtotal += Number($(this).val());
    });
    
    $('#credittot').val(credtotal.toFixed(2));

    var lasttr = $('table tr:last-child');

//Balance
    
    if(debtotal > credtotal)
    {
        var sum1 = debtotal-credtotal;
         //$('.debDiff').hide();
        lasttr.find('.debit').val(0);
        lasttr.find('.credit').val(sum1.toFixed(2));
        lasttr.find('.debsub').val(0);
        lasttr.find('.credsub').val(sum1.toFixed(2));

    }
    else if(debtotal < credtotal)
    {
        var sum1 = credtotal - debtotal;
        //$('.credDiff').hide();
        lasttr.find('.credit').val(0);
        lasttr.find('.debit').val(sum1.toFixed(2));
        lasttr.find('.credsub').val(0);
        lasttr.find('.debsub').val(sum1.toFixed(2));
    }
    else
    {
        
    }

    debtotal = 0;
    credtotal = 0;

    $('.debsub').each(function() {
        debtotal += Number($(this).val());
    });

    $('#debittot').val(debtotal.toFixed(2));

    $('.credsub').each(function() {
        credtotal += Number($(this).val());
    });
    
    $('#credittot').val(credtotal.toFixed(2));

});



</script>



@endsection
	
@stop