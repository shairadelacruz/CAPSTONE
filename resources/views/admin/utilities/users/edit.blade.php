@extends('layouts.admin')

@section('page_title')

Users

@endsection

@section('content')

<h1>Edit Users</h1>


			{!! Form::model($user,['method'=>'PATCH', 'action'=>['AdminUsersController@update', $user->id], 'files' => true]) !!}

			<div class = "form-group">
				{!! Form:: label('name', 'Name:') !!}
				{!! Form:: text('name',null, ['class'=>'form-control']) !!}
			</div>

			<div class = "form-group">
				{!! Form:: label('email', 'Email:') !!}
				{!! Form:: text('email',null, ['class'=>'form-control']) !!}

			</div>

			<div class = "form-group">
				{!! Form:: label('role', 'Role:') !!}
				{!! Form:: select('role', [''=>$user_role]  + $roles ,null, ['class'=>'form-control']) !!}

			</div>

			<div class = "form-group">
				{!! Form:: label('is_active', 'Status:') !!}
				{!! Form:: select('is_active', array(1=>'Active', 0=>'Not Active'), null, ['class'=>'form-control']) !!}

			</div>

			<div class = "form-group">
				{!! Form:: label('password', 'Password:') !!}
				{!! Form:: password('password', ['class'=>'form-control']) !!}

			</div>

			<div class = "form-group">
				<a class="btn btn-default" href="{{ URL::previous() }}">Cancel</a>
				{!! Form:: submit('Edit User', ['class'=>'btn btn-primary']) !!}
			</div>

		{!! Form::close() !!}

	
		@include('includes.form_error')

@stop