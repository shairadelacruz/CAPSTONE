@extends('layouts.admin')

@section('page_title')

Assign Task

@endsection

@section('content')

<h1>Edit Task</h1>

{!! Form::model($task,['method'=>'PATCH', 'action'=>['AdminTasksController@update', $task->id]]) !!}

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
		{!! Form:: select('client_id', [''=>'Choose Options'] + $clients ,null, ['class'=>'form-control chosen-select']) !!}
	</div>

	<div class = "form-group">
		{!! Form:: label('user_id', 'Accountant:') !!}
		{!! Form:: select('user_id', [''=>'Choose Options'] + $users ,null, ['class'=>'form-control chosen-select']) !!}
	</div>

	<div class = "form-group">
		{!! Form:: label('log_id', 'Document:') !!}
		{{Form::select('log_id[]',$logs,null,['class'=>'chosen-select form-control', 'multiple'=>'multiple'], array($task->log->first()->reference_no), array('multiple'))}}
	</div>

	<div class = "form-group">
		{!! Form:: label('deadline', 'Set Deadline:') !!}
		{!! Form:: date('deadline',$task->deadline, ['class'=>'form-control datepicker']) !!}
	</div>

	<div class = "form-group">
		{!! Form:: label('task_type', 'Task types:') !!}
		{!! Form:: select('task_type', array(0=>'None/Other', 1=>'Journal', 2=>'Accounts Receivable', 3=>'Accounts Payable'), 0, ['class'=>'form-control show-tick']) !!}
	</div>

	<div class = "form-group">
		{!! Form:: label('status', 'Status:') !!}
		{!! Form:: select('status', array(0=>'Pending', 1=>'Done', 2=>'For Quality Assurance', 3=>'For Revision'), 0, ['class'=>'form-control show-tick']) !!}
	</div>

	<div class = "form-group">
		<a class="btn btn-default" href="{{ URL::previous() }}">Cancel</a>
		{!! Form:: submit('Save', ['class'=>'btn btn-primary']) !!}
	</div>
	
	{!! Form::close() !!}

	@include('includes.form_error')

@stop