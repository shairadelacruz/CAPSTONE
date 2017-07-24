@extends('layouts.user')

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
                             <div class="row clearfix js-sweetalert">
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
                            </div>

                        </div>
                        <div class="body">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Type</th>
                                        <th>Description</th>
                                        <th>Category</th>
                                        <th>Account</th>
                                        <th>Amount</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Date</th>
                                        <th>Type</th>
                                        <th>Description</th>
                                        <th>Category</th>
                                        <th>Account</th>
                                        <th>Amount</th>
                                        <th>Action</th>

                                    </tr>
                                </tfoot>
                                <tbody>
                                    <tr>
                                        <td>January 2 2017</td>
                                        <td>Expense</td>
                                        <td>A description</td>
                                        <td>Uncategorized Expense</td>
                                        <td>Cash on Hand</td>
                                        <td>1000</td>
                                        <td>
                                            <button class="btn btn-default btn-xs waves-effect" data-toggle="modal" data-target="#editTransaction"><i class="material-icons">create</i></button>
                                            <button class="btn btn-default btn-xs waves-effect" data-toggle="modal" data-type="confirm" data-target="#deleteTransaction"><i class="material-icons">delete</i></button>
                           
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>December 25 2016</td>
                                        <td>Income</td>
                                        <td>Another description</td>
                                        <td>Uncategorized Income</td>
                                        <td>Cash on Hand</td>
                                        <td>2300</td>
                                        <td>
                                            <button type="button" class="btn btn-default btn-xs waves-effect" data-toggle="modal" data-target="#editTransaction"><i class="material-icons">create</i></button>
                                            <button class="btn btn-default btn-xs waves-effect" data-toggle="modal" data-type="confirm" data-target="#deleteTransaction"><i class="material-icons">delete</i></button>
                                            
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>March 25 2016</td>
                                        <td>Income</td>
                                        <td> </td>
                                        <td>Journal Transaction</td>
                                        <td>Cash on Hand</td>
                                        <td>15000</td>
                                        <td>
                                            <button type="button" class="btn btn-default btn-xs waves-effect" data-toggle="modal" data-target="#editTransaction"><i class="material-icons">create</i></button>
                                            <button class="btn btn-default btn-xs waves-effect" data-toggle="modal" data-type="confirm" data-target="#deleteTransaction"><i class="material-icons">delete</i></button>
                                            
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>May 27 2016</td>
                                        <td>Expense</td>
                                        <td>Payment to John Lennon</td>
                                        <td>Bill Payment</td>
                                        <td>Owner Investment</td>
                                        <td>50000</td>
                                        <td>
                                            <button type="button" class="btn btn-default btn-xs waves-effect" data-toggle="modal" data-target="#editTransaction"><i class="material-icons">create</i></button>
                                            <button class="btn btn-default btn-xs waves-effect" data-toggle="modal" data-type="confirm" data-target="#deleteTransaction"><i class="material-icons">delete</i></button>
                                            
                                        </td>

                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->            
            
            <!-- Delete Transaction -->
            <div class="modal fade" id="deleteTransaction" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="smallModalLabel">Delete an Account</h4><br>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-link waves-effect">DELETE</button>
                            <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CANCEL</button>
                        </div>
                    </div>
                </div>
            </div>
           <!--End Delete Transaction--> 

        </div>

	
@stop