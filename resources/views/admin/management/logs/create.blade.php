@extends('layouts.admin')

@section('page_title')

Log

@endsection

@section('content')

<h1>Create Log Entry</h1>

	<form>

	<div class = "form-group">
		{!! Form:: label('receive_date', 'Date Received:') !!}
		{!! Form:: date('receive_date',null, ['class'=>'form-control datepicker']) !!}
	</div>

	<div class = "form-group">
		{!! Form:: label('role', 'Document Type:') !!}
		{!! Form:: select('role', [''=>'Choose Options'] ,null, ['class'=>'form-control']) !!}

	</div>

	<div class = "form-group">
		{!! Form:: label('ref_no', 'Reference No:') !!}
		{!! Form:: text('ref_no',null, ['class'=>'form-control']) !!}
	</div>

	<div class = "form-group">
		{!! Form:: label('email', 'Business:') !!}
		{!! Form:: text('email',null, ['class'=>'form-control']) !!}

	</div>

	<div class = "form-group">
		{!! Form:: label('giver', 'Received From:') !!}
		{!! Form:: text('giver',null, ['class'=>'form-control']) !!}
	</div>

	<div class = "form-group">
		{!! Form:: label('receiver', 'Received By:') !!}
		{!! Form:: text('receiver',null, ['class'=>'form-control']) !!}
	</div>

	<div class = "form-group">
		{!! Form:: submit('Save', ['class'=>'btn btn-primary']) !!}
	</div>
	
	{!! Form::close() !!}

	@include('includes.form_error')

@stop