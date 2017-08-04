@extends('layouts.admin')

@section('page_title')

Bills

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
                                Bills
                            </h2><br>
                             <div class="row clearfix">
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">

                                    <a href="bills-create.html" class="btn btn-primary waves-effect">+Add</a>
                                    
                                    <input type="text" class="datepicker form-control" placeholder="From Date">

  
                                    <input type="text" class="datepicker form-control" placeholder="To Date">
                                                          
                                    <b>Vendors</b>
                                    <select class="form-control show-tick" data-live-search="true">
                                        <option>Select Vendor</option>
                                        <option>Georgi Popovich</option>
                                        <option>Otabek Altin</option>
                                        <option>Some Vendor Name</option>
                                    </select>

                                </div>
                            </div>
                        </div>
                        <div class="body table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>Reference No.</th>
                                        <th>Vendor</th>
                                        <th>Bill Date</th>
                                        <th>Due Date</th>
                                        <th>Amount Due</th>
                                        <th>Balance Amount</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Reference No.</th>
                                        <th>Vendor</th>
                                        <th>Bill Date</th>
                                        <th>Due Date</th>
                                        <th>Due Amount</th>
                                        <th>Balance Amount</th>
                                        <th>Action</th>

                                    </tr>
                                </tfoot>
                                <tbody>
                                    <tr>
                                        <td>2011-COM0001-B-00001</td>
                                        <td>Sara Crispino</td>
                                        <td>2016-09-20</td>
                                        <td>2016-09-30</td>
                                        <td>2000</td>
                                        <td>1000</td>
                                        <td>
                                            <a href ="bills-create.html" class="btn btn-default btn-xs waves-effect"><i class="material-icons">create</i></a>
                                            <button class="btn btn-default btn-xs waves-effect" data-toggle="modal" data-type="confirm" data-target="#deleteBills"><i class="material-icons">delete</i></button>
                           
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>2011-COM0001-B-00002</td>
                                        <td>Mila Babicheva</td>
                                        <td>2017-01-01</td>
                                        <td>2017-02-01</td>
                                        <td>20000</td>
                                        <td>20000</td>
                                        <td>
                                            <a href ="bills-create.html" class="btn btn-default btn-xs waves-effect"><i class="material-icons">create</i></a>
                                            <button class="btn btn-default btn-xs waves-effect" data-toggle="modal" data-type="confirm" data-target="#deleteBills"><i class="material-icons">delete</i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
            
            <!-- Delete Bills -->

            <div class="modal fade" id="deleteBills" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="smallModalLabel">Delete a Bill</h4><br>
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
           <!--End Delete Bills--> 

        </div>

	
@stop