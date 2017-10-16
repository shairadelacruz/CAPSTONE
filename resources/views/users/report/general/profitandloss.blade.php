@extends('layouts.admin')

@section('page_title')

Profit and Loss

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
                                Profit and Loss
                            </h2><br>
                             <div class="row clearfix js-sweetalert">
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                    
                                    <label>From</label>
                                   <input id="start" type="date" class="form-control date" name="to" id="to" value="{{request()->route('start')}}">
                                   <label>To</label>
                                    <input id="end" type="date" class="form-control date" name="from" id="from" value="{{request()->route('end')}}">
                                    <button class="btnPrint btn-success">Print</button>

                                    <input type="hidden" class="clientHidden" name='client_id' value="{{request()->route('client_id')}}" class="form-control">

                                </div>
                            </div>

                        </div>
                        
                        <div class="body table-responsive">
                            <h3>Revenue</h3>
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>Account</th>
                                        <th class="right-align-text">Balance</th>
                                        
                                    </tr>
                                </thead>
                                <tfoot>                         
                                    <tr>
                                        <th>Total</th>
                                        <th id="totR" class="right-align-text"></th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @if($coas)
                                    @foreach($coas->where('coacategory_id', 4) as $coa)
                                    <tr>
                                        <td>{{$coa->name}}</td>
                                        <td class="right-align-text balanceR">
                                        @if($details)
                                        @if($details->where("coa_id", $coa->id))
                                        @foreach($details as $key => $detail)
                                        @if($key == 0)
                                        {{$detail->where("coa_id", $coa->id)->sum('debit') - $detail->where("coa_id", $coa->id)->sum('credit')}}
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
                        
                        <div class="body table-responsive">
                            <h3>Cost of Goods Sold</h3>
                            <table id="trialBalanceTable" class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>Account</th>
                                        <th id="totR" class="right-align-text">Balance</th>
                                        
                                    </tr>
                                </thead>
                                <tfoot>                        
                                    <tr>
                                        <th>Total</th>
                                        <th id="totC" class="right-align-text"></th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @if($coas)
                                    @foreach($coas->where('coacategory_id', 2) as $coa)
                                    <tr>
                                        <td>{{$coa->name}}</td>
                                        <td class="right-align-text balanceC">
                                        @if($details)
                                        @if($details->where("coa_id", $coa->id))
                                        @foreach($details as $key => $detail)
                                        @if($key == 0)
                                        {{$detail->where("coa_id", $coa->id)->sum('debit') - $detail->where("coa_id", $coa->id)->sum('credit')}}
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
                        
                        <div class="body table-responsive">
                            <h3>Operating Expense</h3>
                            <table id="trialBalanceTable" class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>Account</th>
                                        <th class="right-align-text">Balance</th>
                                        
                                    </tr>
                                </thead>
                                <tfoot>                         
                                    <tr>
                                        <th>Total</th>
                                        <th id="totO" class="right-align-text"></th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @if($coas)
                                    @foreach($coas->where('coacategory_id', 3) as $coa)
                                    <tr>
                                        <td>{{$coa->name}}</td>
                                        <td class="right-align-text balanceO">
                                        @if($details)
                                        @if($details->where("coa_id", $coa->id))
                                        @foreach($details as $key => $detail)
                                        @if($key == 0)
                                        {{$detail->where("coa_id", $coa->id)->sum('debit') - $detail->where("coa_id", $coa->id)->sum('credit')}}
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

    $('.btnPrint').on('click', function() {

        var date=$('#date').val();

        window.location = date + '/generate';
    });


        $(document).ready(function(){
        var balR = 0;
        // iterate through each td based on class and add the values
        $(".balanceR").each(function() {

            var value = $(this).text();
            // add only if the value is number
            if(!isNaN(value) && value.length != 0)
            {
                 balR+= parseFloat(value);
            }
            else
            {
                balR+= parseFloat(0);
            }
            
        })
        $("#totR").html(balR.toFixed(2));

        var balC = 0;
        // iterate through each td based on class and add the values
        $(".balanceC").each(function() {

            var value = $(this).text();
            // add only if the value is number
            if(!isNaN(value) && value.length != 0)
            {
                 balC+= parseFloat(value);
            }
            else
            {
                balC+= parseFloat(0);
            }
            
        })
        $("#totC").html(balC.toFixed(2));

        var balO = 0;
        // iterate through each td based on class and add the values
        $(".balanceO").each(function() {

            var value = $(this).text();
            // add only if the value is number
            if(!isNaN(value) && value.length != 0)
            {
                 balO+= parseFloat(value);
            }
            else
            {
                balO+= parseFloat(0);
            }    
        })
        $("#totO").html(balO.toFixed(2));
    });

              
</script>
@endsection
    
@stop