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
                                    
                                    <label>Date</label>
                                    <input type="date" class="form-control date" name="date" id="date"
                                    value="{{request()->route('end')}}">
                                    <button class="btnPrint btn-success">Print</button>

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
                                        <th>{{$details->sum('debit')}}</th>
                                        <th>{{$details->sum('credit')}}</th>
                                    </tr>
                                </tfoot>
                                <tbody id="reportTbody">
                                    @if($coas)
                                    @foreach($coas as $coa)
                                    <tr>
                                        <td class="coa">{{$coa->name}}</td>
                                        <td class="deb">
                                        @if($details)
                                        @if($details->where("coa_id", $coa->id))
                                        @foreach($details as $key => $detail)
                                        @if($key == 0)
                                        {{$detail->where("coa_id", $coa->id)->sum('debit')}}
                                        @endif
                                        @endforeach
                                        @endif
                                        @endif
                                        </td>
                                        <td class="cred">
                                        @if($details)
                                        @if($details->where("coa_id", $coa->id))
                                        @foreach($details as $key => $detail)
                                        @if($key == 0)
                                        {{$detail->where("coa_id", $coa->id)->sum('credit')}}
                                        @endif
                                        @endforeach
                                        @endif
                                        @endif
                                        </td>
                                       
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


    $('#date').on('change', function() {

        var date=$('#date').val();

        window.location = date;
    });

   /* var body= $('#trialBalanceTable').children('tbody').first();
    var totals = $('#totals');

    var total = 0;
    var columnIndex = $(this).closest('td').index();
    var rows = body.find('tr');
    $.each(rows, function() {
        var amount = $(this).children('td').eq(columnIndex).children('.sumThis').val();    
        total += new Number(amount);
    });
    totals.children('td').eq(columnIndex).text(total);


    $('.btnGenerate').on('click', function() {
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

                console.log(data);
                $('td').not('.coa').remove();
                for(var ctr = 0; ctr < data.length; ctr++)
                {

                   $('#reportTbody').append('<tr><td>'+ data[ctr].name +'</td><td></td><td></td></tr>'+)             
                            
                }
                
            }
           
        });
    });

*/

              
</script>
@endsection
    
@stop