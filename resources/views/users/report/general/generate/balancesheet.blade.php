

        <div class="container-fluid">
            
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Balance Sheet
                            </h2><br>
                             <div class="row clearfix js-sweetalert">
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                    
                                    <label>Date: </label>{{request()->route('end')}}

                                </div>
                            </div>

                        </div>
                        
                        <div class="body table-responsive">
                            <h3>Assets</h3>
                            <table id="trialBalanceTable" class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>Account</th>
                                        <th class="right-align-text">Balance</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($coas)
                                    @foreach($coas->where('coacategory_id', 1) as $coa)
                                    <tr>
                                        <td>{{$coa->name}}</td>
                                        <td class="right-align-text">
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
                                <tfoot>                         
                                    <tr>
                                        <th>Total</th>
                                        <th id="totA" class="right-align-text"></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        
                        <div class="body table-responsive">
                            <h3>Liabilities</h3>
                            <table id="trialBalanceTable" class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>Account</th>
                                        <th class="right-align-text">Balance</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($coas)
                                    @foreach($coas->where('coacategory_id', 2) as $coa)
                                    <tr>
                                        <td>{{$coa->name}}</td>
                                        <td class="right-align-text">
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
                                <tfoot>                        
                                    <tr>
                                        <th>Total</th>
                                        <th id="totL" class="right-align-text"></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        
                        <div class="body table-responsive">
                            <h3>Equity</h3>
                            <table id="trialBalanceTable" class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>Account</th>
                                        <th class="right-align-text">Balance</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($coas)
                                    @foreach($coas->where('coacategory_id', 5) as $coa)
                                    <tr>
                                        <td>{{$coa->name}}</td>
                                        <td class="right-align-text">
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
                                <tfoot>                         
                                    <tr>
                                        <th>Total</th>
                                        <th id="totE" class="right-align-text"></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
        </div>
@section('scripts')
<script src="{{asset('plugins/jquery/jquery.min.js') }} "></script>
<script type="text/javascript">
    $(document).ready(function(){
        var balA = 0;
        // iterate through each td based on class and add the values
        $(".balanceA").each(function() {

            var value = $(this).text();
            // add only if the value is number
            if(!isNaN(value) && value.length != 0)
            {
                 balA+= parseFloat(value);
            }
            else
            {
                balA+= parseFloat(0);
            }
            
        })
        $("#totA").html(balA.toFixed(2));

        var balL = 0;
        // iterate through each td based on class and add the values
        $(".balanceL").each(function() {

            var value = $(this).text();
            // add only if the value is number
            if(!isNaN(value) && value.length != 0)
            {
                 balL+= parseFloat(value);
            }
            else
            {
                balL+= parseFloat(0);
            }
            
        })
        $("#totL").html(balL.toFixed(2));

        var balE = 0;
        // iterate through each td based on class and add the values
        $(".balanceE").each(function() {

            var value = $(this).text();
            // add only if the value is number
            if(!isNaN(value) && value.length != 0)
            {
                 balE+= parseFloat(value);
            }
            else
            {
                balE+= parseFloat(0);
            }    
        })
        $("#totE").html(balE.toFixed(2));
    });

              
</script>
@endsection