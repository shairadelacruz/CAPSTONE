@extends('layouts.admin')

@section('page_title')

Bill

@endsection

@extends('includes.form_includes');

@section('content')
    <div id="bill">

        <div class = "panel panel-default">
            
            <div class = "panel-heading">

                <div class = "clearfix">
                    
                    <!-- Nav tabs -->
                     <ul class="nav nav-tabs tab-nav-right" role="tablist">
                        <li role="presentation" class="active"><a href="#billTab" data-toggle="tab">Bill</a></li>
                        <li role="presentation"><a href="#cbTab" data-toggle="tab">Cash Disbursement</a></li>
                        <a href="{{ route('bill', $client_id) }}" class="btn btn-default pull-right">Back</a>
                    </ul>           
                </div>    
            </div>
            <div class="panel-body">         
                <div class="body">
                            <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade in active" id="billTab">
                            @include ("users.payable.bill.billCreate")

                            <a href="{{ route('bill', $client_id) }}" class="btn btn-default">Cancel</a>
                
                            <input type='submit' value='Create' class="btn btn-success">
                
                            {!!Form::close()!!}
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="cbTab">
                            @include ("users.payable.bill.cbCreate")

                            <a href="{{ route('bill', $client_id) }}" class="btn btn-default">Cancel</a>
                
                            <input type='submit' value='Create' class="btn btn-success">
                
                            {!!Form::close()!!}
                                
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel-footer">

                @include('includes.form_error')

            </div>

        </div>
        
    </div>

                        


@section('scripts')

 <script>
    function addRow() {
    
    var tr = '<tr>'+
            '<td class="table-item_id">'+
            '<select class="table-control chosen-select productname getrate" name="item_id[]">'+
            '<option value="0" selected="true" disabled="true">Choose</option>'+  '@if($items)@foreach($items as $item)'+
                    '<option value="{{$item->id}}">{{$item->name}}</option>'+
                    '@endforeach @endif'+
            '</select>'+
                                        
            '</td>'+
            '<td class="table-coa_id">'+
            '<select class="table-control chosen-select coaname" name="coa_id[]">'+
                '<option value="0" selected="true" disabled="true">Choose</option>'+
                    '@if($coas)@foreach($coas as $coa)'+
                        '<option value="{{$coa->id}}">{{$coa->name}}</option>'+
                    '@endforeach @endif'+
            '</select>'+                           
            '</td>'+
            '<td class="table-descriptions">'+
            '<input type="text" class="description" name="descriptions[]">'+
            '</td>'+
            '<td class="table-qty">'+
            '<input type="number" class="qty right-align-text getrate" name="qty[]" value="0">'+
            '</td>'+
            '<td class="table-price">'+
            '<input type="number" class="price right-align-text getrate" name="price[]" value="0" step="0.01">'+
            '</td>'+

            '<td class="table-vat_id">'+
            '<select class="vat_id table-control chosen-select getrate" name="vat_id[]">'+
                '<option value="0" selected="true" disabled="true">Choose</option>'+
                '@if($vats)@foreach($vats as $vat)'+
                '<option value="{{$vat->id}}">{{$vat->vat_code}} - <span class = "vat_rate">{{ number_format($vat->rate, 0) }}</span>%</option>'+
                '@endforeach @endif'+
            '</select>'+
            '</td>'+
            '<td class="table-vat_amount" >'+
            '<input type="number" name="vat_amount[]" value="0" class="right-align-text vat_amount" step="0.01">'+
            '</td>'+
            '<td class="table-total">'+
            '<input type="number" value="0" class="subTotal right-align-text" name="total[]" value="0" step="0.01">'+
            '</td>'+
            '<td><span class="table-remove-btn btn btn-default" onclick="removeRow(this)">X</span></td>'+
            '</tr>';

    $('#billTbody').append(tr);
    $(".chosen-select").chosen()


}

function removeRow(btn) {

        var row = btn.parentNode.parentNode;
        row.parentNode.removeChild(row);
}


