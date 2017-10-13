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
                                    

                                   <input type="date" class="datepicker form-control" placeholder="From Date">

                                    <input type="date" class="datepicker form-control" placeholder="To Date">

                                </div>
                            </div>

                        </div>
                        <div class="body table-responsive">
                            @if($ledgers)
                            @foreach($ledgers as $ledger)
                            <h4>{{$ledger->name}}</h4>
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
                                        <th>Total</th>
                                        <th></th>
                                        <th>Net Movement</th>
                                        <th></th>

                                    </tr>
                                </tfoot>
                                <tbody>  
                                    
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                   
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

    
@stop