@extends('layouts.admin')

@section('page_title')

Assign Task

@endsection

@section('content')

<h1>Assign Task</h1>

	<form>

	<div class = "form-group">
		{!! Form:: label('client', 'Client:') !!}
		{!! Form:: select('client', [''=>'Select Client'] ,null, ['class'=>'form-control']) !!}

	</div>

	<div class = "form-group">
		{!! Form:: label('user', 'Accountant:') !!}
		{!! Form:: select('user', [''=>'Select Accountant'] ,null, ['class'=>'form-control']) !!}

	</div>

	<div class = "form-group">
		{!! Form:: label('role', 'Document:') !!}
		{!! Form:: select('role', [''=>'Select Document'] ,null, ['class'=>'form-control']) !!}

	</div>

	<div class = "form-group">
		{!! Form:: label('dead_date', 'Set Deadline:') !!}
		{!! Form:: date('dead_date',null, ['class'=>'form-control datepicker']) !!}
	</div>

	<div class = "form-group">
		{!! Form:: submit('Save', ['class'=>'btn btn-primary']) !!}
	</div>
	
	{!! Form::close() !!}

	@include('includes.form_error')

@stop