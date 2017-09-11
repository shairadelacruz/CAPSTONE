@extends('layouts.admin')

@section('page_title')

Audit Trail

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
                                Audit Trail
                            </h2><br>

                        </div>
                        <div class="body">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
										<th>Name</th>
										<th>Email</th>
										<th>Role</th>
										<th>Status</th>
										<th>Action</th>

                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
										<th>Name</th>
										<th>Email</th>
										<th>Role</th>
										<th>Status</th>
										<th>Action</th>

                                    </tr>
                                </tfoot>
                                <tbody>

                                    <tr>
                                        <td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
									      
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
        </div>

	
@stop