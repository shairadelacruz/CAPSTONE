@extends('layouts.admin')

@section('page_title')

Trial Balance

@endsection

@extends('includes.table_includes');


@section('content')

        <div class="container-fluid">
            
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Trial Balance
                            </h2><br>
                             <div class="row clearfix js-sweetalert">
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                    
                                    <label>From</label>
                                   <input class="date" type="date" class="datepicker form-control" name="to" id="to">
                                   <label>To</label>
                                    <input class="date" type="date" class="datepicker form-control" name="from" id="from">

                                    <input type="hidden" class="clientHidden" name='client_id' value="{{request()->route('client_id')}}" class="form-control">

                                </div>
                            </div>

                        </div>
                        <div class="body table-responsive">
                            <table id="trialBalanceTable" class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>Account</th>
                                        <th>Debit</th>
                                        <th>Credit</th>
                                        
                                    </tr>
                                </thead>
                                <tfoot>                         
                                    <tr id="totals">
                                        <th>Total</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                                <tbody id="reportTbody">
                                    @if($trials)
                                    @foreach($trials as $trial)
                                    <tr>
                                        <td>{{$trial->name}}</td>
                                        <td>{{$trial->journals_details->sum('debit')}}</td>
                                        <td>{{$trial->journals_details->sum('credit')}}</td>
                                    </tr>
                                   @endforeach
                                   @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
        </div>

@section('scripts')
<script type="text/javascript">
    var body= $('#trialBalanceTable').children('tbody').first();
    var totals = $('#totals');

    var total = 0;
    var columnIndex = $(this).closest('td').index();
    var rows = body.find('tr');
    $.each(rows, function() {
        var amount = $(this).children('td').eq(columnIndex).children('.sumThis').val();    
        total += new Number(amount);
    });
    totals.children('td').eq(columnIndex).text(total);


    $('.date').on('change', function() {
        var from = $('#from').val();
        var to = $('#to').val();
        var client_id = $('.clientHidden').val();
        $.ajax({
            type    : 'get',
            url     : '/user/'+client_id+'/reports/trialbalance/generate/',
            dataType: 'json',
            data    : {
                'from':from,
                'to':to,
                'client_id':client_id
                },
            success:function(data){
                $('td').remove();
                for(var ctr = 0; ctr < data.length; ctr++)
                {

                   $('#reportTbody').append()

                            
                                '<tr><td>'+ data[ctr].name +'</td><td>{{$trial->journals_details->sum("debit")}}</td><td>{{$trial->journals_details->sum("credit")}}</td></tr>'+
                            
                }
                
            }
           
        });
    });



              
</script>
@endsection
    
@stop