$('tbody').delegate('.productname','change',function(){

    var tr = $(this).parent().parent();
    var newtr = tr.next('tr').parent().parent();
    newtr.find('.description').val();
    var id = tr.find('.productname').val();
    var client_id = $('.clientHidden').val();
    var dataId = {'id':id};
    $.ajax({
        type    : 'get',
        url     : '/user/'+client_id+'/payable/bill/create/findPrice/'+id,
        dataType: 'json',
        data    : {'id':id},
        success:function(data){
            
            tr.find('.coaname').val(data.coa_id);
            tr.find('.description').val(data.description);
            tr.find('.price').val(data.price);
            tr.find('.vat_id').val(data.vat_id);
            tr.find('.qty').focus();
            tr.find('.chosen-select').trigger("chosen:updated");
  
        }
       
    });
            
            //tr.find('.chosen-select').trigger("liszt:updated");
           
});


//subTotals

$('tbody').delegate('.getrate','change',function(){
    var tr = $(this).parent().parent();
    var qty = tr.find('.qty').val();
    var price = tr.find('.price').val();
    var getrate = tr.find('.vat_id').find(":selected").text().slice(0, -1);
    var rates = getrate.split('-').splice(1);  
    var rate = rates/100;
    var subtotal = price * qty;
    var vat = subtotal * rate;
    tr.find('.vat_amount').val(vat.toFixed(2));
    var subtotalvat = subtotal + vat;
    tr.find('.subTotal').val(subtotalvat.toFixed(2));
    var total = 0;

    $('.subTotal').each(function() {
        total += Number($(this).val());
    });
    $('.grandTotal').val(total.toFixed(2));
});



//CB Add row

function addRowCb() {
    var tr = '<tr>'+
                '<td class="table-reference_no">'+
                '<input type="reference_no" class="table-control" name="reference_no[]">'+   
                '</td>'+
                                    
                '<td class="table-bill_date">'+
                '<input type="date" class="table-control" name="bill_date[]">'+
                '</td>'+
                '<td class="table-vendor">'+
                '<select class="table-control chosen-select" name="vendor_id[]">'+
                '<option value="0" selected="true" disabled="true"></option>'+
                '@if($vendors)'+
                '@foreach($vendors as $vendor)'+
                '<option value="{{$vendor->id}}">{{$vendor->name}}</option>'+
                '@endforeach'+
                '@endif'+
                '</select>'+
                '</td>'+
                '<td class="table-coa_id">'+
                '<select class="table-control chosen-select" name="coa_id[]">'+
                '<option value="0" selected="true" disabled="true">Choose</option>'+
                '@if($coas)'+
                '@foreach($coas as $coa)'+
                '<option value="{{$coa->id}}">{{$coa->name}}</option>'+
                '@endforeach'+
                '@endif'+
                '</select>'+
                                        
                '</td>'+
                '<td class="table-amount">'+
                '<input type="number" class="table-control" name="amount[]" step="0.01">'+
                '</td>'+

                '<td class="table-vat_id">'+
                '<select class="table-control chosen-select" name="vat_id[]">'+
                '<option value="0" selected="true" disabled="true">Choose</option>'+
                '@if($vats)'+
                '@foreach($vats as $vat)'+
                '<option value="{{$vat->id}}">{{$vat->vat_code}}</option>'+
                '@endforeach'+
                '@endif'+
                '</select>'+
                '</td>'+
                '<td class="table-vat_amount">'+
                '<input type="number" class="table-control" name="vat_amount[]" step="0.01">'+
                '</td>'+
                '<td class="table-remove">'+
                '<input type="hidden" name="client_id[]" value="{{ $client_id }}" class="form-control">'+
                '<span onclick="removeRow(this)" class="table-remove-btn btn btn-default">X</span>'+
                '</td>'+
                '</tr>';

    $('#cbTbody').append(tr);
    $(".chosen-select").chosen()
}




</script>
@endsection
@stop