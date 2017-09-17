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
										<th>Date</th>
										<th>Modified By</th>
										<th>Date</th>
										<th>Account</th>
										<th>Debit</th>
                                        <th>Credit</th>

                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Date</th>
                                        <th>Modified By</th>
                                        <th>Date</th>
                                        <th>Account</th>
                                        <th>Debit</th>
                                        <th>Credit</th>

                                    </tr>
                                </tfoot>
                                <tbody>

                                    <tr>
                                        <td>fg</td>
										<td>hfg</td>
										<td>gfh</td>
										<td>hfg</td>
										<td>fg</td>
									      
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