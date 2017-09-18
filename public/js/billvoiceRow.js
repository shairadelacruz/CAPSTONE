//Para ito sa bill at invoice

$('.addRow').on('click', function(){
	addRow();
});

function addRow() {
	var tr = '<tr>'+
			'<td class="table-item_id">'+
			'<select class="table-control" name="item_id[]" data-live-search="true">'+
			'<option value="0" selected="true" disabled="true"></option>'+
			'@if($items)'+
            '@foreach($items as $item)'+
                '<option value="{{$item->id}}">{{$item->name}}</option>'+
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
            '<td class="table-description">'+
            '<input type="text" class="table-control" name="descriptions[]">'+
            '</td>'+
            '<td class="table-qty">'+
            '<input type="number" class="table-control" name="qty[]">'+
            '</td>'+
            '<td class="table-price">'+
            '<input type="number" class="table-control" name="price[]">'+
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
            '<input type="number" class="table-control" name="vat_amount[]">'+
            '</td>'+
            '<td class="table-total">'+
            '<input type="number" value="@{{ detail.qty * detail.price +detail.vat_amount/100 * detail.qty * detail.price }}" class="table-control" name="total[]">'+
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