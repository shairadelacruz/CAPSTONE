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
                                General Ledger
                            </h2><br>
                             <div class="row clearfix js-sweetalert">
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                    

                                    <label>From: </label>
                                   {{request()->route('start')}}
                                   <label>To: </label>
                                    {{request()->route('end')}}

                                </div>
                            </div>
                            </center>
                        </div>
                        <div class="body table-responsive">
                            @if($coas)
                            @foreach($coas as $coa)
                            <h4>{{$coa->name}}</h4>
                            <table class="table table-bordered table-striped table-hover dataTable">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Transaction</th>
                                        <th>Debit</th>
                                        <th>Credit</th>
                                        <th style="display:none;"></th>
                                        <th>Running Balance</th>
                                    </tr>
                                </thead>

                                <tbody>  
                                    @if($ledgers)
                                    @foreach($ledgers as $ledger)
                                    @foreach($ledger->journal_details as $detail)
                                    @if($coa->id == $detail->coa_id)
                                    <tr>
                                        <td>{{$detail->journal->date->toDateString()}}</td>
                                        <td>{{$detail->journal->transaction_no}}</td>
                                        <td class="right-align-text">{{$detail->debit}}</td>
                                        <td class="right-align-text">{{$detail->credit}}</td>
                                        <td class="credeb" style="display:none;">{{($detail->debit - $detail->credit)}}</td>
                                        <td class="runningBal right-align-text"></td>
                                    </tr>
                                    @endif
                                    @endforeach
                                    @endforeach
                                    @endif
                                </tbody>
                                                                <tfoot>
                                    
                                    <tr>
                                        <th>Total</th>
                                        <th></th>
                                        <th class="right-align-text">
                                            @if($ledgers)
                                            @foreach($ledgers as $key => $ledger)
                                            @if($key == 0)
                                            @foreach($ledger->journal_details as $key1 => $detail)
                                            @if($key1 == 0)

                                            {{$detail->where('coa_id', $coa->id)->sum('debit')}}

                                            @endif
                                            @endforeach
                                            @endif
                                            @endforeach
                                            @endif
                                        </th>
                                        <th class="right-align-text">
                                            @if($ledgers)
                                            @foreach($ledgers as $key => $ledger)
                                            @if($key == 0)
                                            @foreach($ledger->journal_details as $key1 => $detail)
                                            @if($key1 == 0)

                                            {{$detail->where('coa_id', $coa->id)->sum('credit')}}

                                            @endif
                                            @endforeach
                                            @endif
                                            @endforeach
                                            @endif
                                        </th>
                                        <th style="display:none;"></th>
                                        <th class="right-align-text">
                                            @if($ledgers)
                                            @foreach($ledgers as $key => $ledger)
                                            @if($key == 0)
                                            @foreach($ledger->journal_details as $key1 => $detail)
                                            @if($key1 == 0)

                                            {{$detail->where('coa_id', $coa->id)->sum('debit') - $detail->where('coa_id', $coa->id)->sum('credit')}}

                                            @endif
                                            @endforeach
                                            @endif
                                            @endforeach
                                            @endif
                                        </th>

                                    </tr>
                
                                </tfoot>
                            </table>
                            @endforeach
                                   @endif
                            <h4>Value Added Tax</h4>
                            <table class="table table-bordered table-striped table-hover dataTable">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Transaction</th>
                                        <th>Debit</th>
                                        <th>Credit</th>
                                        <th style="display:none;"></th>
                                        <th>Running Balance</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    


                                <tbody>  
                                    @if($details)
                                    @foreach($details as $detail)
                                    @if($detail->vat_id != 0)
                                    <tr>
                                        <td>{{$detail->journal->date->toDateString()}}</td>
                                        <td>{{$detail->journal->transaction_no}}</td>
                                        <td class="right-align-text">
                                            @if($detail->credit == 0)
                                            {{$detail->vat_amount}}
                                            @endif
                                        </td>
                                        <td class="right-align-text">
                                            @if($detail->debit == 0)
                                            {{$detail->vat_amount}}
                                            @endif
                                        </td>
                                        <td class="credeb" style="display:none;"></td>
                                        <td class="runningBal right-align-text"></td>
                                    </tr>
                                    @endif
                                    @endforeach
                                    @endif
                                </tbody>
                                    <tr>
                                        <th>Total</th>
                                        <th></th>
                                        <th class="right-align-text"></th>
                                        <th class="right-align-text"></th>
                                        <th style="display:none;"></th>
                                        <th class="right-align-text"></th>

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