@extends('layouts.admin')

@section('page_title')

Clients

@endsection

@extends('includes.table_includes')

@section('content')

        <div class="container-fluid">
            
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                Clients
                            </h2><br>
                             <div class="row clearfix js-sweetalert">
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">

                                    <button type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#addClients">+Add</button>

                                </div>
                            </div>

                        </div>
                        <div class="body">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Company Name</th>
                                        <th>Address</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Company Name</th>
                                        <th>Address</th>
                                        <th>Action</th>

                                    </tr>
                                </tfoot>
                                <tbody>
                                    <tr>
                                        <td>A</td>
                                        <td>5%</td>
                                        <td>Food</td>
                                        <td>
                                            <button class="btn btn-default btn-xs waves-effect" data-toggle="modal" data-target="#editClients"><i class="material-icons">create</i></button>
                                            <button class="btn btn-default btn-xs waves-effect" data-toggle="modal" data-type="confirm" data-target="#deleteClients"><i class="material-icons">delete</i></button>
                           
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>B</td>
                                        <td>10%</td>
                                        <td>Clothes</td>
                                        <td>
                                            <button type="button" class="btn btn-default btn-xs waves-effect" data-toggle="modal" data-target="#editClients"><i class="material-icons">create</i></button>
                                            <button class="btn btn-default btn-xs waves-effect" data-toggle="modal" data-type="confirm" data-target="#deleteClients"><i class="material-icons">delete</i></button>
                                            
                                        </td>

                                    </tr>
                                    <tr>
                                        <td>C</td>
                                        <td>50%</td>
                                        <td>Meow</td>
                                        <td>
                                            <button type="button" class="btn btn-default btn-xs waves-effect" data-toggle="modal" data-target="#editClients"><i class="material-icons">create</i></button>
                                            <button class="btn btn-default btn-xs waves-effect" data-toggle="modal" data-type="confirm" data-target="#deleteClients"><i class="material-icons">delete</i></button>
                                            
                                        </td>

                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
           
            <!-- Delete Clients -->
            <div class="modal fade" id="deleteClients" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="smallModalLabel">Delete a client</h4><br>
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
           <!--End Delete Clients--> 

        </div>



	
@stop