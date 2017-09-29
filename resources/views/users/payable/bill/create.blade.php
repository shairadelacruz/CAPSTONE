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
            '<select class="table-control chosen-select productname" name="item_id[]">'+
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
            '<input type="number" class="qty" name="qty[]">'+
            '</td>'+
            '<td class="table-price">'+
            '<input type="number" class="price" name="price[]" step="0.01">'+
            '</td>'+

            '<td class="table-vat_id">'+
            '<select class="table-control chosen-select" name="vat_id[]">'+
                '<option value="0" selected="true" disabled="true">Choose</option>'+
                '@if($vats)@foreach($vats as $vat)'+
                '<option value="{{$vat->id}}">{{$vat->vat_code}}</option>'+
                '@endforeach @endif'+
            '</select>'+
            '</td>'+
            '<td class="table-vat_amount" >'+
            '<input type="number" name="vat_amount[]" step="0.01">'+
            '</td>'+
            '<td class="table-total">'+
            '<input type="number" value="" class="table-control" name="total[]" step="0.01">'+
            '</td>'+
            '<td><span class="table-remove-btn" onclick="removeRow(this)">X</span></td>'+
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
    var id = tr.find('.productname').val();
    alert(id);
    var client_id = $('.clientHidden').val();
    var dataId = {'id':id};
    $.ajax({
        type    : 'get',
        url     : '/user/'+client_id+'/payable/bill/create/findPrice/'+id,
        dataType: 'json',
        data    : {'id':id},
        success:function(data){
            $(".coaname").val(data.coa_id);
            tr.find('.description').val(data.description);
            tr.find('.price').val(data.price);
            
            //alert(data.price);
        }
    });
});
$('tbody').delegate('.productname','change',function(){
    var tr = $(this).parent().parent();
    tr.find('.qty').focus();
});
/*$(document).ready(function(){
    $('tbody').delegate('.productname','change',function(){
        var tr = $(this).parent().parent();
        var client_id = $('.clientHidden').val();
        var id = tr.find('.productname').val();
        alert(id);
        //var dataId = {'id':id};
        $.get('/user/'+client_id+'/payable/bill/create/findPrice/'+id, function(data){
            tr.find('.price').val(data.price);
            console.log(data);
        })
    });
});
    */



</script>
@endsection
@stop