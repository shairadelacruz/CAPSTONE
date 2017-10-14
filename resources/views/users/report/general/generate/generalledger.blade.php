
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
                                    

                                    <label>From: </label>
                                   {{request()->route('start')}}
                                   <label>To: </label>
                                    {{request()->route('end')}}

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
                                        <th></th>

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
