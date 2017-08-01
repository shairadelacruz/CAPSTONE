@extends('layouts.user')

@section('page_title')

Customer

@endsection

@section('content')

<h1>Create Customer</h1>
        
    {!! Form::open(['method'=>'POST', 'action'=>['UserCustomerController@store', $client_id]]) !!}
    
    {!! Form:: hidden('client_id', $client_id) !!}      
        
		<div class="form-group form-float">
            <div class="form-line">
                {!! Form:: label('name', 'Customer Name:') !!}
				{!! Form:: text('name',null, ['class'=>'form-control']) !!}
            </div>
        </div>
        <div class="form-group form-float">
            <div class="form-line">
                {!! Form:: label('first_name', 'First Name of Contact:') !!}
				{!! Form:: text('first_name',null, ['class'=>'form-control']) !!}
            </div>
        </div>
        <div class="form-group form-float">
            <div class="form-line">
                {!! Form:: label('middle_name', 'Middle Name of Contact:') !!}
				{!! Form:: text('middle_name',null, ['class'=>'form-control']) !!}
            </div>
        </div>
        <div class="form-group form-float">
            <div class="form-line">
                {!! Form:: label('last_name', 'Last Name of Contact:') !!}
				{!! Form:: text('last_name',null, ['class'=>'form-control']) !!}
            </div>
        </div>

        <div class="form-group form-float">
            <div class="form-line">
				{!! Form:: label('email', 'Email:') !!}
				{!! Form:: text('email',null, ['class'=>'form-control']) !!}
            </div>
        </div>

        <div class="form-group form-float">
            <div class="form-line">
                {!! Form:: label('address1', 'Address:') !!}
				{!! Form:: textarea('address1',null, ['class'=>'form-control no-resize']) !!}
            </div>
        </div>
         <div class="form-group form-float">
            <div class="form-line">
                {!! Form:: label('address2', 'Shipping Address:') !!}
				{!! Form:: textarea('address2',null, ['class'=>'form-control no-resize']) !!}
            </div>
        </div>

        <div class="form-group form-float">
            <div class="form-line">
				{!! Form:: label('phone', 'Phone:') !!}
				{!! Form:: text('phone',null, ['class'=>'form-control']) !!}
            </div>
        </div>

        <div class="form-group form-float">
            <div class="form-line">
				{!! Form:: label('mobile', 'Mobile:') !!}
				{!! Form:: text('mobile',null, ['class'=>'form-control']) !!}
            </div>
        </div>

        <div class="form-group form-float">
            <div class="form-line">
				{!! Form:: submit('Create Customer', ['class'=>'btn btn-primary']) !!}
            </div>
        </div>

	{!! Form::close() !!}

@include('includes.form_error')

@stop