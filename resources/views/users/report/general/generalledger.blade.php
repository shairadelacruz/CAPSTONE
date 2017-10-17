@extends('layouts.admin')

@section('page_title')

General Ledger

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
                                General Ledger
                            </h2><br>
                             <div class="row clearfix js-sweetalert">
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                    

                                    <label>From</label>
                                   <input id="start" type="date" class="form-control date" name="to" id="to" value="{{request()->route('start')}}">
                                   <label>To</label>
                                    <input id="end" type="date" class="form-control date" name="from" id="from" value="{{request()->route('end')}}">
                                    <button class="btnPrint btn-success">Save as PDF</button>
                                    <button class="btnPrintPrev btn-success">Print</button>

                                    <input type="hidden" class="clientHidden" name='client_id' value="{{request()->route('client_id')}}" class="form-control">

                                </div>
                            </div>

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

                                <tbody>  
                                    @if($ledgers)
                                    @foreach($ledgers as $ledger)
                                    @foreach($ledger->journal_details as $detail)
                                    @if($coa->id == $detail->coa_id)
                                    <tr>
                                        <td>{{$detail->journal->date->toDateString()}}</td>
                                        <td><a href="/user/{{request()->route('client_id')}}/accounting/journal/{{$detail->journal->id}}/edit"> {{$detail->journal->transaction_no}}</a></td>
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
                                    
                                    <tr>
                                        <th>Total</th>
                                        <th></th>
                                        <th class="right-align-text"></th>
                                        <th class="right-align-text"></th>
                                        <th style="display:none;"></th>
                                        <th class="right-align-text"></th>

                                    </tr>
                
                                </tfoot>

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
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
        </div>
@section('scripts')
<script type="text/javascript">


    $('#end').on('change', function() {

        //var date=$('#date').val();
        var client_id = $('.clientHidden').val();
        var start = $('#start').val();
        var end = $('#end').val();

        window.location = '/user/'+ client_id +'/reports/generalledger/'+ start +'/'+ end;
    });

    $('.btnPrint').on('click', function() {

        var client_id = $('.clientHidden').val();
        var start = $('#start').val();
        var end = $('#end').val();

        window.location = '/user/'+ client_id +'/reports/generalledger/'+ start +'/'+ end +'/generate';
    });

    $('.btnPrintPrev').on('click', function() {

        var client_id = $('.clientHidden').val();
        var start = $('#start').val();
        var end = $('#end').val();

        window.location = '/user/'+ client_id +'/reports/generalledger/'+ start +'/'+ end +'/print';
    });


    $(document).ready(function(){

        $("table").each(function() {
            var sum = 0;
            $(this).find(".runningBal").each(function() {
                sum += +$(this).prev(".credeb").text();
                $(this).text(sum.toFixed(2));
            });
        })

    });

              
</script>
@endsection

@stop