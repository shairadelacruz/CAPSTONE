@extends('layouts.admin')

@section('page_title')

VAT

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
                                VAT CODES
                            </h2><br>
                             <div class="row clearfix js-sweetalert">
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">

                                    <button type="button" class="btn btn-primary waves-effect" data-toggle="modal" data-target="#addVAT">+Add</button>
                                </div>
                            </div>

                        </div>
                        <div class="body">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>VAT Code</th>
                                        <th>Rate</th>
                                        <th>Description</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>VAT Code</th>
                                        <th>Rate</th>
                                        <th>Description</th>
                                        <th>Action</th>

                                    </tr>
                                </tfoot>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <button class="btn btn-default btn-xs waves-effect" data-toggle="modal" data-target="#editVAT"><i class="material-icons">create</i></button>
                                            <button class="btn btn-default btn-xs waves-effect" data-toggle="modal" data-type="confirm" data-target="#deleteVAT"><i class="material-icons">delete</i></button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
                
            
            <!-- Add VAT -->
            <div class="modal fade" id="addVAT" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="smallModalLabel">Add VAT Code</h4><br>
                        </div>
                        <div class="modal-body">
                            
                            <div class="row clearfix">
                                <form id="form_validation" method="POST">
                                
                                    
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="name" required>
                                            <label class="form-label">Name</label>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                        <input type="number" class="form-control" name="number" required>
                                        <label class="form-label">Number</label>
                                        </div>
                                    </div>
                                    
                                     <div class="form-group form-float">
                                        <div class="form-line">
                                            <textarea name="description" cols="30" rows="5" class="form-control no-resize"></textarea>
                                            <label class="form-label">Description</label>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-link waves-effect">SAVE</button>
                                        <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                                    </div>
                                 
                                </form>
                            </div>

                            
                        </div>
                    </div>
                </div>
            </div>
           <!--End Add VAT--> 
            
            
            <!-- Edit VAT -->
            <div class="modal fade" id="editVAT" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="smallModalLabel">Edit VAT Code</h4><br>
                        </div>
                        <div class="modal-body">
                            
                            <div class="row clearfix">
                                <form id="form_validation" method="POST">
                                
                                    
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="name" required>
                                            <label class="form-label">Name</label>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                        <input type="number" class="form-control" name="number" required>
                                        <label class="form-label">Number</label>
                                        </div>
                                    </div>
                                    
                                     <div class="form-group form-float">
                                        <div class="form-line">
                                            <textarea name="description" cols="30" rows="5" class="form-control no-resize"></textarea>
                                            <label class="form-label">Description</label>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-link waves-effect">SAVE CHANGES</button>
                                        <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                                    </div>
                                 
                                </form>
                            </div>

                            
                        </div>
                    </div>
                </div>
            </div>
           <!--End Edit VAT--> 
            
            <!-- Delete VAT -->
            <div class="modal fade" id="deleteVAT" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="smallModalLabel">Delete VAT code</h4><br>
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
           <!--End Delete VAT--> 

        </div>


@stop