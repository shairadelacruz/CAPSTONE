@extends('layouts.admin')

@section('page_title')

Log

@endsection

@section('content')

<h1>Create Log Entry</h1>

	{!! Form::open(['method'=>'POST', 'action'=>'AdminLogsController@store']) !!}

	<div class = "form-group">
		{!! Form:: label('reference_no', 'Reference No:') !!}
		{!! Form:: text('reference_no',null, ['class'=>'form-control']) !!}
	</div>
	

	<div class = "form-group">
		{!! Form:: label('date_received', 'Date Received:') !!}
		{!! Form:: date('date_received',\Carbon\Carbon::now(), ['class'=>'form-control datepicker']) !!}
	</div>

	<div class = "form-group">
		{!! Form:: label('document_type_id', 'Document Type:') !!}
		{!! Form:: select('document_type_id', [''=>'Choose Options'] + $documents ,null, ['class'=>'form-control']) !!}
	</div>

	<div class = "form-group">
		{!! Form:: label('client_id', 'Client:') !!}
		{!! Form:: select('client_id', [''=>'Choose Options'] + $clients ,null, ['class'=>'form-control']) !!}

	</div>

	<div class = "form-group">
		{!! Form:: label('received_from', 'Received From:') !!}
		{!! Form:: text('received_from',null, ['class'=>'form-control']) !!}
	</div>

	<div class = "form-group">
		{!! Form:: label('user_id', 'Received By:') !!}
		{!! Form:: select('user_id', [''=>'Choose Options'] + $users ,null, ['class'=>'form-control']) !!}
	</div>

	<div class = "form-group">
		{!! Form:: label('photo_id', 'Photo:') !!}
		{!! Form:: file('photo_id',null, ['class'=>'form-control']) !!}

	</div>


	<div class = "form-group">
		{!! Form:: submit('Save', ['class'=>'btn btn-primary']) !!}
	</div>
	
	{!! Form::close() !!}

	@include('includes.form_error')

@stop