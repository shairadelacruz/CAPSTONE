@extends('layouts.admin')

@section('page_title')

Assign Client

@endsection

@section('content')

<h1>Assign Client</h1>

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
		{!! Form:: submit('Save', ['class'=>'btn btn-primary']) !!}
	</div>
	
	{!! Form::close() !!}

	@include('includes.form_error')

@stop