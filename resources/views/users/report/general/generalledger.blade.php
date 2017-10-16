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
                                    <button class="btnPrint btn-success">Print</button>

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
                                    </tr>
                                </thead>
                                <tfoot>
                                    
                                    <tr>
                                        <th>Running Balance</th>
                                        <th></th>
                                        <th></th>
                                        <th>
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
                                        <td>{{$detail->journal->transaction_no}}</td>
                                        <td>{{$detail->debit}}</td>
                                        <td>{{$detail->credit}}</td>
                                    </tr>
                                    @endif
                                    @endforeach
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                            @endforeach
                                   @endif
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

              
</script>
@endsection

@stop