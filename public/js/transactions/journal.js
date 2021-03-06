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


/*function update_vats()
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

}*/