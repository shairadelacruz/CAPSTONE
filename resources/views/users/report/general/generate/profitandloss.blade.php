<!DOCTYPE html>
<html>
<head>
    <title></title>
    <style type="text/css">

        table, td, th {
            border: 1px solid black;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            text-align: left;
            padding: 8px;
            font-style: Sans Serif
        }
        
        th {
            background-color: #f2f2f2;
            color: black;
        }

        tr:nth-child(even){background-color: #f2f2f2}
    </style>
</head>
<body>
        <div class="container-fluid">
            
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <center><div class="header">
                            <h2>
                                Profit and Loss
                            </h2><br>
                             <div class="row clearfix js-sweetalert">
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                    
                                    <label>From: </label>
                                   {{request()->route('start')}}
                                   <label>To: </label>
                                    {{request()->route('end')}}

                                </div>
                            </div>

                        </div></center>
                        
                        <div class="body table-responsive">
                            <h3>Revenue</h3>
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>Account</th>
                                        <th class="right-align-text">Balance</th>
                                        
                                    </tr>
                                </thead>
                                
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
                                        {{$detail->where("coa_id", $coa->id)->sum('debit') - $detail->where("coa_id", $coa->id)->sum('credit') * -1}}
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
                                        <th>Gross Profit</th>
                                        <th id="totR" class="right-align-text"></th>
                                    </tr>
                                </tfoot>
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
                                
                                <tbody>
                                    @if($coas)
                                    @foreach($coas->where('coacategory_id', 6) as $coa)
                                    <tr>
                                        <td>{{$coa->name}}</td>
                                        <td class="right-align-text balanceC">
                                        @if($details)
                                        @if($details->where("coa_id", $coa->id))
                                        @foreach($details as $key => $detail)
                                        @if($key == 0)
                                        {{$detail->where("coa_id", $coa->id)->sum('debit') - $detail->where("coa_id", $coa->id)->sum('credit') * -1}}
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
                                        <th id="totC" class="right-align-text"></th>
                                    </tr>
                                </tfoot>
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
                                        {{$detail->where("coa_id", $coa->id)->sum('debit') - $detail->where("coa_id", $coa->id)->sum('credit') * -1}}
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
                                        <th id="totO" class="right-align-text"></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
        </div>

</body>
</html>