@extends('layouts.admin')

@section('page_title')

Assign Task

@endsection

@section('content')

<h1>Create Task</h1>

	{!! Form::open(['method'=>'POST', 'action'=>'AdminTasksController@store']) !!}

	<div class = "form-group">
		{!! Form:: label('name', 'Task Name:') !!}
	    {!! Form:: text('name',null, ['class'=>'form-control']) !!}
	</div>

	<div class = "form-group">
		{!! Form:: label('description', 'Description:') !!}
       	{!! Form:: textarea('description',null, ['class'=>'form-control']) !!}
	</div>

	<div class = "form-group">
		{!! Form:: label('client_id', 'Client:') !!}
		{!! Form:: select('client_id', [''=>'Choose Options'] + $clients ,null, ['class'=>'form-control']) !!}
	</div>

	<div class = "form-group">
		{!! Form:: label('user_id', 'Accountant:') !!}
		{!! Form:: select('user_id', [''=>'Choose Options'] + $users ,null, ['class'=>'form-control']) !!}
	</div>

	<div class = "form-group">
		{!! Form:: label('log_id', 'Document:') !!}
		{!! Form:: select('log_id', [''=>'Choose Options'] + $logs ,null, ['class'=>'form-control']) !!}
	</div>

	<div class = "form-group">
		{!! Form:: label('deadline', 'Set Deadline:') !!}
		{!! Form:: date('deadline',null, ['class'=>'form-control datepicker']) !!}
	</div>

	<div class = "form-group">
			{!! Form:: label('status', 'Status:') !!}
			{!! Form:: select('status', array(0=>'Pending', 1=>'Done'), 0, ['class'=>'form-control show-tick']) !!}
	</div>

	<div class = "form-group">
		{!! Form:: submit('Save', ['class'=>'btn btn-primary']) !!}
	</div>
	
	{!! Form::close() !!}

	@include('includes.form_error')

@stop