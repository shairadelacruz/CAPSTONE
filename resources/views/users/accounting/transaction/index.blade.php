@extends('layouts.admin')

@section('page_title')

Transactions

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
                                Transactions
                            </h2><br>
                             <!--<div class="row clearfix js-sweetalert">
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">

                                    <button type="button" class="btn btn-primary waves-effect" data-target="#addTransaction">+Add</button>
                                    
                                    <input type="text" class="datepicker form-control" placeholder="From Date">

  
                                    <input type="text" class="datepicker form-control" placeholder="To Date">
                                                          
                                    <p><b>Type</b></p>
                                    <select class="form-control show-tick" data-live-search="true">
                                        <option>Select</option>
                                        <option>Income</option>
                                        <option>Expense</option>
                                        <option>Invoice Payment</option>
                                        <option>Bill Payment</option>
                                    </select>
                                    
                                </div>
                            </div>-->

                        </div>
                        <div class="body">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Type</th>
                                        <th>Description</th>
                                        <th>Amount</th>
                                        

                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Date</th>
                                        <th>Type</th>
                                        <th>Description</th>
                                        <th>Amount</th>
                                        

                                    </tr>
                                </tfoot>
                                <tbody>
                                @if($journals)
                                    @foreach($journals as $journal)
                                    <tr>
                                        <td>{{$journal->date->toDateString()}}</td>
                                        <td>@if($journal->type == 0)
                                            Journal
                                            @elseif($journal->type == 1)
                                            Invoice
                                            @elseif($journal->type == 2)
                                            Bill
                                            @elseif($journal->type == 3)
                                            Payment for Invoice
                                            @elseif($journal->type == 4)
                                            Payment for Bill
                                            @endif
                                        </td>
                                        <td>{{$journal->description}}</td>
                                        <td>{{$journal->journal_details->sum('debit')}}</td>
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