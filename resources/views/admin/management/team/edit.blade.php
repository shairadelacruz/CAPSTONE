@extends('layouts.admin')

@section('page_title')

Team

@endsection

@section('content')

<h1>Edit Team</h1>

	{!! Form::model($team,['method'=>'PATCH', 'action'=>['AdminTeamsController@update', $team->id]]) !!}

	<div class = "form-group">
		{!! Form:: label('name', 'Name:') !!}
		{!! Form:: text('name',null, ['class'=>'form-control']) !!}
	</div>
	

	<div class = "form-group">
		{!! Form:: label('team_leader', 'Team Leader:') !!}<br>
		{{Form::select('team_leader[]',$team_leaders,null,array('name'=>'team_leader[]'))}}
	</div>


	<div class = "form-group">
		{!! Form:: label('user_id', 'Employees:') !!}<br>
		<ul>
			@foreach($team->users as $user)
			<li>{{$user->name}}</li>
			@endforeach
		</ul>
		{{Form::select('user_id[]',$users,null,array('multiple'=>'multiple','reference_no'=>'log_id[]'))}}
	</div>

	<div class = "form-group">
		{!! Form:: submit('Save', ['class'=>'btn btn-primary']) !!}
	</div>
	
	{!! Form::close() !!}

	@include('includes.form_error')

@stop