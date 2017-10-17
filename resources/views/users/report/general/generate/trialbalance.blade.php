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
                                    
                                    <label>Date: </label>
                                    {{request()->route('end')}}

                                </div>
                            </div>

                        </div>
                        <div class="body table-responsive">
                            <table id="sum_table" class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>Account</th>
                                        <th>Debit</th>
                                        <th>Credit</th>
                                        
                                    </tr>
                                </thead>
                                
                                <tbody id="reportTbody">
                                    @if($coas)
                                    @foreach($coas as $coa)
                                    <tr>
                                        <td class="coa">{{$coa->name}}</td>
                                        <td class="deb  right-align-text">

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
                                        <td class="cred  right-align-text">
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
                                   <tr>
                                        <td>Value Added Tax</td>
                                        <td class="right-align-text">{{$vatDeb}}</td>
                                        <td class="right-align-text">{{$vatCred}}</td>
                                    </tr>
                                </tbody>
                                <tfoot>                         
                                    <tr id="totals">
                                        <th>Total</th>
                                        <th class="right-align-text">
                                        @if($details)
                                        @foreach($details as $key => $detail)
                                        @if($key == 0)
                                        {{$details->sum('debit') + $detail->where("credit", 0)->sum('vat_amount')}}
                                        @endif
                                        @endforeach
                                        @endif
                                        </th>
                                        <th class="right-align-text">
                                        @if($details)
                                        @foreach($details as $key => $detail)
                                        @if($key == 0)
                                        {{$details->sum('credit') + $detail->where("debit", 0)->sum('vat_amount')}}
                                        @endif
                                        @endforeach
                                        @endif
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->



</body>
</html>