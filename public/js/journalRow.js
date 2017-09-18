//Para sa journal

$('.addRow').on('click', function(){
	addRow();
});

function addRow() {
	var tr = '<tr>'+
			'<td class="table-reference_no">'+
			'<select class="table-control" name="reference_no[]" data-live-search="true">'+
			'<option value="0" selected="true" disabled="true"></option>'+
			'@if($ref)'+
            '@foreach($refs as $ref)'+
                '<option value="{{$ref->id}}">{{$ref->name}}</option>'+
            '@endforeach'+
            '@endif'+
			'</select>'+
			'</td>'+
			'<td class="table-client_coa_id">'+
			'<select class="table-control" name="coa_cli_id[]" data-live-search="true">'+
			'<option value="0" selected="true" disabled="true"></option>'+
			'@if($coas)'+
            '@foreach($coas as $coa)'+
                '<option value="{{$coa->id}}">{{$coa->name}}</option>'+
            '@endforeach'+
            '@endif'+
			'</select>'+
			'</td>'+
            '<td class="table-debit">'+
            '<input type="number" class="table-control" name="debit[]">'+
            '</td>'+
            '<td class="table-credit">'+
            '<input type="number" class="table-control" name="credit[]">'+
            '</td>'+
            '<td class="table-description">'+
            '<input type="text" class="table-control" name="descriptions[]">'+
            '</td>'+
			'<td class="table-vat_id">'+
			'<select class="table-control" name="vat_id[]" data-live-search="true">'+
			'<option value="0" selected="true" disabled="true"></option>'+
			'@if($vats)'+
            '@foreach($vats as $vat)'+
                '<option value="{{$vat->id}}">{{$vat->vat_code}}</option>'+
            '@endforeach'+
            '@endif'+
			'</select>'+
			'</td>'+
            '<td class="table-vat_amount">'+
            '<input type="number" class="table-control" name="vat_amount[]" disabled="true">'+
            '</td>'+
            '<td><a href="#" class="btn btn-danger removeRow"><i class="glyphicon glyphicon-remove"></i></a></td>'+
			'</tr>';
	$('tbody').append(tr);
}

$('.removeRow').on('click', function(){
	var l=$('tbody tr').length;
	if(l==1){
		alert("Not applicable");
	}
	else{
		$(this).parent().parent().remove();
	}
});