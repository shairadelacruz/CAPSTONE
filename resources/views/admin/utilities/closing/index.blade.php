@extends('layouts.admin')

@section('page_title')

Close Transactions

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
                                Closing Transactions
                            </h2><br>

                        </div>
                        <div class="body">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>Code</th>
                                        <th>Company Name</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Code</th>
                                        <th>Company Name</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                @if($closings)
                                    @foreach($closings as $closing)
                                    @if($closing->status == 1)
                                    <tr>
                                        <td>{{$closing->client->code}}{{$closing->client->id}}</td>
                                        <td>{{$closing->client->company_name}}</td>
                                        <td>{{ \Carbon\Carbon::parse($closing->created_at)->format('m-Y') }}</td>
                                        <td>{{$closing->status == 1 ? 'Open' : 'Closed'}}</td>
										<td></td>
                                    </tr>
                                    @endif
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