@extends('layouts.user')

@section('page_title')

Products and Services

@endsection

@section('content')

<h1>Add a Product or Service</h1>

	{!! Form::open(['method'=>'POST', 'action'=>'AdminUsersController@store']) !!}

	<div class = "form-group">
		{!! Form:: label('name', 'Name:') !!}
		{!! Form:: text('name',null, ['class'=>'form-control']) !!}
	</div>

	<div class = "form-group">
		{!! Form:: label('price', 'Price:') !!}
		{!! Form:: text('price',null, ['class'=>'form-control']) !!}

	</div>

	<div class = "form-group">
		{!! Form:: label('desc', 'Description:') !!}
		{!! Form:: textarea('desc',null, ['class'=>'form-control']) !!}

	</div>

	<div class = "form-group">
		{!! Form:: label('tax', 'Tax:') !!}
		{!! Form:: select('tax', [''=>'VAT'] ,null, ['class'=>'form-control']) !!}

	</div>

	<input type="checkbox" id="cbInvoicesAdd" oncheck="check()"/>
    <label for="cbInvoicesAdd">Product/Service allowed to be added to Invoices</label>

	<div class = "form-group">
		{!! Form:: label('inc_acc', 'Income Account:') !!}
		{!! Form:: select('inc_acc', [''=>'Sales'] ,null, ['class'=>'form-control']) !!}

	</div>

	<input type="checkbox" id="cbBillsAdd"/>
    <label for="cbBillsAdd">Product allowed to be added to Bills</label>

	<div class = "form-group">
		{!! Form:: label('exp_acc', 'Expense Account:') !!}
		{!! Form:: select('exp_acc', [''=>'Accounting Fees'] ,null, ['class'=>'form-control']) !!}

	</div>

	<div class = "form-group">
		{!! Form:: submit('Save', ['class'=>'btn btn-primary']) !!}
	</div>
	
	{!! Form::close() !!}

	@include('includes.form_error')

@stop