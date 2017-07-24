@extends('layouts.admin')

@section('page_title')

Cash Disbursement

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
                                Cash Disbursement
                            </h2><br>
                             <div class="row clearfix js-sweetalert">
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">

                                    <a href="cashdis-create.html" class="btn btn-primary waves-effect">+Add</a>

                                </div>
                            </div>
                            

                        </div>
                        <div class="body table-responsive">
                            <table id="mainTable" class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Reference No.</th>
                                        <th>Date</th>
                                        <th>Vendor</th>
                                        <th>Description</th>
                                        <th>Account</th>
                                        <th>Amount</th>
                                        <th>VAT Code</th>
                                        <th>VAT Amount</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No.</th>
                                        <th>Reference No.</th>
                                        <th>Date</th>
                                        <th>Vendor</th>
                                        <th>Description</th>
                                        <th>Account</th>
                                        <th>Amount</th>
                                        <th>VAT Code</th>
                                        <th>VAT Amount</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <tr>
                                        <td>02</td>
                                        <td>001</td>
                                        <td>February 17 2017</td>
                                        <td>McDonalds</td>
                                        <td>Meals</td>
                                        <td>Travel Meals</td>
                                        <td>112</td>
                                        <td>IV Services</td>
                                        <td>12.00</td>
                                        <td>
                                            <a href ="cashdis-create.html" class="btn btn-default btn-xs waves-effect"><i class="material-icons">create</i></a>
                                            <button class="btn btn-default btn-xs waves-effect" data-toggle="modal" data-type="confirm" data-target="#deleteCashDis"><i class="material-icons">delete</i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>03</td>
                                        <td>002</td>
                                        <td>February 29 2017</td>
                                        <td>Globe Telecom</td>
                                        <td>Internet</td>
                                        <td>Comm., Light, Water</td>
                                        <td>999</td>
                                        <td>IV Services</td>
                                        <td>12.00</td>
                                        <td>
                                            <a href ="cashdis-create.html" class="btn btn-default btn-xs waves-effect"><i class="material-icons">create</i></a>
                                            <button class="btn btn-default btn-xs waves-effect" data-toggle="modal" data-type="confirm" data-target="#deleteCashDis"><i class="material-icons">delete</i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
            
            <!-- Delete journals -->

            <div class="modal fade" id="deleteCashDis" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="smallModalLabel">Delete a Cash Disbursement</h4><br>
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
           <!--End Delete Journals--> 

        </div>

	
@stop