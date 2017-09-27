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
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>COA</th>
                                        <th>Category</th>
                                        <th>Debit</th>
                                        <th>Credit</th>
                                        <th>Net Movement</th>

                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th></th>
                                        <th>Total</th>
                                        <th>Debit Total</th>
                                        <th>Credit Total</th>
                                        <th></th>

                                    </tr>
                                </tfoot>
                                <tbody>
                                    
                                    @if($ledgers)
                                    @foreach($ledgers as $ledger)
                                    <tr>
                                        <td>{{$ledger->name}}</td>
                                        <td>{{$ledger->coacategory->name}}</td>
                                        <td>{{$ledger->journals_details->sum('debit')}}</td>
                                        <td>{{$ledger->journals_details->sum('credit')}}</td>
                                        <td>{{$ledger->journals_details->sum('debit') - $ledger->journals_details->sum('credit')}}</td>
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

    
@stop