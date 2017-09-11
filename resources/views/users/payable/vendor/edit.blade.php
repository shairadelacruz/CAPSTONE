@extends('layouts.admin')

@section('page_title')

Vendors

@endsection

@section('content')

<h1>Edit Vendor</h1>
	{!! Form::model($vendor,['method'=>'PATCH', 'action'=>['UserVendorController@update',$vendor->id,
    $client_id]]) !!}

        {!! Form:: hidden('client_id', $client_id) !!} 

		<div class="form-group form-float">
            <div class="form-line">
                {!! Form:: label('name', 'Vendor Name:') !!}
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
                {!! Form:: label('address', 'Address:') !!}
				{!! Form:: textarea('address',null, ['class'=>'form-control no-resize']) !!}
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
				{!! Form:: submit('Edit Vendor', ['class'=>'btn btn-primary']) !!}
            </div>
        </div>

	{!! Form::close() !!}

@include('includes.form_error')

@stop