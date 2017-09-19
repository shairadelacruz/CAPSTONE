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
		{!! Form:: text('company_name',null, ['class'=>'form-control', 'required']) !!}
	</div>

	<div class = "form-group">
		{!! Form:: label('legal_name', 'Legal Name:') !!}
		{!! Form:: text('legal_name',null, ['class'=>'form-control']) !!}
	</div>

	<div class = "form-group">
		{!! Form:: label('code', 'Code:') !!}
		{!! Form:: text('code',null, ['class'=>'form-control','maxlength' => 3,'required']) !!}
	</div>

	<div class = "form-group">
		{!! Form:: label('tin_number', 'Tin Number:') !!}
		{!! Form:: text('tin_number',null, ['class'=>'form-control', 'required']) !!}
	</div>

	<div class = "form-group">
		{!! Form:: label('address', 'Address:') !!}
		{!! Form:: textarea('address',null, ['class'=>'form-control no-resize']) !!}
	</div>	

	<div class = "form-group">
		{!! Form:: label('business_id', 'Industry Type:') !!}
	    {!! Form:: select('business_id', [''=>'Choose Options'] + $industries ,null, ['class'=>'form-control chosen-select']) !!}
    </div>

	<div class = "form-group">
		{!! Form:: label('financial_year', 'Financial Year (Enter first month):') !!}
		{!! Form:: date('financial_year',null, ['class'=>'form-control datepicker']) !!}
	</div>

    <h3>Contact Person</h3>

	<div class = "form-group">
		{!! Form:: label('contact_name', 'Name of Contact:') !!}
		{!! Form:: text('contact_name',null, ['class'=>'form-control datepicker','required']) !!}
	</div>

	<div class = "form-group">
		{!! Form:: label('email', 'Email:') !!}
		{!! Form:: text('email',null, ['class'=>'form-control']) !!}
    </div>

    <div class = "form-group">
		{!! Form:: label('phone', 'Phone:') !!}
		{!! Form:: text('phone',null, ['class'=>'form-control']) !!}
    </div>      

    <div class = "form-group">
		{!! Form:: label('mobile', 'Mobile:') !!}
		{!! Form:: text('mobile',null, ['class'=>'form-control']) !!}
    </div>
        
	<div class = "form-group">
		<a class="btn btn-default" href="{{ URL::previous() }}">Cancel</a>
		{!! Form:: submit('Create Client', ['class'=>'btn btn-primary']) !!}
	</div>

	
	{!! Form::close() !!}

	@include('includes.form_error')

@stop