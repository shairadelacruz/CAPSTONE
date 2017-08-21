@extends('layouts.admin')

@section('page_title')

Clients

@endsection

@extends('includes.form_includes');

@section('content')

<h1>Create Client</h1>

	
	{!! Form::open(['method'=>'POST', 'action'=>'AdminClientsController@store']) !!}

	<div class = "form-group">
		{!! Form:: label('company_name', 'Company Name:') !!}
		{!! Form:: text('company_name',null, ['class'=>'form-control']) !!}
	</div>

	<div class = "form-group">
		{!! Form:: label('legal_name', 'Legal Name:') !!}
		{!! Form:: text('legal_name',null, ['class'=>'form-control']) !!}

	</div>

	<div class = "form-group">
		{!! Form:: label('address', 'Address:') !!}
		{!! Form:: textarea('address',null, ['class'=>'form-control no-resize']) !!}
	</div>	

	<div class = "form-group">
		{!! Form:: label('financial_year', 'Financial Year:') !!}
		{!! Form:: date('financial_year',null, ['class'=>'form-control datepicker']) !!}
	</div>

	<div class = "form-group">
		{!! Form:: label('contact_name', 'Name of Contact:') !!}
		{!! Form:: text('contact_name',null, ['class'=>'form-control datepicker']) !!}
	</div>

	<div class = "form-group">
		{!! Form:: submit('Create Client', ['class'=>'btn btn-primary']) !!}
	</div>
	
	{!! Form::close() !!}

	@include('includes.form_error')

@stop