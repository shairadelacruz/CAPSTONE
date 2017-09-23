@extends('layouts.admin')

@section('page_title')

Log

@endsection

@section('content')

<h1>Create Log Entry</h1>

	{!! Form::open(['method'=>'POST', 'action'=>'AdminLogsController@store', 'files'=>true]) !!}
	
            
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                             <div class="row clearfix js-sweetalert">
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                    <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                                	<label>Date Received</label>
                                    <input type="date" class="datepicker form-control" placeholder="Date Received" name="date_received">
                                    <label>Client</label>
                                    <select class="form-control chosen-select" title="Client" name="client_id">
                                    	<option value="0" selected="true" disabled="true"></option>
                                        @if($clients)
		                                @foreach($clients as $client)
		                                    <option value="{{$client->id}}">{{$client->company_name}}</option>
		                                @endforeach
		                                @endif
                                    </select>
                                    <label>Received From</label>
                                    <input type="text" class="form-control" name="received_from">
                                </div>
                            </div>

                        </div>
                        <div class="body table-responsive">
                            <table id="mainTable" class="inventoryForCompute table table-bordered table-striped table-hover dataTable">
                                <thead>
                                    <tr>
                                        <th>Reference No.</th>
                                        <th>Document Type</th>
                                        <th>Document</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <input type="text" class="form-control" name="reference_no[]">
                                        </td>
                                        <td>
                                            <select class="form-control show-tick chosen-select" title="Nothing Selected" name="document_type_id[]">
                                                <option value="0" selected="true" disabled="true"></option>
		                                        @if($documents)
				                                @foreach($documents as $document)
				                                    <option value="{{$document->id}}">{{$document->name}}</option>
				                                @endforeach
				                                @endif
                                    		</select>
                                        </td>
                                        <td><input type="file" name="document_path[]"></td>
                                        <td><input type="button" class="btn btn-default" onclick="removeRow(this)" value="X"></td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr><td><span class="btn btn-default" onclick="addRow()">Add Line</span></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    </tr>
                                </tfoot>
                            </table>

                                <a class="btn btn-default" href="{{ URL::previous() }}">Cancel</a>
                               <input type='submit' value='Create' class="btn btn-success">
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->

	
	{!! Form::close() !!}

	@include('includes.form_error')

	<script>
		function addRow() {
			var tr = '<tr>'+
				'<td><input type="text" class="form-control" name="reference_no[]"></td>'+
				'<td>'+
				'<select class="form-control show-tick chosen-select" title="Nothing Selected" name="document_type_id[]">'+
				'<option value="0" selected="true" disabled="true"></option>'+
				'@if($documents)'+
				'@foreach($documents as $document)'+
				'<option value="{{$document->id}}">{{$document->name}}</option>'+
				'@endforeach'+
				'@endif'+
				'</select>'+
				'</td>'+
				'<td><input type="file" name="document_path[]"></td>'+
				'<td><input type="button" class="btn btn-default" onclick="removeRow(this)" value="X"></td>'+
				'</tr>';
			$('tbody').append(tr);
			$(".chosen-select").chosen({width: "100%"})
		}
	</script>
	<script>
		function removeRow(btn) {
			var row = btn.parentNode.parentNode;
			row.parentNode.removeChild(row);
		}
	</script>
@stop