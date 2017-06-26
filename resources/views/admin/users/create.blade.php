@extends('layouts.admin')

@section('page_title')

Users

@endsection

@section('content')

<h1>Create Users</h1>

	{!! Form::open(['method'=>'POST', 'action'=>'AdminUsersController@store']) !!}

	<div class = "form-group">
		{!! Form:: label('name', 'Name:') !!}
		{!! Form:: text('name',null, ['class'=>'form-control']) !!}
	</div>

	<div class = "form-group">
		{!! Form:: label('email', 'Email:') !!}
		{!! Form:: text('email',null, ['class'=>'form-control']) !!}

	</div>

	<div class = "form-group">
		{!! Form:: label('role_id', 'Role:') !!}
		{!! Form:: select('role_id', [''=>'Choose Options'] + $roles ,null, ['class'=>'form-control']) !!}

	</div>

	<div class = "form-group">
		<div class="row clearfix">
			{!! Form:: label('is_active', 'Status:') !!}
			{!! Form:: select('is_active', array(1=>'Active', 0=>'Not Active'), 0, ['class'=>'form-control show-tick']) !!}
		</div>
	</div>

	<div class = "form-group">
		{!! Form:: label('password', 'Password:') !!}
		{!! Form:: password('password', ['class'=>'form-control']) !!}
	</div>

	<div class = "form-group">
		{!! Form:: submit('Create User', ['class'=>'btn btn-primary']) !!}
	</div>
	
	{!! Form::close() !!}

	@include('includes.form_error')

@stop